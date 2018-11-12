<?php
  include_once '../../../src/User/Hydrator/User.php';
  include_once '../../../src/User/Repository/UserRepository.php';
  include_once '../../../src/User/Entity/User.php';
if($_SERVER['REQUEST_METHOD']==='POST')
{ 
$password = $_POST["password"] ?? null;
$mail = $_POST["mail"] ?? null;
$user = new User\Repository\UserRepository();
$userDatas = $user->findByOne($mail,$password);
$name = $userDatas->getName();
$id=$userDatas->getId();
$datasToReturn = array(
	'name'=>$name,
	'id'=>$id
);
if($userDatas!==null)
{
	echo json_encode($datasToReturn);
}else{
	echo '';
}
}
?>         
