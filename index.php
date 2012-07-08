<?php

include_once('Zend/Loader/Autoloader.php');
Zend_Loader_Autoloader::getInstance();
spl_autoload_register(function ($c) {include_once $c.'.php';});

try {
    $cluedo = new Cluedo();
    while($cluedo->move());
    echo PHP_EOL.'total moves: '.$cluedo->moves;
    echo PHP_EOL.'Killer: '.$cluedo->getKiller();
    
} catch (Exception $exc) {
    echo "ERROR: ".$exc->getMessage();
}






