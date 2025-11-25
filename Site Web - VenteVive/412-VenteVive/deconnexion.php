<?php
require_once("connexion_base.php");
$donnees['menu'] = "deconnexion";
$donnees['titre_page'] = "deconnexion";
include "debut-page2.inc.php";
?>
<?php
session_start();
unset($_SESSION['id_membre']);
?>
<main>
    <div class="container mt-4">
    <h1>Vous avez été déconnecté</h1>
</main>
<?php include "fin-page2.inc.php"; ?>