<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
if (!isset($_SESSION["login"])) {
    header("Location: connexion.php");
    exit;
}

// Vérifiez si la demande est une demande POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $experienceId = $_POST["experienceId"];
    $poste = $_POST["poste"];
    $employeur = $_POST["employeur"];
    $ville_experience = $_POST["ville_experience"];
    $date_start_experience = $_POST["date_start_experience"];
    $date_end_experience = $_POST["date_end_experience"];
    $description_experience = $_POST["description_experience"];

    // Mettez à jour l'expérience dans la base de données en utilisant PDO

    $host = "localhost";
    $dbname = "cvcrafter";
    $username = "root";
    $passwordDB = "Etoile19*";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $passwordDB);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $updateQuery = "UPDATE experience SET poste = ?, employeur = ?, ville = ?, date_start = ?, date_end = ?, description = ? WHERE id = ? AND utilisateurs_id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->execute([$poste, $employeur, $ville_experience, $date_start_experience, $date_end_experience, $description_experience, $experienceId, $_SESSION["id"]]);

        echo "Expérience mise à jour avec succès";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
