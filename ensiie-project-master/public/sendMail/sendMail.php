<?php
 require 'libs/PHPMailer-5.2.2/class.phpmailer.php';
 include_once '../src/Food/Repository/mailRepository.php';
 

$food = new \Mail\Food\Mail();
$name = "";
$datas = $food->checkExpirateProducts();
foreach($datas as $data){
    $name =($datas[0]["namef"])."-".$name;
}
$name2="";
foreach($datas as $data){
    $name2 =($datas[0]["namef"])." * ".$name2;
}
if(count($data)===0){
}else{
       
        $gmail = new PHPmailer();
        $gmail->IsSMTP();
        $gmail->SMTPAuth=TRUE;
        $gmail->SMTPSecure="tls";
        $gmail->Host = 'smtp.gmail.com';
        $gmail->Port=587;
        $gmail->Username="smartfridgeweb@gmail.com";
        $gmail->Password='Projetweb';
        $gmail->Body="salut mec";
        $gmail->setFrom("alexastankov95@gmail.com","Assistant of Mickey");
        $gmail->AddAddress("mladenatanasov75@gmail.com","Mladen ATANASOV");
        $gmail->AddAddress("petya.tasheva03@gmail.com","Mladen ATANASOV");
        $gmail->AddAddress("vincentducholet@gmail.com","Mladen ATANASOV");
        //$gmail->AddAddress("thomas.comes@matters.tech","Mladen ATANASOV");
        $gmail->Subject="Hello Mr Mickey !";
        $gmail->MsgHTML("
        Le(s) ".$name2." vont perimer dans 2 jours.
        Voici la recette que vous pouvez faire avec ce produit :
        https://www.marmiton.org/recettes/recherche.aspx?aqt=".$name."&st=1!");
        if(!$gmail->Send()){
            var_dump($gmail);
            $error = "mail wasn t sented sir";
        echo $error.$gmail->ErrorInfo;
        }else{
            $error = "<br /> Your message has been sent successfully sir ! Enjoy to the party !";
            echo $error;
        }
        }
?>