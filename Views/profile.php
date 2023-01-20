<?php
/** @var Profile $controller */
$azubi = $controller->getAzubi();
$skillDataPre = $azubi->getSkillPre();
$skillDataNew = $azubi->getSkillNew(); ?>
<div class="row p-2">
    <div class="card container">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3 text-center">
                    <br>
                    <img width="200px" class="img-fluid rounded-circle" src="<?= $azubi->getPictureurl(); ?>">
                </div>
                <div class="col-sm-8">
                    <br>
                    <h1><b>Personal Information</b></h1>
                    <h6><b>Azubi zum Fachinformatiker Anwendungsentwicklung</b></h6>
                    <p>Name: <?= $azubi->getName()?></p>
                    <p>Email: <?= $azubi->getEmail();?></p>
                    <p>Github: <?= $azubi->getGithubuser(); ?></p>
                    <input id="timeStart" type="hidden" value="<?= $azubi->getEmploymentstart(); ?> 10:00:00">
                    <p id="timeOutput"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="card container mt-2">
        <div class="card-body">
            <h3>Pre-Skills</h3>
            <ul>
                <?php foreach ($skillDataPre as $skillPre){?>
                <li><?= $skillPre?></li>
                <?php } ?>
            </ul>
            <h3>New-Skills</h3>
            <ul>
                <?php foreach ($skillDataNew as $skillNew){?>
                    <li><?= $skillNew?></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>



