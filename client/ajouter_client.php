<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un client</title>
    <link rel="stylesheet" href="/asset/ajou_client.css">
   
</head>
<body>

<form method="POST" enctype="multipart/form-data">
    <h2>Ajouter un client</h2>

    <label>Nom :</label><input type="text" name="nom" required>
    <label>Prénom :</label><input type="text" name="prenom" required>
    <label>Adresse :</label><input type="text" name="adresse">
    <label>Ville :</label><input type="text" name="ville">
    <label>Âge :</label><input type="number" name="age" min="1">
    <label>Email :</label><input type="email" name="mail">
    <label>Image (optionnelle) :</label><input type="file" name="image">

    <button type="submit" name="ajouter">➕ Ajouter</button>
    <a href="liste_clients.php">⬅ Retour à la liste</a>
</form>

<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "marchi_bordo";
$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) { die("Erreur de connexion : " . mysqli_connect_error()); }

if (isset($_POST['ajouter'])) {
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);
    $ville = mysqli_real_escape_string($conn, $_POST['ville']);
    $age = (int) $_POST['age'];
    $mail = mysqli_real_escape_string($conn, $_POST['mail']);

    $imagePath = "";
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
        $targetFile = $targetDir . time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
        $imagePath = $targetFile;
    }

    $sql = "INSERT INTO clients (nom, prenom, adresse, ville, age, mail, image)
            VALUES ('$nom', '$prenom', '$adresse', '$ville', '$age', '$mail', '$imagePath')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('✅ Client ajouté !'); window.location.href='liste_clients.php';</script>";
    } else {
        echo "<p style='color:red;'>Erreur : " . mysqli_error($conn) . "</p>";
    }
}
mysqli_close($conn);
?>
</body>
</html>
