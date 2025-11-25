<?php
session_start();

// Vérifier si l'identifiant du produit et la quantité sont reçus
if (isset($_POST['id']) && isset($_POST['quantite'])) {
    // Récupérer l'identifiant du produit et la quantité
    $id_produit = $_POST['id'];
    $quantite = $_POST['quantite'];
} 
$donnees['menu'] = "Confirmation";
$donnees['titre_page'] = "Confirmation";
require_once "debut-page2.inc.php";

?>
    <!-- Liens vers les fichiers CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="alert alert-success" role="alert">
            Félicitations, vous avez acheté <?php echo $quantite; ?> exemplaire(s) du produit !
        </div>
        <a href="accueil2.php" class="btn btn-primary">Retour à l'accueil</a>
    </div>
<?php require_once "fin-page2.inc.php"; ?>