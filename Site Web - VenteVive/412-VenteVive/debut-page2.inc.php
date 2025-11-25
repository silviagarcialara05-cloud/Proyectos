<?php 
require_once("connexion_base.php"); 

// exécuter une requete MySQL
$requete = "SELECT * FROM Vcategorie;";
$reponse = $pdo->prepare($requete);
$reponse->execute();
// récupérer tous les enregistrements dans un tableau
$enregistrements = $reponse->fetchAll();
// connaitre le nombre d'enregistrements
$nombreReponses = count($enregistrements);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $donnees['titre_page']; ?></title>
    <!-- Liens vers les fichiers CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Style personnalisé -->
    <link href="./css/styles.css" rel="stylesheet">
</head>
<body>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="accueil2.php">VenteVive</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
                <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php echo ($donnees['menu'] == 'Accueil') ? 'active' : ''; ?>">
                       
                <li class="nav-item <?php echo ($donnees['menu'] == 'Accueil') ? 'active' : ''; ?>">
                        <?php if ($donnees['menu'] == 'Connexion') { ?>
                            <span class="nav-link">Connexion</span>
                        <?php } else { ?>
                            <a class="nav-link" href="connexion.php">Connexion</a>
                        <?php } ?>
                    </li>
                    <li class="nav-item <?php echo ($donnees['menu'] == 'verifier-connexion') ? 'active' : ''; ?>">
                        <?php if ($donnees['menu'] == 'verifier-connexion') { ?>
                            <span class="nav-link">Incription</span>
                        <?php } else { ?>
                            <a class="nav-link" href="inscription.php">Incription</a>
                        <?php } ?>
                    </li>
                    <li class="nav-item <?php echo ($donnees['menu'] == 'deconnexion') ? 'active' : ''; ?>">
                        <?php if ($donnees['menu'] == 'deconnexion') { ?>
                            <span class="nav-link">deconnexion</span>
                        <?php } else { ?>
                            <a class="nav-link" href="deconnexion.php">Deconnexion</a>
                        <?php } ?>
                    </li>
                    <li class="nav-item <?php echo ($donnees['menu'] == 'Ajouter un produit') ? 'active' : ''; ?>">
                        <?php if ($donnees['menu'] == 'Ajouter un produit') { ?>
                            <span class="nav-link">Vendre</span>
                        <?php } else { ?>
                            <a class="nav-link" href="produit-formulaire.php">Vendre</a>
                        <?php } ?>
                    </li>
                </ul>
                <!-- Barre de recherche -->
                
                <form class="form-inline my-2 my-lg-0" action="rechercher.php" method="GET">
                <fieldset>
                <lablel style="color: green;">Catégorie:</label>
                        
                    <select name="id" id="id">
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
            
                    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Rechercher" aria-label="Rechercher">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </nav>