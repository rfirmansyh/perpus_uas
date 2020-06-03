<?php 

class App {

    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];


    public function __construct() {
        $url = $this->parseURL();

        if ( isset($url[0]) ) {
            if ( strtolower($url[0]) === 'admin' ) {
                $this->controller = 'Login';
                unset($url[0]);
                if ( isset($url[1]) ) {
                    if ( !isset($_SESSION['petugas']) ) {
                        $this->controller = 'Login';
                        unset($url[1]);
                    } else {
                        if ( file_exists('../app/controllers/admin/'. $url[1].'.php') ) {
                            $this->controller = $url[1];
                            unset($url[1]);
                        }
                    }
                }

                require_once '../app/controllers/admin/'.$this->controller.'.php';
                $this->controller = new $this->controller;  

                if ( isset($url[2]) ) {
                    if ( method_exists($this->controller, $url[2]) ) {
                        $this->method = $url[2];
                        unset($url[2]);
                    }
                }

            } else {
                if ( file_exists('../app/controllers/'. $url[0].'.php') ) {
                    $this->controller = $url[0];
                    unset($url[0]);
                }
                require_once '../app/controllers/'.$this->controller.'.php';
                $this->controller = new $this->controller;  
                if ( isset($url[1]) ) {
                    if ( method_exists($this->controller, $url[1]) ) {
                        $this->method = $url[1];
                        unset($url[1]);
                    }
                }    
            }
            
        } else {
            require_once '../app/controllers/'.$this->controller.'.php';
            $this->controller = new $this->controller;
        }


        
        if ( !empty($url) ) {
            $this->params = array_values($url);
        }


        call_user_func_array([$this->controller, $this->method], $this->params);

    }

    public function parseURL() {
        if ( isset($_GET['url']) ) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }

}