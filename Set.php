<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Set
 *
 * @author texai
 */
class Set {
    
    public $name;
    public $items;
    
    public function __construct($name) {
        $this->name = $name;
        foreach (new Zend_Config_Ini('config.ini',$name) as $key => $value) {
            $this->addItem($key, $value);
        }
        
    }
    
    public function addItems($items) {
        foreach($items as $key => $value){
            $this->addItem($key, $value);
        }
    }
    
    public function addItem($key, $value) {
        $this->items[$key] = $value;
    }
    
    
}