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
    
    /**
     *
     * @var int
     */
    public $moves;
    
    /**
     *
     * @var int
     */
    protected $_currentPlayer;
    
    public function __construct() {
        $this->_config = new Zend_Config_Ini('config.ini');
        $this->_killer = new Suggestion($this);
        $this->_startingDecks = array();
        $this->_deal();
    }
    
    public function addPlayer(Player $p) {
        $p->setCluedo($this);
        $this->_players[] = $p;
    }
    
    protected function _loadDefaultPlayers(){
        foreach($this->_config->players->names as $playerName){
            $this->addPlayer(new Player($playerName));
        }
    }
    
    protected function _deal() {
        
        if(count($this->_players)==0){
            $this->_loadDefaultPlayers();
        }
        
        if(count($this->_players)<3){
            throw new Exception('Three players are required at least');
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
            $this->_startingDecks[$type] = clone $deck;
        }
        
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
        
        // let's play!
        $this->moves = 0;
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
    
    public function move() {
        echo ++$this->moves.': ';
        if(is_null($this->_currentPlayer)){
            $this->_currentPlayer = 0;
        }
        $s = $this->_players[$this->_currentPlayer]->play();
        $this->_currentPlayer = ($this->_currentPlayer+1)%count($this->_players);
        
        if($this->_config->settings->max_moves <= $this->moves ){
            return false;
        }
        
        return $s->isEqualsTo($this->_killer);
    }
    
//    public function 

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