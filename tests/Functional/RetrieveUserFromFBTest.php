<?php

namespace Tests\Functional;

//use GuzzleHttp\Client;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;

class RetrieveUserFromFBTest extends BaseTestCase
{
    
    protected $client;

    public function setUp()
    {
        parent::setUp();
/*
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $this->settings['server']]);*/
    }
/*
    // Test a wrong URL should retrieve an 401 - Not Found error
    function testWrongURL()
    {
        $response = $this->client->request('GET', '/WrongURL', ['http_errors' => false]);

        $this->assertEquals(404, $response->getStatusCode());

    }


    // Test the request without send the token should retrieve an 404 - Unauthorized Error
    function testWithoutToken()
    {
        $response = $this->client->request('GET', '/api/profile/facebook/me', ['http_errors' => false]);

        $this->assertEquals(401, $response->getStatusCode());

    }
*/
    // Test the request without send the token should retrieve an 200 - OK
    function testWithToken()
    {
        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => 'GET',
                'REQUEST_URI' => 'http://0.0.0.0:8888/api/profile/facebook/1142471849',
                'HTTP_TOKEN' => 'EAADuZBjuAKKgBACWmedaHzMevZC5Obev0fSlL7KU8VQ88HcHZBxWVZAA31VNbJWZAsecAyNBQQqZAHwP9EtiT2FjmqUeBJyFz3IG5IEZCgLStkxhv6GLlU0EEHXv9FGHraEoR78dSwbR9eZCLhhWXWqJ9yLKYc2GKefVulVHZB6QiNQZDZD',
            ]
        );

        $request = Request::createFromEnvironment($environment);
        // Set up a response object
        $response = new Response();

        // Instantiate the application
        $app = new App($this->settings);

        // Set up dependencies
        require __DIR__ . '/../../src/dependencies.php';

        // Register middleware
        if ($this->withMiddleware) {
            require __DIR__ . '/../../src/middleware.php';
        }

        // Register routes
        require __DIR__ . '/../../src/routes.php';

        // Process the application
        $response = $app->process($request, $response);

        /*
        $response = $this->client->request('GET', '/api/profile/facebook/me', ['headers' => ['authorization' => ['EAADuZBjuAKKgBAEeZC6U4x9ZBWO7N6T5KGWe2w2QyGfUBI34BjaeDjvjwiZCFC0WOkn0ieYknWMnvw1ZA4znike4GKZAQOqeAuSmNkLBHop65GrbhP44EoRW7fgl7dFwHkrjDa1pImJLoozwfM6yjMljMmIbX9xszD3PApUweCZBgZDZD']], 'http_errors' => false]);*/

        $this->assertEquals(200, $response->getStatusCode());

    }
}