<?php

//session_start();

$prenom = $_SESSION['prénom'];
$id = $_SESSION['id'];

/* Recupération des users*/
//require_once '../vendor/autoload.php';
require_once 'Modele.php';

function enTete($titre, $style)
{
    print "<!DOCTYPE html>\n";
    print "<html>\n";
    print "  <head>\n";
    print "    <meta charset=\"utf-8\" />\n";
    print "    <title>$titre</title>\n";
    print "    <link rel=\"stylesheet\" href=\"$style\"/>\n";
    print "  </head>\n";

    print "  <body>\n";
   // print "    <header><h1>$titre</h1></header>\n";
}

function pied(){
    print "  </body>\n";
    print "</html>";
}

function footer(){
    print "<footer>\n";
    print "<div>\n";
    print "    <p>Twiitie 2018</p>\n";
    print "</div>\n";
    print "</footer>";
}


function affiche($str) {
    echo $str;
}

function affiche_info($str) {
    echo '<p>'.$str.'</p>';
}

function affiche_erreur($str) {
    echo '<p class="erreur">'.$str.'</p>';
}


function titreH1($titre){
    print "<h1>$titre</h1>\n";
}


/*
 *  Affiche le menu navigation
 */
function afficheMenu(){
    global $prenom;
    print "<nav id=\"fontmenu\">\n";
    print "<ul id=\"menu\">\n";
    print "    <li>\n";
    print "        <span class=\"nomsite\">twitIIE</span>\n";
    print "    </li>\n";
    print "    <li>\n";
    print "        <a href=\"accueil.php\">\n";
    print "         Accueil <img src=\"icones/home.png\" alt=\"accueil\"/>\n";
    print "        </a>\n";
    print "    </li>\n";
    print "    <li>\n";
    print "        <a href=\"profil.php?pseudo=".prenom_user($_SESSION['id'])."&id=".$_SESSION['id']."\">\n";
    print "        Mon Profil <img src=\"icones/profil.png\" alt=\"profil\"/>\n";
    print "         </a>\n";
    print "    </li>\n";
    print "    <li>\n";
    print "        <a href=\"edition.php?pseudo=$prenom\">\n";
    print "        Edition profil <img src=\"icones/editionprofil.png\" alt=\"edition_profil\"/>\n";
    print "        </a>\n";
    print "    </li>\n";
    print "    <li>\n";
    print "         <a href=\"Msg_Ecrire.php\">\n";
    print "        Message <img src=\"icones/message.png\" alt=\"message\"/>\n";
    print "        </a>\n";
    print "    </li>\n";
    print "    <li>\n";
    print "        <a href=\"deconnexion.php\">\n";
    print "        Déconnexion <img src=\"icones/logout.png\" alt=\"bouton de déconnexion\"/>\n";
    print "        </a>\n";
    print "    </li>\n";
    print "</ul>\n";
    print "</nav>\n";
}




/* Fonctions pour messages */

function affiche_message($message){
    echo 'Message de '.$message->getEmetteur().' à '.
        ($message->getDate())->format('H:i:s').' le '.
        ($message->getDate())->format('Y-m-d').': ';
    echo $message->getContenu();
    print "</br>";
}

/*
 *
 */
function listeDiscussion($listeAmis){
    print "<p class=\"titre\">Vos amis:</p>\n";
    foreach($listeAmis as $F){
        echo '<button id=\''.$F['id'].'\' onclick="document.getElementById(\'h1\').innerHTML=\'Ma conversation avec '.$F['prénom'].'\'; document.getElementById(\'envoyer\').value='.$F['id'].'; Conversation(); document.getElementById(\'chat\').style.display = \'block\';">'.$F['prénom'].'</button>';
        print("\n");
    }
}

/*
 * Affiche la liste des amis
 */
function afficheListeAmis($listeAmis){
    print "<div class=\"amis\">Vos amis:<br/>\n";
    foreach($listeAmis as $F){
        echo "<a href=\"profil.php?pseudo=".$F['prénom']."&id=".$F['id']."\">@".$F['prénom']."</a><br/>\n";
    }
    print "</div>\n";
}


