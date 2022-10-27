<?php if (!empty($controller->getErrorMessage())){ ?>
    <div class="errorBox">
        <?= "<img style='width: 20px' src='Views/images/sign-error-icon.png'> <p style='font-size: 20px; color: white'>  Error: ".$controller->getErrorMessage()."</p>"; ?>
    </div>
<?php } ?>



