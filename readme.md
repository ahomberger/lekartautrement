## Le Kart Autrement

Site basé sur le framework Laravel 5.2 et AngularJS 1.5.8.

Packages utilisés:

* JWT-Auth - [tymondesigns/jwt-auth](https://github.com/tymondesigns/jwt-auth)
* Dingo API - [dingo/api](https://github.com/dingo/api)
* Laravel-CORS [barryvdh/laravel-cors](http://github.com/barryvdh/laravel-cors)

## Installation

###Créer le lien vers PHP 5.5
```bash
$ mkdir -p ~/.composer/vendor/bin
$ ln -s /usr/bin/php5.5-cli ~/.composer/vendor/bin/php
```
###Modifier le PATH
```bash
echo 'export PATH="$HOME/.composer/vendor/bin:$PATH"' >> ~/.profile
echo "alias php='/usr/bin/php5.5-cli'" >> ~/.profile
echo "alias composer='php ~/composer.phar'" >> ~/.profile
source ~/.profile
```

###Installer Composer
```bash
curl -sS https://getcomposer.org/installer | php
```

###Installer le projet
```bash
$ git clone https://github.com/ahomberger/lekartautrement laravel
$ cd laravel
$ cp .env.example .env
$ composer install
```

## Usage

Quelques articles qui peuvent aidé poru son utilisation :

* [How to Build an API-Only JWT-Powered Laravel App](https://www.sitepoint.com/how-to-build-an-api-only-jwt-powered-laravel-app/)
* [How to Consume Laravel API with AngularJS](https://www.sitepoint.com/how-to-consume-laravel-api-with-angularjs/)

## Main Features

### A Ready-To-Use AuthController

I've put an "AuthController" in _App\Api\V1\Controllers_. It supports the four basic authentication/password recovery operations:

* _login()_;
* _signup()_;
* _recovery()_;
* _reset()_;

In order to work with them, you just have to make a POST request with the required data.

You will need:

* _login_: just email and password;
* _signup_: whatever you like: you can specify it in the config file;
* _recovery_: just the user email address;
* _reset_: token, email, password and password confirmation;

### A Separate File for Routes

You can specify your routes in the `api_routes.php` file, that will be automatically loaded. In this file you will find many examples of routes.

### Secrets Generation

Every time you create a new project starting from this repository, the _php artisan jwt:generate_ command will be executed.

## Configuration

As I already told before, this boilerplate is based on _dingo/api_ and _tymondesigns/jwt-auth_ packages. So, you can find many informations about configuration <a href="https://github.com/tymondesigns/jwt-auth/wiki/Configuration" target="_blank">here</a> and <a href="https://github.com/dingo/api/wiki/Configuration">here</a>.

However, there are some extra options that I placed in a _config/boilerplate.php_ file.

* **signup_fields**: you can use this option to specify what fields you want to use to create your user;
* **signup_fields_rules**: you can use this option to specify the rules you want to use for the validator instance in the signup method;
* **signup_token_release**: if "true", an access token will be released from the signup endpoint if everything goes well. Otherwise, you will just get a _201 Created_ response;
* **reset_token_release**: if "true", an access token will be released from the signup endpoint if everything goes well. Otherwise, you will just get a _200_ response;
* **recovery_email_subject**: here you can specify the subject for your recovery data email;

## Creating Endpoints

You can create endpoints in the same way you could to with using the single _dingo/api_ package. You can <a href="https://github.com/dingo/api/wiki/Creating-API-Endpoints" target="_blank">read its documentation</a> for details.

After all, that's just a boilerplate! :)

## Cross Origin Resource Sharing

If you want to enable CORS for a specific route or routes group, you just have to use the _cors_ middleware on them.

Thanks to the _barryvdh/laravel-cors_ package, you can handle CORS easily. Just check <a href="https://github.com/barryvdh/laravel-cors" target="_blank">the docs at this page</a> for more info.

## Notes

I currently removed the _VerifyCsrfToken_ middleware from the _$middleware_ array in _app/Http/Kernel.php_ file. If you want to use it in your project, just use the route middleware _csrf_ you can find, in the same class, in the _$routeMiddleware_ array.

## Feedback

I currently made this project for personal purposes. I decided to share it here to help anyone with the same needs. If you have any feedback to improve it, feel free to make a suggestion, or open a PR!
