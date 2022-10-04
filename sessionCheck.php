<?php
//Starting a session - Important for when a user logs in
session_start();
$_SESSION['logintimestamp'] = 'Yes';
if(empty($_SESSION['logintimestamp'])){
    die('Not Logged');
}

