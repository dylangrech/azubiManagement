<?php

class Logout extends SafetyController
{
    protected $view = "logout";
    protected $searchList = false;

    public function logoutUser()
    {
       session_unset();
       header('Location: index.php?controller=Login');
    }
}