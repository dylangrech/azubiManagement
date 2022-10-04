<?php
session_start();
$_SESSION['logintimestamp'] = 'Yes';
if(empty($_SESSION['logintimestamp'])){
    die('Not Logged');
}

