<?php

class AjaxController extends SafetyController
{

    public function render()
    {
        if ($this->view === false) {
            throw new \Exception("No View Found");
        }

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
        echo $file_content;

    }
}