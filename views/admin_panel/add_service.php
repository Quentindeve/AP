<?php
require_once "../../model/security.php";
global $SECURITY_ADMIN_LEVEL;

$SECURITY_ADMIN_LEVEL->authorize();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/static/css/role.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Ajouter un role</title>
</head>
<body>
    
    <?php
// Informations de connexion à la base de données
$serveur = "192.168.20.70:3306";
$utilisateur = "dev";
$motDePasse = "azerty1234+";
$baseDeDonnees = "LPFS";

// Récupérer les données soumises par le formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_service = $_POST["nom_service"];

    // Connexion à la base de données
    $connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

    if ($connexion->connect_error) {
        die("Erreur de connexion à la base de données : " . $connexion->connect_error);
    }

    // Requête SQL pour insérer les données dans la table "produits" avec l'image encodée en base64
    $sql = "INSERT INTO services (nom_service) VALUES (?)";
$stmt = $connexion->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $nom_service);
    if ($stmt->execute()) {
        echo "Le service a été ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du service : " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Erreur de préparation de la requête : " . $connexion->error;
}

    // Fermeture de la connexion à la base de données
    $connexion->close();
}
?>

<div class="mainscreen">

<div class="card">

  <div class="leftside">
    <img src="/static/images/LPFS_logo.png" alt="">
  </div>

  <p class="titre_form">Formulaire d'ajout d'un service</p>
<form method="post" enctype="multipart/form-data" class="formulaire">
    <label for="nom">Nom du Service:</label>
    <input type="text" id="nom_service" name="nom_service" required><br><br>

    <!-- Messages d'erreur -->
<p id="error-nom_service" class="error-message"></p>


    <input type="submit" value="Ajouter le service" id="ajoute">
</form>

<a href="/views/admin_panel/panel.php" ><i class="fa-solid fa-door-open" id="retour"></i></a>

</div>

</body>

</html>



