<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Deck
 *
 * @author texai
 */
class Deck {
    
    protected $_cards;
    
    public function __construct() {
        $this->_cards = array();
    }
    
    public function addCard(Card $card) {
        $this->_cards[] = $card;
    }
    
    public function getCards(){
        return $this->_cards;
    }


    public function pick(){
        $r = rand(0,$this->count()-1);
        $card = $this->_cards[$r];
        unset($this->_cards[$r]);
        $this->_cards = array_values($this->_cards);
        return $card;
    }
    
    public function count(){
        return count($this->_cards);
    }
    
    public function isEqualsTo(Deck $deck){
        if($this->count()!=$deck->count()) {
            return false;
        }
        $isEquals = true;
        foreach($this->_cards as $card){
            if(!$deck->hasCard($card)){
                $isEquals == false;
            }
        }
        return $isEquals;
    }
    
    public function hasCard(Card $card){
        $has = false;
        foreach($this->_cards as $deckCard){
            if($card->isEqualsTo($deckCard)){
                $has = true;
            }
        }
        return $has;
    }
    
    public function __toString() {
        $t = "";
        foreach ($this->_cards as $card) {
            $t .= $card;
        }
        return $t.PHP_EOL;
    }
    
    
}