<?php
include "sessionCheck.php";
include 'functions.php';
$conn = getDatabaseConnection();

//Variables contain the data inputted in the password field which can be found in index.php
$password = getRequestParameter('password', '');
$confirmPassword = getRequestParameter('password-confirm', '');
//function Validate makes sure that both the password and confirmation field contain the same input
Validate($password, $confirmPassword);

//The following variable checks if there is an ID in the hidden input called azubi_id
$azubiId = getRequestParameter("azubi_id");
if (!empty($azubiId)) {
    //following function will update the azubi if the there is an ID in the hidden input field
    updateAzubi($conn);
} else {
    //following function will insert the data if there is no ID in the input field
    insertAzubi($conn);
}

mysqli_close($conn);

?>