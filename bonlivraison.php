<?php
$title = 'bonlivraison';
include 'header.php';
include 'dbconnect.php';
///////////////ajouter///////////////
if(isset($_POST['ajouter'])){
    $date =  $_POST ['date'];
    $nouvellcaissier = $_POST ['caissier_nom'];
    $nouvellclient = $_POST ['client_nom'];
    $Réglé = $_POST ['reglé'];


    if(!empty($date)&& isset($nouvellcaissier)&& isset($nouvellclient )&& isset($Réglé )){
        $sqlInsert = "INSERT INTO BonLivraison(date,caissier_id,client_id,reglé) 
        VALUES ('$date','$nouvellcaissier','$nouvellclient','$Réglé')";
        $resultInsert = $conn->query($sqlInsert);
        if ($resultInsert) {
                 ///
        }else{
            echo "Une erreur de l'ajout de la BonLivraison : " . $conn->error;
        }
    }else{
            echo "";  
        }
}
 //////////////delete///////////
 if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $bonlivraisonToDelete = $_GET['delete'];


    $sqlDelete = "DELETE FROM bonlivraison WHERE id = $bonlivraisonToDelete";
    $resultDelete = $conn->query($sqlDelete);

    if ($resultDelete) {
        echo "";
    } else {
        echo "حدث خطأ أثناء حذف العائلة: " . $conn->error;
    }
}

$sql = "SELECT bonlivraison.*, client.nom AS client_nom, caissier.nom AS caissier_nom
        FROM bonlivraison
        LEFT JOIN client ON bonlivraison.client_id = client.id
        LEFT JOIN caissier ON bonlivraison.caissier_id = caissier.id";


$result = $conn->query($sql);
?>
<div class="app-container">
    <?php
    include 'side-bar.php';
    ?>
        <div class="row w-100 my-4">
            <div class="col-8 mx-auto">
                <div class="btn-container">
                <a href="./ajouter-bonlivraison.php" class="btn btn-primary">Ajouter</a>
                </div>
                <table class="table border m-auto">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Réglé</th>
                            <th scope="col">Client</th>
                            <th scope="col">Caissier</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        //
                            if ($result->num_rows > 0) {
        
                            while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo($row["id"]);?></th>
                                <td><?php echo($row["date"]); ?></td>
                                <td><?php echo(($row["reglé"] == 1)?'Réglé':'Non Réglé'); ?></td>
                                <td><?php echo($row["client_nom"]); ?></td>
                                <td><?php echo($row["caissier_nom"]); ?></td>
                                <td>
                                    <a class="btn btn-primary btn-sm edit-btn" href="./modifier-bonlivraison.php?bonlivraison=<?php   echo$row["id"];?>" role="button"> Modifier </a>
                                    <a class="btn btn-primary btn-sm " href="?delete=<?php   echo($row["id"]);?>" role="button"> Supprimer </a>
                                    <a class="btn btn-primary btn-sm" href="./Détail bon de livraison .php" >Détail</a>
                                </td>
                            </tr>
                                    
                        <?php
                            }
                        }
                        ?>
        
                    </tbody>
                </table>
            </div>  
        </div>
</div>