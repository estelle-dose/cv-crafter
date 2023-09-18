<?php
// Inclure la configuration de la base de données et démarrer la session
include("config.php");
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["login"])) {
    header("Location: connexion.php");
    exit;
}

// Vérifier si un identifiant d'expérience a été passé en paramètre GET
if (!isset($_GET["id"])) {
    header("Location: profil.php"); // Rediriger si l'identifiant n'est pas spécifié
    exit;
}

// Récupérer l'identifiant de l'expérience à partir du paramètre GET
$experience_id = $_GET["id"];

// Sélectionner les détails de l'expérience depuis la base de données
$experienceQuery = "SELECT poste, employeur, ville, date_start, date_end, description FROM experience WHERE id = ? AND utilisateurs_id = ?";
$experienceStmt = $conn->prepare($experienceQuery);
$experienceStmt->execute([$experience_id, $_SESSION["id"]]);
$experience = $experienceStmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si l'expérience existe et appartient à l'utilisateur
if (!$experience) {
    header("Location: profil.php"); // Rediriger si l'expérience n'existe pas ou n'appartient pas à l'utilisateur
    exit;
}

// Traitement du formulaire de mise à jour de l'expérience
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $poste = $_POST["poste"];
    $employeur = $_POST["employeur"];
    $ville_experience = $_POST["ville_experience"];
    $date_start_experience = $_POST["date_start_experience"];
    $date_end_experience = $_POST["date_end_experience"];
    $description_experience = $_POST["description_experience"];

    // Mettre à jour les informations de l'expérience dans la base de données
    $updateQuery = "UPDATE experience SET poste = ?, employeur = ?, ville = ?, date_start = ?, date_end = ?, description = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->execute([$poste, $employeur, $ville_experience, $date_start_experience, $date_end_experience, $description_experience, $experience_id]);

    // Rediriger l'utilisateur vers la page de profil après la mise à jour
    header("Location: profil.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier l'expérience</title>
    <!-- Inclure des liens vers les fichiers CSS ou d'autres ressources nécessaires -->
</head>
<body>
    <h1>Modifier l'expérience</h1>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="poste">Poste:</label>
        <input type="text" id="poste" name="poste" value="<?php echo $experience["poste"]; ?>" required><br>

        <label for="employeur">Employeur:</label>
        <input type="text" id="employeur" name="employeur" value="<?php echo $experience["employeur"]; ?>" required><br>

        <label for="ville_experience">Ville:</label>
        <input type="text" id="ville_experience" name="ville_experience" value="<?php echo $experience["ville"]; ?>" required><br>

        <label for="date_start_experience">Date de début:</label>
        <input type="date" id="date_start_experience" name="date_start_experience" value="<?php echo $experience["date_start"]; ?>" required><br>

        <label for="date_end_experience">Date de fin:</label>
        <input type="date" id="date_end_experience" name="date_end_experience" value="<?php echo $experience["date_end"]; ?>" required><br>

        <label for="description_experience">Description:</label>
        <textarea id="description_experience" name="description_experience" rows="4" required><?php echo $experience["description"]; ?></textarea><br>

        <input type="submit" value="Mettre à jour l'expérience">
    </form>
</body>
</html>
