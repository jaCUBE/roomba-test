<?php


spl_autoload_register('roomba_autoloader');


/**
 * Autoloader for roomba test related classes.
 * @param string $classname Class name
 */

function roomba_autoloader(string $classname){
    @include 'app/models/'.$classname.'.class.php';
}