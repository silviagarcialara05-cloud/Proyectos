<?php session_start(); ?>
<?php 
require_once("connexion_base.php"); 


?>
<?php

require_once("connexion_base.php");
$donnees['menu'] = "Inscription";
$donnees['titre_page'] = "Inscription";
include "debut-page2.inc.php";
?>
<main>

<div class="container mt-4">
        <h2>Inscription d'un nouveau membre</h2>
        <form action="enregistrer-membre.php" method="post">
            <fieldset>
                <p>
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom" />
                </p>
                <p>
                    <label for="prenom">Prénom :</label>
                    <input type="text" name="prenom" id="prenom" />
                </p>
                <p>
                    <label for="email">Adresse email :</label>
                    <input type="email" name="email" id="email" />
                    <br/>
                </p>
                <p>
                    <label for="pseudo">Pseudo :</label>
                    <input type="text" name="pseudo" id="pseudo" />
                </p>
                <p>
                    <label for="motdepasse">Mot de passe :</label>
                    <input type="password" name="motdepasse" id="motdepasse"/>
                </p>
                <p>
                    <input type="checkbox" value="oui" name="consentement" id="consentement" />
                    En soumettant ce formulaire, j'accepte que les informations saisies dans ce formulaire soient utilisées, exploitées, traitées, pour permettre de m'authentifier dans le cadre de ce site Vente.
                </p>
                <p>
                    <input class="btn btn-primary" type="submit" value="Valider" />
                </p>
            </fieldset>
        </form>
</main>
<?php include "fin-page2.inc.php"; ?>