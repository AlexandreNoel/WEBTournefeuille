<?php

session_start();

$prenom = $_SESSION['prénom'];
$id = $_SESSION['id'];

/* Recupération des users*/
require '../../vendor/autoload.php';


//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();

$messageRepository = new \Message\MessageRepository($connection);
$messages = $messageRepository->fetchAll();





//enTete("Vos Messages", "CSS/stylesheet1.css");
$msg1 = new \Message\Message();

$msg1->setEmetteur("Dupont");
$msg1->setRecepteur($users['1']->getFirstname());
$msg1->setDate(new DateTime);
$msg1->setContenu("Bonjour, comment tu vas?");



/*foreach ($users as $user) :
	echo '<p>'.$user->getId().' ';
	echo $user->getFirstname().' ';
	echo $user->getLastname().' ';
	echo $user->getAge().' years'.'</p>';
endforeach;*/

/*
foreach ($messages as $message) :
	affiche_message($message);
endforeach;

*/

//affiche_message($msg1);




//$msgManager->add($msg1);

/* MESSAGE MANAGER */
//$msgManager = new \Message\MessageManager($connection);




/************** VUE *****************/
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
	print "    <header><h1> $titre </h1></header>\n";
}

function pied(){
	print "  </body>\n";
	print "</html>";
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


/* Fonctions pour messages */

function affiche_message($message){
    echo 'Message de '.$message->getEmetteur().' à '.
    ($message->getDate())->format('H:i:s').' le '.
    ($message->getDate())->format('Y-m-d').': ';
    echo $message->getContenu();
}

/* Fonction pour recuperer le prenom de quelqu'un */
function prenom_user($id_user){
    global $connection;
    $sth = $connection->prepare('SELECT * FROM "user" WHERE id=\''.$id_user.'\';');
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_OBJ);
    return $result->firstname;
}




?>

<html>
<script>
	function Conversation(){ /* PAS BON : FAIRE avec AJAX */
		var xhttp;
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
 			if (this.readyState == 4 && this.status == 200) {// 4 = request finished and response is ready, 200 = "OK"
 				var Res = this.responseText;
	 			var Msgs = Res.split(",,")
	 			var chat = document.getElementById("chatbox");
	 			chat.innerHTML = "";
                for(var i=0;i<Msgs.length;i++){
                    chat.innerHTML += Msgs[i];
                    chat.innerHTML += '</br>';
                }
                chat.scrollTop = chat.scrollHeight;

                /******************* ACTUALISATION AUTOMATIQUE ******************/
                window.setTimeout(" Conversation();", 1000*10, "JavaScript"); 		}
		};
		xhttp.open("GET", "Msg_Conversation.php?emetteur="+ document.getElementById('envoyer').value +"&recepteur=<?php echo $id; ?>" , true);
		xhttp.send();

	}

/*POUR ACTUALISATION AUTOMATIQUE ??? */
	/*function chatRefresh() { var XHR = new XMLHttpRequest();  XHR.onreadystatechange = function(){ if (XHR.status == 200 && XHR.readyState == 4) { Conversation(); chatRefresh(); } }; }*/


	function EnvoiMessage(){
		var Champ = document.getElementById("sendField");
		var Msg = Champ.value;
//console.log("test");

		var xhttp;
		if (Msg.length == 0) { 
			return;
		}
		xhttp = new XMLHttpRequest();
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {// 4 = request finished and response is ready, 200 = "OK"
                Conversation();
            }
        };
		xhttp.open("GET", "Msg_Envoie.php?m="+Msg+"&emetteur=<?php echo $id; ?>"+"&recepteur="+ document.getElementById('envoyer').value , true);
		xhttp.send(); 
		Champ.value = "";
	}

    var FriendList = <?php
        $sth = $connection->prepare('SELECT * FROM "amis" WHERE personne1=\''.$_SESSION['id'].'\' OR personne2=\''.$_SESSION['id'].'\' ');
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_OBJ);
        echo '[';
        while($result){
            echo '["';
            if($result->personne1 == $_SESSION['id']){
                echo $result->personne2."\",\"".prenom_user($result->personne2) ;
            }
            else{
                echo $result->personne1."\",\"".prenom_user($result->personne1) ;
            }
            echo '"]';
            $result = $sth->fetch(PDO::FETCH_OBJ);
            if($result){
                echo ',';
            }
        }
        echo ']';
        ?> ;


    function liste_amis(){
    	document.write("<p class=\"titre\">Vos amis:</p>");
    	for(var i=0;i<FriendList.length;i++){
    		document.write("<button value=\""+ FriendList[i][1] + "\" onclick=\"document.getElementById('h1').innerHTML=\'Ma conversation avec " + FriendList[i][1] + "\'; document.getElementById('envoyer').value='"+ FriendList[i][0] +"'; Conversation() \">" + FriendList[i][1] + "</button>");
    	}
    	document.write("<br/>");
    }

</script>

<head>
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Mes messages (<?php echo $_SESSION['prenom']; ?>)</title>
</head>
<body>

<nav id="fontmenu">
    <ul id="menu">
        <li>
            <span class="nomsite">Twitiie</span>
        </li>
        <li>
            <a href="../accueil.php">Accueil</a>
        </li>
        <li>
            <a href=<?php echo "../edition.php?pseudo=".$_SESSION['prénom'] ?>>Mon Profil</a>
        </li>
        <li>
            <a href="Msg_Ecrire.php">Message</a></br>

        </li>
    </ul>
</nav>




<div class="conteneur">



<div class="chat_liste_amis">
    <script>
        liste_amis();
    </script>
</div>

<section>
<h1 id="h1"></h1>

<p id="dialogue"></p>

    <div>
        <div id="chatbox" class="chatbox"></div>
        <div>
            <input type="text" id="sendField" placeholder="Votre message ..." onkeypress="if (event.keyCode==13){EnvoiMessage();}" ></input>

            <button type="button" id="envoyer" onclick="EnvoiMessage()">Envoyer</button>
            <button onclick="Conversation();">Recharger</button>

        </div>
    </div>
</section>

</div>



<!-- <a href="../accueil.php">Retour à l'accueil</a><br> -->
<?php
pied();
?>




