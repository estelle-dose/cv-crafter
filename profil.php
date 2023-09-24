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

                   // Vérifie si le fichier a été uploadé sans erreur.
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $filename = $_FILES["photo"]["name"];
            $filetype = $_FILES["photo"]["type"];
            $filesize = $_FILES["photo"]["size"];

            // Vérifie l'extension du fichier
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!array_key_exists($ext, $allowed)) die("Erreur : Veuillez sélectionner un format de fichier valide.");

            // Vérifie la taille du fichier - 5Mo maximum
            $maxsize = 5 * 1024 * 1024;
            if ($filesize > $maxsize) die("Error: La taille du fichier est supérieure à la limite autorisée.");

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
<meta charset="utf-8">
    <title>Profil</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" 
    integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link id="style" rel="stylesheet" type="text/css" href="styleprof.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

  <script defer src="script.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Assistant&display=swap');
  </style>
</head>
<body class="bodyprof">
    <section class="modif">
    <div class="form">
    <form method="POST" class="forma" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">

    <div class="flex">
            <div class="img">
                <img src="upload/<?=$row['photo']?>" alt="Photo de profil">
            </div>
            
            <div class="form-fields">
                <label>
                    <input class="input input-field" type="text" id="login" name="login" value="<?php echo $row["login"]; ?>" required>
                    <span class>Login</span>
                </label>
                <div class="flex">
                <label>
                    <input class="input input-field" type="text" id="prenom" name="prenom" value="<?php echo $row["prenom"]; ?>" required>
                    <span>Prenom</span>
                </label>
            

                <label>
                    <input class="input input-field" type="text" id="nom" name="nom" value="<?php echo $row["nom"]; ?>" required>
                    <span>Nom</span>
                </label>
        </div>
        </div>
    </div>

        <label>
            <input class="input" type="text" id="mail" name="mail" value="<?php echo $row["mail"]; ?>" required>
            <span>Mail</span>
        </label>

        <label>
            <input class="input" type="tel" id="phone" name="phone" value="<?php echo $row["phone"]; ?>" required>
            <span>Numero de tel</span>
        </label>

    <div class="flex">

        <label>
            <input class="input" type="text" id="postal" name="postal" value="<?php echo $row["postal"]; ?>" required>
            <span>Code postal</span>
        </label>

        <label>
            <input class="input" type="text" id="ville" name="ville" value="<?php echo $row["ville"]; ?>" required>
            <span>Ville</span>
        </label>
    </div>

        <!-- Affichage du champ de modification du mot de passe -->
        <label>
            <input class="input" type="password" id="password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
            <span>Changer le mot de passe</span>
        </label>

        <label>
            <input class="input" type="password" id="confirmPassword" name="confirmPassword" value="<?php echo isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : ''; ?>">
            <span>Confirmez le nouveau mot de passe</span>
        </label>

        <!-- Allow the user to upload a new photo -->
        <div class="flex">
        <h3 class="title" class="photo" for="fileUpload">Photo de profil:</h3>
            <!-- Cachez l'élément input de type file -->
            <input type="file" id="fileUpload" name="photo" style="display: none;">

            <!-- Bouton personnalisé pour choisir un fichier -->
            <label for="fileUpload" class="button">Choisir un fichier</label>

        </div>


        <button class="button" type="submit" name="enregistrer_modifications">Enregistrer les modifications</button>

        

    </form>

    <form class="formdeco" method="GET" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="hidden" name="logout" value="true">
        
        <button class="button" type="submit">Se déconnecter</button>
    </form>

    </div>

        <!-- expérience -->
        <div class="form">
        <h3 class="title" id="experience-link">Ajouter une expérience +</h3>
        <form class="forma" id="experience-form" style="display: none;" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div class="form-ex">
            <label>
                <input class="input" type="text" id="poste" name="poste" required>
                <span>Poste</span>
            </label>
        </div>
        <div class="form-ex">
            <label>
                <input class="input" type="text" id="employeur" name="employeur" required>
                <span>Employeur</span>
            </label>
        </div>
        <div class="form-ex">
            <label>
                <input class="input" type="text" id="ville_experience" name="ville_experience" required>
                <span>Ville</span>
            </label>
        </div>
        <div class="form-ex">
            <div class="flex">
                <label>
                    <input class="input" type="date" id="date_start_experience" name="date_start_experience" required>
                    <span>Date de début</span>
                </label>

                <label>
                    <input class="input" type="date" id="date_end_experience" name="date_end_experience" required>
                    <span>Date de fin</span>
                </label>
            </div>
        </div>
        <div class="form-ex">
            <label>
                <textarea class="input" id="description_experience" name="description_experience" rows="4" required></textarea>
                <span>Description</span>
            </label>
        </div>
        
            <button class="button" type="submit" name="ajouter_experience">Ajouter l'expérience</button>
        </form>

        <!-- Formation -->
        <h3 class="title" id="formation-link">Ajouter une formation +</h3>
        <form class="forma" id="formation-form" style="display: none;" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div class="form-ex">
            <label>
            <input class="input" type="text" id="nom_formation" name="nom_formation" required>
            <span>Formation</span>
            </label>
        </div>

        <div class="form-ex">
            <label>
            <input class="input" type="text" id="nom_etablissement" name="nom_etablissement" required>
            <span>Etablissement</span>
            </label>
        </div>

        <div class="form-ex">
            <label>
            <input class="input" type="text" id="ville_formation" name="ville_formation" required>
            <span>Ville</span>
            </label>
        </div>

        <div class="form-ex">
            <div class="flex">
                <label>
                <input class="input" type="date" id="date_start_formation" name="date_start_formation" required>
                <span>Date de début</span>
                </label>

                <label>
                <input class="input" type="date" id="date_end_formation" name="date_end_formation" required>
                <span>Date de fin</span>
                </label>
            </div>
        </div>

        <div class="form-ex">
            <label>
            <textarea class="input" id="description_formation" name="description_formation" rows="4" required></textarea>
            <span>Description</span>
            </label>
        </div>

            <button class="button" type="submit" name="ajouter_formation">Ajouter la formation</button>
        </form>

        <!-- Competence -->

        <h3 class="title" id="competence-link">Ajouter une compétence +</h3>
        <form class="forma" id="competence-form" style="display: none;" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

        <div class="form-ex">
            <label>
            <input class="input" type="text" id="nom_competence" name="nom_competence" required>
            <span>Compétence</span>
            </label>
        </div>

        <div class="form-ex">
            <label>
                <select class="input" id="niveau_competence" name="niveau_competence" required>
                    <option value="Débutant">Débutant</option>
                    <option value="Intermédiaire">Intermédiaire</option>
                    <option value="Avancé">Avancé</option>
                    <option value="Expert">Expert</option>
                </select>
                <span>Niveau</span>
            </label>
        </div>

            <button class="button" type="submit" name="ajouter_competence">Ajouter la compétence</button>
        </form>

        <!-- Interet -->

        <h3 class="title" id="interet-link">Ajouter un intérêt +</h3>
        <form class="forma" id="interet-form" style="display: none;" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div class="form-ex">
            <label>
                <input class="input" type="text" id="nom_interet" name="nom_interet" required>
                <span>Intérêt</span>
            </label>
        </div>

            <button class="button" type="submit" name="ajouter_interet">Ajouter l'intérêt</button>
        </form>
        <!-- Langue -->

        <h3 class="title" id="langue-link">Ajouter une langue +</h3>
        <form class="forma" id="langue-form" style="display: none;" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div class="form-ex">
            <label>
            <input class="input" type="text" id="nom_langue" name="nom_langue" required>
            <span>Langue</span>
            </label>
        </div>

        <div class="form-ex">
            <label>
            <select class="input" id="niveau_langue" name="niveau_langue" required>
                <option value="Débutant">A0 : Débutant</option>
                <option value="Elémentaire">A1 : Elémentaire</option>
                <option value="Pré-intermédiaire">A2 : Pré-intermédiaire</option>
                <option value="Intermédiaire">B1 : Intermédiaire</option>
                <option value="Intermédiaire supérieur">B2 : Intermédiaire supérieur</option>
                <option value="Avancé">C1 : Avancé</option>
                <option value="Courant">C2 : Courant</option>
            </select>
            <span>Niveau</span>
            </label>
        </div>

            <button class="button" type="submit" name="ajouter_langue">Ajouter la langue</button>
        </form>
    
    </div>

    <!-- changement de couleur -->

    <div class="form">

    <h3 class="title" for="colorPicker">Choisir une couleur pour le fond :</h3>
    <input type="color" id="colorPicker">
    
    <h3 class="title" for="iconColorPicker">Choisir une couleur pour les icônes :</h3>
    <input type="color" id="iconColorPicker">

    <h3 class="title" for="titleColorPicker">Choisir une couleur pour les titres :</h3>
    <input type="color" id="titleColorPicker">

    <h3 class="title" for="textColorPicker">Choisir une couleur pour le texte :</h3>
    <input type="color" id="textColorPicker">          
    

