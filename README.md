#Installation

#Add
"squall/facebook": "dev-master"

Update your composer.json file to include this package as a dependency


##Register the Facebook service provider by adding it to the providers array in the app/config/app.php file.

Alias the Facebook facade by adding it to the aliases array in the app/config/app.php file.


##Configuration
Copy the config file into your project by running

php artisan config:publish squall/facebook
Edit the config file to include your app ID and secret key.

Now open up app/config/app.php and add the service provider to your providers array.

'providers' => array(
    'Squall\Facebook\FacebookServiceProvider'
)