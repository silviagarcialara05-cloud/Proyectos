<?php session_start(); ?>
<?php
$donnees['menu'] = "Accueil";
$donnees['titre_page'] = "Page d'accueil";
require_once "debut-page2.inc.php";
?>

    <!-- Contenu principal -->
    <main>
    <section class="home-description">
    <div class="container">
        <h2>Bienvenue sur VenteVive</h2>
        <p>Découvrez une expérience de shopping en ligne exceptionnelle, où chaque clic vous rapproche de vos envies. Que vous recherchiez les dernières tendances de la mode, des gadgets innovants, des produits de beauté de qualité ou des articles pour la maison, notre boutique en ligne est votre destination ultime.</p>
    </div>
</section>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Découvrez nos catégories de produits</h2>
        
        <div class="row">
        
<?php
// Parcourir les résultats et afficher chaque produit comme un lien
for ($i = 0; $i < $nombreReponses; $i++) {
    echo '<div class="col-md-4 mb-4">';
    echo '<div class="card">';
    echo '<img src="categorie_upload/categorie-' . $enregistrements[$i]['id'] . '.jpg" width="300" height="200" class="card-img-top" alt="...">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $enregistrements[$i]['nom'] . '</h5>';
    echo '<a href="produit-categorie2.php?id=' . $enregistrements[$i]['id'] . '" class="btn btn-primary">Voir les produits</a>';
    echo '</div></div></div>';
}
?>

            
                
            </div>
        </div>
        <!-- Sélection des catégories -->
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form action="produit-categorie2.php" method="GET"> 
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Sélectionner une catégorie</label>
                        <select class="form-control" name="id" id="id">
                    
                    <?php
                        // parcourir le tableau des enregistrements
                        for ($i=0; $i<count($enregistrements); $i++)
                        {
                        ?>
                            <option value="<?php echo $enregistrements[$i]['id'];?>">
                                <?php echo $enregistrements[$i]['nom'];?>
                            </option>
                        <?php
                        }
                    ?>
                    </select>
                       
                    </div>
    <button type="submit" class="btn btn-primary">Voir</button> <!-- Bouton pour soumettre le formulaire -->
</form>
            </div>
        </div>
    </div>
</main>

    <?php require_once "fin-page2.inc.php"; ?>
