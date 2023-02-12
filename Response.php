<?php

namespace App;

require_once('Stream.php');

use Psr\Http\Message\ResponseInterface;

class Response extends Message implements ResponseInterface
{
    private $statusCode;
    private $reason;
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function withStatus($code, $reasonPhrase = '')
    {
        $this->statusCode = $code;
        $this->reason = $reasonPhrase;
    }

    public function getReasonPhrase()
    {
        return $this->reason;
    }
    public function setBody($body)
    {
        $this->stream->write($body);
        $this->withBody($this->stream);
    }
    public function getBody() : string
    {
        return $this->stream->read($this->stream->getSize());
    }
}