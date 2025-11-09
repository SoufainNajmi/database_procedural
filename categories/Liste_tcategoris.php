<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des catégories</title>
    <link rel="stylesheet" href="/asset/liste_categories.css">
</head>
<body>

<h1> Liste des catégories</h1>
<a href="ajouter_categorie.php"><button class="add">➕ Ajouter une catégorie</button></a>

<?php
$conn = mysqli_connect("localhost","root","","marchi_bordo");
if (!$conn) die("Erreur de connexion");

$res = mysqli_query($conn, "SELECT * FROM categorie ORDER BY date_creation DESC");

if (mysqli_num_rows($res) == 0) {
    echo "<p>Aucune catégorie trouvée.</p>";
} else {
    echo "<table>
           
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr>
                <td>{$row['id_categorie']}</td>
                <td>{$row['nom_categorie']}</td>
                <td>" . nl2br($row['description']) . "</td>
                <td>{$row['date_creation']}</td>
                <td>
                    <a href='update_categorie.php?id={$row['id_categorie']}'><button class='update'>Modifier</button></a>
                    <a href='delete_categorie.php?id={$row['id_categorie']}'><button class='delete'>Supprimer</button></a>
                </td>
            </tr>";
    }
    echo "</table>";
}
mysqli_close($conn);
?>
</body>
</html>
