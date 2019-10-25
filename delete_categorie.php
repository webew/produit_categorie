<?php
session_start();
if( isset($_SESSION["login"]) ){
    $connection = new PDO("mysql:host=localhost;dbname=produit_categorie;port=3306;charset=utf8", "root", "");
    $requete = $connection->prepare("DELETE FROM categorie WHERE id_categorie= :id_cat");
    $requete->bindParam(':id_cat', $_GET["id_cat"]);
    $requete->execute();
}
header('location:gestion_categories.php');