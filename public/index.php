<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';


$settings = include  '../src/settings.php';
$app = new \Slim\App($settings);

$app->get('/api/profile/facebook/{id}', function (Request $request, Response $response)  use ($app){

    $token = $request->getHeaders()['HTTP_TOKEN'][0]; 

    $fbSettings = $this->get('settings')['fbSettings'];

    $fb = new Facebook\Facebook([
            'app_id' => $fbSettings['app_id'],
            'app_secret' => $fbSettings['app_secret'],
            'default_graph_version' => $fbSettings['default_graph_version'],
            'http_client_handler' => $fbSettings['http_client_handler']
    ]);

    try {
      // Returns a `Facebook\FacebookResponse` object
      $fbResponse = $fb->get('/' . $request->getAttribute('id') . '?fields=link, name, birthday', $token);
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        return $response->withStatus(401)->withJson(['msg' => $e->getMessage()]);
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        return $response->withStatus(401)->withJson(['msg' => $e->getMessage()]);
      exit;
    }

    $user = $fbResponse->getGraphUser();
    return $response->withJson($user->asArray());

});

$app->run();