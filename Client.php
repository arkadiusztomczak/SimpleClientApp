<?php
namespace App;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

require_once('vendor/autoload.php');
require_once('Uri.php');
require_once('Request.php');
require_once('Response.php');

class Client
{
    private string $authMethod;
    private RequestInterface $request;
    private Uri $uri;
    private string $jwtToken;
    public function __construct($authMethod, $login, $pass = "")
    {
        $this->authMethod = $authMethod;

        $this->request = new Request();
        $this->uri = new Uri();

        $this->uri->withUserInfo($login, $pass);
    }

    public function withUri(string $uri)
    {
        $this->uri->withPath($uri);
    }
    public function withJwtToken(string $token)
    {
        $this->jwtToken = $token;
    }
    public function getUri()
    {
        return $this->uri->getPath();
    }
    public function getJwtToken() {
        return $this->jwtToken;
    }

    public function send () : ResponseInterface
    {
        $response = new Response();
        try {
            $curl = curl_init();

            if($this->getUri() === '') throw new \Exception('Empty Uri');

            curl_setopt($curl, CURLOPT_URL, $this->getUri());
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

            if ($this->authMethod == "Basic") {
                // Auth: Basic
                curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                curl_setopt($curl, CURLOPT_USERPWD, $this->uri->getAuthority());
            } else if ($this->authMethod == "JWT") {
                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                    'Authorization: Bearer ' . $this->getJwtToken()
                ));
            }
            else throw new \Exception('Improper auth method');

            $result = curl_exec($curl);

            $response->setBody($result);
            $response->withStatus(200);

            curl_close($curl);
        }
        catch (\Exception $e)
        {
            $response->withStatus(400,$e);
        }
        return $response;
    }
}