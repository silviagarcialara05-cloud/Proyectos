<?php
session_start();
require_once("connexion_base.php");

// Vérifie si les paramètres nécessaires sont présents dans l'URL
if (isset($_GET['id']) && isset($_GET['nom']) && isset($_GET['prix'])&& isset($_GET['stock'])&& isset($_GET['id_Vcategorie'])) {
    // Récupère les détails du produit depuis l'URL
    $id_produit = $_GET['id'];
    $nom_produit = $_GET['nom'];
    $prix_produit = $_GET['prix'];
    $stock_produit = $_GET['stock'];
    $id_Vcategorie = $_GET['id_Vcategorie'];


    // Initialise le panier s'il n'existe pas déjà dans la session
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }

    // Ajoute le produit au panier
    $_SESSION['panier'][] = [
        'id' => $id_produit,
        'nom' => $nom_produit,
        'prix' => $prix_produit,
        'stock'=> $stock_produit,
        'id_Vcategorie'=> $id_Vcategorie

    ];


    // Récupérer les détails du produit spécifié
    $requete_produit = "SELECT * FROM Vproduit WHERE id=? AND id_Vcategorie=?";
    $reponse_produit = $pdo->prepare($requete_produit);
    $reponse_produit->execute(array($id_produit, $id_categorie));
    $produit = $reponse_produit->fetch();

    // Redirige vers la page d'accueil ou une autre page
    header('Location: accueil.php');
    exit();
} else {
    // Redirige vers une autre page en cas de paramètres manquants
    header('Location: accueil.php');
    exit();
}
?>
