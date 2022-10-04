<?php
include "sessionCheck.php";
include 'functions.php';
$conn = getDatabaseConnection();
$password = getRequestParameter('password', '');
$confirmPassword = getRequestParameter('password-confirm', '');
Validate($password, $confirmPassword);

$azubiId = getRequestParameter("azubi_id");
if (!empty($azubiId)) {
    updateAzubi($conn);
} else {
    insertAzubi($conn);
}

mysqli_close($conn);

?>