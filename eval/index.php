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
<main class="main">




<?php
    include "pdo.php";
    include "requetes.php";

    $articles = recup_articles();
    for ($i = 0; $i < count($articles); $i++){
        echo "<section><h2>".$articles[$i]["titre_article"]."</h2><img src='asset/img/".$articles[$i]["image_article"]."'><p>".$articles[$i]["contenue_article"]."</p><a href='article.php?nom=".$articles[$i]["titre_article"]."'><p>Voir l'article</p></a></section>";
    }

?>

</main>
    
</body>
</html>