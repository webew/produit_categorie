<?php

$mdp = "toto";

$mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);
$mdp_hash1 = password_hash($mdp, PASSWORD_DEFAULT);

echo $mdp_hash;
echo '<br>';
echo $mdp_hash1;

var_dump(password_verify($mdp, $mdp_hash));
var_dump(password_verify($mdp, $mdp_hash1));