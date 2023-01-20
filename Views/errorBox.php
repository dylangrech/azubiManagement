<?php if (!empty($controller->getErrorMessage())){ ?>
    <div class="container h-100 d-flex align-items-center justify-content-center">
        <div class="row alert alert-danger h-100 d-flex"">
            <div class="col-sm-12">
                <p><img width="20px" src="Views/images/sign-error-icon.png"> Error: <?= $controller->getErrorMessage(); ?></p>
            </div>
        </div>
    </div>
<?php } ?>



