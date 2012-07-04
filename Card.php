<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Card
 *
 * @author texai
 */
class Card {
    
    public $type;
    public $id;
    public $name;
    
    public function __construct($type, $id, $name) {
        $this->type = $type;
        $this->id = $id;
        $this->name= $name;
    }
    
    public function isEqualsTo(Card $card){
        return $this->type == $card->type && $this->id == $card->id;
    }
    
    public function __toString() {
        return sprintf("    (%s)[%s]%s", $this->type, $this->id, $this->name).PHP_EOL;
    }
    
    
}