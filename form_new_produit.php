<?php
//requête préparée
$requete = $connection->prepare("SELECT * FROM `categorie` ORDER BY libelle_categorie");
$requete->execute(); //exécution de la requête

//récupération des données
$categories = $requete->fetchAll(PDO::FETCH_ASSOC);
// var_dump($categories);
?>
<form action="#" method="POST">
    <div class="form-group">
        <label for="">Libellé produit</label>
        <input class="form-control" type="text" name="libelle_produit">
    </div>
    <div class="form-group">
        <label for="">Prix produit</label>
        <input class="form-control" type="text" name="prix_produit">
    </div>
    <div class="form-group">
        <select class="form-control" name="categorie" id="">
            <?php foreach ($categories as $cat) : ?>
                <option value="<?= $cat["id_categorie"] ?>"><?= $cat["libelle_categorie"] ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <input class="btn btn-primary" type="submit" value="Valider">
</form>
<?php
if(!empty($_POST)){
    //requête préparée
    $requete = $connection->prepare("INSERT INTO produit(libelle_produit,prix_produit,id_categorie) VALUES(:libelle_produit,:prix_produit,:id_categorie)");

    $requete->bindParam(':libelle_produit', $_POST["libelle_produit"]);
    $requete->bindParam(':prix_produit', $_POST["prix_produit"]);
    $requete->bindParam(':id_categorie', $_POST["categorie"]);

    $requete->execute();//exécution de la requête
}

?>