<?php

namespace AlgoliaTest\Lib;

class Response
{
    protected $content;
    protected $code;
    protected $headers;

    public function __construct($content, $code = 200, $headers = [])
    {
        $this->content = $content;
        $this->code    = $code;
        $this->headers = $headers;
    }

    public function send()
    {
        \http_response_code($this->code);
        foreach ($this->headers as $headerName => $headerValue) {
            header($headerName . ':' . $headerValue);
        }
        echo $this->content;
    }
}
