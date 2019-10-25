<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php include '_nav.php'; ?>

    <?php $connection = include 'connexion_bdd.php'; ?>

    <h1>Gestion des produits</h1>

    <?php 
        if( isset($_SESSION["login"]) ){
            include './form_new_produit.php';
        }
    ?>

    <hr>

    <?php
        include './fonction_liste_produits.php';
        $produits = listeProduits();
    ?>
    <table class="table">
        <thead>
            <tr>
                <th>Libellé</th>
                <th>Prix</th>
                <th>Catégorie</th>
                <?php if( isset($_SESSION["login"]) ) : ?>
                    <th></th>
                    <th></th>
                <?php endif ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $prod) : ?>
                <tr>
                    <td>
                        <?= $prod["libelle_produit"] ?>
                    </td>
                    <td>
                        <?= $prod["prix_produit"] ?>
                    </td>
                    <td>
                        <?= $prod["libelle_categorie"] ?>
                    </td>
                    <?php if( isset($_SESSION["login"]) ) : ?>
                        <td>
                            <a href="update_produit.php?id_prod=<?= $prod["id_produit"] ?>">Modifier</a>
                        </td>
                        <td>
                            <a href="delete_produit.php?id_prod=<?= $prod["id_produit"] ?>">Supprimer</a>
                        </td>
                    <?php endif ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>