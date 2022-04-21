<?php
    include "pdo.php";
    include "requetes.php";

    supprimer_article($_GET["article"]);
    header("Location: index.php");

?>
