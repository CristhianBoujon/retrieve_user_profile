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

        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $this->settings['server']]);
    }

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

    // Test the request with token. If token is valid should retrieve 200 - OK
    function testWithToken()
    {
        // To get a valid User Token for testing purposes you can visit https://developers.facebook.com/tools/accesstoken/
        $token = '';

        $response = $this->client->request('GET', '/api/profile/facebook/me', 
            ['headers' => 
                ['token' => [$token]
            ], 

            'http_errors' => false]
        );

        $this->assertEquals(200, $response->getStatusCode());

    }
}