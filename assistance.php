<?php
    $servername = "localhost";
    $username   = "user";
    $password   = "btsinfo";
    $dbname     = "ticket";

    try {
        // Créer une nouvelle connexion PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Définir le mode d'erreur PDO sur exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifier si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Vérifier si les clés existent dans le tableau $_POST
            if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['description'], $_POST['os'], $_POST['service'], $_POST['date'])) {
                // Récupérer les valeurs du formulaire
                $nom         = $_POST['nom'];
                $prenom      = $_POST['prenom'];
                $email       = $_POST['email'];
                $description = $_POST['description'];
                $os          = $_POST['os'];
                $service     = $_POST['service'];
                $date        = $_POST['date'];

                // Préparer la requête SQL pour insérer les données
                $sql = "INSERT INTO ticket (nom, prenom, email, description, os, service, date)
                    VALUES (:nom, :prenom, :email, :description, :os, :service, :date)";

                // Préparer la déclaration
                $stmt = $conn->prepare($sql);

                // Lier les paramètres
                $stmt->bindParam(':nom', $nom);
                $stmt->bindParam(':prenom', $prenom);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':os', $os);
                $stmt->bindParam(':service', $service);
                $stmt->bindParam(':date', $date);

                // Exécuter la requête
                $stmt->execute();
            }

        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    // Fermer la connexion
    $conn = null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assistance</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #E6E3E3;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-group {
            width: 100%;
        }
        .assist {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
            color: black;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"], input[type="email"], textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="assist">
        <h2>Assistance</h2>
        <form method="post" action="assistance.php">
            <div class="form-group">
                <label for="nom">Indiquez votre nom :</label>
                <input type="text" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Indiquez votre prénom :</label>
                <input type="text" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="email">Indiquez votre e-mail :</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="service">Indiquez votre service :</label>
                <select id="select" name="service" required>
                    <option value="marketing">Marketing</option>
                    <option value="RH">Ressources Humaines</option>
                    <option value="compta">Comptabilité</option>
                </select>
            </div>
            <div class="form-group">
                <label for="os">Indiquez votre OS :</label>
                <select id="select" name="os" required>
                    <option value="Linux">Linux</option>
                    <option value="Windows">Windows</option>
                </select>
            </div>
            <div class="form-group">
                <label for="date">Indiquez la date du jour :</label>
                <input type="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="description">Décrivez votre problème :</label>
                <textarea name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Soumettre">
            </div>
        </form>
    </div>
</body>
</html>
