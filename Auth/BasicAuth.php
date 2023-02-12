<?php

namespace App\Auth;

use App\Response;

class BasicAuth implements AuthInterface
{
    private $user;
    private $secret;
    public function __construct()
    {
        $this->user = 'user';
        $this->secret = 'pass';
    }

    public function authorize(array $credentials): Response
    {
        $response = new Response();

        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            $response->withStatus(401,"Unauthorized");
            $response->withBody('<p>Access denied. You did not enter a password.</p>');
            exit;
        }

        if ($_SERVER['PHP_AUTH_USER'] == $this->user && $_SERVER['PHP_AUTH_PW'] == $this->secret) {
            $response->withStatus(200,"OK");
            $response->withBody('<p>Access granted. You know the password!</p>');
        } else {
            $response->withStatus(401,"Unauthorized");
            $response->withBody('<p>Access denied! You do not know the password.</p>');
        }

        return $response;
    }
}