<?php
    require_once __DIR__.'./../vendor/autoload.php';

    // Initialisation de la session
    if(session_status()!=PHP_SESSION_ACTIVE)
        session_start();


    $_SESSION['authenticated_admin']=true;
    // Vérification si Admin connecté
    if(!isset($_SESSION['authenticated_admin'])){
        header('Location: /');
    }
    else{
        /* Déclaration des gestionnaires Client */
        $userRepository = new \Client\Repository\Client();
        $userHydrator = new \Client\Hydrator\Client();
        $transacRepository = new \Transaction\Repository\Transaction();
        $transacHydrator = new \Transaction\Hydrator\Transaction();
        $productHydrator = new \Product\Hydrator\Product();
        $productRepository = new \Product\Repository\Product();

        //================================
        // Gestion de recherche de client
        //================================
        if(isset($_POST['getUserInfo'])) {
            $nickname = $_POST['getUserInfo'];
            $user = $userRepository->findOneByNickname($nickname);
            echo json_encode($userHydrator->extract($user));
            exit;
        }

        //===================================
        // Créditation d'un client
        //===================================
        else if(isset($_POST["id"]) && isset($_POST["credit"]) && isset($_POST["password"]) ){

            try{
                $userBarmen = $userRepository->findOneByCodeBarmen($_POST['password']);
                if(isset($userBarmen)) {
                    $userRepository->giveMoney($_POST["id"],$_POST["credit"]);
                    $arr = array(
                        'status' => true,
                    );
                    echo json_encode($arr);
                }
                else{
                    throw new Exception("Barmen non valide !");
                }
            }
            catch(Exception $e){
                $arr = array(
                    'status' => false,
                    'error' => $e->getMessage()
                );

                echo json_encode($arr);
            }

        }

        //===================================
        // Validation de la commande
        //===================================
        else if(isset($_POST['command']) && isset($_POST['password'])){
            try{
                $user = $userRepository->findOneByCodeBarmen($_POST['password']);
                if(isset($user)) {
                    $idbarmen = $user->getId();
                    $idclient = $_POST['idutilisateur'];
                    $date = date("Y-m-d H:i:s");
                    $products = $_POST['products'];

                    $prodSpl = new SplObjectStorage();
                    foreach ($products as $productData){
                        $product = $productRepository->findById($productData['id']);
                        if(isset($product)){
                            $prodSpl->attach($product,$productData['qty']);
                        }else{
                            throw new Exception("Problème lors de la récupération des produits en base.");
                        }
                    }

                    $transaction = $transacHydrator->hydrate(
                        ['products' => $prodSpl ?? null,
                            'datecommande' => $date ?? null,
                            'idutilisateur' => $idclient ?? null,
                            'idbarmen' => $idbarmen ?? null,
                        ], new \Transaction\Entity\Transaction()
                    );

                    $idCommande = $transacRepository->create($transaction);

                    // Si commande correctement effectuée
                    if (isset($idCommande) && $idCommande > 0) {
                        echo json_encode(array('status' => true, 'idCommande' => $idCommande));
                    } // Si erreur
                    else {
                        throw new Exception("Commande invalide: Veuillez contacter un admin.");
                    }
                }
                else{
                    throw new Exception("Barmen non valide ! ");
                }
            }
            catch(Exception $e){
                $arr = array(
                    'status' => false,
                    'error' => $e->getMessage()
                );

                echo json_encode($arr);
            }
            http_response_code(200);
            return ;
        }
        http_response_code(400);

    }
