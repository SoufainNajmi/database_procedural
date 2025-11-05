<?php
$conn = mysqli_connect("localhost", "root", "", "marchi_bordo");
if (!$conn) die("Erreur de connexion");

if (!isset($_GET['id'])) die("Aucun article spécifié");

$id = (int)$_GET['id'];
$req = mysqli_query($conn, "SELECT * FROM article WHERE id_article=$id");
$article = mysqli_fetch_assoc($req);

if (isset($_POST['modifier'])) {
    $nom = mysqli_real_escape_string($conn, $_POST['nom_article']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    $prix = (float)$_POST['prix'];
    $quantite = (int)$_POST['quantite'];
    $id_categorie = !empty($_POST['id_categorie']) ? (int)$_POST['id_categorie'] : "NULL";

    $imagePath = $article['image'];
    if (!empty($_FILES['image']['name'])) {
        if (!empty($article['image']) && file_exists($article['image'])) unlink($article['image']);
        $targetDir = "uploads/";
        if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
        $targetFile = $targetDir . time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
        $imagePath = $targetFile;
    }

    $sql = "UPDATE article SET nom_article='$nom', description='$desc', prix=$prix, quantite=$quantite, id_categorie=$id_categorie, image='$imagePath' WHERE id_article=$id";
    mysqli_query($conn, $sql);
    echo "<script>alert('✅ Article modifié !'); window.location.href='liste_articles.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un article</title>
    <link rel="stylesheet" href="/asset/update.css">
</head>
<body>
<form method="POST" enctype="multipart/form-data">
    <h2>Modifier l'article</h2>

    <img src="<?= !empty($article['image']) ? $article['image'] : 'asset/img/default.png' ?>" alt="">

    <label>Nom :</label>
    <input type="text" name="nom_article" value="<?= $article['nom_article'] ?>" required>

    <label>Description :</label>
    <textarea name="description" rows="4"><?= $article['description'] ?></textarea>

    <label>Prix :</label>
    <input type="number" step="0.01" name="prix" value="<?= $article['prix'] ?>" required>

    <label>Quantité :</label>
    <input type="number" name="quantite" value="<?= $article['quantite'] ?>">

    <label>Catégorie :</label>
    <select name="id_categorie">
        <option value="">-- Sélectionner une catégorie --</option>
        <?php
        $cats = mysqli_query($conn, "SELECT * FROM categorie ORDER BY nom_categorie");
        while ($c = mysqli_fetch_assoc($cats)) {
            $sel = ($c['id_categorie'] == $article['id_categorie']) ? "selected" : "";
            echo "<option value='{$c['id_categorie']}' $sel>{$c['nom_categorie']}</option>";
        }
        ?>
    </select>

    <label>Nouvelle image :</label>
    <input type="file" name="image">

    <button type="submit" name="modifier">💾 Enregistrer</button>
    <a href="liste_articles.php">⬅ Retour à la liste</a>
</form>
</body>
</html>
