<?php
//Initialise Array - Either empty or filled
$emptyArray = [];
$filledArray = ['John', 'Peter', 'Joe'];
$emptyAssociativeArray = []; //or array();
$filledAssociativeArray = ['John'=>30, 'Peter'=>40, 'Joe'=>50];

//Read Array
echo $filledArray[0]; //Returns John
echo '<br>';
echo $filledAssociativeArray['John']; //Returns 30
echo '<br>';

//Add Values in Array
$emptyArray[] = 'newValue'; //Given Index 0
$filledArray[] = 'randomName'; //Given Index 3
//Add Values in Associative Array
$emptyAssociativeArray['randomName'] = 10;
$filledAssociativeArray['randomName'] = 60;

foreach ($filledArray as $name){
    echo $name.'<br>'; //outputs the name(value of an index)
}

foreach ($filledAssociativeArray as $name => $age){
    echo 'My name is '.$name.' and I am '.$age.' years old <br>'; //Outputs the key and the value of the array
}

// array_pop($arrayName) - removes last value in array
// array_shift($arrayName) - removes first value in array (array is re-indexed)
//unset($arrayNname) - deletes the whole array
//unset($arrayName[$param]) - delete value in the param, array is not re-indexed






