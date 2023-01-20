<?php

class BaseController
{
    protected $view = false;
    protected $startsSession = false;
    protected $showNavigationBar = true;
    protected $errorMessage = false;
    protected $errorLine = false;
    protected $errorFile = false;
    public $loggedInUser = null;

    public function __construct()
    {
        if ($this->startsSession === true){
            session_start();
        }
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    public function getErrorLine()
    {
        return $this->errorLine;
    }

    public function setErrorLine($errorLine)
    {
        $this->errorLine = $errorLine;
    }

    public function getErrorFile()
    {
        return $this->errorFile;
    }

    public function setErrorFile($errorFile)
    {
        $this->errorFile = $errorFile;
    }

    public function getShowNavigationBar()
    {
        return $this->showNavigationBar;
    }

    public function getRequestParameter($param, $default = false)
    {
        if (isset($_REQUEST[$param])){
            return $_REQUEST[$param];
        }
        return $default;
    }

    public function getUrl($file = ''){
        return Config::getConfigParameter('url').$file;
    }

    public function redirect($url)
    {
        header("Location: " . $url);
        exit();
    }

    public function render()
    {
            if ($this->view === false) {
                throw new \Exception("No View Found");
            }

            //$viewPath = __DIR__."./../Views/".$this->view.".php";
            //if (!file_exists($viewPath)) {
            //    $this->setErrorMessage('No View Found');
            //}

            $controller = $this;

            ob_start();
            try {
                $viewPath = __DIR__."./../Views/".$this->view.".php";
                if (!file_exists($viewPath)) {
                    throw new \Exception('No View Found');
                }
                include $viewPath;
            } catch (Throwable $e) {
                $this->setErrorMessage($e->getMessage());
                $this->setErrorLine($e->getLine());
                $this->setErrorFile($e->getFile());
            }
            $file_content = ob_get_contents();
            ob_end_clean();
            include __DIR__ . "/../Views/header.php";
            echo $file_content;
            include __DIR__."/../Views/footer.php";

    }
}





