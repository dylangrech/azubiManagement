<?php
include "sessionCheck.php";
include 'functions.php';
$conn = getDatabaseConnection();
$edit_button = 'edit_button';
$delete_button = 'delete_button';
$delete_selected = getRequestParameter('checkedId');
if (!empty($delete_selected)) {
    foreach ($delete_selected as $deleteID) {
        deleteAzubi($conn, $deleteID);
    }
}
$search = getRequestParameter('search');
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Page Title</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" type="text/css" href="style.css" />
<style></style>
<body>
    <div>
        <form class="list_form" action="list.php" method="post">
            <input class="search_input" type="text" name="search" placeholder="Search">
            <input class="search_button" value="Suchen"  type="submit" name="submit-search">
            <br>
            <table class="list-table">
                <thead>
                    <tr>
                        <td>Select</td>
                        <td>Name</td>
                        <td>Birthday</td>
                        <td>Email</td>
                        <td colspan="2">Edit or Delete</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                $query = "SELECT * FROM azubi";
                if (!empty($search)){
                    $search = mysqli_real_escape_string($conn, $search);
                    $query .= " WHERE name LIKE '%$search%' OR birthday LIKE '%$search%' OR email LIKE '%$search%'";
                }
                $displayData = executeMysqlQuery($conn, $query);
                if($displayData->num_rows > 0) {
                    while($rows = $displayData-> fetch_assoc()){ ?>
                    <tr style="border:1px solid black;margin-left:auto;margin-right:auto;">
                        <td><input type="checkbox" name="checkedId[]" value="<?= $rows['id']?>"></td>
                        <td><?=  $rows['name']; ?></td>
                        <td><?=  $rows["birthday"]; ?></td>
                        <td><?=  $rows["email"]; ?></td>
                        <td><a href="index.php?azubi_id=<?= $rows['id']?>"><img style="width: 25px" src="69-697943_edit-data-icon-comments-transparent-pen-icon-png.png"></a></td>
                        <td><a href="delete.php?delete_azubi-id=<?= $rows['id']?>"><img style="width: 15px" src="1000_F_272554194_9bJhYSJkUcLbTjXfDlDANV2RyQYGO06N.jpg"></a></td>
                    </tr>
                    <?php } }?>
                </tbody>
            </table>
            <div>
                <a role="button" href="index.php">Neue Azubi anlegen</a>
            </div>
            <div>
                <input type="submit" name ="delete_all_button" value="Ausgewählte Azubis löschen">
            </div>
        </form>
    </div>
</body>
</html>