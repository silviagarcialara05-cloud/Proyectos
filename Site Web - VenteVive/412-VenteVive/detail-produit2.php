<?php session_start(); ?>
<?php
require_once("connexion_base.php");

$donnees['menu'] = "Détail produit";
$donnees['titre_page'] = "Page de détail du produit";
require_once "debut-page2.inc.php";


// Vérifier si les identifiants existent dans l'URL
if (isset($_GET['id']) && isset($_GET['categorie'])) {
    // Récupérer les identifiants de l'URL
    $id_produit = $_GET['id'];
    $id_categorie = $_GET['categorie'];
}

// Récupérer les détails du produit spécifié
$requete_produit = "SELECT * FROM Vproduit WHERE id=? AND id_Vcategorie=?";
$reponse_produit = $pdo->prepare($requete_produit);
$reponse_produit->execute(array($id_produit, $id_categorie));
$produit = $reponse_produit->fetch();

// Récupérer les détails du produit spécifié
$requete_avis = "SELECT * FROM Vavis WHERE id_Vproduit=?";
$reponse_avis = $pdo->prepare($requete_avis);
$reponse_avis->execute(array($id_produit));
$avis = $reponse_avis->fetchAll();

?>
<main>
    <div class="container mt-4">
        <?php if ($produit): ?>
            <div class="product-detail">
                <h2><?php echo $produit['nom']; ?></h2>
                <p><?php echo $produit['description']; ?></p>
                <p>Prix : <?php echo $produit['prix']; ?></p>
                <p>Quantité en stock : <?php echo $produit['stock']; ?></p>
                <img src="images_upload/produit-<?php echo $produit['id']; ?>-<?php echo $id_categorie; ?>.jpg" alt="<?php echo $produit['nom']; ?>" class="img-fluid"  width="300" height="200"/>
            </div>

            <div class="product-reviews mt-4">
                <h2>Avis des clients</h2>
                <ul class="list-unstyled">
                    <?php foreach ($avis as $avisItem): ?>
                        <li class="card p-3 mb-3">
                            <p><?php echo $avisItem['commentaire']; ?></p>
                            <p>Note : <?php echo $avisItem['note']; ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
                
                <form action="ajouter-Vavis.php" method="post" class="add-review-form mt-4">
                    <fieldset>
                        <legend>Ajouter un avis</legend>
                        <div class="form-group">
                            <label for="commentaire">Commentaire :</label>
                            <textarea id="commentaire" name="commentaire" rows="4" class="form-control" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Note :</label><br>
                            <div class="rating">
                            <input type="radio" id="note1" name="note" value="1" required>
                            <label for="note1">1</label>
                            <input type="radio" id="note2" name="note" value="2" required>
                            <label for="note2">2</label>
                            <input type="radio" id="note3" name="note" value="3" required>
                            <label for="note3">3</label>
                            <input type="radio" id="note4" name="note" value="4" required>
                            <label for="note4">4</label>
                            <input type="radio" id="note5" name="note" value="5" required>
                            <label for="note5">5</label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Soumettre</button>
                    </fieldset>
                    <input type="hidden" name="id_produit" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>" />
                </form>
            </div>
            
            <form action="panier.php?id=<?php echo $produit['id']; ?>" method="post" class="buy-form mt-4">
                
                <button type="submit" class="btn btn-primary">Ajouter au panier</button>
            </form>
        <?php else: ?>
            <p class="text-danger">Aucun produit trouvé pour cet identifiant.</p>
        <?php endif; ?>

        <a href="accueil2.php" class="btn btn-secondary mt-4">Retour à l'accueil</a>
    </div>
</main>


<?php require_once "fin-page2.inc.php"; ?>
