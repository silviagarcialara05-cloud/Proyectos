<?php session_start();
$donnees['menu'] = "Les produits";
$donnees['titre_page'] = "Les Produits";
include "debut-page2.inc.php"; ?>
<?php require_once("connexion_base.php"); 
$requete = "SELECT * FROM Vproduit";
$reponse = $pdo->prepare($requete);
$reponse->execute(array());
// récupérer tous les enregistrements dans un tableau
$enregistrements = $reponse->fetchAll();
// connaitre le nombre d'enregistrements
$nombreReponses = count($enregistrements);
?>

<main>
    <div class="container mt-4">
<h2>Notre produit </h2>
<a href="produit-formulaire.php">Ajouter de produit</a>   
<ul>
        <?php
// Parcourir les résultats et afficher chaque produit comme un lien
for ($i = 0; $i < $nombreReponses; $i++) {
    echo "<li><a href='detail-produit2.php?categorie=" . $enregistrements[$i]['id_Vcategorie'] . "&id=" . $enregistrements[$i]['id'] . "'>" . $enregistrements[$i]['nom'] . "</a></li>";
    echo "<img src='images_upload/produit-" . $enregistrements[$i]['id'] . "-" . $enregistrements[$i]['id_Vcategorie'] . ".jpg' width='200' height='200'>";
}

?>
</main>

    
<?php include "fin-page2.inc.php"; ?>