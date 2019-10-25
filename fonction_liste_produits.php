<?php

function listeProduits(){
    //connexion à la base de données
    $connection = new PDO("mysql:host=localhost;dbname=produit_categorie;port=3306;charset=utf8","root","");

    //requête préparée
    $requete = $connection->prepare("SELECT * FROM `produit` JOIN categorie ON produit.id_categorie=categorie.id_categorie ORDER BY libelle_categorie,prix_produit");
    $requete->execute();//exécution de la requête

    //récupération des données
    $produits = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $produits;
}