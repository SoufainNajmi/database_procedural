<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un article</title>
      <link rel="stylesheet" href="/asset/ajouter.css"> 
</head>
<body>

<form method="POST" enctype="multipart/form-data">
    <h2>Ajouter un article</h2>

    <label>Nom de l'article :</label>
    <input type="text" name="nom_article" required>

    <label>Description :</label>
    <textarea name="description" rows="4"></textarea>

    <label>Prix (€) :</label>
    <input type="number" step="0.01" name="prix" required>

    <label>Quantité :</label>
    <input type="number" name="quantite" min="0" value="0">

    <label>Catégorie :</label>
    <select name="id_categorie">
        <option value="">-- Sélectionner une catégorie --</option>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "marchi_bordo");
        $res = mysqli_query($conn, "SELECT * FROM categorie ORDER BY nom_categorie");
        while ($cat = mysqli_fetch_assoc($res)) {
            echo "<option value='{$cat['id_categorie']}'>{$cat['nom_categorie']}</option>";
        }
        ?>
    </select>

    <label>Image:</label>
    <input type="file" name="image">

    <button type="submit" name="ajouter">➕ Ajouter</button>
    <a href="liste_articles.php">⬅ Retour à la liste</a>
</form>

<?php
if (isset($_POST['ajouter'])) {
    $nom = mysqli_real_escape_string($conn, $_POST['nom_article']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    $prix = (float)$_POST['prix'];
    $quantite = (int)$_POST['quantite'];
    $id_categorie = !empty($_POST['id_categorie']) ? (int)$_POST['id_categorie'] : "NULL";

    $imagePath = "";
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
        $targetFile = $targetDir . time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
        $imagePath = $targetFile;
    }

    $sql = "INSERT INTO article (nom_article, description, prix, quantite, id_categorie, image)
            VALUES ('$nom', '$desc', $prix, $quantite, $id_categorie, '$imagePath')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('✅ Article ajouté !'); window.location.href='liste_articles.php';</script>";
    } else {
        echo "<p style='color:red;'>Erreur : " . mysqli_error($conn) . "</p>";
    }
}
mysqli_close($conn);
?>
</body>
</html>
