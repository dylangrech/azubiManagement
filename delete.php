<?php
include "sessionCheck.php";
include 'functions.php';
$conn = getDatabaseConnection();

if (getRequestParameter('delete_azubi-id')){
    $id = getRequestParameter('delete_azubi-id');
    $deleted = deleteAzubi($conn, $id);
    if($deleted === true){
        echo 'Delete';
            // TODO; Redirect to list
    }else{
        echo 'Not Deleted';
    }
}

?>
