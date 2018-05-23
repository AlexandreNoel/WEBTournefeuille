<?php

if(isset($_POST["mail"]) && !empty($_POST["mail"])){

    // Include config file

    include ("config.php");
    global $db;


    // Prepare a delete statement

    $sql = "DELETE FROM Eleve WHERE mail = :mail";



    if($stmt = $db->prepare($sql)){

        // Bind variables to the prepared statement as parameters

        $stmt->bindParam(':mail', $param_mail);


        // Set parameters

        $param_mail = trim($_POST["mail"]);



        // Attempt to execute the prepared statement

        if($stmt->execute()){

            // Records deleted successfully. Redirect to landing page

            header("location: CRUDindex.php");

            exit();

        } else{

            echo "Il y a eu une erreur. Veuillez réessayer plus tard.";

        }

    }



    // Close statement

    unset($stmt);



    // Close connection

    unset($db);

} else{

    // Check existence of id parameter

    if(empty(trim($_GET["mail"]))){

        // URL doesn't contain id parameter. Redirect to error page

        header("location: error.php");

        exit();

    }

}

echo '

<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">

    <title>Voir enregistrement</title>

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

                    <h1>Delete Record</h1>

                </div>

                <form method="post">

                    <div class="alert alert-danger fade in">

                        <input type="hidden" name="mail" value="'.trim($_GET["mail"]).'"/>

                        <p>Êtes-vous sûr de vouloir supprimer cet élément ?</p><br>

                        <p>

                            <input type="submit" value="Oui" class="btn btn-danger">

                            <a href="CRUDindex.php" class="btn btn-default">Non</a>

                        </p>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

</body>

</html>';