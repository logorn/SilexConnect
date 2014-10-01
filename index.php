<?php

require __DIR__.'/vendor/autoload.php';

use MarcW\Silex\Provider\BuzzServiceProvider;
use SensioLabs\Connect\Api\Api;
use SensioLabs\Connect\Silex\ConnectServiceProvider;
use Silex\Application;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;

$app = new Application(array(
    'debug' => true,
));

$app->register(new UrlGeneratorServiceProvider());
$app->register(new SessionServiceProvider());
$app->register(new BuzzServiceProvider());

$app->register(new ConnectServiceProvider(), array(
    'sensiolabs_connect.app_id'     => 'YOUR_APP_ID',
    'sensiolabs_connect.app_secret' => 'YOUR_APP_SECRET',
    'sensiolabs_connect.app_scope'  => 'SCOPE_MASTER',
));

$app->register(new SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'default' => array(
            'pattern' => '^',
            // 'anonymous' => true,
            'sensiolabs_connect' => true,
            'logout' => true,
        ),
    ),
));

$app->get('/', function() {
    return 'hello';
});

$app->run();
