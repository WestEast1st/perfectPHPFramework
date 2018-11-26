<?php
namespace Core;
/**
 * Class Request
 * @package Core
 */
class Request
{

    /**
     * @return bool
     */
    public function verifyMethodPost ( ):bool
    {
        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
            return True;
        }
        return False;
    }

    /**
     * @param string $name
     * @param null $default
     * @return null
     */
    public function fetchGetParam (string $name, $default = Null)
    {
        if (isset($_GET[$name])) {
            return $_GET[$name];
        }
        return $default;
    }

    /**
     * @param string $name
     * @param null $default
     * @return null
     */
    public function fetchPostParam (string $name, $default = Null)
    {
        if (isset($_POST[$name])) {
            return $_POST[$name];
        }
        return $default;
    }

    /**
     * @return string
     */
    public function fetchHost (): string
    {
        if (!empty($_SERVER['HTTP_HOST']))
        {
            return $_SERVER['HTTP_HOST'];
        }
        return $_SERVER['SERVER_NAME'];
    }

    /**
     * @return bool
     */
    public function verifySsl ():bool
    {
        if ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) {
            return True;
        }
        return False;
    }


    /**
     * @return null|string
     */
    public function fetchRequestUri (): ?string
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * @return null|string
     */
    public function fetchBaseUri (): ?string
    {
        $script_name = $_SERVER['SCRIPT_NAME'];
        $request_uri = Self::fetchRequestUri();

        if ( 0 === strpos($request_uri, $script_name)){
            return $script_name;
        } else {
            return rtrim(dirname($script_name),'/');
        }
        return '';
    }


    /**
     * @return null|string
     */
    public function fetchPathInfo (): ?string
    {
        $base_uri       = Self::fetchBaseUri();
        $request_uri    = Self::fetchRequestUri();

        if ( false !== ($pos = stpos($request_uri, '?') ) ) {
            $request_uri = substr($request_uri, 0, $pos);
        }

        return (string)substr($request_uri, strlen($base_uri));

    }
}