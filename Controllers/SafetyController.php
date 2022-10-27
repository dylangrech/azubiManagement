<?php

class SafetyController extends BaseController
{
    protected $startsSession = true;

    public function __construct()
    {
        parent::__construct();
        $maxTime = 480;
        $timeSinceLog = (time() - $_SESSION['login'])/60;
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true && $timeSinceLog < $maxTime){
            return true;
        } else {
            $this->redirect($this->getUrl('index.php?controller=Login'));
        }
    }
}