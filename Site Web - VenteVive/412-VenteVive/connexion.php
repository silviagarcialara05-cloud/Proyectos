<?php
session_start();
require_once("connexion_base.php");
$donnees['menu'] = "CONNEXION";
$donnees['titre_page'] = "CONNEXION";
include "debut-page2.inc.php";
?>
<?php 
require_once("connexion_base.php"); 

// exécuter une requete MySQL
$requete = "SELECT * FROM Vcategorie;";
$reponse = $pdo->prepare($requete);
$reponse->execute();
// récupérer tous les enregistrements dans un tableau
$enregistrements = $reponse->fetchAll();
// connaitre le nombre d'enregistrements
$nombreReponses = count($enregistrements);
?>


        <h2>Connexion</h2>


             <form action="verifier-connexion.php" method="post">
                    <p>
                    <label for="pseudo">Votre login :</label>
                    <input type="text" name="pseudo" id="pseudo" />
                </p>               
                <p>
                    <label for="motdepasse">Mot de passe :</label>
                    <input type="password" name="motdepasse" id="motdepasse" />
                    <br/>
                </p>
       
                <input type="submit" value="Login">
        </form>
   
    <?php include "fin-page2.inc.php"; ?>
