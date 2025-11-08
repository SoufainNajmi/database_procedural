<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 
    <link rel="stylesheet" href="/asset/list_client.css">
</head>
<body>
    <div>
        <h2>List de clinet </h2>
         <a href="ajou2.php"> <button>Ajouter un Client </button></a>
    </div>
    <hr>
    <hr>
    <div>
        <?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "marchi_bordo";
$connx = mysqli_connect($host, $user, $password, $dbname);

         if(!$connx){
            echo" we have an probleme cote connection!....";
            exit;
         }

         $req="SELECT id_client,nom,prenom,age  FROM  clients ";

        

         $result = mysqli_query($connx,$req);

         $x = mysqli_num_rows($result);

         if($x=0){
              echo" aucun client trouvie !... ";
         }else{
            echo "<table>";
            echo "<tr>
                  <th>id</th>
                  <th>nom</th>
                  <th>prenom</th>
                  <th>age</th>
                  <th>action1</th>
                  <th>action2</th>
            
                 </tr>";
 while($row=mysqli_fetch_assoc($result)){
         echo "<tr>
                <td>{$row ['id_client']}</td>
                <td> {$row['nom']} </td>
                <td>{$row['prenom']}</td>
                <td>{$row['age']}</td>
                <td><a href=`delete.php?id={$row ['id_client']}` > Supprimer</a>  </td>
                <td><a href=`delete.php?id={$row ['id_client']}` > Update</a>  </td>
              </tr>";
 }
    echo "</table>";
         }
        
        ?>
    </div>
    

</body>
</html>