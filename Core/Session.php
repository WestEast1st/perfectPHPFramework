<?php
namespace Core;


/**
 * Class Session
 * @package Core
 */
class Session
{
    /**
     * @var bool
     */
    protected static $sessionStarted        = False;
    /**
     * @var bool
     */
    protected static $sessionIdRegenerated  = False;

    /**
     * Session constructor.
     */
    public function __construct():void
    {
        if (!self::$sessionStarted){
            session_start();
            self::$sessionStarted = true;
        }
    }

    /**
     * @param $name
     * @param $value
     */
    public function set ($name, $value):void
    {
        $_SESSION[$name] = $value;
    }

    /**
     * @param $name
     * @param null $default
     * @return null|string
     */
    public function fetch ($name, $default = null):?string
    {
        if (isset($_SESSION[$name])) {
            return$_SESSION[$name];
        }
        return $default;
    }

    /**
     * @param $name
     */
    public function remove ($name):void
    {
        unset($_SESSION[$name]);
    }

    /**
     *
     */
    public function clear ():void
    {
        $_SESSION = [];
    }

    /**
     * @param bool $destroy
     */
    public function regenerate (bool $destroy = true):void
    {
        if(!self::$sessionIdRegenerated){
            session_register_id($destroy);
            self::$sessionIdRegenerated = true;
        }
    }

    /**
     * @param bool $bool
     */
    public function setAuthenticated (bool $bool):void
    {
        $this->set('_authenticated',$bool);
        $this->regenerate();
    }

    /**
     * @return null|string
     */
    public function isAuthenticated ()
    {
        return $this->fetch('_authenticated', false);
    }
}