<?php
/** @var AzubiCards $controller */
$data = $controller->getAzubiData();
foreach ($data as $azubi){ ?>
<div class="card">
    <img src="<?= $azubi->getPictureurl(); ?>" alt="Avatar" style="width = 50px">
    <div class="container">
        <p><b>Name: </b><?= $azubi->getName(); ?></p>
        <p><b>E-Mail: </b><?= $azubi->getEmail(); ?></p>
    </div>
</div>
<?php }?>

