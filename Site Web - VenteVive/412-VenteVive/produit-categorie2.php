<?php session_start(); ?>
<?php
require_once("connexion_base.php");

$donnees['menu'] = "Produit categorie";
$donnees['titre_page'] = "Page des produits";
require_once "debut-page2.inc.php";

$id_categorie = 1; // par défaut, affichage des produits de la catégorie avec l'id 1
if (isset($_GET['id'])) {
    $id_categorie = $_GET['id'];
}


// Récupérer tous les produits de la catégorie spécifiée
$requete_produits = "SELECT * FROM Vproduit WHERE id_Vcategorie=?";
$reponse_produits = $pdo->prepare($requete_produits);
$reponse_produits->execute(array($id_categorie));
$produits = $reponse_produits->fetchAll();

?>

<main>

<section class="home-description">
    <div class="container">
        <h2>Produits de la catégorie</h2>
        
    </div>
</section>
<div class="container mt-4">

<div class="row">

<?php foreach ($produits as $produit) { ?>
    <div class="col-md-4 mb-4">
        <div class="card">
            <img src="images_upload/produit-<?php echo $produit['id']; ?>-<?php echo $id_categorie; ?>.jpg" class="card-img-top" alt="<?php echo $produit['nom']; ?>" width="200" height="300">
            <div class="card-body">
                <h5 class="card-title"><a href="detail-produit2.php?id=<?php echo $produit['id']; ?>&categorie=<?php echo $produit['id_Vcategorie']; ?>"><?php echo $produit['nom']; ?></a></h5>
                <p class="card-text"><?php echo $produit['description']; ?></p>
                <p>Prix: <?php echo $produit['prix']; ?> $</p>
                <p>Stock: <?php echo $produit['stock']; ?> unités</p>
            </div>
        </div>
    </div>
<?php } ?>
    
</div>
</div>
</main>
<?php require_once "fin-page2.inc.php"; ?>
