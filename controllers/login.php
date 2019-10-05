<?php

class Login extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index () {
        Session::remove("reason"); // Wipe this shit...
        Steam::OpenIDSteam();
    }

    // Used for resyncing steam account details...
    public function resync() {
        if(Account::isLoggedIn()) {
            Steam::resync(Account::$steamid, true);
        } else {
            header("Location: ".URL);
        }
    }
}