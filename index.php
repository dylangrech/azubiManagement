<?php

include __DIR__."/autoloader.php";

$controller = "AzubiList";
if (isset($_REQUEST['controller'])) {
    $controller = $_REQUEST['controller'];
}


$controllerObject = new $controller();

if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
    if (method_exists($controllerObject, $action)) {
        try {
            $controllerObject->$action();
        } catch (Throwable $exception) {
            $controllerObject->setErrorMessage($exception->getMessage());
        }
    }
}

$controllerObject->render();