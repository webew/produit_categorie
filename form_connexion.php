<?php
session_start();
if (isset($_SESSION["login"])) {
    header("location:index.php");
}

if (!empty($_POST)) { //si on a validé le formulaire
    $connection = new PDO("mysql:host=localhost;dbname=produit_categorie;port=3306;charset=utf8", "root", "");
    $req_connexion = $connection->prepare("SELECT * FROM user WHERE login=:login");
    $req_connexion->bindParam(':login', $_POST["login"]);
    $req_connexion->execute();

    if ($user = $req_connexion->fetch() and password_verify($_POST["pwd"], $user["pwd"])) {
        $_SESSION["login"] = $user["login"];
        header('location:index.php');
    } else {
        echo " Mauvais identifiants :-(";
    }
}

?>

<form action="#" method="POST">
    <label for="input_login">Login</label>
    <input type="text" id="input_login" name="login">

    <label for="input_pwd">Login</label>
    <input type="password" id="input_pwd" name="pwd">

    <input type="submit" value="Connexion">
</form>