<?php

$title = 'Famille';

include 'header.php';
include 'dbconnect.php';

if(isset($_POST['modifier'])){
    $nouvelleFamille = $_POST['nouvelle_famille'];
    $Famille = $_POST['Famille'];
    // التأكد من أن القيمة غير فارغة قبل إضافتها إلى قاعدة البيانات
    if (!empty($nouvelleFamille)) {
        $sqlUPDATE = "UPDATE famille SET famille='$nouvelleFamille 'WHERE id=$Famille"; 
        $resultUPDATE = $conn->query($sqlUPDATE);

        if ($resultUPDATE) {
            // echo "modifier avec succès";
        } else {
            echo "Une erreur s'est produite lors de modifier de la famille : " . $conn->error;
        }
    } else {
        echo "";
    }
}
                             //////////////ajouter/////////////////
if(isset($_POST['ajouter'])){
    $nouvelleFamille = $_POST['nouvelle_famille'];

    // التأكد من أن القيمة غير فارغة قبل إضافتها إلى قاعدة البيانات
    if (!empty($nouvelleFamille)) {
        $sqlInsert = "INSERT INTO famille (famille) 
        VALUES ('$nouvelleFamille')";
        $resultInsert = $conn->query($sqlInsert);

        if ($resultInsert) {
                header("Location: famille.php");
            exit();
        } else {
            echo "Une erreur s'est produite lors de l'ajout de la famille : " . $conn->error;
        }
    } else {
        echo "";
    }
}
                             //////////////delete/////////////////

if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $familleIdToDelete = $_GET['delete'];


    $sqlDelete = "DELETE FROM famille WHERE id = $familleIdToDelete";
    $resultDelete = $conn->query($sqlDelete);

    if ($resultDelete) {
        echo "";
    } else {
        echo "حدث خطأ أثناء حذف العائلة: " . $conn->error;
    }
}



$sql = "SELECT * FROM famille";

$result = $conn->query($sql);


?>

<div class="app-container">
    <?php
        include 'side-bar.php';
    ?>
        <div class="row w-100 my-4">
            <div class="col-8 mx-auto">
                <div class="btn-container">
                <a href="./ajouter-famille.php" class="btn btn-primary">Ajouter</a>  
                </div>
                <table class="table border m-auto">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Famille</th>
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
                                <td><?php echo($row["famille"]); ?></td>
                                <td>                              
                                    <a class="btn btn-primary btn-sm edit-btn" href="./modifier-famille.php?famille=<?php   echo($row["id"]);?>" role="button"> Modifier </a>
                                    <a class="btn btn-primary btn-sm" href="?delete=<?php echo $row['id']; ?>" role="button"> Supprimer </a> 
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
<!-- Modal -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter une famille</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="nouvelle_famille" class="form-control" placeholder="FAMILLE" aria-label="FAMILLE">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" name="ajouter">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>  
</div> -->

<?php

include 'footer.php';

?>