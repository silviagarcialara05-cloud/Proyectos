<?php
session_start();
require_once("connexion_base.php");
$donnees['menu'] = "Verifier";
$donnees['titre_page'] = "Verification";
include "debut-page2.inc.php";
?>
<?php
require_once "connexion_base.php";
$nombreReponses = 0;
if (!empty($_POST['pseudo']) && !empty($_POST['motdepasse'])) {
    $pseudo = $_POST['pseudo'];
    $motdepasse = $_POST['motdepasse'];
// exécuter une requete MySQL de type SELECT .. WHERE
    $requete = "SELECT * FROM Vmembre WHERE pseudo = ?";
    $reponse = $pdo->prepare($requete);
    $reponse->execute(array($pseudo));
// récupérer tous les enregistrements dans un tableau
    $enregistrements = $reponse->fetchAll();
// connaitre le nombre d'enregistrements
    $nombreReponses = count($enregistrements);
}
?>
<main>

<div class="container mt-4">

            <?php
                if ($nombreReponses > 0) {
                    // on vérifie si le mot de passe de la base de données au mot de passe du formulaire
                    $motdepasse_crypte = $enregistrements[0]['motdepasse'];
                    if (password_verify($motdepasse, $motdepasse_crypte)) {
                        // pseudo et mot de passe correspondent
                        $_SESSION['pseudo'] = $pseudo;
                        $_SESSION['id_Vmembre'] = $enregistrements[0]['id'];
                        echo "Bienvenue, " . $pseudo . "!<br>";
                        echo "<a href='accueil2.php'>Lien vers l'accueil</a>";
                    } else {
                        // pseudo existe mais mot de passe ne correspond pas
                        echo "Mot de passe incorrect.";
                        echo "<a href='connexion.php'>Connexion</a>!<br>";
                    }
                } else {
                    // le membre n'existe pas
                    echo "<a href='inscription.php'>Inscription</a>";
                    echo "<a href='connexion.php'>Connexion</a>!<br>";
                }
                ?>
                </main>
  <?php include "fin-page2.inc.php"; ?>