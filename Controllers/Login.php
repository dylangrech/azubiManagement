<?php

class Login extends BaseController
{
    protected $view = 'login';
    protected $startsSession = true;
    protected $showNavigationBar = false;

    public function loginUser()
    {
        //Variables contain data which has been inputted by the user
        $passwordLog = $this->getRequestParameter('password-log');
        $userEmail = $this->getRequestParameter('user-email');
        //If data inputted is correct, query is executed and user is redirected to list.php
        if (!empty($passwordLog) AND !empty($userEmail)){
            $sql = "SELECT * FROM azubi WHERE email = '$userEmail' AND password = '".DatabaseConnect::getHashed($passwordLog)."'";
            $result = DatabaseConnect::executeMysqlQuery($sql);
            $success = mysqli_fetch_array($result);
            if (!empty($success)){
                $_SESSION['userEmail'] = $userEmail;
                $_SESSION['loggedIn'] = true;
                $_SESSION['login'] = time();
                $this->redirect($this->getUrl('index.php?controller=AzubiList'));
            }
        }
    }
}