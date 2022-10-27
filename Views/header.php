<?php
DatabaseConnect::getDbConnection();
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Page Title</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" type="text/css" href="<?php echo $this->getUrl('css/style.css'); ?>" />
<header class ="site-header">
        <div class="headerLogo">
        <a href="https://www.fatchip.de"><img src="Views/Images/fatchip_logo.png" width="200 px"></a>
        </div>
        <div class="headerTitle">
        <a class="headerLink" href="index.php"><h1>The Azubi Experience</h1></a>
        </div>
</header>
<br>
<body class="bodyWebsite">
    <?php include __DIR__.'/errorBox.php' ?>
    <?php if ($controller->getShowNavigationBar() === true) { ?>
        <div class="navContainer">
            <nav>
                <ul>
                    <li><a href="<?= $controller->getUrl('index.php')?>">List</a></li>
                    <li><a href="<?= $controller->getUrl('index.php?controller=AzubiForm')?>">Form</a></li>
                    <li><a href="<?= $controller->getUrl('index.php?controller=Profile')?>">Profile</a></li>
                    <li><a href="<?= $controller->getUrl('index.php?controller=AzubiCards')?>">Team</a></li>
                    <li><a href="<?= $controller->getUrl('index.php?controller=Logout')?>" >Logout</a></li>
                </ul>
            </nav>
        </div>
    <?php } ?>
