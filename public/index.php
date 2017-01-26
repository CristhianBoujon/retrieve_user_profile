<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
//use Overflow012\Facebook\FacebookService as FacebookService;
require '../vendor/autoload.php';
require '../src/Overflow012/Facebook/FacebookService.php';

$settings = include  '../src/settings.php';
$app = new \Slim\App($settings);

$app->get('/api/profile/facebook/{id}', function (Request $request, Response $response)  use ($app){

    $token = $request->getHeaders()['HTTP_TOKEN'][0]; 

    $fbSettings = $this->get('settings')['fbSettings'];
    try {
        $facebookService = new FacebookService($fbSettings, $token);
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        return $response->withStatus(401)->withJson(['msg' => $e->getMessage()]);
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        return $response->withStatus(401)->withJson(['msg' => $e->getMessage()]);
      exit;
    }

    $user = $facebookService->getUser($request->getAttribute('id'));
    return $response->withJson($user);


    
});

$app->run();