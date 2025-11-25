<?php session_start(); ?>
<?php
require_once("connexion_base.php");

$donnees['menu'] = "Détail produit";
$donnees['titre_page'] = "Page de détail du produit";
// Inclure le fichier d'en-tête et de mise en page
require_once("debut-page2.inc.php");

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Récupérer le critère de recherche
    $search = $_GET['search'];
    $id_categorie = $_GET['id'];

    // Construire la requête SQL
    $requete_recherche = "SELECT * FROM Vproduit WHERE id_Vcategorie = ? AND nom LIKE ?";
    $reponse_recherche = $pdo->prepare($requete_recherche);
    $reponse_recherche->execute(array($id_categorie, "%$search%"));
    $resultats = $reponse_recherche->fetchAll();
}


?>
<main>

<div class="container mt-4">
    <h2>Résultats de la recherche</h2>

    <?php if (isset($resultats) && count($resultats) > 0) : ?>
        <div class="row">
            <?php foreach ($resultats as $produit) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="images_upload/produit-<?php echo $produit['id']; ?>-<?php echo $produit['id_Vcategorie']; ?>.jpg" class="card-img-top" alt="<?php echo $produit['nom']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $produit['nom']; ?></h5>
                            <p class="card-text"><?php echo $produit['description']; ?></p>
                            <p class="card-text">Prix: <?php echo $produit['prix']; ?></p>
                            <p class="card-text">Stock: <?php echo $produit['stock']; ?></p>
                            <a href="detail-produit2.php?id=<?php echo $produit['id']; ?>&categorie=<?php echo $produit['id_Vcategorie']; ?>" class="btn btn-primary">Détails</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p>Aucun produit trouvé pour la recherche "<?php echo $search; ?>".</p>
    <?php endif; ?>
</div>
    </main>
<?php require_once("fin-page2.inc.php"); ?>
