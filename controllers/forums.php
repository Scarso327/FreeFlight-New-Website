<?php

class Forums extends Controller {

    public function __construct() {
        Controller::$currentPage = "Forums";
    }

    public function index() {
        parent::buildPage(array(VIEWS . "site-notifications", VIEWS . "navbar"));
    }

    public function user($steamid = null) {
        $member = Accounts::GetUser($steamid);

        if (!$member) {
            new Issue("#404");
            exit;
        }

        Controller::$currentPage = $member->steamName;

        parent::buildPage(array(VIEWS . "site-notifications", VIEWS . "navbar"));
    }
}