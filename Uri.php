<?php

namespace App;

use Psr\Http\Message\UriInterface;

class Uri implements UriInterface
{
    private string $user;
    private string $pass;
    private string $path;
    public function __construct()
    {
        $this->user = "";
        $this->pass = "";
        $this->path = "";
    }

    public function getScheme()
    {
        // TODO: Implement getScheme() method.
    }

    public function getAuthority() : string
    {
        return $this->user . '[:' . $this->pass . ']';
    }

    public function getUserInfo()
    {
        // TODO: Implement getUserInfo() method.
    }

    public function getHost()
    {
        // TODO: Implement getHost() method.
    }

    public function getPort()
    {
        // TODO: Implement getPort() method.
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getQuery()
    {
        // TODO: Implement getQuery() method.
    }

    public function getFragment()
    {
        // TODO: Implement getFragment() method.
    }

    public function withScheme($scheme)
    {
        // TODO: Implement withScheme() method.
    }

    public function withUserInfo($user, $password = null)
    {
        $this->user = $user;
        $this->pass = $password;
    }

    public function withHost($host)
    {
        // TODO: Implement withHost() method.
    }

    public function withPort($port)
    {
        // TODO: Implement withPort() method.
    }

    public function withPath($path)
    {
        $this->path = $path;
    }

    public function withQuery($query)
    {
        // TODO: Implement withQuery() method.
    }

    public function withFragment($fragment)
    {
        // TODO: Implement withFragment() method.
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
    }
}