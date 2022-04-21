<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="asset/style.css">
</head>

<body>

<header>
    <a href="index.php"><h1>INDEX</h1></a>
        <?php

                if (!empty($_SESSION["pseudo"])){
                    if ($_SESSION["pseudo"] == "admin"){
                        echo "<nav><a href='crearticle.php'><p>Création d'article</p></a></nav>";
                    }
                    echo "<nav><p> Bonjour ".$_SESSION["pseudo"]." / </p><a href='destroy.php'><p>se Déconnecter</p></a></nav>";
                } else {
                    echo "<nav><a href='connexion.php'><p>Me Connecter</p></a><p> / </p><a href='creation.php'><p>Créer un compte</p></a></nav>";
                }
        ?>

</header>

<main id="mainarticle">




<?php
    include "pdo.php";
    include "requetes.php";
    // echo $_GET["nom"];

    $article = recup_un_article($_GET["nom"]);

    echo "<h1>".$article[0]["titre_article"]."</h1>";
    echo "<p>".$article[0]["contenue_article"]."</p>";
    echo "<img src='asset/img/".$article[0]["image_article"]."'>";
    // echo "<h2> écrit le ".$article[0]["date_article"]."</h2>";

    $originalDate = $article[0]["date_article"];
    $timestamp = strtotime($originalDate); 
    $newDate = date("d-m-Y G:i:s", $timestamp );
    echo "<h2> écrit le ".$newDate."</h2>";

    $auteur = recup_auteur($article[0]["id_user"]);
    echo "<h3> Par ".$auteur[0]["pseudo_user"]."</h3>";

    if (!empty($_SESSION["pseudo"])){
        if ($_SESSION["pseudo"] == "admin"){
            echo "<a href='supprimer.php?article=".$article[0]["id_article"]."'>Supprimer</a>";
        }
    }
    
?>




</main>
    
</body>
</html>