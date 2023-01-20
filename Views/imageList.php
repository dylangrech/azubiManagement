<?php
/** @var AzubiCards $controller */
$data = $controller->getAzubiData(); ?>
<div class="container p-5">
    <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
        <?php foreach ($data as $azubi) { ?>
        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="text-center">
                    <div class="img-responsive img-hover-zoom img-hover-zoom--colorize">
                        <img id="imageInImageList" class="img-fluid shadow" src="<?= $azubi->getPictureurl();?>" alt="Profile Image">
                    </div>
                </div>
                <div class="card-body">
                    <div class="my-2 text-center">
                        <h2><?= $azubi->getName();?></h2>
                    </div>
                    <div class="mb-3-">
                        <p class="text-muted text-center role"><a class="text-decoration-none" none;" href="mailto:<?= $azubi->getEmail();?>"><?= $azubi->getEmail();?></a></p> <!-- Style move -->
                    </div>
                    <div class="box">
                        <div>
                            <ul class="list-inline">
                                <li class="list-inline-item"><a target="_blank" href="https://github.com/<?= $azubi->getGithubuser();?>"><img class="img-fluid" src="Views/images/github-icon.svg"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</div>
