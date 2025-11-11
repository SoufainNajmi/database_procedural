<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Marchi Bordo</title>
    <link rel="stylesheet" href="dash.css">
    
</head>
<body>

<header>
    <h1>📊 Tableau de bord - Marchi Bordo</h1>
</header>

<div class="container">
<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "marchi_bordo";

// Connexion à la base
$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) {
    die("<p style='color:red;'>Erreur de connexion : " . mysqli_connect_error() . "</p>");
}

// --- Comptages ---
$clients = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM clients"))['total'];
$articles = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM articles"))['total'];
$categories = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM categories"))['total'];

// --- Cartes d'infos ---
echo "
    <div class='card'>
        <h2>👥 Clients</h2>
        <p>$clients</p>
        <a href='./list_client.php'>Voir les clients</a>
    </div>

    <div class='card'>
        <h2>📦 Articles</h2>
        <p>$articles</p>
        <a href='./list_article.php'>Voir les articles</a>
    </div>

    <div class='card'>
        <h2>🗂️ Catégories</h2>
        <p>$categories</p>
        <a href='./list_categorie.php'>Voir les catégories</a>
    </div>
";

mysqli_close($conn);
?>
</div>

</body>
</html>
