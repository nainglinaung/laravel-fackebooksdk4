<?php

namespace Squall\Facebook;

session_start();

use Config;

class Facebook {

    protected $redirectLogin;

    public function __construct() {
        FacebookSession::setDefaultApplication(Config::get('facebook::appId'), Config::get('facebook::appSecret'));
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

    public function get_grapData($session,$query,$is_canvas) {
        if($is_canvas){
            $request = new FacebookRequest($this->get_canvasSession(), 'GET', $query);
            $response = $request->execute();
            return $response->getGraphObject(GraphUser::className())->asArray();
        }else{
            echo '<pre>';print_r($session);exit;
            // $request = new FacebookRequest($session, 'GET', $query);
            // $response = $request->execute();
            // print_r($response);exit;
            // return $response->getGraphObject(GraphUser::className())->asArray();
        }
    }
    
    public function get_loginUrl($scope,$redirect_uri) {
        $this->redirectLogin = new FacebookRedirectLoginHelper($redirect_uri);
        return $this->redirectLogin->getLoginUrl($scope);
    }

    public function get_loginSession($redirect_uri){
        $loginHelper = new FacebookRedirectLoginHelper($redirect_uri);
        $session = $loginHelper->getSessionFromRedirect();
        
        if($session){
            $token = $session->getToken();
            return $token;
        }

    }

}
