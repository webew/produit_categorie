<?php
session_start();
if( isset($_SESSION["login"]) ){
    $connection = new PDO("mysql:host=localhost;dbname=produit_categorie;port=3306;charset=utf8", "root", "");
    $requete = $connection->prepare("DELETE FROM produit WHERE id_produit= :id_prod");
    $requete->bindParam(':id_prod', $_GET["id_prod"]);
    $requete->execute();
}
header('location:gestion_produits.php');