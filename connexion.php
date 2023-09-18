<?php
session_start();

// Vérification de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $login = $_POST["login"];
    $password = $_POST["password"];

    // Connexion à la base de données
    $conn = new mysqli("localhost", "root", "Etoile19*", "cvcrafter");

    // Vérification des erreurs de connexion
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données : " . $conn->connect_error);
    }

    // Requête de vérification de l'utilisateur
    $sql = "SELECT * FROM utilisateurs WHERE login = '$login' AND password = '$password'";

    // Exécution de la requête
    $result = $conn->query($sql);

    // Vérification si l'utilisateur existe
    if ($result->num_rows == 1) {
           // Récupérer l'ID de l'utilisateur
           $row = $result->fetch_assoc();
        
        // Utilisateur trouvé, création des variables de session
        $_SESSION["logged_in"] = true;
        $_SESSION["id"] = $row['id'];
        $_SESSION["login"] = $row['login'];
        
        if ($login == "admin" AND $password == "admin") {
            // Redirection vers la page d'administration si l'utilisateur est admin
            header("Location: admin.php");
            exit();
        } else {
            // Redirection vers la page de profil pour les utilisateurs normaux
            header("Location: profil.php");
            exit();
        }
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }

    // Fermeture de la connexion à la base de données
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link id="style" rel="stylesheet" type="text/css" href="style6.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&display=swap');
  </style>
</head>
<body>
    <form method="POST" action="connexion.php">
        <h1>Connexion</h1>
        <label for="login">Nom d'utilisateur :</label>
        <input type="text" id="login" name="login" required><br>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Se connecter">
    </form>
</body>
</html>
