<?php

class AzubiCards extends SafetyController
{
    //Properties
    protected $view = "imageList";
    protected $searchList = false;

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

    public function checkUrl($imageURL)
    {
        $ch = curl_init($imageURL);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($code == 200){
            echo $imageURL;
        } else {
            echo "social-media-chatting-online-blank-profile-picture-head-and-body-icon-people-standing-icon-grey-background-free-vector.jpg";
        }
    }
}