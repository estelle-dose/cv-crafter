<?php
// Démarrer la session
session_start();

// Récupérer les informations de l'utilisateur connecté depuis la base de données
$host = "localhost";
$dbname = "cvcrafter";
$username = "root";
$passwordDB = "Etoile19*";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $passwordDB);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les informations de l'utilisateur connecté
    $query = "SELECT login, prenom, nom, mail, password, phone, postal, ville, photo FROM utilisateurs WHERE login = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$_SESSION["login"]]);
    $row = $stmt->fetch();



// langue

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // ...

    // Ajouter une langue
        if (isset($_POST["ajouter_langue"])) {
            // Récupérez les données du formulaire de langue
            $nom_langue = $_POST["nom_langue"];
            $niveau_langue = $_POST["niveau_langue"]; // Récupérez la valeur sélectionnée
    
            // Insérez les données dans la table "langue"
            $insertQuery = "INSERT INTO langue (utilisateurs_id, nom, niveau) VALUES (?, ?, ?)";
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->execute([$_SESSION["id"], $nom_langue, $niveau_langue]);
    
            // Redirigez l'utilisateur vers la page "profil.php" après l'ajout
            header("Location: profil.php");
            exit;
        }
        }
    

    // expérience

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["ajouter_experience"])) {
            // Récupérez les données du formulaire d'expérience
            $poste = $_POST["poste"];
            $employeur = $_POST["employeur"];
            $ville_experience = $_POST["ville_experience"];
            $date_start_experience = $_POST["date_start_experience"];
            $date_end_experience = $_POST["date_end_experience"];
            $description_experience = $_POST["description_experience"];

            // Insérez les données dans la table "experience"
            $insertQuery = "INSERT INTO experience (utilisateurs_id, poste, employeur, ville, date_start, date_end, description) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->execute([$_SESSION["id"], $poste, $employeur, $ville_experience, $date_start_experience, $date_end_experience, $description_experience]);

            // Redirigez l'utilisateur vers la page "profil.php" après l'ajout
            header("Location: profil.php");
            exit;
        } 

        // Formation
        if (isset($_POST["ajouter_formation"])) {
            // Récupérez les données du formulaire de formation
            $nom_formation = $_POST["nom_formation"];
            $nom_etablissement = $_POST["nom_etablissement"];
            $ville_formation = $_POST["ville_formation"];
            $date_start_formation = $_POST["date_start_formation"];
            $date_end_formation = $_POST["date_end_formation"];
            $description_formation = $_POST["description_formation"];

            // Insérez les données dans la table "formation"
            $insertFormationQuery = "INSERT INTO formation (utilisateurs_id, nom_formation, nom_etablissement, ville, date_start, date_end, description) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $insertFormationStmt = $conn->prepare($insertFormationQuery);
            $insertFormationStmt->execute([$_SESSION["id"], $nom_formation, $nom_etablissement, $ville_formation, $date_start_formation, $date_end_formation, $description_formation]);

            // Redirigez l'utilisateur vers la page "profil.php" après l'ajout
            header("Location: profil.php");
            exit;
        }

        // Competence

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["ajouter_competence"])) {
                // Récupérez les données du formulaire de compétence
                $nom_competence = $_POST["nom_competence"];
                $niveau_competence = $_POST["niveau_competence"]; // Récupérez la valeur sélectionnée
        
                // Insérez les données dans la table "competence"
                $insertQuery = "INSERT INTO competence (utilisateurs_id, nom, niveau) VALUES (?, ?, ?)";
                $insertStmt = $conn->prepare($insertQuery);
                $insertStmt->execute([$_SESSION["id"], $nom_competence, $niveau_competence]);
        
                // Redirigez l'utilisateur vers la page "profil.php" après l'ajout
                header("Location: profil.php");
                exit;
            }
        }

        
        //Interet

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["ajouter_interet"])) {
                // Récupérez les données du formulaire d'intérêt
                $nom_interet = $_POST["nom_interet"];
        
                // Insérez les données dans la table "interet"
                $insertQuery = "INSERT INTO interet (utilisateurs_id, nom) VALUES (?, ?)";
                $insertStmt = $conn->prepare($insertQuery);
                $insertStmt->execute([$_SESSION["id"], $nom_interet]);
        
                // Redirigez l'utilisateur vers la page "profil.php" après l'ajout
                header("Location: profil.php");
                exit;
            }
        }        
        
        // utilisateur
        
        if (isset($_POST["enregistrer_modifications"])) {
            // Récupérer les nouvelles données du formulaire de profil
        $newLogin = $_POST["login"];
        $newPrenom = $_POST["prenom"];
        $newNom = $_POST["nom"];
        $newMail = $_POST["mail"];
        $newphone = $_POST["phone"];
        $newpostal = $_POST["postal"];
        $newville = $_POST["ville"];
        $newPassword = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];
    
