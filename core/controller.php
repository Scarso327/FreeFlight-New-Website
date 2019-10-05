<?php

class Controller {
    
    public static $currentPage = "Home";
    public static $subPage = "";
    public static $breadcrumbs = array();
    public static $messages = array();

    public static function addCrumb($crumb) {
        array_push(self::$breadcrumbs, $crumb);
    }

    public static function addMsg($msg, $color = "green") {
        array_push(self::$messages, array($msg, $color));
    }

    public static function buildCrumbs() {
        foreach (self::$breadcrumbs as $crumb) {
            echo '<a href="'.URL.$crumb[1].'">'.$crumb[0].'</a>';
        
            if ($crumb != end(self::$breadcrumbs)) {
                echo ' <span class="slash">/</span> ';
            }
        }
    }

    public static function buildMessages() {
        foreach (self::$messages as $message) {
            ?>
            <section class = "site-message <?=$message[1];?>">
                <?=$message[0];?>
            </section>
            <?php
        }
    }

    public static function buildPage($pages = false, $data = null) {
        new View($pages, $data);
    }
}