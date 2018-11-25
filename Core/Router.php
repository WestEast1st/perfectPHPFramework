<?php

namespace Core;


/**
 * Class Router
 * @package Core
 */
class Router
{
    /**
     * @var
     */
    protected $routes;

    /**
     * Router constructor.
     * @param $definitions
     */
    public function __construct ($definitions): void
    {
        Self::$routes = Self::compileRoutes($definitions);
    }

    /**
     * @param $definitions
     * @return array
     */
    public function compileRoutes ($definitions)
    {
        $routes = [];
        foreach ( $definitions as $url => $params ) {
            $tokens = explode('/', ltrim($uri, '/'));
            foreach ($tokens as $i => $token) {
                if (0 === strpos($token, ':')) {
                    $name   = substr($token,1);
                    $token  = '(?P<' . $name . '>[^/]+)';
                }
                $tokens[$i] = $token;
            }

            $pattern = '/' . implode('/',$tokens) ;
            $routes[$pattern] = $params;
        }
        return $routes;
    }

    /**
     * @param $path_info
     * @return array|bool
     */
    public function resolve ($path_info)
    {
        if ('/' !== substr($path_info, 0, 1)){
            $path_info = '/'. $path_info;
        }
        foreach (Self::$routes as $pattern => $params) {
            if (preg_match('#^'.$pattern.'$#', $path_info, $matches)) {
                $params = array_merge($params, $matches);
                return $params;
            }
        }
        return False ;
    }
}