<?php

namespace Squall\Facebook;

session_start();

use Config;

/**
 * Class Facebook
 * @package Squall
 * @author Kyaw Min Lwin
 * @author Nyi Nyi Phyo
 */

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

    public function isAdmin() {
        $pageHelper = new FacebookPageTabHelper();
        return $pageHelper->isAdmin();
    }

    /**
     * To decide thos User is Fan of current page or not
     * 
     * @param String $session : Facebook login access token
     * @param String $page_id : Current Page ID
     * @return object array if user is fan of current page.
     */

    public function isFan($session,$page_id){

        $page_session   = new FacebookSession($session);
        $request        = new FacebookRequest( $page_session, 'GET', '/me/likes/' . $page_id );
        $response       = $request->execute();
        
        return $response->getGraphObject(GraphUser::className())->asArray();

    }

    /**
     * To decide thos User is Admin of current page or not
     * 
     * @param String $session : Facebook login access token
     * @param String $page_id : Current Page ID
     * @return object array if user is admin of current page.
     */

    public function getAdmin($session,$page_id){

        $page_session   = new FacebookSession($session);
        //$request        = new FacebookRequest( $page_session, 'GET', '/'.$page_id .'/admins/me' );
        $request        = new FacebookRequest( $page_session, 'GET', '/me/accounts?fields=id,name,perms' );
        $response       = $request->execute();
        return $response->getGraphObject(GraphUser::className())->asArray();

    }

    public function get_pageSession() {
        $pageHelper = new FacebookPageTabHelper();
        return $pageHelper->getSession();
    }

    public function get_canvasSession() {
        $pageHelper = new FacebookCanvasLoginHelper();
        return $pageHelper->getSession();
    }

    /**
     * To access graph data of canvas page or none canvas page
     * 
     * @param String $session   : Facebook login access token
     * @param String $query     : Graph data query
     * @param Boolean $is_canvas: Canvas page or none canvas page
     * @return Graph data object array
     */

    public function get_graphData($session,$query,$is_canvas) {
        
        if ($is_canvas) {

            $request = new FacebookRequest($this->get_canvasSession(), 'GET', $query);
            $response = $request->execute();

            return $response->getGraphObject(GraphUser::className())->asArray();

        } else {

            try{

                $this->login_session = new FacebookSession($session);
                $request    = new FacebookRequest($this->login_session, 'GET', $query);
                $response   = $request->execute();

                return $response->getGraphObject(GraphUser::className())->asArray();

            } catch (FacebookRequestException $ex) {

                $ex->getMessage();

            } catch (\Exception $ex) {

                echo $ex->getMessage();

            }

        }

    }

    /**
     * Get Facebook Login URL
     * 
     * @param Array $scope         : Permission array of login application 
     * @param String $redirect_uri : Redirect URL for login 
     * @return Redirect to Login Permission Dialog
     */

    public function get_loginUrl($scope,$redirect_uri) {

        $this->redirectLogin = new FacebookRedirectLoginHelper($redirect_uri);
        return $this->redirectLogin->getLoginUrl($scope);

    }

    /**
     * Get Facebook Login Session
     * 
     * @param String $redirect_uri : Redirect URL for login 
     * @return Facebook Login Session
     */

    public function get_loginSession($redirect_uri){

        $loginHelper    = new FacebookRedirectLoginHelper($redirect_uri);
        $session        = $loginHelper->getSessionFromRedirect();
        if($session)
        return $session->getToken();

    }

    /**
     * Get Facebook Login Session
     * 
     * @param String $link      : Link to post
     * @param String $message   : Message Description to post status on user wall 
     * @return 
     */

    public function post_links($link, $message) {

        try {

            $response = (new FacebookRequest(

                    $this->get_canvasSession(), 'POST', '/me/feed', array(
                                                            'link' => $link,
                                                            'message' => $message
                                            )))->execute()->getGraphObject();

            return $response->getProperty('id');

        } catch (FacebookRequestException $e) {

            echo "Exception occured, code: " . $e->getCode();
            echo " with message: " . $e->getMessage();

        }

    }    

}
