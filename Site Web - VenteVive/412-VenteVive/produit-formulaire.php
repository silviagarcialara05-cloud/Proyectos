<?php session_start(); ?>
<?php
$donnees['menu'] = "Vente";
$donnees['titre_page'] = "Vendre votre produit";
require_once "debut-page2.inc.php";
?>
<main>
    <div class="container mt-4">

<h2>Ajoutez un nouveau produit</h2>
<form action="produit-enregistrer.php" enctype="multipart/form-data" method="post">
<p>Nom de produit:</p><input type="text" name="nom" /><br />
<p>Prix du produit:</p><input type="decimal" name="prix"  /><br />
<p>Description:<br /><textarea id="description" name="description" rows="4" cols="50"></textarea><br />
<p>Quantité:</p><input type="number" name="stock" /><br />
<p>Caterogie:</p><input type="number" name="id_Vcategorie" /><br />
<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
<input type="file" name="fichier" /><br />
<input class="btn btn-primary" type="submit" />
<a href="produit.php">Liste de produit</a></li>
</form>
</main>