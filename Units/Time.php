<?php

class Time 
{
    public function hour_to_shake($quantity) {   
        return (int) $quantity * 360000000000;
    }

    public function shake_to_hour($quantity) {
        return $quantity / 360000000000;
    }
}