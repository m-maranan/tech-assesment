<?php

class Volume 
{
    public function litter_to_barrel($quantity) {   
        return (int) $quantity * 0.0083864143251288;
    }

    public function barrel_to_litter($quantity) {
        return $quantity / 0.0083864143251288;
    }

    public function litter_to_hogshead($quantity) {
        return (int) $quantity * 0.0041932072;
    }

    public function hogshead_to_litter($quantity) {
        return $quantity / 0.0041932072;
    }
}