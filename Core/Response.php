<?php
namespace Core;


/**
 * Class Response
 * @package Core
 */
class Response
{
    /**
     * @var string
     */
    protected $content      = '';
    /**
     * @var int
     */
    protected $status_code  = 200;
    /**
     * @var string
     */
    protected $status_text  = 'OK';
    /**
     * @var array
     */
    protected $http_headers = [];

    /**
     *
     */
    public function send ():void
    {
        header( 'HTTP/1.1' . $this->status_code . ' ' . $this->status_text );
        foreach ( $this->http_headers as $name => $value) {
            header($name . ': ' . $valus);
        }
        echo $this->content;
    }

    /**
     * @param string $content
     */
    public function addContent(string $content = ''):void
    {
        $this->content = $content;
    }

    /**
     * @param int $status_code
     * @param string $status_text
     */
    public function addStatusCode(int $status_code, string $status_text = ''):void
    {
        $this->status_code = $status_code;
        $this->status_text = $status_text;
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function addHttpHeader (string $name, string $value):void
    {
        $this->http_headers[$name] = $value;
    }
}