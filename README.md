Installation
Update your composer.json file to include this package as a dependency

"squall/facebook": "dev-master"

Register the Facebook service provider by adding it to the providers array in the app/config/app.php file.

Squall\Facebook\FacebookServiceProvider
Alias the Facebook facade by adding it to the aliases array in the app/config/app.php file.


Configuration
Copy the config file into your project by running

php artisan config:publish squall/facebook
Edit the config file to include your app ID and secret key.