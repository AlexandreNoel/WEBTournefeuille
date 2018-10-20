<?php 

namespace Controler;

class User {
  function register_user() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    }
    // get $_POST from views

    $_POST['prenom_user'] = 'John';
    $_POST['nom_user'] = 'Doe';
    $_POST['isadmin'] = false;
    $_POST['promo'] = "FIPA";
    $_POST['mail_User'] = "test@gmail.com";
    $_POST['Secret_User'] = "password";

    $data = $_POST;

    $service = new \Service\User();
    $hydrator = new \Hydrator\User();

    // verify args
    $msg =$service->verify_registration($data);
        printf($msg);

    // verify if already registered
     if($service->isExisting($data)){
       echo "already registered";
     }

    //$user = $hydrator->hydrate($_POST,new \Entity\User());
  }
}
