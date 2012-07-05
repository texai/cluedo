<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlayerAbstract
 *
 * @author texai
 */
abstract class PlayerAbstract {
    
    
    public $name;
    
    /**
     *
     * @var Deck
     */
    protected $_deck;
    
    /**
     *
     * @var Cluedo
     */
    protected $_cluedo;
    
    public function __construct($name) {
        $this->name = $name;
        $this->_deck = new Deck();
    }
    
    public function setCluedo(Cluedo $cluedo){
        $this->_cluedo = $cluedo;
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
    
    public abstract function play();
    
}