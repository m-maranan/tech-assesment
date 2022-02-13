<?php
include('Units/Volume.php');
include('Units/Time.php');

class Converter
{
    public $unit;
    public $quantity;
    public $users;
    
    private $file  = "data.json";
    
    public function __construct($unit, $quantity) {
        $this->unit = $unit;
        $this->quantity = $quantity;

        $this->volume = new Volume();
        $this->time = new Time();
        $this->users = new User();
    }

    public function convert() {
        switch ($this->unit) {
            case 'litter_barrel':
                return $this->volume->litter_to_barrel($this->quantity);                
                break;
            case 'barel_litter':
                return $this->volume->barrel_to_litter($this->quantity);                
                break;
            case 'litter_hogshead':
                return $this->volume->litter_to_hogshead($this->quantity);                
                break;
            case 'hogshead_litter':
                return $this->volume->hogshead_to_litter($this->quantity);                
                break;
            case 'hour_shake':
                return $this->time->hour_to_shake($this->quantity);                
                break;
            case 'shake_hour':
                return $this->time->shake_to_hour($this->quantity);                
                break;
            // case 'liter_barnmegaparsec':
            //     return $this->volume->liter_to_barnmegaparsec($this->quantity);                
            //     break;
            // case 'barnmegaparsec_liter':
            //     return $this->volume->barnmegaparsec_to_liter($this->quantity);                
            //     break;    
            default:
                return true;
                break;
        }
    }

    public function saveToHistory($id, $history) {   
        $data = $this->users->all();
        
        $key = array_search($id, array_column($data, 'id'));
        
        array_unshift($data[$key]['history'], $history);
        
        file_put_contents($this->file, json_encode($data));
    }
  }