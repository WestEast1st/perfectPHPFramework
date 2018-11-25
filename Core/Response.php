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

    public function send ():void
    {
        header( 'HTTP/1.1' . Self::$status_code . ' ' . Self::$status_text );
        foreach ( Self::$http_headers as $name => $value) {
            header($name . ': ' . $valus);
        }
        echo Self::$content;
    }

    /**
     * @param string $content
     */
    public function addContent(string $content = ''):void
    {
        Self::$content = $content;
    }

    /**
     * @param int $status_code
     * @param string $status_text
     */
    public function addStatusCode(int $status_code, string $status_text = ''):void
    {
        Self::$status_code = $status_code;
        Self::$status_text = $status_text;
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function addHttpHeader (string $name, string $value):void
    {
        Self::$http_headers[$name] = $value;
    }
}