<?php

class Logout extends SafetyController
{
    protected $view = "logout";

    public function logoutUser()
    {
       session_destroy();
       header('Location: index.php?controller=Login');
    }
}