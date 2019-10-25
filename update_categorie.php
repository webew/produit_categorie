<?php
session_start();
if( ! isset($_SESSION["login"]) ){
    header('location:index.php');
}else{

$connection = new PDO("mysql:host=localhost;dbname=produit_categorie;port=3306;charset=utf8", "root", "");

if( !empty($_POST) ){
    $req_update = $connection->prepare("UPDATE categorie SET libelle_categorie=:libelle_categorie WHERE id_categorie=:id_categorie");
    $req_update->bindParam(':libelle_categorie',$_POST["libelle_categorie"]);
    $req_update->bindParam(':id_categorie',$_GET["id_cat"]);
    $req_update->execute();
    header('location:gestion_categories.php');
}

$requete = $connection->prepare("SELECT * FROM categorie WHERE id_categorie= :id_cat");
$requete->bindParam(':id_cat', $_GET["id_cat"]);
$requete->execute();
$categorie = $requete->fetch(PDO::FETCH_ASSOC);
?>

<form action="#" method="POST">
    <label for="input_libelle_categorie">Catégorie</label>
    <input type="text" 
    id="input_libelle_categorie" 
    name="libelle_categorie" 
    value="<?= $categorie["libelle_categorie"] ?>">
    <input type="submit" value="Enregistrer">
</form>
<?php } ?>