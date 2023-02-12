<?php

namespace App\Auth;

use App\Response;
use Firebase\JWT\JWT;

class JwtAuth implements AuthInterface
{
    private $login;
    private $secret;
    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->secret = $password;
    }

    public function authorize(array $credentials): Response
    {
        $valudUser = true; // asssuming that user data is correct

        $secretKey  = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c';
        $issuedAt   = new DateTimeImmutable();
        $expire     = $issuedAt->modify('+10 minutes')->getTimestamp();
        $serverName = "mypage.com";
        $username   = "username";                                           // Retrieved from filtered POST data

        $data = [
            'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
            'iss'  => $serverName,                       // Issuer
            'nbf'  => $issuedAt->getTimestamp(),         // Not before
            'exp'  => $expire,                           // Expire
            'userName' => $username,                     // User name
        ];

        return JWT::encode($data,$secretKey,'HS512');
    }
}