<?php

include_once('Zend/Loader/Autoloader.php');
Zend_Loader_Autoloader::getInstance();
spl_autoload_register(function ($c) {include_once $c.'.php';});



$cluedo = new Cluedo();
$cluedo->addPlayer(new Player('ernesto'));
$cluedo->addPlayer(new Player('sergio'));
$cluedo->addPlayer(new Player('antolin'));
$cluedo->addPlayer(new Player('franz'));

try {
    $cluedo->deal();
    echo $cluedo;
} catch (Exception $exc) {
    echo "ERROR: ".$exc->getMessage();
}






