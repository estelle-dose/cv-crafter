<?php
// Démarrer la session
session_start();

// Récupérer les informations de session
if (!isset($_SESSION["login"])) {
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: connexion.php");
    exit;
}

// Récupérer les informations de la base de données
$host = "localhost";
$dbname = "cvcrafter";
$username = "root";
$passwordDB = "Etoile19*";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $passwordDB);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Exemple de requête pour récupérer des informations de la base de données
    $query = "SELECT login, prenom, nom, password, phone, postal, ville, photo FROM utilisateurs WHERE login = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$_SESSION["login"]]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vous pouvez maintenant utiliser $userData pour afficher les informations de l'utilisateur
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nouveau CV</title>
    <link id="style" rel="stylesheet" type="text/css" href="style.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Assistant&display=swap');
  </style>
</head>
<body>
    <h1>Nouveau CV</h1>
    <p>Bienvenu dans la création de cv</p>
</html>
