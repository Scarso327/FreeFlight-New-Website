<?php

class Home extends Controller {

    public function __construct() {
        parent::buildPage(array(VIEWS . "site-notifications", VIEWS . "navbar"));
    }
}