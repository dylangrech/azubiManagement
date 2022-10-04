<?php
function getDatabaseConnection(){

    //inputting data
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

    //Create Connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check Connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

function getRequestParameter($key, $default = false){
    if(isset($_REQUEST[$key])){
       return $_REQUEST[$key];
    }
    return $default;
}

function executeMysqlQuery($conn, $query){
    $result = mysqli_query($conn, $query);
    $error = mysqli_error($conn);
    if (!empty($error)){
        echo "<h1>Error with query: ".$query." Error: ".$error."</h1>";
    }
    // echo $query."<br>";
    return $result;
}

function createAzubiSkill($conn, $azubiID, $skillType, $skillValue){
    $sqlpre = "INSERT INTO azubi_skills(azubi_id, type, skill) VALUES ('$azubiID', '$skillType', '$skillValue')";

    if (executeMysqlQuery($conn, $sqlpre)){
        return true;
    } else{
        return false;
    }
}

function updateAzubi($conn){

    $id = getRequestParameter('azubi_id');
    $name = getRequestParameter('name', '');
    $birthday = getRequestParameter( 'birthday', '');
    $email = getRequestParameter( 'email', '');
    $githubuser = getRequestParameter( 'githubuser', '');
    $employmentstart =getRequestParameter( 'employmentstart', '');
    $pictureurl = getRequestParameter( 'pictureurl', '');
    $password = getRequestParameter('password', '');



    $query = "UPDATE azubi SET name='$name', birthday='$birthday', email='$email', githubuser='$githubuser', employmentstart='$employmentstart', pictureurl ='$pictureurl', password = '".getHashed($password)."' WHERE id ='$id'";
    $execute_query = executeMysqlQuery($conn, $query);

    if($execute_query){
        echo "Updated";
    } else{
        echo "Not Updated";
    }
}

function insertAzubi($conn){

    //Taking all value from data input from index.php - Each data has been stored in the variable $name, $birthday and so forth
    $name = $_REQUEST['name'];
    $birthday = $_REQUEST['birthday'];
    $email = $_REQUEST['email'];
    $githubuser = $_REQUEST['githubuser'];
    $employmentstart = $_REQUEST['employmentstart'];
    $pictureurl = $_REQUEST['pictureurl'];
    $password = $_REQUEST['password'];
    $passwordconfirmation = $_REQUEST['password'];

    if (empty($name)) {
        die("<h1 style='color: darkorange'>You forgot to enter your full name!</h1>");
    }

    if (empty($birthday)) {
        die('<h1 style="color: darkorange">You forgot to enter your birth date!</h1>');
    }

    if (empty($email)) {
        die('<h1 style="color: darkorange">You forgot to enter your e-mail</h1>');
    }

    if (empty($githubuser)) {
        die('<h1 style="color: darkorange">You forgot to enter a github user!</h1>');
    }

    if (empty($employmentstart)) {
        die('<h1 style="color: darkorange">You forgot to choose a date!</h1>');
    }

    if (empty($pictureurl)) {
        die('<h1 style="color: darkorange">You forgot to link your picture!</h1>');
    }

    if (empty($password)) {
        die('<h1 style="color: darkorange">You forgot to enter a password!</h1>');
    }

    if (empty($passwordconfirmation)){
        die('<h1 style="color: darkorange">You forgot to confirm the password!</h1>');
    }

        //Inserting the Data that has been given into the azubi table
        $sql = "INSERT INTO azubi (name, birthday, email, githubuser, employmentstart, pictureurl, password) VALUES ('$name', '$birthday', '$email', '$githubuser', '$employmentstart', '$pictureurl', '".getHashed($password)."')";

        // if both given queries are working, given commands will be executed
        if (executeMysqlQuery($conn, $sql)) {
            echo "<h3>Data has been stored successfully</h3>";
        } else {
            echo "<h3>An Error has occurred</h3>";
        }

        //Taking values for
        //retrieving the ID from the last query
        $azubiID = mysqli_insert_id($conn);
        $preSkill = $_REQUEST['preSkill'];
        $preSkill1 = $_REQUEST['preSkill1'];
        $preSkill2 = $_REQUEST['preSkill2'];
        $preSkill3 = $_REQUEST['preSkill3'];
        $preSkill4 = $_REQUEST['preSkill4'];
        $newSkill = $_REQUEST['newSkill'];
        $newSkill1 = $_REQUEST['newSkill1'];
        $newSkill2 = $_REQUEST['newSkill2'];
        $newSkill3 = $_REQUEST['newSkill3'];
        $newSkill4 = $_REQUEST['newSkill4'];

        if (empty($preSkill)) {
            die('<h1 style="color: darkorange">You forgot to add a skill in the Pre-Section!</h1>>');
        }
        if (!empty($preSkill1)) {
            createAzubiSkill($conn, $azubiID, 'pre', $preSkill1);
        }
        if (!empty($preSkill2)) {
            createAzubiSkill($conn, $azubiID, 'pre', $preSkill2);
        }
        if (!empty($preSkill3)) {
            createAzubiSkill($conn, $azubiID, 'pre', $preSkill3);
        }
        if (!empty($preSkill4)) {
            createAzubiSkill($conn, $azubiID, 'pre', $preSkill4);
        }
        if (empty($newSkill)) {
            die('<h1 style="color: darkorange">You forgot to add a skill in the New-Section!</h1>');
        }
        if (!empty($newSkill1)) {
            createAzubiSkill($conn, $azubiID, 'new', $newSkill1);
        }
        if (!empty($newSkill2)) {
            createAzubiSkill($conn, $azubiID, 'new', $newSkill2);
        }
        if (!empty($newSkill3)) {
            createAzubiSkill($conn, $azubiID, 'new', $newSkill3);
        }
        if (!empty($newSkill4)) {
            createAzubiSkill($conn, $azubiID, 'new', $newSkill4);
        }
        createAzubiSkill($conn, $azubiID, 'pre', $preSkill);
        createAzubiSkill($conn, $azubiID, 'new', $newSkill);
}

function deleteAzubi($conn, $id){
    $query = "Delete FROM azubi WHERE id='$id'";
    $execute_query = executeMysqlQuery($conn, $query);

    if($execute_query){
        return true;
    }
    return false;
}

function Validate($value1, $value2){
    if ($value1 !== $value2){
        echo "<button><a href='index.php'>Try Again</a></button> <br>";
        die("Confirmed Password does not match");
    }
}

function getHashed($password){
    return md5($password."salt");
}

