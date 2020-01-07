<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;

class PartyInfo 
{ 
    public $id = null; // uint 
    public $writable = null; // bool 

    static public function ParseFromArray($arr)
    { 
        $info = new PartyInfo();

        $info->id= Utils::arrayGet($arr, "id"); 
        $info->writable = Utils::arrayGet($arr, "writable"); 

        return $info;
    } 
}
