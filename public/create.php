<?php

include ("config.php");
global $db;


// Récupère et valide le formulaire une fois valider

if($_SERVER["REQUEST_METHOD"] == "POST"){


    // Check input errors before inserting in database

    if(isset($_POST['mail']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mdp']) && isset($_POST['pseudo']) && isset($_POST['promo']) && isset($_POST['telephone']) && isset($_POST['admin'])){

        $mail = $_POST["mail"];
        $nom = $_POST["nom"];
        $prenom =$_POST["prenom"];
        $mdp =$_POST["mdp"];
        $pseudo = $_POST["pseudo"];
        $promo = $_POST["promo"];
        $telephone = $_POST["telephone"];
        $admin = $_POST["admin"];
        // Prepare an insert statement

        $sql = "INSERT INTO Eleve (mail, nom, prenom, mdp, pseudo, promo, telephone, admin) VALUES (:mail, :nom, :prenom, :mdp, :pseudo, :promo, :telephone, :admin)";


        if($stmt = $db->prepare($sql)){

            // Bind variables to the prepared statement as parameters

            $stmt->bindParam(':mail', $param_mail);

            $stmt->bindParam(':nom', $param_nom);

            $stmt->bindParam(':prenom', $param_prenom);

            $stmt->bindParam(':mdp', $param_mdp);

            $stmt->bindParam(':pseudo', $param_pseudo);

            $stmt->bindParam(':promo', $param_promo);

            $stmt->bindParam(':telephone', $param_telephone);

            $stmt->bindParam(':admin', $param_admin);


            // Set parameters

            $param_mail = $mail;

            $param_nom = $nom;

            $param_prenom = $prenom;

            $param_mdp = $mdp;

            $param_pseudo = $pseudo;

            $param_promo = $promo;

            $param_telephone = $telephone;

            $param_admin = $admin;

            // Attempt to execute the prepared statement

            if($stmt->execute()){

                // Records created successfully. Redirect to landing page

                header("location: CRUDindex.php");

                exit();

            } else{

                echo "Il y a eu une erreur. Veuillez recommencer plus tard.";

            }

        }



        // Close statement

        unset($stmt);

    }

    // Close connection

    unset($db);

}


echo '
<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">

    <title>Créer un enregistrement</title>

    <link rel=\"stylesheet\" href=\"style.css\"/>

    <style type="text/css">

        .wrapper{

            width: 500px;

            margin: 0 auto;

        }

    </style>

</head>

<body>

<div class="wrapper">

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">

                <div class="page-header">

                    <h2>Créer un enregistrement</h2>

                </div>

                <p>Veuillez remplir ce formulaire et l\'envoyer pour ajouter un nouvel élève à la base de données</p>

                <form method="post">

                        <label>Mail</label></br>

                        <input type="text" name="mail" class="form-control"></br>

                        <label>Nom</label></br>

                        <input type="text" name="nom" class="form-control"></br>

                        <label>Prénom</label></br>

                        <input type="text" name="prenom" class="form-control" ></br>
                    
                        <label>Mot de passe</label></br>

                        <input type="text" name="mdp" class="form-control" ></br>
                    
                        <label>Pseudo</label></br>

                        <input type="text" name="pseudo" class="form-control"></br>
                    
                        <label>Promotion</label></br>

                        <input type="text" name="promo" class="form-control"></br>
                    
                        <label>Téléphone</label></br>

                        <input type="text" name="telephone" class="form-control"></br>
                    
                        <label>Administrateur</label></br>

                        <input type="text" name="admin" class="form-control"></br>

                    <input type="submit" class="btn btn-primary" value="Envoyer">

                    <a href="CRUDindex.php" class="btn btn-default">Annuler</a>

                </form>

            </div>

        </div>

    </div>

</div>

</body>

</html>';