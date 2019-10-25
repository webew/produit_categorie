<form action="#" method="POST">
    <div class="form-group">
        <label for="input_libelle_categorie">Catégorie</label>
        <input class="form-control" type="text" id="input_libelle_categorie" name="libelle_categorie">
    </div>
    <input type="submit" value="Enregistrer" class="btn btn-primary">
</form>
<?php
if (!empty($_POST)) {
    $requete = $connection->prepare("INSERT INTO categorie(libelle_categorie) VALUES (:libelle_categorie)");
    $requete->bindParam(':libelle_categorie', $_POST["libelle_categorie"]);
    $requete->execute();
}
?>