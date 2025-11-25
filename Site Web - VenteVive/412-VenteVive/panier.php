<?php session_start(); ?>
<?php
require_once("connexion_base.php");

$donnees['menu'] = "Acheter produit";
$donnees['titre_page'] = "Acheter un produit";
require_once "debut-page2.inc.php";

// Vérifier si l'identifiant du produit existe dans l'URL
if (isset($_GET['id'])) {
    // Récupérer l'identifiant du produit de l'URL
    $id_produit = $_GET['id'];

    // Récupérer les détails du produit spécifié
    $requete_produit = "SELECT * FROM Vproduit WHERE id=?";
    $reponse_produit = $pdo->prepare($requete_produit);
    $reponse_produit->execute(array($id_produit));
    $produit = $reponse_produit->fetch();
}
?>

<main>
    <div class="container mt-4">
        <?php if ($produit): ?>
            <div class="product-detail">
                <h2><?php echo $produit['nom']; ?></h2>
                <p><?php echo $produit['description']; ?></p>
                <p>Prix : <?php echo $produit['prix']; ?></p>
                <p>Quantité en stock : <?php echo $produit['stock']; ?></p>
            </div>

            <form action="confirmation-achat.php" method="post" class="buy-form mt-4">
                <input type="hidden" name="id" value="<?php echo $produit['id']; ?>" />
                <div class="form-group">
                    <label for="quantite">Quantité :</label>
                    <input type="number" id="quantite" name="quantite" class="form-control" min="1" max="<?php echo $produit['stock']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Acheter</button>
            </form>
        <?php else: ?>
            <p class="text-danger">Aucun produit trouvé pour cet identifiant.</p>
        <?php endif; ?>

        <a href="accueil.php" class="btn btn-secondary mt-4">Retour à l'accueil</a>
    </div>
</main>

<?php require_once "fin-page2.inc.php"; ?>