// Récupérer le mot de passe actuel
            $currentPasswordQuery = "SELECT password FROM utilisateurs WHERE login = ?";
            $currentPasswordStmt = $conn->prepare($currentPasswordQuery);
            $currentPasswordStmt->execute([$_SESSION["login"]]);
            $currentPasswordRow = $currentPasswordStmt->fetch(PDO::FETCH_ASSOC);
            $currentPassword = $currentPasswordRow["password"];

            // Vérifier si l'utilisateur souhaite modifier le mot de passe
            if (!empty($newPassword)) {
                if ($newPassword === $confirmPassword) {
                    // L'utilisateur souhaite modifier le mot de passe, assurez-vous de le hasher avant de le stocker en base de données
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                } else {
                    // Les mots de passe ne correspondent pas, vous pouvez afficher un message d'erreur ou rediriger vers la page avec un message d'erreur.
                    echo "Les mots de passe ne correspondent pas.";
                    exit;
                }
            } else {
                // L'utilisateur ne souhaite pas modifier le mot de passe, conservez le mot de passe actuel
                $hashedPassword = $currentPassword;
            }

                    // Mettre à jour les informations de l'utilisateur
            $updateQuery = "UPDATE utilisateurs SET login = ?, prenom = ?, nom = ?, mail = ?, phone = ?, postal = ?, ville = ?, password = ? WHERE login = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->execute([$newLogin, $newPrenom, $newNom, $newMail, $newphone, $newpostal, $newville, $hashedPassword, $_SESSION["login"]]);

            // Vérifier si un nouveau fichier image a été téléchargé
            if ($_FILES["photo"]["error"] === UPLOAD_ERR_OK) {
                // Un nouveau fichier image a été téléchargé
                // Vous pouvez ajouter votre logique de validation d'image ici

// Mettre à jour la photo de profil
                $updateQuery = "UPDATE utilisateurs SET login = ?, prenom = ?, nom = ?, mail = ?, phone = ?, postal = ?, ville = ?, photo = ? WHERE login = ?";
                $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->execute([$newLogin, $newPrenom, $newNom, $newMail, $newphone, $newpostal, $newville, $_FILES["photo"]["name"], $_SESSION["login"]]);
        
// Déplacer le fichier téléchargé
                    move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $_FILES["photo"]["name"]);
                    echo "Votre fichier a été téléchargé avec succès.";
}

                    // Redirection vers la page de profil mise à jour
            header("Location: profil.php");
                        exit;
}
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

