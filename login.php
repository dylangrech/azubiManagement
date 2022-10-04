<?php
include "sessionCheck.php";
include "functions.php";
$conn = getDatabaseConnection();
//Variables contain data which has been inputted by the user
$passwordLog =getRequestParameter('password-log');
$userEmail = getRequestParameter('user-email');
//If data inputted is correct, query is executed and user is redirected to list.php
if (!empty($passwordLog) AND !empty($userEmail)){
    $sql = "SELECT * FROM azubi WHERE email = '$userEmail' AND password = '".getHashed($passwordLog)."'";
    $result = executeMysqlQuery($conn,$sql);
    $success = mysqli_fetch_array($result);
    if (!empty($success)){
        $_SESSION['logintimestamp'] = time();
        redirect(getUrl('list.php'));
    } else{
        echo 'Try Again';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Page Title</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<!-- Through the getUrl function, we do not have to go around the whole code written to change the path of a link or action form -->
<link rel="stylesheet" href="<?php echo getUrl('style.css'); ?>">
<body>
    <form action="<?php echo getUrl('login.php'); ?>" method="post">
        <label>E-Mail: </label>
        <input type="text" name="user-email">
        <label>Password: </label>
        <input type="password" name="password-log">
        <input type="submit" value="login">
    </form>
</body>
</html>
