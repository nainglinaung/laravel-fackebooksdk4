<?php

namespace Squall\Facebook;

use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurl;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\Entities\AccessToken;
use Facebook\Entities\SignedRequest;
use Facebook\FacebookSession;
use Facebook\FacebookSignedRequestFromInputHelper;
use Facebook\FacebookCanvasLoginHelper;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookOtherException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;
use Facebook\FacebookPageTabHelper;
use Config;

class FB {

    public function __construct() {
        FacebookSession::setDefaultApplication(Config::get('facebook::appId'), Config::get('facebook::appSecret'));
    }

    public function get_tabId() {
        $helper = new FacebookPageTabHelper();
        return $helper->getPageId();
    }

}