// Traitement de la déconnexion
if (isset($_GET["logout"])) {
    // Supprimer toutes les variables de session
    session_unset();

    // Détruire la session
    session_destroy();

    // Redirection vers la page de connexion
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" 
    integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link id="style" rel="stylesheet" type="text/css" href="styleprof.css">
    <script defer src="script.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Assistant&display=swap');
    </style>
</head>
<body class="bodyprof">
    <section class="modif">
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <h1>Profil</h1>
        <!-- Display the user's current login and other fields here -->
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" value="<?php echo $row["login"]; ?>" required><br>

        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo $row["prenom"]; ?>" required><br>

        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?php echo $row["nom"]; ?>" required><br>

        <label for="mail">Mail:</label>
        <input type="text" id="mail" name="mail" value="<?php echo $row["mail"]; ?>" required><br>

        <label for="phone">Numéro de téléphone:</label>
        <input type="tel" id="phone" name="phone" value="<?php echo $row["phone"]; ?>" required><br>

        <label for="postal">Code postal:</label>
        <input type="text" id="postal" name="postal" value="<?php echo $row["postal"]; ?>" required><br>

        <label for="ville">Ville:</label>
        <input type="text" id="ville" name="ville" value="<?php echo $row["ville"]; ?>" required><br>

        <!-- Affichage du champ de modification du mot de passe -->
        <label for="password">Nouveau mot de passe:</label>
        <input type="password" id="password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>" placeholder="Laissez vide pour conserver le mot de passe actuel"><br>

    <label for="confirmPassword">Confirmez le nouveau mot de passe:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" value="<?php echo isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : ''; ?>" placeholder="Laissez vide pour conserver le mot de passe actuel">

    
              <br>

        <!-- Allow the user to upload a new photo -->
        <label for="fileUpload">Photo de profil:</label>
        <input type="file" id="fileUpload" name="photo" >

        <br>
        
        <img src=upload/<?=$row['photo']?> height="100" >

        <br>

        <button class="button"><input type="submit" name="enregistrer_modifications" value="Enregistrer les modifications"></button>
    </form>

        <!-- expérience -->
        <h2 id="experience-link">Ajouter une expérience +</h2>
        <form id="experience-form" style="display: none;" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="poste">Poste:</label>
            <input type="text" id="poste" name="poste" required><br>

            <label for="employeur">Employeur:</label>
            <input type="text" id="employeur" name="employeur" required><br>

            <label for="ville_experience">Ville:</label>
            <input type="text" id="ville_experience" name="ville_experience" required><br>

            <label for="date_start_experience">Date de début:</label>
            <input type="date" id="date_start_experience" name="date_start_experience" required><br>

            <label for="date_end_experience">Date de fin:</label>
            <input type="date" id="date_end_experience" name="date_end_experience" required><br>

            <label for="description_experience">Description:</label>
            <textarea id="description_experience" name="description_experience" rows="4" required></textarea><br>

            <button class="button"><input type="submit" name="ajouter_experience" value="Ajouter l'expérience"></button>
        </form>

        <!-- Formation -->
        <h2 id="formation-link">Ajouter une formation +</h2>
        <form id="formation-form" style="display: none;" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="nom_formation">Nom de la formation:</label>
            <input type="text" id="nom_formation" name="nom_formation" required><br>

            <label for="nom_etablissement">Nom de l'établissement:</label>
            <input type="text" id="nom_etablissement" name="nom_etablissement" required><br>

            <label for="ville_formation">Ville:</label>
            <input type="text" id="ville_formation" name="ville_formation" required><br>

            <label for="date_start_formation">Date de début:</label>
            <input type="date" id="date_start_formation" name="date_start_formation" required><br>

            <label for="date_end_formation">Date de fin:</label>
            <input type="date" id="date_end_formation" name="date_end_formation" required><br>

            <label for="description_formation">Description:</label>
            <textarea id="description_formation" name="description_formation" rows="4" required></textarea><br>

            <button class="button"><input type="submit" name="ajouter_formation" value="Ajouter la formation"></button>
        </form>

        <!-- Competence -->

        <h2 id="competence-link">Ajouter une compétence +</h2>
        <form id="competence-form" style="display: none;" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="nom_competence">Nom de la compétence:</label>
            <input type="text" id="nom_competence" name="nom_competence" required><br>

            <label for="niveau_competence">Niveau de la compétence:</label>
            <select id="niveau_competence" name="niveau_competence" required>
                <option value="Débutant">Débutant</option>
                <option value="Intermédiaire">Intermédiaire</option>
                <option value="Avancé">Avancé</option>
                <option value="Expert">Expert</option>
            </select><br>

            <button class="button"><input type="submit" name="ajouter_competence" value="Ajouter la compétence"></button>
        </form>

        <!-- Interet -->

        <h2 id="interet-link">Ajouter un intérêt +</h2>
        <form id="interet-form" style="display: none;" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="nom_interet">Nom de l'intérêt :</label>
            <input type="text" id="nom_interet" name="nom_interet" required><br>

            <button class="button"><input type="submit" name="ajouter_interet" value="Ajouter l'intérêt"></button>
        </form>
        <!-- Langue -->

        <h2 id="langue-link">Ajouter une langue +</h2>
        <form id="langue-form" style="display: none;" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="nom_langue">Langue:</label>
            <input type="text" id="nom_langue" name="nom_langue" required><br>

            <label for="niveau_langue">Niveau de la langue:</label>
            <select id="niveau_langue" name="niveau_langue" required>
                <option value="Débutant">A0 : Débutant</option>
                <option value="Elémentaire">A1 : Elémentaire</option>
                <option value="Pré-intermédiaire">A2 : Pré-intermédiaire</option>
                <option value="Intermédiaire">B1 : Intermédiaire</option>
                <option value="Intermédiaire supérieur">B2 : Intermédiaire supérieur</option>
                <option value="Avancé">C1 : Avancé</option>
                <option value="Courant">C2 : Courant</option>
            </select><br>

            <button class="button"><input type="submit" name="ajouter_langue" value="Ajouter la langue"></button>
        </form>
        <br>
    <form method="GET" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="hidden" name="logout" value="true">
        <button class="button"><input type="submit" value="Se déconnecter"></button>
    </form>     
    
    <!-- changement de couleur -->

    <label for="colorPicker">Choisir une couleur pour le fond :</label>
<input type="color" id="colorPicker">

<label for="iconColorPicker">Choisir une couleur pour les icônes :</label>
<input type="color" id="iconColorPicker">

<label for="titleColorPicker">Choisir une couleur pour les titres :</label>
<input type="color" id="titleColorPicker">

<label for="textColorPicker">Choisir une couleur pour le texte :</label>
<input type="color" id="textColorPicker">          
    </section>




  <!-- CV -->

    <section class="container">

        <div class="left_side">
            <div class="profileText">
                <div class="imgBx">
                    <img src=upload/<?=$row['photo']?>>
                </div>
                <h2><?php echo $row["prenom"]; ?> <?php echo $row["nom"]; ?></h2>
            </div>

            <div class="contactInfo">
                <h3 class="title">Contact</h3>
                <ul>
                    <li>
                        <span class="icon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                        <span class="text"><?php echo $row["phone"]; ?></span>
                    </li>
                    <li>
                        <span class="icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                        <span class="text"><?php echo $row["mail"]; ?></span>
                    </li>
                    <li>
                        <span class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                        <span class="text"><?php echo $row["ville"]; ?></span>
                    </li>
                </ul>
            </div>

            <div class="contactInfo">
                <h3 class="title">Interet</h3>
                <ul>
                    <?php
                        // Sélectionnez les intérêts de l'utilisateur connecté depuis la base de données
                        $interetsQuery = "SELECT nom FROM interet WHERE utilisateurs_id = ?";
                        $interetsStmt = $conn->prepare($interetsQuery);
                        $interetsStmt->execute([$_SESSION["id"]]);
                        $interets = $interetsStmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($interets as $interet) {
                            echo "<li>
                            <span class='icon'><i class='fa fa-star' aria-hidden='true'></i></span>
                            <span class='text'>" . $interet["nom"] . "</span></li>";
                        }
                    ?>
                </ul>
            </div>

            <div class="contactInfo language">
                <h3 class="title">Langues</h3>
                <ul>
                    <?php
                        // Sélectionnez les langues de l'utilisateur connecté depuis la base de données
                        $languesQuery = "SELECT nom, niveau FROM langue WHERE utilisateurs_id = ?";
                        $languesStmt = $conn->prepare($languesQuery);
                        $languesStmt->execute([$_SESSION["id"]]);
                        $langues = $languesStmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($langues as $langue) {
                            echo "<li><h4>" . $langue["nom"] . "</h4> 
                            <h5>(Niveau : " . $langue["niveau"] . ")</h5></li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
        
        <div class="right_side">
            <div class="about">
                <h2 class="title2">Expérience</h2>
                    <?php
                    // Sélectionnez les expériences de l'utilisateur connecté depuis la base de données
                    $experiencesQuery = "SELECT id, poste, employeur, ville, date_start, date_end, description FROM experience WHERE utilisateurs_id = ?";
                    $experiencesStmt = $conn->prepare($experiencesQuery);
                    $experiencesStmt->execute([$_SESSION["id"]]);
                    $experiences = $experiencesStmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($experiences as $experience) {
                        echo "<div class='box'><div class='year_company'><h5>" . $experience["date_start"] . "/" . $experience["date_end"] . "</h5>
                        <h5>" . $experience["employeur"] . "</h5>
                        <h5>". $experience["ville"] ."</h5></div>
                        <div class='text'><h4>" . $experience["poste"] . "</h4>
                        <p>" . $experience["description"] . "</p></div></div>";
                    }
                    ?>
            </div>

            <div class="about">
                <h2 class="title2">Formations</h2>
                <?php
                    // Sélectionnez les formations de l'utilisateur connecté depuis la base de données
                    $formationsQuery = "SELECT nom_formation, nom_etablissement, ville, date_start, date_end, description FROM formation WHERE utilisateurs_id = ?";
                    $formationsStmt = $conn->prepare($formationsQuery);
                    $formationsStmt->execute([$_SESSION["id"]]);
                    $formations = $formationsStmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($formations as $formation) {
                        echo "<div class='box'><div class='year_company'><h5>" . $formation["date_start"] . "/" . $formation["date_end"] . "</h5>
                        <h5>" . $formation["ville"] . "</h5></div>
                        <div class='text'><h4>" . $formation["nom_formation"] . "</h4>
                        <h6>" . $formation["nom_etablissement"] . "</h6>
                        <p>" . $formation["description"] . "</p></div></div>";
                    }
                    ?>
            </div>

            <div class="about skills">
                <h2 class="title2">Compétences</h2>
                <?php
                    // Sélectionnez les compétences de l'utilisateur connecté depuis la base de données
                    $competencesQuery = "SELECT nom, niveau FROM competence WHERE utilisateurs_id = ?";
                    $competencesStmt = $conn->prepare($competencesQuery);
                    $competencesStmt->execute([$_SESSION["id"]]);
                    $competences = $competencesStmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($competences as $competence) {
                        echo "<div class='box'><h4>" . $competence["nom"] . "</h4>
                        <p>" . $competence["niveau"] . "</p></div>";
                    }
                    ?>
            </div>
        </div>
        
        <script>
function toggleUpdateForm(experienceId) {
    var formId = "updateForm" + experienceId;
    var form = document.getElementById(formId);
    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}

// Sélectionnez l'élément input de type "color"
const colorPicker = document.getElementById("colorPicker");

// Sélectionnez l'élément que vous souhaitez changer de couleur (dans ce cas, left_side)
const leftSide = document.querySelector(".left_side");

// Ajoutez un écouteur d'événements pour détecter le changement de la couleur
colorPicker.addEventListener("input", function () {
    const selectedColor = colorPicker.value;
    leftSide.style.backgroundColor = selectedColor;
});

// Sélectionnez l'élément input de type "color" pour les icônes
const iconColorPicker = document.getElementById("iconColorPicker");

// Sélectionnez tous les éléments avec la classe "icon"
const icons = document.querySelectorAll(".icon");

// Ajoutez un écouteur d'événements pour détecter le changement de la couleur des icônes
iconColorPicker.addEventListener("input", function () {
    const selectedIconColor = iconColorPicker.value;
    
    // Parcourez tous les éléments "icon" et mettez à jour leur couleur
    icons.forEach(function (icon) {
        icon.style.color = selectedIconColor;
    });
});

// Sélectionnez l'élément input de type "color" pour les titres "title2"
const titleColorPicker = document.getElementById("titleColorPicker");

// Sélectionnez tous les éléments avec la classe "title2"
const title2Elements = document.querySelectorAll(".title2");

// Ajoutez un écouteur d'événements pour détecter le changement de la couleur des titres "title2"
titleColorPicker.addEventListener("input", function () {
    const selectedTitleColor = titleColorPicker.value;
    
    // Parcourez tous les éléments "title2" et mettez à jour leur couleur
    title2Elements.forEach(function (title2Element) {
        title2Element.style.color = selectedTitleColor;
    });
});

// Sélectionnez l'élément input de type "color" pour le texte
const textColorPicker = document.getElementById("textColorPicker");

// Sélectionnez tous les éléments avec la classe "text" à l'intérieur des éléments avec les classes "about", "box", et "text"
const textElements = document.querySelectorAll(".about .box .text");

// Ajoutez un écouteur d'événements pour détecter le changement de la couleur du texte
textColorPicker.addEventListener("input", function () {
    const selectedTextColor = textColorPicker.value;
    
    // Parcourez tous les éléments "text" et mettez à jour leur couleur de texte
    textElements.forEach(function (textElement) {
        textElement.style.color = selectedTextColor;
    });
});



</script>

</body>
</html>
