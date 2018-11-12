<?php
namespace User\Hydrator;

include_once '../../../src/User/Entity/User.php';
class User{

    public function extract(\User\Entity\User $userObject):array {
        $data = [];
        if($userObject->getId()){
            $data["id"]->getId();
        }
        if($userObject->getGenre()){
            $data["genre"]=$userObject->getGenre();
        }
        if($userObject->getName()){
            $data["nameu"] = $userObject->getName();
        }
        if($userObject->getPassword()){
            $data["passwordp"]=$userObject->getPassword();
        }
        if($userObject->getlastName()){
            $data["lastname"] = $userObject->getlastName();
        }
        if($userObject->getUsername()){
            $data["username"] = $userObject->getUsername();
        }
        if($userObject->getMail()){ 
            $data["mail"] = $userObject->getMail(); 
        }
        return $data;
    }
    public function hydrate(array $data, \User\Entity\User $emptyEntity){
        $emptyEntity->setId($data["id"] ?? null);
        $emptyEntity->setGenre($data["genre"]?? null);
        $emptyEntity->setName($data["nameu"]?? null);
        $emptyEntity->setPassword($data["passwordp"] ?? null);
        $emptyEntity->setUsername($data["username"] ?? null);
        $emptyEntity->setMail($data["mail"] ?? null);
        $emptyEntity->setlastName($data["lastname"] ?? null);
        return $emptyEntity;
    }
}



?>