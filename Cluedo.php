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
     * @var Set
     */
    public static $suspects;
    
    /**
     *
     * @var Set
     */
    public static $weapons;
    
    /**
     *
     * @var Set
     */
    public static $rooms;
    
    
    /**
     *
     * @var Array
     */
    public $players;
    
    
    
    public function __construct() {
        
        self::$suspects = new Set('suspects');
        self::$rooms = new Set('rooms');
        self::$weapons = new Set('weapons');
        
        
        
    }
    
    public function addPlayer(Player $p) {
        $this->players[] = $p;
    }
    
    public function deal() {
        
        if(count($this->players)<3){
            throw new Exception('Se requiere al menos 3 jugadores');
        }
        
        
    }
    
    
}