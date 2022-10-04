<?php
include "sessionCheck.php";
include 'functions.php';
$conn = getDatabaseConnection();

//If the search field in index.php contains an ID, when the user clicks the delete button, the ID will be deleted through a function
if (getRequestParameter('delete_azubi-id')){
    $id = getRequestParameter('delete_azubi-id');
    $deleted = deleteAzubi($conn, $id);
    if($deleted === true){
        redirect(getUrl('list.php'));
    }else{
        echo 'Not Deleted';
    }
}

?>
