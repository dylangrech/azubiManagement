<!DOCTYPE html>
    <html lang="en">
    <meta charset="UTF-8">
    <title>Form</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Montserrat&family=Nabla&family=Raleway:wght@200&display=swap" rel="stylesheet">
    <body>
        <div id="wrapper-content">
            <form action="insert.php" method="post">
                <div id="personal-info-wrapper">
                    <h1 style="color: darkorange">Input Personal Data</h1>
                    <?php
                        include "sessionCheck.php";
                        include 'functions.php';
                        $conn = getDatabaseConnection();
                        $submission = 'Authenticate-Submit';

                        $row = ['name' => '', 'birthday' => '',  'email' => '',  'githubuser' => '',  'employmentstart' => '',  'pictureurl' => '', 'password' => '' ];
                        $azubi_id = getRequestParameter('azubi_id');
                        if ($azubi_id !== false ){
                            $query = "SELECT * FROM azubi WHERE id='$azubi_id'";
                            $select_query = executeMysqlQuery($conn, $query);

                            if (mysqli_num_rows($select_query) > 0){
                                $row = mysqli_fetch_assoc($select_query);

                            } else{
                                echo 'No record';
                            }
                        }
                        $password = 'password';
                        $passwordConfirm = 'password-confirm';
                    ?>

                    <p>
                        <input type="hidden" name="azubi_id" value="<?= $azubi_id; ?>">
                        <input type="text" name="name" id="fullName" placeholder="Full Name" value="<?= $row['name'];?>">
                    </p>
                    <br>
                    <p>
                        <input type="text" name="birthday" id="birthDate" placeholder="Birth Date (YY-MM-DD)" value="<?= $row['birthday'];?>"> <br>
                    </p>
                    <br>
                    <p>
                        <input type="text" name="email" id="emailAddress" placeholder="E-Mail" value="<?= $row['email'];?>"> <br>
                    </p>
                    <br>
                    <p>
                        <input type="text" name="githubuser" id="gitUser" placeholder="Github Username" value="<?= $row['githubuser'];?>"> <br>
                    </p>
                    <br>
                    <p>
                        <input style="width: 12%" type="text" name="employmentstart" id="employeeStart" placeholder="Start of Employment(YY-MM-DD)" value="<?= $row['employmentstart'];?>"> <br>
                    </p>
                    <br>
                    <p>
                        <input type="text" name="pictureurl" id="pictureURL" placeholder="PictureURL" value="<?= $row['pictureurl'];?>"> <br>
                    </p>
                    <br>
                    <p>
                        <input type="password" name="password" id="password" placeholder="Password" value="<?= $row['password'];?>" > <br>
                    </p>
                    <br>
                    <p>
                        <input type="password" name="password-confirm" placeholder="Confirm Password">
                    </p>
                </div>
                <br>
                <div id="wrapper-skills">
                    <div id="input1">
                        <h1 style="color: darkorange">Pre-Skills</h1>
                        <p>
                            <input type="text" name="preSkill" id="preSkill" placeholder="Skill"> <br>
                        </p>
                        <p>
                            <input type="text" name="preSkill1" id="preSkill1" placeholder="Skill"> <br>
                        </p>
                        <p>
                            <input type="text" name="preSkill2" id="preSkill2" placeholder="Skill"> <br>
                        </p>
                        <p>
                            <input type="text" name="preSkill3" id="preSkill3" placeholder="Skill"> <br>
                        </p>
                        <p>
                            <input type="text" name="preSkill4" id="preSkill4" placeholder="Skill"> <br>
                        </p>
                    </div>
                    <br>
                    <div id="input2">
                        <h1 style="color: darkorange">New Skills</h1>
                        <p>
                            <input type="text" name="newSkill" id="newSkill" placeholder="Skill"> <br>
                        </p>
                        <p>
                            <input type="text" name="newSkill1" id="newSkill1" placeholder="Skill"> <br>
                        </p>
                        <p>
                            <input type="text" name="newSkill2" id="newSkill2" placeholder="Skill"> <br>
                        </p>
                        <p>
                            <input type="text" name="newSkill3" id="newSkill3" placeholder="Skill"> <br>
                        </p>
                        <p>
                            <input type="text" name="newSkill4" id="newSkill4" placeholder="Skill"> <br>
                        </p>
                    </div>
                </div>
                <div id="submit">
                <input type="submit" value="Submit" name="Authenticate-Submit">
                </div>
            </form>
            <form action="" method="GET">
                <input type="text" name="azubi_id" value="<?php if(isset($_GET['azubi_id'])){echo $_GET['azubi_id'];}?>">
                <button type="submit">Search</button>
            </form>
            <?php if ($azubi_id !== false){ ?>
            <form action="delete.php" method="POST">
                <label>Input AzubiID</label>
                <input type="hidden" name="delete_azubi-id" value="<?= $azubi_id; ?>">
                <button type="submit" name="delete-azubi-button">Delete Azubi</button>
            </form>
            <?php } ?>
        </div>
    </body>
</html>