<?php

class AppError extends ErrorHandler {

    function error404($params) {  
        App::import('Lib', 'Facebook.FB');
        $Facebook = new FB();
        $this->fb = $Facebook;

        $this->controller->layout = 'error';  
  
        parent::error404($params);  
    }
    
}	