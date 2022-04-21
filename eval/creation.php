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
    <nav>
        <?php

                

                if (!empty($_SESSION["pseudo"])){
                    if ($_SESSION["pseudo"] == "admin"){
                        echo "<a href='crearticle.php'><p>Création d'article</p></a>";
                    }
                    echo "<p> Bonjour ".$_SESSION["pseudo"]." / </p><a href='destroy.php'><p>se Déconnecter</p></a>";
                } else {
                    echo "<a href='connexion.php'><p>Me Connecter</p></a><p> / </p><a href='creation.php'><p>Créer un compte</p></a>";
                }
        ?>
    </nav>

</header>

<section  class="secCo">
<h1>CREE COMPTE </h1>

<form action="creation.php" method="GET">
    <label for="newpseudo">Votre pseudo</label>
    <input type="text" id="newpseudo" name="newpseudo">

    <label for="newmdp">Votre MDP</label>
    <input type="text" id="newmdp" name="newmdp">

    <label for="verifmdp">Vérification MDP</label>
    <input type="text" id="verifmdp" name="verifmdp">

    <input type="submit" value="Créer">
</form>


<a href="index.php">Retour</a>;
</section>

<?php
    include "pdo.php";
    include "requetes.php";

    if (!empty($_GET["newpseudo"]) && !empty($_GET["newmdp"]) && !empty($_GET["verifmdp"])){
        if ($_GET["newmdp"] == $_GET["verifmdp"]){
            if (verif_pseudo($_GET["newpseudo"]) == true){
                echo "Pseudo pas utilisé";
                $mdpcr = password_hash($_GET["newmdp"], PASSWORD_DEFAULT);
                creation_compte($_GET["newpseudo"],$mdpcr);
                header("Location: connexion.php");
            } else {
                echo "Pseudo déjà utilisé";
            }
        }
        
    } 
?>
    
</body>
</html>