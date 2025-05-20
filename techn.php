<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Gestion des Tickets</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f4f4f4;
    }
    h1, h2 {
        text-align: center;
        color: #333;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: white;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    th, td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }
    th {
        background-color: #4CAF50;
        color: white;
    }
    tr:nth-child(even):not(.statut-ouvert):not(.statut-en-cours):not(.statut-ferme) {
        background-color: #f9f9f9;
    }
    tr.statut-ouvert {
        background-color: #b6fcb6; /* vert clair */
    }
    tr.statut-en-cours {
        background-color: #fffcb6; /* jaune clair */
    }
    tr.statut-ferme {
        background-color: #ffc2b6; /* rouge clair */
    }
    form.filter-form {
        background: white;
        max-width: 350px;
        margin: 0 auto 30px auto;
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.15);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }
    form.filter-form select {
        flex: 1;
        padding: 8px 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 15px;
        cursor: pointer;
        transition: border-color 0.3s ease;
    }
    form.filter-form select:focus {
        outline: none;
        border-color: #4CAF50;
        box-shadow: 0 0 5px #4CAF50;
    }
    form.filter-form input[type="submit"] {
        padding: 9px 20px;
        background-color: #4CAF50;
        color: white;
        font-weight: bold;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 15px;
        transition: background-color 0.3s ease;
    }
    form.filter-form input[type="submit"]:hover {
        background-color: #45a049;
    }
    form.edit-form {
        background-color: white;
        padding: 20px;
        margin: 20px auto 40px auto;
        max-width: 700px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    form.edit-form label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
    }
    form.edit-form input[type="text"],
    form.edit-form input[type="email"],
    form.edit-form textarea,
    form.edit-form select {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 14px;
    }
    form.edit-form textarea {
        resize: vertical;
    }
    form.edit-form input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 18px;
        margin-top: 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 15px;
    }
    form.edit-form input[type="submit"]:hover {
        background-color: #45a049;
    }
    .actions form {
        display: inline-block;
        margin: 0 5px;
    }
</style>
</head>
<body>

