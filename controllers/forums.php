<?php

class Forums extends Controller {

    public function __construct() {
        Controller::$currentPage = "Forums";
        Controller::addCrumb(array(Controller::$currentPage, "forums/"));
    }

    public function index() {
        parent::buildPage();
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