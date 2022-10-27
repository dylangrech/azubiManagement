<?php
/** @var Profile $controller */
$azubi = $controller->getAzubi(); ?>
<div class="content">
    <div class="image">
        <img id="personal" src="<?= $azubi->getPictureurl(); ?>" width="300" height="300">
    </div>
    <div class="info">
    <p>Name: <?= $azubi->getName(); ?></p>
    <p>Azubi zum Fachinformatiker zum Anwendungsentwicklung</p>
    <p>Birthday: <?= $azubi->getBirthday(); ?></p>
    <p>Email: <?= $azubi->getEmail(); ?></p>
    <p>Github: <?= $azubi->getGithubuser(); ?></p>
    <p>Bei Fatchip seit: <?= $controller->outputTime(); ?></p>
    </div>
</div>
