<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('version', ['uses' => 'MailController@version']);
$router->post('parse-codes', ['uses' => 'MailController@parseCodes']);
$router->post('parse-emails', ['uses' => 'MailController@parseEmails']);
$router->post('campaign-start', ['uses' => 'MailController@campaignStart']);
