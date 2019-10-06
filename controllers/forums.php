<?php

class Forums extends Controller {

    public function __construct() {
        Controller::$currentPage = "Forums";
        Controller::addCrumb(array(Controller::$currentPage, "forums/"));
    }

    public function index() {
        parent::buildPage(array(VIEWS . "forums/global"), array(
            "css" => array("news.css"),
            "pageInfo" => array(
                "body" => array(VIEWS . "forums/navigation"),
                "sidebar" => array(VIEWS . "forums/sidebars/latest")
            ),
            "categories" => Forum::getCategories()
        ));
    }

    public function forum($forum = null, $topic = null) {
        $section = Forum::getSection($forum);

        if (!$section) {
            new Issue("#404");
            exit;
        }

        Controller::$subPage = $section->title;
        Controller::addCrumb(array(Controller::$subPage, "forums/forum/".$forum));

        if ($topic) {
            $topic = Topics::getTopic($topic);

            if (!$topic) {
                new Issue("#404");
                exit;
            }
        
            Controller::$subPage = $topic->title;
            Controller::addCrumb(array(Controller::$subPage, "forums/forum/".$forum."/".$topic->id));
            
            parent::buildPage(array(VIEWS . "forums/global"), array(
                "css" => array("news.css", "topic.css"),
                "pageInfo" => array(
                    "body" => array(VIEWS . "forums/topic"),
                    "sidebar" => array(VIEWS . "forums/sidebars/latest")
                ),
                "section" => $section,
                "topic" => $topic
            ));
        } else {
            parent::buildPage(array(VIEWS . "forums/global"), array(
                "css" => array("news.css"),
                "pageInfo" => array(
                    "body" => array(VIEWS . "forums/section"),
                    "sidebar" => array(VIEWS . "forums/sidebars/latest")
                ),
                "section" => $section,
                "topics" => Topics::getTopics($section->id)
            ));
        }
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