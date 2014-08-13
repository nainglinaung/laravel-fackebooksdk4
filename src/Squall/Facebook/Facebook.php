<?php

namespace Squall\Facebook;

use Config;

class Facebook {

    public function __construct() {
        Facebook\FacebookSession::setDefaultApplication(Config::get('facebook::appId'), Config::get('facebook::appSecret'));
    }

    public function get_tabId() {
        $helper = new Facebook\FacebookPageTabHelper();
        return $helper->getPageId();
    }

}
