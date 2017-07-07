<?php

namespace lib;

class Core
{
    private static $instance;

    private function __construct()
    {}

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }
    
    // others global functions
}
