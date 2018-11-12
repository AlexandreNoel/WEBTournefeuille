<?php
    require_once __DIR__.'./../vendor/autoload.php';

    // Initialisation de la session
    if(session_status()!=PHP_SESSION_ACTIVE)
        session_start();

    // Vérification si utilisateur correctement connecté
    if(!isset($_SESSION['authenticated_user'])){
       header('Location: /');
    }
    else{

        $msg="";
        $userRepository = new \Client\Repository\Client();
        $userHydrator = new Client\Hydrator\Client();

        //========================================
        // Gestion du POST
        //========================================
        if(isset($_FILES['image']['name']) && $_FILES['image']['size'] > 0 ) {
            try {
                //----------------------------
                //Initialisation des variables
                //----------------------------
                $currentDir = getcwd();
                $uploadDirectory = "/assets/images/userPic/";
                $fileExtensions = ['jpeg', 'jpg', 'png','gif'];
                $maxsize = 2000000;
                $fileName = $_FILES['image']['name'];
                $fileSize = $_FILES['image']['size'];
                $fileTmpName = $_FILES['image']['tmp_name'];
                $fileType = $_FILES['image']['type'];

                $split = explode('.', $fileName);
                $fileExtension = strtolower((end($split)));
                $uploadPath = $currentDir . $uploadDirectory . basename($fileName);
                $pathImageSrc = $uploadDirectory . basename($fileName);

                //Vérification initiale sur le type / taille de fichier
                if (!in_array($fileExtension, $fileExtensions)) {
                    throw new \Exception("Extension autorisé: png ou jpg/jpeg seulement");
                }
                if ($fileSize > $maxsize) {
                    throw new \Exception("Fichier de 2MB");
                }

                // Transfère du fichier dans le dossier d'upload
                $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
                if ($didUpload) {
                    $_POST['image']=$pathImageSrc;
                } else {
                    throw new \Exception("Un problème a eu lieu durant le transfert du fichier depuis le dossier temporaire");
                }
            } catch (Exception $e) {
                $msg = $e->getMessage();
            }
        }

        if(isset($_POST['email'],$_POST['prenom'],$_POST['nom'],$_POST['pseudo'],$_POST['idutilisateur'])) {
            $userRepository->updateInfo($userHydrator->hydrate($_POST, new \Client\Entity\Client()));
            $msg= $msg . "Update effectuée avec succès";
        }


        //========================================
        // Gestion de l'utilisateur
        //========================================
        /** @var \Client\Entity\Client $user */
        $user =  $_SESSION["authenticated_user"];
        // Mise à jour de l'utilisateur
        $user = $userRepository->findOneByNickname($user->getNickname());
        $_SESSION["authenticated_user"] = $user;
        // Initialisation des variables
        $nickname = $user->getNickname();



        require_once('../view/userInfo.php');
    }


?>
