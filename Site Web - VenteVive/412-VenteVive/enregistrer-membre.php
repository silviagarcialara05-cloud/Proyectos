<?php session_start(); ?>
<?php
require_once("connexion_base.php");

$reussi = false;
if (!empty($_POST['pseudo']) && !empty($_POST['motdepasse']) && !empty($_POST['email']) &&
    !empty($_POST['prenom']) && !empty($_POST['nom']) && 
    !empty($_POST['consentement']))
{
    $pseudo = $_POST['pseudo'];
    $motdepasse = $_POST['motdepasse'];
    $email = $_POST['email'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];

    $motdepasse_crypte = password_hash($motdepasse, PASSWORD_DEFAULT);



    $requete="INSERT INTO Vmembre (pseudo,motdepasse,prenom,nom,email,datecreation) VALUES (?, ?, ?, ?, ?, NOW())";
    $reponse=$pdo->prepare($requete);
    $reponse->execute(array($pseudo, $motdepasse_crypte, $prenom, $nom, $email));
    $reussi = true;
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>Récapitulatif</title>
    </head>
    <body>
    <?php
    if ($reussi == true)
    {
    ?>
        <h2>Récapitulatif des informations</h2>
        <p>
            Nom : <?php echo $nom; ?><br />
            Prénom :<?php echo $prenom; ?><br />
            Adresse email : <?php echo $email; ?><br />
            Pseudo : <?php echo $pseudo; ?><br />
            Mot de passe : **********<br />
        </p>
        <a href="connexion.php"> Connexion</a>
    <?php
    }
    else
    {
    ?>
        <p>Veuillez svp renseigner toutes les informations.</p>
    <?php
    }
    ?>
    </body>
</html>
