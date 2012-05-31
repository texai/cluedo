<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Player
 *
 * @author texai
 */
class Player {
    
    
    public $name;
    
    public function __construct($name) {
        $this->name = $name;
    }
    
    public function __toString() {
        $t = "Player Name: ". $this->name . PHP_EOL;
        return $t;
    }
    
}

?>
