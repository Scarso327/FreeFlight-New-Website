<?php

class Application {

    private $controller = null;
    private $action = null;
    private $params = array();

    public function __construct() {
        self::URLSetup();

        if (isset($_GET['logout'])) { Account::logout(); } // Logout...
        new Controller();

        Controller::addMsg("If you wish to view the old site use this link. <a href='".URL."old/' target='_blank'>Site</a>", "Green");

        $loginReason = Session::get("reason");
        if ($loginReason) {
            Controller::addMsg($loginReason, "Red");
        }

        switch (true) {
            case ($this->controller):
                if (file_exists(ROOT.'controllers/'.$this->controller.'.php')) {
                    require_once ROOT.'controllers/'.$this->controller.'.php';
                    $this->controller = new $this->controller;
                    if($this->action) {
                        if(method_exists($this->controller, $this->action)) {
                            if (!empty($this->params)) {
                                call_user_func_array(array($this->controller, $this->action), $this->params);
                            } else {
                                $this->controller->{$this->action}();
                            }
                        } else {
                            new Issue("#404");
                        }
                    } else {
                        $this->controller->index();
                    }
                    exit;
                } else {
                    new Issue("#404");
                }
                break;
            default:
                new Home;
        }
    }

    public function URLSetup() {
        if (isset($_GET['url'])) {
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $this->controller = isset($url[0]) ? $url[0] : null;
            $this->action = isset($url[1]) ? $url[1] : null;
            unset($url[0], $url[1]);
            $this->params = array_values($url);
        }
    }

    public static function randomStrGen($length = 64) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        
        $str = '';

        for ($i = 0; $i < $length; $i++) {
            $str .= $characters[rand(0, $charactersLength - 1)];
        }

        return $str;
    }

    /*
    ** Credit: https://stackoverflow.com/questions/1416697/converting-timestamp-to-time-ago-in-php-e-g-1-day-ago-2-days-ago
    */
    public static function formatTime($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime, new DateTimeZone('Europe/London'));
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );

        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}