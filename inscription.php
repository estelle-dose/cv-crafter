<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $login = $_POST["login"];
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $mail = $_POST["mail"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $phone = $_POST["phone"];
    $postal = $_POST["postal"];
    $ville = $_POST["ville"];
    
    // Vérifier si les mots de passe correspondent
    if ($password === $confirmPassword) {
        // Connexion à la base de données
        $host = "localhost";
        $dbname = "cvcrafter";
        $username = "root";
        $passwordDB = "Etoile19*";
        
        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $passwordDB);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Insérer les données dans la table utilisateurs
            $query = "INSERT INTO utilisateurs (login, prenom, nom, mail, password, phone, postal, ville) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->execute([$login, $prenom, $nom, $mail, $password, $phone, $postal, $ville]);
            
            // Redirection vers la page de connexion
            header("Location: connexion.php");
            exit;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        echo "Les mots de passe ne correspondent pas.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <link id="style" rel="stylesheet" type="text/css" href="style.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Assistant&display=swap');
  </style>
</head>
<body>
<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <h1>Inscription</h1>
        <br>
        <div  class="login-box">
            <div class="user-box">
                <input type="text" id="login" name="login" required>
                <label for="login">Login</label>
            </div>
            <div class="user-box">
                <input type="text" id="prenom" name="prenom" required>
                <label for="prenom">Prénom</label>
            </div>
            <div class="user-box">
                <input type="text" id="nom" name="nom" required>
                <label for="nom">Nom</label>
            </div>
            <div class="user-box">
                <input type="text" id="mail" name="mail" required>
                <label for="mail">Mail</label>
            </div>
            <div class="user-box">
                <input type="tel" id="phone" name="phone" required>
                <label for="phone">Télephone</label>
            </div>
            <div class="user-box">
                <input type="text" id="postal" name="postal" required>
                <label for="postal">Code postal</label>
            </div>
            <div class="user-box">
                <input type="text" id="ville" name="ville" required>
                <label for="ville">Ville</label>
            </div>
            <div class="user-box">
                <input type="password" id="password" name="password" required>
                <label for="password">Mot de passe</label>
            </div>
            <div class="user-box">
                <input type="password" id="confirmPassword" name="confirmPassword" required>
                <label for="confirmPassword">Confirmer le mot de passe</label>
            </div>
        </div>

        <button class="button"><input type="submit" value="S'inscrire"></button>
    </form>
</body>
</html>
