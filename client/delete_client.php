<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "marchi_bordo";
$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) die("Erreur de connexion : " . mysqli_connect_error());
if (!isset($_GET['id'])) die("Aucun client spécifié.");

$id = (int) $_GET['id'];

$imgRes = mysqli_query($conn, "SELECT image FROM clients WHERE id_client = $id");
if ($imgRes && $row = mysqli_fetch_assoc($imgRes)) {
    if (!empty($row['image']) && file_exists($row['image'])) unlink($row['image']);
}

mysqli_query($conn, "DELETE FROM clients WHERE id_client = $id");

echo "<script>alert('✅ Client supprimé avec succès !'); window.location.href='liste_clients.php';</script>";

mysqli_close($conn);
?>
