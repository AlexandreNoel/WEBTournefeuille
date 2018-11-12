<?php
  include_once '../../../src/User/Hydrator/User.php';
  include_once '../../../src/User/Repository/UserRepository.php';
  include_once '../../../src/User/Entity/User.php';
if($_SERVER['REQUEST_METHOD']==='POST')
{ 
    $userRepository = new User\Repository\UserRepository();
    $userHydrator = new \User\Hydrator\User();
    $name = $_POST["name"];
    $lastname=$_POST["lastname"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $mail = $_POST["mail"];
    $tableGenre = $_POST["genre"];
    $idGenge = $_POST["genre"]==="Parent"?"idParent":"IdChild";
    $userFields = $userHydrator->hydrate(
        [
        'mail'=>$mail,
        'nameu'=>$name,
        'lastname'=>$lastname,
        'passwordp'=>$password,
        'username'=>$username,
        'genre'=>$tableGenre
        ],new \User\Entity\User());
    $createdUser = $userRepository->createUser($userFields, $tableGenre,$idGenge);  
}else{

}
?>         
