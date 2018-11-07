<?php
/**
 * Created by PhpStorm.
 * User: Lineal
 * Date: 27/10/2018
 * Time: 12:27
 */

require_once __DIR__.'./../vendor/autoload.php';
session_start();

if(!isset($_SESSION['authenticated_user'])){
    header('Location: /');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_FILES['fileToUpload']['name'])) {
        try {
            //----------------------------
            //Initialisation des variables
            //----------------------------
            $currentDir = getcwd();
            $uploadDirectory = "/assets/images/articles/";
            $fileExtensions = ['jpeg', 'jpg', 'png'];
            $maxsize = 2000000;
            $fileName = $_FILES['fileToUpload']['name'];
            $fileSize = $_FILES['fileToUpload']['size'];
            $fileTmpName = $_FILES['fileToUpload']['tmp_name'];
            $fileType = $_FILES['fileToUpload']['type'];

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

        }
    }
    if (isset(
        $_POST["idannonce"],
        $_POST["titre"],
        $_POST["contenu"],
        $_POST["idauteur"])){
        if(!isset($_POST["image"]) && isset($_POST['previousImage']) && $_POST['previousImage'] != ""){
            $_POST["image"] = $_POST['previousImage'];
        }
        $hydrator = new News\Hydrator\News();
        $repoproducts = new News\Repository\News();
        $entity = $hydrator->hydrate($_POST, new \News\Entity\News());
        $repoproducts->update($entity);
    }
} else {
    throw new \HttpInvalidParamException('Method not allowed', 405);
}
header('Location: /gestionNews');
exit();
