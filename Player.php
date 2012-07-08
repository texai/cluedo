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
class Player extends PlayerAbstract {

    
    /**
     *
     * @return Suggestion 
     */
    public function play() {
        $s = new Suggestion($this->_cluedo);
        foreach($this->_cluedo->getTypes() as $type){
            $typeCards = $this->_cluedo->getStartingDeckByType($type)->getCards();
            $s->addCard($typeCards[rand(0,count($typeCards)-1)]);
        }
        echo "   ".$this->name;
        echo $s;
        return $s;
    }

}