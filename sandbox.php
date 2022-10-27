<?php


$num_of_attempts = 5;
$attempts = 0;

do {
    try{
        executeCode();
    } catch (Throwable $e){
        $attempts++;
        sleep(1);
        continue;
    }
    break;
} while ($attempts < $num_of_attempts);

function executeCode(){
}

