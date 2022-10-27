<?php

class AzubiCards extends SafetyController
{
    //Properties
    protected $view = "imageList";

    //function that retreives the azubi data through a query and the data iss then inputted in an array
    public function getAzubiData()
    {
        $azubiArray = [];
        $query = "SELECT * FROM azubi";
        $result = DatabaseConnect::executeMysqlQuery($query);
        if ($result){
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach ($data as $row){
                //variable azubi is given the class Azubi from Azubi.php
                $azubi = new Azubi($row['id'], $row['name'], $row['birthday'], $row['email'], $row['githubuser'], $row['employmentstart'], $row['pictureurl'], $row['password']);
                $azubiArray[] = $azubi;
            }
        }
        return $azubiArray;
    }
}