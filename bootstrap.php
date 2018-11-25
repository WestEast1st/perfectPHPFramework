<?php

require_once 'core/ClassLoader.php';
/*
 * Class Auto Loader
 */
$loader = new ClassLoader();

$loader->registerDir( dirname(__FILE__).'/core' ):
$loader->registerDir( dirname(__FILE__).'/models' ):
$loader->register();