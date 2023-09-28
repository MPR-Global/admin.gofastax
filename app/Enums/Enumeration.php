<?php
namespace App\Enums;
// PHP program to show use of enumerations
  
// Base enumeration class
abstract class Enumeration {
  
    public static function cases() 
    {
        $reflect = new \ReflectionClass( get_called_class() );
        return $reflect->getConstants();
    }
}