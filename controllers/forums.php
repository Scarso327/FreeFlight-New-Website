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
        Controller::addCrumb(array("Users", "forums/user/".$steamid));

        $member = Accounts::GetUser($steamid);

        if (!$member) {
            new Issue("#404");
            exit;
        }

        Controller::$currentPage = $member->steamName;
        Controller::addCrumb(array(Controller::$currentPage, "forums/user/".$steamid));

        parent::buildPage(array(VIEWS . "forums/account"), array(
            "css" => array("user.css"),
            "member" => $member
        ));
    }
}