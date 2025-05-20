<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpdesk</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 0;
        }
        img{
            width: 5%;
            position:initial;
        }
        header {
            background-color:white;
            color: white;
            padding: 20px 0px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        nav {
            margin: 15px 0;
        }
        nav a {
            margin: 0 15px;
            color: black;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }
        nav a:hover {
            color: #ffdd57;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        footer {
            text-align: center;
            padding: 15px;
            color:black;
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: 20px;
        }
        h1 {
            color: #333;
            font-size: 2.5em;
            margin: 0;
        }
        h2 {
            color: #007bff;
            margin-top: 20px;
        }
        p {
            line-height: 1.6;
            color: #555;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<header>
    <img id="img" src="icone_helpdesk.jpg" alt="icone_helpdesk">
    <h1>Bienvenue au Helpdesk</h1>
    <nav>
        <a href="assistance.php">assistance</a>
        <a href="assit/techn.php">espace technicien</a>
    </nav>
</header>

<div class="container">
    <h2>Demande d'assistance </h2>
    <p>Pour toutes demandes d'assistance , merci cliquer sur le boutton pour vous connecter .</p>
    <a href="assistance.php" class="button">Demander d'assistance</a>
    <h2>Espace technicien</h2>
    <p>Pour vous connecter tant que technicien , merci de cliquer sur le boutton .</p>
    <a href="assit/techn.php" class="button">Espace technicien</a>
</div>

<footer>
    <p>&copy; Ceci est un logiciel professionel , merci de l'utiliser à cet effet.</p>
</footer>

</body>
</html>
