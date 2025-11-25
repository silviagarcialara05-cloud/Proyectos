<?php 
session_start();
require_once "connexion_base.php";
$donnees['menu'] = "Ajouter avis";
$donnees['titre_page'] = "Les commentaires";
include "debut-page2.inc.php";
?>
<main>

<div class="container mt-4">
<?php

// Vérifier si l'utilisateur est connecté et s'il a sélectionné un produit
if (isset($_SESSION['id_Vmembre'])) {
    // Récupérer les informations envoyées par le formulaire
    $note = isset($_POST['note']) ? $_POST['note'] : "Aucune note";
    $id_Vproduit = isset($_POST['id_produit']) && $_POST['id_produit'] !== "Aucun produit sélectionné" ? $_POST['id_produit'] : null;
    $commentaire = isset($_POST['commentaire']) ? $_POST['commentaire'] : "Aucun commentaire";

    // Vérifier si id_Vproduit est défini et non vide
    if ($id_Vproduit !== null) {
        // Exécuter une requête MySQL de type INSERT pour enregistrer l'avis
        $requete = "INSERT INTO Vavis (id_Vmembre, id_Vproduit, note, commentaire, date) VALUES (?,?,?,?,NOW())";
        $reponse = $pdo->prepare($requete);
        $reponse->execute(array($_SESSION['id_Vmembre'], $id_Vproduit, $note, $commentaire));

        echo "<p>Votre avis a bien été enregistré.</p>";
    } else {
        echo "Aucun produit sélectionné.";
    }
} else {
    echo "Il faut se connecter et sélectionner un produit pour pouvoir laisser un avis.";
    echo "<p><a href='connexion.php'>Se connecter</a></p>";                
    echo "<p><a href='inscription.php'>S'inscrire</a></p>";
}
?>




<p><a href="accueil.php">Retour à l'accueil</a></p>

</main>

