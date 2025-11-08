<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des clients</title>
    <link rel="stylesheet" href="/asset/list_client.css">
</head>
<body>

<h1>Liste des clients</h1>
<a href="ajouter_client.php">    <button class="add">➕ Ajouter un client</button>    </a>

<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "marchi_bordo";

$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) {
    die("<p style='color:red;'>Erreur de connexion : " . mysqli_connect_error() . "</p>");
}

$query = "SELECT * FROM clients";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<p>Aucun client trouvé.</p>";
} else {
    echo '<table>
            <tr>
                <th>Image</th>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Adresse</th>
                <th>Ville</th>
                <th>Âge</th>
                <th>Email</th>
                <th>Date d\'ajout</th>
                <th>Actions</th>
            </tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td><img src='" . (!empty($row['image']) ? $row['image'] : "asset/img/default.png") . "' alt=''></td>
                <td>{$row['id_client']}</td>
                <td>{$row['nom']}</td>
                <td>{$row['prenom']}</td>
                <td>{$row['adresse']}</td>
                <td>{$row['ville']}</td>
                <td>{$row['age']}</td>
                <td>{$row['mail']}</td>
                <td>{$row['date_ajout']}</td>
                <td>
                    <a href='update_client.php?id={$row['id_client']}'><button class='update'>Modifier</button></a>
                    <a href='delete_client.php?id={$row['id_client']}'><button class='delete'>Supprimer</button></a>
                </td>
            </tr>";
    }

    echo "</table>";
}
mysqli_close($conn);
?>
</body>
</html>
