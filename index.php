<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, grant_type, client_secret, client_id');

require 'vendor/autoload.php';

use Slim\Middleware\HttpBasicAuthentication\PdoAuthenticator;
use Chadicus\Books\FileRepository;
use Chadicus\Slim\OAuth2\Routes;
use Chadicus\Slim\OAuth2\Middleware;
use Slim\Http;
use Slim\Views;
use OAuth2\Storage;
use OAuth2\GrantType;

// Var initialisation
$dsn = 'mysql:host=localhost;dbname=polydea_api;charset=utf8';
$usr = 'root';
$pwd = 'root';

$pdo = new \Slim\PDO\Database($dsn, $usr, $pwd);
$storage = new Storage\Pdo($pdo);

$config = [
'settings' => [
'displayErrorDetails' => true,
'determineRouteBeforeAppMiddleware' => true,
],
];

$server = new OAuth2\Server(
    $storage,
    [
    'access_lifetime' => 3600,
    ],
    [
    new GrantType\ClientCredentials($storage),
    new GrantType\AuthorizationCode($storage),
    ]
    );

$app = new \Slim\App($config);

$container = $app->getContainer();

$renderer = new Views\PhpRenderer(__DIR__ . '/vendor/chadicus/slim-oauth2-routes/templates');


$app->map(['GET', 'POST'], Routes\Authorize::ROUTE, new Routes\Authorize($server, $renderer))->setName('authorize');
$app->post(Routes\Token::ROUTE, new Routes\Token($server))->setName('token');
$app->map(['GET', 'POST'], Routes\ReceiveCode::ROUTE, new Routes\ReceiveCode($renderer))->setName('receive-code');

$authorization = new Middleware\Authorization($server, $app->getContainer());

// $user = "thomas";
// $hash = password_hash("password", PASSWORD_DEFAULT);

// $status = $pdo->exec(
//     "INSERT INTO users (username, password) VALUES ('{$user}', '{$hash}')"
// );

// routing : Automatically load router files
$routers = glob('routers/*.router.php');
foreach ($routers as $router) {
    require $router;
}

$app->run();
