<nav>
    <ul>
        <li>
            <a href="index.php">Accueil</a>
        </li>
        <li>
            <a href="gestion_categories.php">Gestion des catégories</a>
        </li>
        <li>
            <a href="gestion_produits.php">Gestion des produits</a>
        </li>
        <li>
            <?php if(isset($_SESSION["login"])) : ?>
                <a href="logout.php">Déconnexion</a>
            <?php else : ?>
                <a href="form_connexion.php">Connexion</a>
            <?php endif ?>
        </li>
    </ul>
</nav>
<?php

if(isset($_SESSION["login"])){
    echo "<div id='divBonjour'>Bonjour " . $_SESSION["login"] . "</div>";
}
?>