<?php

class User
{

    public $name;
    public $user;
    
    private $file  = "data.json";
    
    public function set($name)
    {
        $this->name = $name;
    }

    public function getById($id)
    {
        $data = $this->all();
        if($data){
            $key = array_search($id, array_column($data, 'id'));
            return $data[$key];    
        }
        return;
    }

    public function save()
    {   
        // Get All Users
        $data = $this->all();
        
        $this->user = [
            'id' => uniqid(), 
            'name' => $this->name, 
            'history' => []
        ];
        
        if($data){
            array_push($data, $this->user);
        }else{

            $data = [$this->user];            
        }

        file_put_contents($this->file, json_encode($data));
        
        return $this->user;
    }

    public function all(){
        if(file_exists($this->file)){
            return json_decode(file_get_contents($this->file), true);
        }
    }
}
