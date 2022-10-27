<?php

class DatabaseConnect
{
    protected static $dbconnect = null;
    //function which connects to the database
    public static function getDbConnection()
    {
        if (self::$dbconnect === null){
            mysqli_report(MYSQLI_REPORT_OFF);
            self::$dbconnect = mysqli_connect(Config::getConfigParameter('host'), Config::getConfigParameter('username'), Config::getConfigParameter('password'), Config::getConfigParameter('dbname'));
            if (!self::$dbconnect){
                throw new \Exception("Connection Failed: ". mysqli_connect_error());
            }
        }
        return self::$dbconnect;
    }

    //function which executes a query, with a better view of the error (clearer error message, useful to better understand the underlying problem
    public static function executeMysqlQuery($query)
    {
        $result = mysqli_query(self::getDbConnection(), $query);
        $error = mysqli_error(self::getDbConnection());
        if (!empty($error)){
            throw new \Exception("Error with query: ".$query." Error: ".$error);
        }
        //echo $query."<br>";
        return $result;
    }

    //function that hashes the password (md5 hash)
    public static function getHashed($password){
        return md5($password.Config::getConfigParameter('hash'));
    }

    //function that gets the Url
    public static function getUrl($file = ' ')
    {
        return Config::getConfigParameter('url').$file;
    }

    //function that redirects the user to another page
    public function redirect($url)
    {
        header("Location: " . $url);
        exit();
    }
}




