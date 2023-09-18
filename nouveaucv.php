<?php
session_start();

// Assurez-vous que l'utilisateur est connecté
if (!isset($_SESSION["login"])) {
    header("Location: connexion.php");
    exit;
}

$host = "localhost";
$dbname = "cvcrafter";
$username = "root";
$passwordDB = "Etoile19*";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $passwordDB);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les informations de l'utilisateur connecté
    $query = "SELECT login, prenom, nom, phone, postal, ville, photo FROM utilisateurs WHERE login = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$_SESSION["login"]]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Afficher les informations de l'utilisateur
    echo "<h1>CV</h1>";
    echo "<p> <img src='upload/" . $row['photo'] . "' height='200'></p>";
    echo "<p><strong>Prénom:</strong> " . $row["prenom"] . "</p>";
    echo "<p><strong>Nom:</strong> " . $row["nom"] . "</p>";
    echo "<p><strong>Numéro de téléphone:</strong> " . $row["phone"] . "</p>";
    echo "<p><strong>Code postal:</strong> " . $row["postal"] . "</p>";
    echo "<p><strong>Ville:</strong> " . $row["ville"] . "</p>";
    
    // Afficher les expériences de l'utilisateur
    echo "<h2>Expériences</h2>";
    $experiencesQuery = "SELECT poste, employeur, ville, date_start, date_end, description FROM experience WHERE utilisateurs_id = ?";
    $experiencesStmt = $conn->prepare($experiencesQuery);
    $experiencesStmt->execute([$_SESSION["id"]]);
    $experiences = $experiencesStmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($experiences as $experience) {
        echo "<p><strong>Poste:</strong> " . $experience["poste"] . "</p>";
        echo "<p><strong>Employeur:</strong> " . $experience["employeur"] . "</p>";
        echo "<p><strong>Ville:</strong> " . $experience["ville"] . "</p>";
        echo "<p><strong>Date de début:</strong> " . $experience["date_start"] . "</p>";
        echo "<p><strong>Date de fin:</strong> " . $experience["date_end"] . "</p>";
        echo "<p><strong>Description:</strong> " . $experience["description"] . "</p>";
        echo "</br>";
    }

    // Afficher les formations de l'utilisateur
    echo "<h2>Formations</h2>";
    $formationsQuery = "SELECT nom_formation, nom_etablissement, ville, date_start, date_end, description FROM formation WHERE utilisateurs_id = ?";
    $formationsStmt = $conn->prepare($formationsQuery);
    $formationsStmt->execute([$_SESSION["id"]]);
    $formations = $formationsStmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($formations as $formation) {
        echo "<p><strong>Nom de la formation:</strong> " . $formation["nom_formation"] . "</p>";
        echo "<p><strong>Nom de l'établissement:</strong> " . $formation["nom_etablissement"] . "</p>";
        echo "<p><strong>Ville:</strong> " . $formation["ville"] . "</p>";
        echo "<p><strong>Date de début:</strong> " . $formation["date_start"] . "</p>";
        echo "<p><strong>Date de fin:</strong> " . $formation["date_end"] . "</p>";
        echo "<p><strong>Description:</strong> " . $formation["description"] . "</p>";
        echo "</br>";
    }

    // Afficher les compétences de l'utilisateur
    echo "<h2>Compétences</h2>";
    $competencesQuery = "SELECT nom, niveau FROM competence WHERE utilisateurs_id = ?";
    $competencesStmt = $conn->prepare($competencesQuery);
    $competencesStmt->execute([$_SESSION["id"]]);
    $competences = $competencesStmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($competences as $competence) {
        echo "<p><strong>Nom de la compétence:</strong> " . $competence["nom"] . "</p>";
        echo "<p><strong>Niveau de la compétence:</strong> " . $competence["niveau"] . "</p>";
        echo "</br>";
    }

    // Afficher les intérêts de l'utilisateur
    echo "<h2>Intérêts</h2>";
    $interetsQuery = "SELECT nom FROM interet WHERE utilisateurs_id = ?";
    $interetsStmt = $conn->prepare($interetsQuery);
    $interetsStmt->execute([$_SESSION["id"]]);
    $interets = $interetsStmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($interets as $interet) {
        echo "<p><strong>Nom de l'intérêt:</strong> " . $interet["nom"] . "</p>";
        echo "</br>";
    }

    // Afficher les langues de l'utilisateur
    echo "<h2>Langues</h2>";
    $languesQuery = "SELECT nom, niveau FROM langue WHERE utilisateurs_id = ?";
    $languesStmt = $conn->prepare($languesQuery);
    $languesStmt->execute([$_SESSION["id"]]);
    $langues = $languesStmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($langues as $langue) {
        echo "<p><strong>Langue:</strong> " . $langue["nom"] . "</p>";
        echo "<p><strong>Niveau de la langue:</strong> " . $langue["niveau"] . "</p>";
        echo "</br>";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Votre CV</title>
    <link id="style" rel="stylesheet" type="text/css" href="newcv.css">
</head>
<body>
    <!-- Le contenu de votre CV -->

    <div class="container">
        <!-- Le contenu de votre CV -->
    </div>
</body>
</html>

