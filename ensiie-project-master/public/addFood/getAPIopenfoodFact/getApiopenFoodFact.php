<?php

if(isset($_POST["codeBarre"]))
{
    if($response = @file_get_contents(@"https://fr.openfoodfacts.org/produit/".$_POST["codeBarre"])==FALSE)
    {  
        echo '';
   }else {
            $response = file_get_contents("https://fr.openfoodfacts.org/produit/" .$_POST["codeBarre"], NULL, NULL, 85, 1005);
            $pos = strpos($response,"<title>");
            $res = substr($response,0,100);
            echo $res;
    }
}
?>
