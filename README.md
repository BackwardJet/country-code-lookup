# country-code-lookup
Outputs the country code of any given phone number (In E.164 format).

[Click here](http://ec2-54-67-86-85.us-west-1.compute.amazonaws.com/lookup) to see a live version.

Built using:
* HTML5
* Bootstrap CSS
* JQuery
* [MessageBird API](https://developers.messagebird.com/)
* PHP
* [Guzzle](http://docs.guzzlephp.org/en/stable/)
* Apache

Installation/Usage:
* Install [Composer](https://getcomposer.org/) for PHP
* Install guzzle in Composer with the following command `composer require guzzlehttp/guzzle`
* In api/api.php, api/create.php and lookup.php, update `$COMPOSER_VENDOR_DIR` with the location of your vendor directory
