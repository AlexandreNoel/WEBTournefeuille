<?php
session_start();
require '../vendor/autoload.php';
include('menu.php');
//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();
?>

<html>
<head>
    <title> Recettes  </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"  href="style_index.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/form.css">

</head>
<body>

<?php
menu_oeno();
?>

<br />
<br />
<br />
</div>
<h3><?php echo 'Liste des vins' ?></h3>

    <table class="table table-bordered table-hover table-striped">
        <thead style="font-weight: bold">
        <td>Id du vin</td>
        <td>Nom du vin</td>
        <td>Note</td>
        </thead>
        <?php /** @var \User\User $user */
    	  $irec=$connection->query("SELECT * FROM public.note_vins")->fetchAll();
    	  $j=1;
    	  foreach($irec as $id){
       			 $j++;
   			 }  
    if(isset($_POST['note_vins']) && $_SESSION['connect']>=1){
    	echo $j;
        $req=$connection->prepare('INSERT INTO public.note_vins(note_vins,id_vin,id_vote,id_usr) VALUES(:note_vins,:id_vin,:id_vote,:id_usr)');
        $req->execute(['note_vins'=>$_POST['note_vins'],
            'id_vin'=>$_POST['liste_vins'],
            'id_vote' => $j,
            'id_usr' => $_SESSION['id'],
            ]);
    }

        $turec=$connection->query("SELECT * FROM public.liste_vins")->fetchAll();

        if(!empty($turec)){
        	foreach ($turec as $res){
        		$id_vino=$res['id_vin'];
        	    $tunote=$connection->query("SELECT AVG(note_vins) AS moyenne FROM public.note_vins WHERE id_vin=$id_vino")->fetch();

        	?>
           		<tr>
               		<td><?php echo $res['id_vin'] ?></td>
               		<td><?php echo $res['nom'] ?></td>
               		<td><?php echo $tunote['moyenne'];?></td>

            		</tr>
        	<?php }	
        }
        
?>
    </table>
    <?php 
    echo '<div class="gtco-container">';

    echo '<div class="form-c">';
    echo '<div class="form-c-head">Noter un vin :</div>';
    echo '<form method = "post" action="#">';
    echo '<label for="id"><span class="txt">ID du Vin <span class="required">*</span></span><input type="text" class="input-field" name="id" /></label>';
    echo '<label for="note"><span class="txt">Note <span class="required">*</span></span><input type="number" class="input-field" name="note" min=0 max=5 /></label>';
    echo '<input type ="submit" name="submit" value="Noter"/>';
    echo '</form>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    ?>
  </body>

