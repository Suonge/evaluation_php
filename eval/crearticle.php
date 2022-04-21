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

<section>
<h1>CREATION ARTICLE</h1>

<form action="crearticle.php" method="POST" enctype="multipart/form-data">
    <label for="newpseudo">Le nom de l'article :</label>
    <input type="text" id="nom" name="nom">

    <label for="newmdp">Le contenue de l'article</label>
    <input type="text" id="contenue" name="contenue">

    <label for="image">L'image pour l'article</label>
    <input type="file" name="image" id="image">
    <input type="submit" value="Créer">
</form>
</section>


<?php
    include "pdo.php";
    include "requetes.php";

    if (!empty($_POST["nom"]) && !empty($_POST["contenue"])){
        $type = pathinfo($_FILES["image"]["name"]);
        print_r($_FILES["image"]["name"]);
        $target = "asset/img/";
        $img_user = $target.$_FILES["image"]["name"];
        move_uploaded_file($_FILES["image"]["tmp_name"], $img_user);

        $date = date("Y")."-".date("m")."-".date("j")." ".date("G").":".date("i").":".date("s");


        creation_article($_POST["nom"],$_POST["contenue"],$_FILES["image"]["name"],$date,$_SESSION["pseudo"]);
    }

?>

<a href="index.php"><p>Retour</p></a>

</body>
</html>