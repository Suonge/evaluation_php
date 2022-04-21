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
<h1>CONNEXION</h1>

<form action="connexion.php" method="GET">
    <label for="pseudo">Votre pseudo</label>
    <input type="text" id="pseudo" name="pseudo">

    <label for="mdp">Votre MDP</label>
    <input type="text" id="mdp" name="mdp">

    <input type="submit">
</form>

<a href="creation.php"><p>Créer un compte</p></a>
</section>

<?php

    include "pdo.php";
    include "requetes.php";
    

    if (!empty($_GET["pseudo"]) && !empty($_GET["mdp"])){
        $mdpBDD = recup_mdp($_GET["pseudo"]);
        print_r($mdpBDD);
        
        if (!empty($mdpBDD[0]["mdp_user"])){
            if (password_verify($_GET["mdp"], $mdpBDD[0]["mdp_user"])){
                $_SESSION['pseudo'] = $_GET["pseudo"];
                header("Location: index.php");
            } else {
                echo "Pseudo ou MDP incorrect";
            }
        } else {
            echo "Pseudo ou MDP incorrect";
        }
        // var_dump($mdpBDD);
    }


    // var_dump($infoBDD);

    // echo $infoBDD[0]["pseudo"];

    // if (!empty($_GET["pseudo"]) && !empty($_GET["mdp"])){
    //     foreach ($infoBDD as $user){
    //         if($user["pseudo"] == $_GET["pseudo"] && $user["mdp"] == $_GET["mdp"]){
    //             $verif = 1;
    //             break;
    //         } else {
    //             $verif = 0;
    //         }
    //     }
    //     if($verif == 1){
    //         echo "Victoire";
    //         header("Location: index.php");
    //     exit;
    //     } else if ($verif == 0) {
    //         echo "Pseudo ou MDP incorrect";
    //     }
    // }


?>

    
</body>
</html>