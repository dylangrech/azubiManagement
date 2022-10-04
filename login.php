<?php
include "sessionCheck.php";
include "functions.php";
$conn = getDatabaseConnection();
$passwordLog =getRequestParameter('password-log');
$userEmail = getRequestParameter('user-email');
if (!empty($passwordLog) AND !empty($userEmail)){
    $sql = "SELECT * FROM azubi WHERE email = '$userEmail' AND password = '".getHashed($passwordLog)."'";
    $result = executeMysqlQuery($conn,$sql);
    $success = mysqli_fetch_array($result);
    if (!empty($success)){
        $_SESSION['logintimestamp'] = time();
        header('Location: http://localhost/Projekte/Database-Webpage/list.php');
    } else{
        echo 'Try Again';
    }
}
$conn = getDatabaseConnection();
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Page Title</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="">
<body>
    <form action="" method="post">
        <label>E-Mail: </label>
        <input type="text" name="user-email">
        <label>Password: </label>
        <input type="password" name="password-log">
        <input type="submit" value="login">
    </form>
</body>
</html>
