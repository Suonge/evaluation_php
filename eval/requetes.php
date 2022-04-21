<?php

function recup_articles(){
    $db = connexion_BD();
    $sql = "SELECT * FROM `articles`";
    $requete = $db->query($sql);
    $req = $requete->fetchAll();
    return $req;
}

function recup_mdp($pseudo){
    $db = connexion_BD();
    $sql = "SELECT mdp_user FROM `users` WHERE pseudo_user='".$pseudo."'";
    $requete = $db->query($sql);
    $req = $requete->fetchAll();
    return $req;
}

function verif_pseudo($pseudo){
    $db = connexion_BD();
    $sql = "SELECT pseudo_user FROM `users` WHERE pseudo_user='".$pseudo."'";
    $requete = $db->query($sql);
    $req = $requete->fetchAll();
    if (!empty($req[0]["pseudo_user"])){
        return false;
    } else {
        return true;
    }
    
}

function creation_compte($pseudo,$mdp){
    $db = connexion_BD();
    $sql = "INSERT INTO users (pseudo_user, mdp_user) VALUES ('".$pseudo."', '".$mdp."')";
    $db->query($sql);
}

function creation_article($nom,$contenue,$image,$date,$createur){

    $db2 = connexion_BD();
    $sql2 = "SELECT id_user FROM `users` WHERE pseudo_user='".$createur."'";
    $requete2 = $db2->query($sql2);
    $req2 = $requete2->fetchAll();
    $id = $req2[0]["id_user"];

    $db = connexion_BD();
    $sql = "INSERT INTO articles (titre_article, contenue_article, date_article, image_article, id_user) VALUES ('".$nom."', '".$contenue."', '".$date."', '".$image."', '".$id."')";
    $db->query($sql);
}

function recup_un_article($nom){
    $db = connexion_BD();
    $sql = "SELECT * FROM `articles` WHERE titre_article='".$nom."'";
    $requete = $db->query($sql);
    $req = $requete->fetchAll();
    return $req;
}

function recup_auteur($nom){
    $db = connexion_BD();
    $sql = "SELECT pseudo_user FROM `users` WHERE id_user='".$nom."'";
    $requete = $db->query($sql);
    $req = $requete->fetchAll();
    return $req;
}

function supprimer_article($id){
    $db = connexion_BD();
    $sql = "DELETE FROM articles WHERE id_article = ".$id.";";
    $db->query($sql);
}
?>