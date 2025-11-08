<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "marchi_bordo";
$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) die("Erreur de connexion : " . mysqli_connect_error());

if (!isset($_GET['id'])) die("Aucun client sélectionné.");
$id = (int) $_GET['id'];

$req = mysqli_query($conn, "SELECT * FROM clients WHERE id_client = $id");
$client = mysqli_fetch_assoc($req);

if (isset($_POST['modifier'])) {
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);
    $ville = mysqli_real_escape_string($conn, $_POST['ville']);
    $age = (int) $_POST['age'];
    $mail = mysqli_real_escape_string($conn, $_POST['mail']);

    $imagePath = $client['image'];
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
        if (!empty($client['image']) && file_exists($client['image'])) unlink($client['image']);
        $targetFile = $targetDir . time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
        $imagePath = $targetFile;
    }

    $sql = "UPDATE clients SET nom='$nom', prenom='$prenom', adresse='$adresse', ville='$ville', age='$age', mail='$mail', image='$imagePath' WHERE id_client=$id";
    mysqli_query($conn, $sql);
    echo "<script>alert('✅ Client mis à jour !'); window.location.href='liste_clients.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le client</title>
    <style>
        body { font-family: Arial; background-color: #f4f6f7; display: flex; justify-content: center; align-items: center; height: 100vh; }
        form { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px #ccc; width: 400px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #aaa; border-radius: 5px; }
        img { width: 80px; height: 80px; border-radius: 10px; margin: 10px auto; display: block; }
        button { margin-top: 15px; width: 100%; padding: 10px; background: #3498db; color: white; border: none; border-radius: 5px; }
    </style>
</head>
<body>
<form method="POST" enctype="multipart/form-data">
    <h2>Modifier le client</h2>
    <img src="<?= !empty($client['image']) ? $client['image'] : 'asset/img/default.png' ?>" alt="">
    <label>Nom :</label><input type="text" name="nom" value="<?= $client['nom'] ?>" required>
    <label>Prénom :</label><input type="text" name="prenom" value="<?= $client['prenom'] ?>" required>
    <label>Adresse :</label><input type="text" name="adresse" value="<?= $client['adresse'] ?>">
    <label>Ville :</label><input type="text" name="ville" value="<?= $client['ville'] ?>">
    <label>Âge :</label><input type="number" name="age" value="<?= $client['age'] ?>">
    <label>Email :</label><input type="email" name="mail" value="<?= $client['mail'] ?>">
    <label>Nouvelle image (optionnelle) :</label><input type="file" name="image">
    <button type="submit" name="modifier">💾 Enregistrer</button>
    <a href="liste_clients.php">⬅ Retour</a> 
</form>
</body>
</html>
