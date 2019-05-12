<?php

    include("db.php");

    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

function verif_infos($email) {

    if ($db = db_connect()) {
        $query = "SELECT mail,nom,mdp FROM Connexion WHERE email=$email;";
        $reponse = db_query($db, $query);
        if ($reponse) {
            if (pg_num_rows($reponse)==0) {
                $res[0]=-1;
                $res[1]=0;
                $res[2]=0;
            }
            else{
                while ($tuplecourant = pg_fetch_array($reponse) ){
                    $res[0]=0;
                    $res[1]=$tuplecourant['user'];
                    $res[2]=$tuplecourant['mdp'];
                }
            }
        }
        else {
            $res[0]=-2;
            $res[1]=0;
            $res[2]=0;
        }
    }
    else {
        $res[0]=-3;
        $res[1]=0;
        $res[2]=0;
    }
    return $res;
}

    $infos=verif_infos($email);
    if ($infos[0]==0 && $infos[2]==$mdp){
        global $AUTHENT;
        $AUTHENT=0;
        $_SESSION['nomuser']=$infos[1];
        header('Location: profil.html');
    }
    else{
        affiche_erreur("E-Mail ou mot de passe incorrect.");
        print "</br>";
        print " <a href='connexion.html'>Retour au menu de connexion.</a>";
    }

?>