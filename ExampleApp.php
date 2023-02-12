<?php

namespace App;
require('Client.php');

//Aplikacja sprawdzająca płeć
$name = 'Peter';

$client = new Client('Basic','user','pass');
$client->withUri('https://api.genderize.io?name='.$name);

$response = $client->send();

if($response->getStatusCode() == 200)
{
    $body = json_decode($response->getBody());
    echo $name . " jest " . ($body->gender == "male" ? "mężczyzną" : "kobietą");
}
else echo $response->getReasonPhrase();