<?php
    $conn = mysqli_connect("localhost", "user", "btsinfo", "ticket");
    if (! $conn) {
        die("Connexion échouée : " . mysqli_connect_error());
    }

    // Par défaut, filtre sur "fermé"
    $filtre_statut = 'fermé';
    if (isset($_POST['filtrer'])) {
        $filtre_statut = $_POST['filtre_statut'];
    }

    if (isset($_POST['delete'])) {
        $id = (int) $_POST['delete'];
        mysqli_query($conn, "DELETE FROM ticket WHERE id=$id");
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    if (isset($_POST['update'])) {
        $id          = (int) $_POST['id'];
        $nom         = mysqli_real_escape_string($conn, $_POST['nom']);
        $prenom      = mysqli_real_escape_string($conn, $_POST['prenom']);
        $email       = mysqli_real_escape_string($conn, $_POST['email']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $os          = mysqli_real_escape_string($conn, $_POST['OS']);
        $service     = mysqli_real_escape_string($conn, $_POST['Service']);
        $statut      = mysqli_real_escape_string($conn, $_POST['statut']);

        $sql = "UPDATE ticket SET nom='$nom', prenom='$prenom', email='$email', description='$description', OS='$os', Service='$service', statut='$statut' WHERE id=$id";
        mysqli_query($conn, $sql);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    if ($filtre_statut != '') {
        $sql = "SELECT * FROM ticket WHERE statut='$filtre_statut' ORDER BY id DESC";
    } else {
        $sql = "SELECT * FROM ticket ORDER BY id DESC";
    }
    $result = mysqli_query($conn, $sql);

    echo "<h1>Gestion des Tickets</h1>";
?>

<form method="post" class="filter-form" aria-label="Filtrer les tickets par statut">
    <select name="filtre_statut" aria-label="Choisir un statut">
        <option value=""                                                 <?php if ($filtre_statut == '') {
                                                         echo 'selected';
                                                 }
                                                 ?>>Tous les statuts</option>
        <option value="ouvert"                                                             <?php if ($filtre_statut == 'ouvert') {
                                                                     echo 'selected';
                                                             }
                                                             ?>>Ouvert</option>
        <option value="en cours"                                                                 <?php if ($filtre_statut == 'en cours') {
                                                                         echo 'selected';
                                                                 }
                                                                 ?>>En cours</option>
        <option value="fermé"                                                             <?php if ($filtre_statut == 'fermé') {
                                                                     echo 'selected';
                                                             }
                                                             ?>>Fermé</option>
    </select>
    <input type="submit" name="filtrer" value="Filtrer" />
</form>

<?php
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr>
            <th>ID</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Description</th>
            <th>OS</th><th>Service</th><th>Statut</th><th>Date</th><th>Actions</th>
          </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            $class = '';
            if ($row['statut'] == 'ouvert') {
                $class = 'statut-ouvert';
            } elseif ($row['statut'] == 'en cours') {
                $class = 'statut-en-cours';
            } elseif ($row['statut'] == 'fermé') {
                $class = 'statut-ferme';
            }

            echo "<tr class='$class'>
                <td>" . htmlspecialchars($row['id']) . "</td>
                <td>" . htmlspecialchars($row['nom']) . "</td>
                <td>" . htmlspecialchars($row['prenom']) . "</td>
                <td>" . htmlspecialchars($row['email']) . "</td>
                <td>" . htmlspecialchars($row['description']) . "</td>
                <td>" . htmlspecialchars($row['OS']) . "</td>
                <td>" . htmlspecialchars($row['Service']) . "</td>
                <td>" . htmlspecialchars($row['statut']) . "</td>
                <td>" . htmlspecialchars($row['date']) . "</td>
                <td class='actions'>
                    <form method='post' style='display:inline'>
                        <input type='hidden' name='edit' value='" . $row['id'] . "'>
                        <input type='submit' value='Modifier'>
                    </form>
                    <form method='post' style='display:inline' >
                        <input type='hidden' name='delete' value='" . $row['id'] . "'>
                        <input type='submit' value='Supprimer'>
                    </form>
                </td>
              </tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align:center; margin-top:20px;'>Aucun ticket trouvé.</p>";
    }

    if (isset($_POST['edit'])) {
        $id       = (int) $_POST['edit'];
        $sql_edit = "SELECT * FROM ticket WHERE id=$id";
        $res_edit = mysqli_query($conn, $sql_edit);
        if ($res_edit && mysqli_num_rows($res_edit) == 1) {
            $ticket = mysqli_fetch_assoc($res_edit);
        ?>
        <h2>Modifier le ticket #<?php echo $ticket['id']; ?></h2>
        <form method="post" class="edit-form">
            <input type="hidden" name="id" value="<?php echo $ticket['id']; ?>">
            <label>Nom :</label>
            <input type="text" name="nom" value="<?php echo htmlspecialchars($ticket['nom']); ?>" required>
            <label>Prénom :</label>
            <input type="text" name="prenom" value="<?php echo htmlspecialchars($ticket['prenom']); ?>" required>
            <label>Email :</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($ticket['email']); ?>" required>
            <label>Description :</label>
            <textarea name="description" rows="4" required><?php echo htmlspecialchars($ticket['description']); ?></textarea>
            <label>OS :</label>
            <input type="text" name="OS" value="<?php echo htmlspecialchars($ticket['OS']); ?>">
            <label>Service :</label>
            <input type="text" name="Service" value="<?php echo htmlspecialchars($ticket['Service']); ?>">
            <label>Statut :</label>
            <select name="statut" required>
                <option value="ouvert"                                                                             <?php if ($ticket['statut'] == 'ouvert') {
                                                                                             echo 'selected';
                                                                                     }
                                                                                     ?>>Ouvert</option>
                <option value="en cours"                                                                                 <?php if ($ticket['statut'] == 'en cours') {
                                                                                                 echo 'selected';
                                                                                         }
                                                                                         ?>>En cours</option>
                <option value="fermé"                                                                             <?php if ($ticket['statut'] == 'fermé') {
                                                                                             echo 'selected';
                                                                                     }
                                                                                     ?>>Fermé</option>
            </select>
            <input type="submit" name="update" value="Enregistrer">
        </form>
        <?php
            }
            }

            mysqli_close($conn);
        ?>

</body>
</html>
