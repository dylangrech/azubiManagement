<?php
DatabaseConnect::getDbConnection();
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<head>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <title>Azubi Site</title>
</head>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" type="text/css" href="<?php echo $this->getUrl('css/style.css'); ?>" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<body class="bg-light">
<?php if ($controller->getShowNavigationBar() === true) { ?>
    <nav class="navbar p-2 navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" target="_blank" href="https://www.fatchip.de/"><img width="100px" alt="Fatchip-Logo" class="img-thumbnail" src="Views/Images/fatchip_logo.png"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= $controller->getUrl('index.php')?>">List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $controller->getUrl('index.php?controller=AzubiForm')?>">Form</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $controller->getUrl('index.php?controller=Profile')?>">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $controller->getUrl('index.php?controller=AzubiCards')?>">Team</a>
                    </li>
                </ul>
                <a class="btn btn-danger dflex" href="<?= $controller->getUrl('index.php?controller=Logout')?>">Logout</a>
            </div>
        </div>
        <?php } ?>
    </nav>
<?php include __DIR__.'/errorBox.php' ?>
    <div class="container d-flex align-items-center justify-content-center">




