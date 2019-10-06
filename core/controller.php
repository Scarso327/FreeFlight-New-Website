<?php

class Controller {
    
    public static $currentPage = "Home";
    public static $subPage = "";
    public static $breadcrumbs = array();
    public static $messages = array();

    public function __construct($auth = false) {
        Session::start(); // Start a Session to be used.
        
        if ((isset($_GET['login']))) { exit; }

        // Session = Alive...
        if (Session::get("steamid")) {
            // Cookie Revival Check...
            if (!(isset($_COOKIE['remember_token'])) || !(isset($_COOKIE['steam_id']))) {
                $token = Accounts::setToken($player->steamid);
                if (!$token) { Account::logout(true); exit; }

                setcookie("steam_id", Session::get("steamid"), time()+3600 * 24 * 365, "/");
                setcookie("remember_token", $token, time()+3600 * 24 * 365, "/");
            }
        } else {
            // Session Revival Check...
            if (isset($_COOKIE['remember_token']) && isset($_COOKIE['steam_id'])) {
                if (!(Accounts::checkToken($_COOKIE['steam_id'], $_COOKIE['remember_token']))) {
                    Account::logout(false);
                    Session::set("reason", "Session Expired");
                    header ("Location: ".URL."login");
                    exit;
                }

                Steam::resync($_COOKIE['steam_id']);
            }
        }

        new Account (Session::get("steamid"));
        
        // Check our login...
        if ($auth && !Account::isLoggedIn()) {
            Session::set("reason", "Session Expired");
            header ("Location: ".URL); exit;
        }
    }

    public static function addCrumb($crumb) {
        array_push(self::$breadcrumbs, $crumb);
    }

    public static function addMsg($msg, $color = "green") {
        array_push(self::$messages, array($msg, $color));
    }

    public static function buildCrumbs() {
        foreach (self::$breadcrumbs as $crumb) {
            ?>
            <a <?php if ($crumb == end(self::$breadcrumbs)) { echo 'class="active"'; } ?>href="<?=URL.$crumb[1];?>"><?=$crumb[0];?></a>
            <?php

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