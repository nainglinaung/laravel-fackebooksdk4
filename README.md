# Installation

Update your `composer.json` file to include this package as a dependency
```json
"squall/facebook": "dev-master"
```

Register the Facebook service provider by adding it to the providers array in the `app/config/app.php` file.
```
Squall\Facebook\FacebookServiceProvider
```

# Configuration

Copy the config file into your project by running
```
php artisan config:publish squall/facebook
```

Edit the config file to include your app ID, secret key, scopes and redirect login url.

# Usage Default FB SDK Functions
If you want to use Original Facebook PHP SDK You can use following namespace Squall\Facebook\etc..
### Example

```php
use Squall\Facebook\FacebookSession;
use Squall\Facebook\FacebookRequest;
use Squall\Facebook\GraphUser;
use Squall\Facebook\FacebookRequestException;
```
So all the methods listed here http://developers.facebook.com/docs/reference/php/ are available, as well as the folowing.

# Usage Our Functions
```
    $fb = new Facebook();

    //get Page Id From Tab Application
    $fb->get_tabId();

    //Check User was liked Our Tab App
    $fb->isLiked();

    //get access token
    $fb->get_accessToken();

    //get page session
    $session = $fb->get_canvasSession();

    if (isset($session)) {
        $response = $fb->get_graphData($session,'/me/taggable_friends', true);
        $fb->post_links('http://www.example.com', 'post link to feed');
    } else {
        echo '<a href="' . $fb->get_loginUrl() . '" target="_top">Login</a>';
    }
```

### get_accessToken()

Get Facebook Session Token,

### get_tabId()

Get Facebook Tab Application ID.

### isLiked()

Check For Tab Application Like.

### get_pageSession() && get_canvasSession()

Get Tab App Session & Canvas App Session.

### get_graphData($session, $query, $is_Canvas)

Get Graph Data with various query. $is_Canvas value is boolean *.cwTRUE or *.cwFALSE

### get_loginSession($redirect_uri)

Get Session with Redirect Login outside Canvas

### post_links($link, $message)

Post Link and Message to User Feed.

# More details are coming soon.
