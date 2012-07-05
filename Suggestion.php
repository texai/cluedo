<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Suggestion
 *
 * @author texai
 */
class Suggestion extends Deck {
    
    /**
     *
     * @var Cluedo
     */
    protected $_cluedo;
    
    public function __construct(Cluedo $cluedo) {
        parent::__construct();
        $this->_cluedo = $cluedo;
    }
    
    public function isValid(){
        $cluedoTypes = $this->_cluedo->getTypes();
        $suggesionTypes = array();
        foreach ($this->_cards as $card){
            $suggesionTypes[] = $card->type;
        }
        return (count(array_diff($cluedoTypes, $suggesionTypes)) + count(array_diff($suggesionTypes, $cluedoTypes)))==0;
    }

    public function __toString() {
        $t = "    ";
        foreach ($this->_cards as $card) {
            $t .= $card->type .':'. $card->id . ' | ';
        }
        return $t.PHP_EOL;
    }    
    
}