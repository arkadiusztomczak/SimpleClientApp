<?php

namespace App;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

class headers
{
    public string $header;
    public string $value;
    public function __construct(string $header, string $value) {
        $this->header = $header;
        $this->value = $value;
    }
}

class Message implements MessageInterface
{
    protected Stream $stream;
    private string $protocolVersion;
    private array $headers;
    public function __construct()
    {
        $this->stream = new Stream();
    }
    public function getProtocolVersion()
    {
        return $this->protocolVersion;
    }

    public function withProtocolVersion($version)
    {
        $this->protocolVersion = $version;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function hasHeader($name)
    {
        foreach ($this->headers as $h) {
            if ($h->header === $name) {
                return true;
            }
        }
        return false;
    }

    public function getHeader($name)
    {
        foreach ($this->headers as $h) {
            if ($h->header === $name) {
                return $h;
            }
        }
        return null;
    }

    public function getHeaderLine($name)
    {
        // TODO: Implement getHeaderLine() method.
    }

    public function withHeader($name, $value)
    {
        $header = new headers($name,$value);
        $this->headers[] =  $header;
    }

    public function withAddedHeader($name, $value)
    {
        // TODO: Implement withAddedHeader() method.
    }

    public function withoutHeader($name)
    {
        // TODO: Implement withoutHeader() method.
    }

    public function getBody()
    {
        // TODO: Implement getBody() method.
    }

    public function withBody(StreamInterface $body)
    {
        // TODO: Implement withBody() method.
    }
}