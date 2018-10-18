<?php 

namespace Controler;

class User {
  function register_user() {
    // get $_POST from views

    $_POST['firstname'] = 'John';
    $_POST['lastname'] = 'Doe';
    $_POST['birthday'] = '1967-11-22';
    $_POST['mail'] = "rockyoan@gml.com";

    // verify args
    // verify if already registered
    $service = new \Service\User();
    $msg =$service->verify_registration($_POST['firstname'], $_POST['lastname'],$_POST['birthday'], $_POST['mail']);

    printf($msg);
  }
}
