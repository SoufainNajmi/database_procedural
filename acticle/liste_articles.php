<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Liste des articles</title>
  <link rel="stylesheet" href="liste.css">
</head>
<body>

<h1> Liste des articles</h1>
<a href="ajouter_article.php"><button class="add">➕ Ajouter un article</button></a>

<?php
// --- Connexion à la base de données ---
$host = "localhost";
$user = "root";
$password = "";
$dbname = "marchi_bordo";

$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) {
    die("<p style='color:red;'>Erreur de connexion : " . mysqli_connect_error() . "</p>");
}

// --- Récupération des articles avec leur catégorie ---
$query = "SELECT a.*, c.nom_categorie 
          FROM article a 
          LEFT JOIN categorie c ON a.id_categorie = c.id_categorie 
          ORDER BY a.date_ajout DESC";

$result = mysqli_query($conn,$query);

if (!$result) {
    die("Erreur dans la requête SQL : " . mysqli_error($conn));
}


$x = mysqli_num_rows($result);

if ($x == 0) {
    echo "<p>Aucun article trouvé.</p>";
} else {
    echo '<table>
           
            <tr>
                <th>Image</th>
                <th>ID</th>
                <th>Nom de l\'article</th>
                <th>Description</th>
                <th>Prix (€)</th>
                <th>Quantité</th>
                <th>Catégorie</th>
                <th>Date d\'ajout</th>
                <th>Actions</th>
            </tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td><img src='" . (!empty($row['image']) ? $row['image'] : "asset/img/default.png") . "' alt='Article'></td>
                <td>{$row['id_article']}</td>
                <td>{$row['nom_article']}</td>
                <td>" . nl2br(substr($row['description'], 0, 60)) . "...</td>
                <td>{$row['prix']}</td>
                <td>{$row['quantite']}</td>
                <td>" . (!empty($row['nom_categorie']) ? $row['nom_categorie'] : "Non catégorisé") . "</td>
                <td>{$row['date_ajout']}</td>
                <td>
                    <a href='update_article.php?id={$row['id_article']}'><button class='update'>Modifier</button></a>
                    <a href='delete_article.php?id={$row['id_article']}'><button class='delete'>Supprimer</button></a>
                </td>
            </tr>";
    }

    echo "</table>";
}

mysqli_close($conn);
?>
</body>
</html>
