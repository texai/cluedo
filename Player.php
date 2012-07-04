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
    protected $_deck;
    
    public function __construct($name) {
        $this->name = $name;
        $this->_deck = new Deck();
    }
    
    public function dealCard(Card $card){
        $this->_deck->addCard($card);
    }
    
    public function __toString() {
        $t =  "  Player Name: ". $this->name . PHP_EOL;
        $t .= "  Deck: ". PHP_EOL;
        $t .= $this->_deck;
        return $t;
    }
    
}

?>
