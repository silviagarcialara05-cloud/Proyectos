<?php session_start(); ?>
<?php require_once("connexion_base.php"); ?>
<?php
if (!empty($_POST['nom']&&$_POST['prix']&&$_POST['description']&&$_POST['stock']&&['id_Vcategorie']))
{
$nom = $_POST['nom'];
$description = $_POST['description'];
$prix = $_POST['prix'];
$stock = $_POST['stock'];
$id_Vcategorie = $_POST['id_Vcategorie'];
// exécuter une requete MySQL de type INSERT
$requete="INSERT INTO Vproduit (nom, description, prix, stock, id_Vcategorie, dateajout) VALUES (?,?,?,?,?,NOW())";
$reponse=$pdo->prepare($requete);
$reponse->execute(array($nom,$description,$prix,$stock,$id_Vcategorie));

// récupérer l'idenitifant du dernier enregistrement inséré
$message = "";

// récupérer l'idenitifant du dernier enregistrement inséré
$dernier_id = $pdo->lastInsertId();
// code du prochain exercice ici
// print_r($_FILES['fichier']); // Commentez cette ligne quand tout va bien
// print_r($_FILES); // Commentez cette ligne quand tout va bien
if(!empty($_FILES['fichier']['tmp_name']))
    {
    $size = getimagesize($_FILES['fichier']['tmp_name']);
    // print_r($size); // Commentez cette ligne quand tout va bien
    // echo "Filetype : ".$size['mime']; // Commentez cette ligne quand tout va bien
    if ($size['mime'] == "image/jpeg")
    {
        $uploaddir = $_SERVER['DOCUMENT_ROOT']."/cswd/VenteVive/images_upload/";
        $uploadfile = "produit-" . $dernier_id . "-" . $id_Vcategorie . ".jpg";
        if (move_uploaded_file($_FILES['fichier']['tmp_name'], $uploaddir.$uploadfile))
        {
            echo $message = $message ." Votre produit a bien été ajouté  ";
        }
        else
        {
            echo $message = $message . "Problème sur le serveur : ".$uploaddir;
        }
    }
    else
    {
        echo $message = $message . "Pas le bon type de fichier : ".$size['mime'];
    }
}
else
{
    echo $message = $message . "Pas de fichier spécifié.";
}
}
else
{
    echo $message = "Spécifiez un nom de produit svp.";
}
?>

<ul>
    <li><a href="produit.php">Liste de produits</a></li>
    <li><a href="produit-formulaire.php">Ajouter un autre produit</a></li>
</ul>