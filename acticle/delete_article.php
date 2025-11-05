<?php
$conn = mysqli_connect("localhost", "root", "", "marchi_bordo");
if (!$conn) die("Erreur de connexion");

if (!isset($_GET['id'])) die("Aucun article spécifié");

$id = (int)$_GET['id'];

// Supprimer l'image si elle existe
$res = mysqli_query($conn, "SELECT image FROM article WHERE id_article=$id");
if ($res && $row = mysqli_fetch_assoc($res)) {
    if (!empty($row['image']) && file_exists($row['image'])) unlink($row['image']);
}

// Supprimer l'article
mysqli_query($conn, "DELETE FROM article WHERE id_article=$id");

echo "<script>alert('✅ Article supprimé !'); window.location.href='liste_articles.php';</script>";
?>
