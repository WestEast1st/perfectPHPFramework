<?php
namespace Core;
/**
 * Class ClassLoader
 * @package Core
 */
class ClassLoader
{
    protected $dirs;

    public function  register ( ): void
    {
        spl_autoload( [ $this , 'localClass' ] );
    }

    /**
     * @param string $dir
     */

    public function registerDir (string $dir ): void
    {
        $this->dirs[] = $dir;
    }

    /**
     * @param string $class
     */
    public function loadClass (string $class ): void
    {
        foreach ($this->dirs as $dir) {
            $file = $dir . '/' . $class . '.php';
            if ( is_readable( $file ) ) {
                require_once $file ;
                return ;
            }
        }
    }

}