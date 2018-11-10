<?php
    require_once __DIR__.'./../vendor/autoload.php';

    // Initialisation de la session
    if(session_status()!=PHP_SESSION_ACTIVE)
        session_start();


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
        $newsRepository = new \News\Repository\News();
        $newsHydrator = new \News\Hydrator\News();
        //================================
        // Vérification du mdp barmen
        //================================
        if(isset($_POST['serviceCheckBarmen']) && isset($_POST['password'])){
            try {
                $userBarmen = $userRepository->findOneByCodeBarmen($_POST['password']);
                if (isset($userBarmen)) {
                    $arr = array(
                        'status' => true,
                        'barmenId' => $userBarmen->getId()
                    );
                    echo json_encode($arr);
                }
                else{
                    throw new \Exception("Barmen Invalide.");
                }
            }catch(Exception $e){
                $arr = array(
                    'status' => false,
                    'error' => $e->getMessage()
                );

                echo json_encode($arr);
            }
            http_response_code(200);
            return ;
        }

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
                    $userRepository->giveMoney($_POST["id"],$_POST["credit"],$userBarmen->getId());
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
            http_response_code(200);
            return ;

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
                    var_dump($transaction);
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

        //===================================
        //  Récupération d'une news
        //===================================
        else if(isset($_POST['idNews'])){
            $id = $_POST['idNews'];
            $news = $newsRepository->findById($id);
            echo json_encode($newsHydrator->extract($news));
            exit;
        }
        //===================================
        // Upload d'un fichier sur le serveur
        //===================================
        else if(isset($_FILES['fileToUpload']['name'])){
            try{
                //----------------------------
                //Initialisation des variables
                //----------------------------
                $arr = array('status' => false);

                $currentDir = getcwd();
                $uploadDirectory = "/assets/images/articles/";
                $fileExtensions = ['jpeg', 'jpg', 'png','gif'];
                $maxsize=2000000;
                $fileName = $_FILES['fileToUpload']['name'];
                $fileSize = $_FILES['fileToUpload']['size'];
                $fileTmpName = $_FILES['fileToUpload']['tmp_name'];
                $fileType = $_FILES['fileToUpload']['type'];

                $split = explode('.', $fileName);
                $fileExtension = strtolower((end($split)));
                $uploadPath = $currentDir . $uploadDirectory . basename($fileName);

                //Vérification initiale sur le type / taille de fichier
                if (!in_array($fileExtension, $fileExtensions)) {
                    throw new \Exception("Extension autorisé: gif,png ou jpg/jpeg seulement");
                }
                if ($fileSize > $maxsize) {
                    throw new \Exception("Fichier de 2MB");
                }

                // Transfère du fichier dans le dossier d'upload
                $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
                if ($didUpload) {
                    $arr = array(
                        'status' => true,
                        'fileName' =>  $fileName
                    );
                    echo json_encode($arr);
                }else {
                    throw new \Exception("Un problème a eu lieu durant le transfert du fichier depuis le dossier temporaire");
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
