<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         body { font-family: Arial; background-color: #f4f6f7; display: flex; justify-content: center; align-items: center; height: 100vh; }
        form { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px #ccc; width: 400px; }
        h2 { text-align: center; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #aaa; border-radius: 5px; }
        button { margin-top: 15px; width: 100%; padding: 10px; background: #2ecc71; border: none; color: white; border-radius: 5px; }
        a { display: block; text-align: center; margin-top: 10px; color: #3498db; text-decoration: none; }

    </style>
</head>
<body>
    <form action="ajou2.php" method="post">
        <label>Nom :</label><input type="text" name="nom" required>
        <label>Prénom :</label><input type="text" name="prenom" required>
        <label>Adresse :</label><input type="text" name="adresse">
        <label>Ville :</label><input type="text" name="ville">
        <label>Âge :</label><input type="number" name="age" min="1">
        <label>Email :</label><input type="email" name="mail">
        <label>Image :</label><input type="file" name="image">
        <button type="submit" name="ajouter"> ajouter un client </button>
        <?php
        $host = "localhost";
$user = "root";
$password = "";
$dbname = "marchi_bordo";
$conn = mysqli_connect($host, $user, $password, $dbname);

        if(isset($_POST['ajouter'])){
            $nom = htmlspecialchars($_POST['nom']);
             $orenom = htmlspecialchars($_POST['nom']);
              $adress= htmlspecialchars($_POST['nom']);
               $ville = htmlspecialchars($_POST['nom']);
                $age = (int)$_POST['age'];
                 $email= htmlspecialchars($_POST['nom']);
                  $imad = htmlspecialchars($_POST['nom']);

                 
    $sql = "INSERT INTO clients (nom, prenom, adresse, ville, age, mail)
            VALUES ('$nom', '$prenom', '$adresse', '$ville', '$age', '$mail'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('✅ Client ajouté !'); window.location.href='liste_clients.php';</script>";
    } else {
        echo "<p style='color:red;'>Erreur : " . mysqli_error($conn) . "</p>";
    }
}
mysqli_close($conn);
       

        
        
        
        ?>
    </form>
</body>
</html>