<button class="button" type="button" onclick="convertHTMLtoPDF()">Télécharge ton CV en PDF</button>
 
</section>

</div>

  <!-- CV -->

    <section class="container" id="divID">

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
                <h3 class="title2">Expérience</h3>
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
                        <div class='text'><h4 class='text'>" . $experience["poste"] . "</h4>
                        <p>" . $experience["description"] . "</p></div></div>";
            }
            ?>
        </div>

        <div class="about">
                <h3 class="title2">Formations</h3>
            <?php
            // Sélectionnez les formations de l'utilisateur connecté depuis la base de données
            $formationsQuery = "SELECT nom_formation, nom_etablissement, ville, date_start, date_end, description FROM formation WHERE utilisateurs_id = ?";
            $formationsStmt = $conn->prepare($formationsQuery);
            $formationsStmt->execute([$_SESSION["id"]]);
            $formations = $formationsStmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($formations as $formation) {
                echo "<div class='box'><div class='year_company'><h5>" . $formation["date_start"] . "/" . $formation["date_end"] . "</h5>
                        <h5>" . $formation["ville"] . "</h5></div>
                        <div class='text'><h4 class='text'>" . $formation["nom_formation"] . "</h4>
                        <h6 class='text'>" . $formation["nom_etablissement"] . "</h6>
                        <p>" . $formation["description"] . "</p></div></div>";
            }
            ?>
        </div>

        <div class="about skills">
                <h3 class="title2">Compétences</h3>
            <?php
            // Sélectionnez les compétences de l'utilisateur connecté depuis la base de données
            $competencesQuery = "SELECT nom, niveau FROM competence WHERE utilisateurs_id = ?";
            $competencesStmt = $conn->prepare($competencesQuery);
            $competencesStmt->execute([$_SESSION["id"]]);
            $competences = $competencesStmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($competences as $competence) {
                echo "<div class='box'><h4 class='text'>" . $competence["nom"] . "</h4>
                        <p>" . $competence["niveau"] . "</p></div>";
            }
            ?>
        </div>
        </div>
    </section>


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
    	<script type="text/javascript">
		function convertHTMLtoPDF() {
			const { jsPDF } = window.jspdf;

			let doc = new jsPDF('l', 'mm', [1440, 1452]);
			let pdfjs = document.querySelector('#divID');

			doc.html(pdfjs, {
				callback: function(doc) {
					doc.save("newpdf.pdf");
				},
				x: 12,
				y: 12
			});			
		}		
	</script>

</body>
</html>
