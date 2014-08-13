<?php

namespace Squall\Facebook;

session_start();

use Config;

class Facebook {

    protected $redirectLogin;

    public function __construct() {
        FacebookSession::setDefaultApplication(Config::get('facebook::appId'), Config::get('facebook::appSecret'));
        $this->redirectLogin = new FacebookRedirectLoginHelper(Config::get('facebook::redirectLogin'));
    }

    public function get_accessToken() {
        return $session = new FacebookSession('access-token');
    }

    public function get_tabId() {
        $helper = new FacebookPageTabHelper();
        return $helper->getPageId();
    }

    public function isLiked() {
        $pageHelper = new FacebookPageTabHelper();
        return $pageHelper->isLiked();
    }

    public function get_pageSession() {
        $pageHelper = new FacebookPageTabHelper();
        return $pageHelper->getSession();
    }

    public function get_canvasSession() {
        $pageHelper = new FacebookCanvasLoginHelper();
        return $pageHelper->getSession();
    }

    public function get_grapData($session) {

        $request = new FacebookRequest($this->get_canvasSession(), 'GET', '/me');
        $response = $request->execute();
        return $response->getGraphObject()->asArray();
    }

    public function get_loginUrl() {
        return $this->redirectLogin->getLoginUrl(Config::get('facebook::scope'));
    }

}
