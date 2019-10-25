<?php
session_start();//on indique à php que l'on gère les sessions dans ce script
if( ! isset($_SESSION["login"]) ){//si on n'est pas connecté
    header('location:index.php');//onredirige vers l'accueil
}else{
//si on est connecté, on va soit :
// - mettre à jour les données si le fomrulaire a été soumis
// - afficher le formulaire si on vient de la page gestion_produits
$connection = new PDO("mysql:host=localhost;dbname=produit_categorie;port=3306;charset=utf8", "root", "");
//si le formulaire est soumis
if( !empty($_POST) ){
    //on met les données à jour
    $req_update = $connection->prepare("UPDATE produit SET libelle_produit=:libelle_produit,prix_produit=:prix_produit, id_categorie=:id_categorie WHERE id_produit=:id_produit");
    $req_update->bindParam(':id_produit',$_GET["id_prod"]);
    $req_update->bindParam(':libelle_produit',$_POST["libelle_produit"]);
    $req_update->bindParam(':prix_produit',$_POST["prix_produit"]);
    $req_update->bindParam(':id_categorie',$_POST["id_categorie"]);
    
    $req_update->execute();
    header('location:gestion_produits.php');//on redirige
}

//affichage du formulaire rempli avec les données du produit à modifier
$requete_produit = $connection->prepare("SELECT * FROM produit WHERE id_produit= :id_prod");
$requete_produit->bindParam(':id_prod', $_GET["id_prod"]);
$requete_produit->execute();
$produit = $requete_produit->fetch(PDO::FETCH_ASSOC);

//requête préparée
$requete_categories = $connection->prepare("SELECT * FROM `categorie` ORDER BY libelle_categorie");
$requete_categories->execute(); //exécution de la requête

//récupération des données
$categories = $requete_categories->fetchAll(PDO::FETCH_ASSOC);

?>
<form action="#" method="POST">
    <div class="form-group">
        <label for="">Libellé produit</label>
        <input class="form-control" type="text" name="libelle_produit" value="<?= $produit["libelle_produit"] ?>">
    </div>
    <div class="form-group">
        <label for="">Prix produit</label>
        <input class="form-control" type="text" name="prix_produit" value="<?= $produit["prix_produit"] ?>">
    </div>
    <div class="form-group">
        <select class="form-control" name="id_categorie">
            <?php foreach ($categories as $cat) : ?>
                <?php
                    $selected = "";
                    if($cat["id_categorie"] == $produit["id_categorie"]){
                        $selected = "selected";
                    }
                ?>
                <option <?= $selected ?> value="<?= $cat["id_categorie"] ?>"><?= $cat["libelle_categorie"] ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <input class="btn btn-primary" type="submit" value="Valider">
</form>

<?php } ?>