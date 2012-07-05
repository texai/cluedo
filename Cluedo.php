<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cluedo
 *
 * @author texai
 */
class Cluedo {
    
    /**
     *
     * @var Zend_Config_Ini
     */
    protected $_config;
    
    /**
     *
     * @var Suggestion
     */
    protected $_killer;
    
    /**
     *
     * @var Deck
     */
    protected $_poolDeck;
    
    /**
     *
     * @var Array
     */
    public $_startingDecks;
    
    
    /**
     *
     * @var Array
     */
    protected $_players;
    
    
    
    public function __construct() {
        $this->_config = new Zend_Config_Ini('config.ini');
        $this->_killer = new Suggestion($this);
    }
    
    public function addPlayer(Player $p) {
        $p->setCluedo($this);
        $this->_players[] = $p;
    }
    
    public function deal() {
        if(count($this->_players)<3){
            throw new Exception('Se requiere al menos 3 jugadores');
        }
        
        // ordering each deck by type
        $types = $this->_config->cluedo->types;
        $startingDecks = array();
        $totalNCards = 0;
        foreach ($types as $type) {
            $deck = new Deck();
            foreach($this->_config->$type as $id => $name){
                $deck->addCard(new Card($type, $id, $name));
                $totalNCards++;
            }
            $startingDecks[$type] = $deck;
        }
        $this->_startingDecks = $startingDecks;
        
        // choosing killer
        foreach ($types as $type) {
            $this->_killer->addCard($startingDecks[$type]->pick());
        }
        
        // joining all type decks
        $remainingDeck= new Deck();
        foreach ($types as $type) {
            foreach($startingDecks[$type]->getCards() as $card){
                $remainingDeck->addCard($card);
            }
        }
        
        // dealing cards to playes
        $nplayers = count($this->_players);
        while($remainingDeck->count() >= $nplayers){
            foreach ($this->_players as $player) {
                $player->dealCard($remainingDeck->pick());
            }
        }
        
        // choosing poolDeck
        $this->_poolDeck = $remainingDeck;
        
    }
    
    public function getPlayers(){
        return $this->_players;
    }
    
    public function getTypes(){
        return $this->_config->cluedo->types->toArray();
    }
    
    public function getKiller(){
        return $this->_killer;
    }
    
    /**
     * 
     * @return Deck
     */
    public function getStartingDeckByType($type){
        return $this->_startingDecks[$type];
    }
    
    public function __toString() {
        $t = "Players: ".PHP_EOL;
        foreach($this->_players as $player){
            $t .= $player;
        }
        $t .= "Killer: ".PHP_EOL;
        $t .= $this->_killer;
        $t .= "PoolDeck: ".PHP_EOL;
        $t .= $this->_poolDeck;
        return $t.PHP_EOL;
    }
    
    
}