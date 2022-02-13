<?php

class Conversion 
{
    public $unit_from;
    public $unit_to;
    
    function __construct($unit, $quantity) {
        $this->unit = $unit;
        $this->quantity = $quantity;
    }

    function convert() {
        switch ($this->unit) {
            case 'liter_barrel':
                
                break;
            
            default:
                # code...
                break;
        }
      return $this->name;
    }
  }