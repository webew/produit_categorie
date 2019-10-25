<?php session_start();echo session_id(); ?>
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

    <h1>Gestion des catégories</h1>

    <?php 
        if( isset($_SESSION["login"]) ){
            include './form_new_categorie.php';
        }
    ?>
    <hr>

    <?php
    $requete_categories = $connection->prepare("SELECT * FROM categorie ORDER BY libelle_categorie");
    $requete_categories->execute();
    $categories = $requete_categories->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <table class="table">
        <thead>
            <tr>
                <th>Id catégorie</th>
                <th>Libellé catégorie</th>
                <?php if( isset($_SESSION["login"]) ) : ?>
                    <th></th>
                    <th></th>
                <?php endif ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $cat) : ?>
                <tr>
                    <td><?= $cat["id_categorie"] ?></td>
                    <td><?= $cat["libelle_categorie"] ?></td>
                    <?php if( isset($_SESSION["login"]) ) : ?>
                        <td>
                            <a href="update_categorie.php?id_cat=<?= $cat["id_categorie"] ?>">Modifier</a>
                        </td>
                        <td>
                            <a href="delete_categorie.php?id_cat=<?= $cat["id_categorie"] ?>">Supprimer</a>
                        </td>
                    <?php endif ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</body>

</html>