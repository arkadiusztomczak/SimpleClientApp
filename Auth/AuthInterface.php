<?php

namespace App\Auth;

use App\Response;

interface AuthInterface
{
    public function authorize(array $credentials) : Response;
}