function afficheTweet($tweet, $likes){
    echo ajoutNomLien('@'.prenom_user($tweet->getAuteur()))." a tweeté à ".
        ($tweet->getDate())->format('H:i:s')." le ".($tweet->getDate())->format('Y-m-d').
        "</br><br/> ".ajoutNomLien(ajoutHashtagLien($tweet->getContenu()))."<br/></br>";
    print "\n";
    echo "        <button id=\"".$tweet->getId()."\" onclick=\"Liker(".$tweet->getId().")\">";

    if (dejaLiker($tweet->getId())) {
        echo "Je n'aime plus";
    }
    else {
        echo "J'aime";
    }
    echo "</button> Likes : ".$likes;
    print "\n";
}

/*
 * $listeTweets est un tableau de 2 colonnes avec une colonne pour les tweets et l'autre pour likes
 */
function afficheListeTweets($listeTweets){
    print "<div class=\"alltweets\">Derniers Tweets :<br/><br/>\n";
    for($i=0; $i<sizeof($listeTweets); $i++){
        echo "    <div class=\"tweets\">";
        echo afficheTweet($listeTweets[$i][1], $listeTweets[$i][0]);
       /* print "\n";
        echo "        <button id=\"".$listeTweets[$i][1]->getId()."\" onclick=\"Liker(".$listeTweets[$i][1]->getId().")\">";

        if (dejaLiker($listeTweets[$i][1]->getId())) {
            echo "Je n'aime plus";
        }
        else {
            echo "J'aime";
        }
        echo "</button> Likes : ".$listeTweets[$i][0];*/
        print "\n";
        echo "        <button id=\"Comment\" onclick=\"afficherCommentaire(".$listeTweets[$i][1]->getId().")\">Commenter</button>";
        print "\n    </div>\n";
    }
    print "</div>\n";
}



/*
 * Affiche tous les commentaires d'un tweet
 */
function afficherCommentaires($T) {
    print "<ul>\n";
    foreach ($T as $res) :
        echo '        <li>'.prenom_user($res->getOwnerId()).' ';
        echo 'a commenté à '.($res->getDate())->format('H:i:s')." le ".($res->getDate())->format('Y-m-d').' : ';
        echo $res->getContenu().' '."\n";


        /* Ajout bouton pour ecrire commentaire */
        echo '      <button onclick="afficherChampId('.$res->getId().');" class="inputbutton">Répondre</button></br>'."\n";

        echo '      <form method="POST" action="Commentaire/envoiCommentaire.php" class="champCommentaire" id="'.$res->getId().'">'."\n";
        echo '        <input type="hidden" name="type_parent" value="commentaire">'."\n";
        echo '      <input type="hidden" name="id_parent" value="'.$res->getId().'">'."\n";
        echo '      <input type="hidden" name="TargetOwner" value="'.$res->getTargetId().'">'."\n";
        echo '        <input type="text" size=50 name="contenu" placeholder="Veuillez saisir votre commentaire ...">'."\n";
        echo '        <input type="submit" value="Envoyer" onclick="alert(\'Commentaire Envoyé\')" class="inputbutton">'."\n";
        echo "</form>\n";

        afficherCommentaires(getCommentaires($res->getId(), "commentaire"));
        print "</li>\n";
    endforeach;
    echo '</ul>';
}



/*
 * $text est un string
 * Remplace les @ par des liens cliquables vers les profils
 */
function ajoutNomLien($text){
    $T = explode(" ", $text);
    for ($i=0; $i<count($T); $i++){
        if (isset($T[$i][0])) {
            if ('@' == $T[$i][0]) {
                $id = idUser(substr($T[$i], 1));
                if ($id != FALSE) {
                    $T[$i] = "<a href=\"profil.php?pseudo=" . substr($T[$i], 1) . "&id=" . $id . "\">$T[$i]</a>";
                }
            }
        }
    }
    return implode(" ",$T);
}

/*
 * $text est un string
 * Remplace les hashtag # par des liens cliquables vers une page contenant tous les tweets avec ce hashtag
 */
function ajoutHashtagLien($text){
    $T = explode(" ", $text);
    for ($i=0; $i<count($T); $i++){
        if (isset($T[$i][0])) {
            if ('#' == $T[$i][0]) {
                $T[$i] = "<a href=\"hashtagTweet.php?hashtag=".substr($T[$i], 1)."\">$T[$i]</a>";
            }
        }
    }
    return implode(" ",$T);
}

/*
 * $text est un string
 * Utilisation de ajoutNomLien et ajoutHashtagLien
 */
function ajoutLienNH($text){
    return ajoutNomLien(ajoutHashtagLien($text));
}








