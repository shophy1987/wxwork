<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;

class SetAgentScopeRsp 
{
    public $invaliduser = null; // string array
    public $invalidparty = null; // uint array
    public $invalidtag = null; // uint array

    static public function ParseFromArray($arr)
    { 
        $info = new SetAgentScopeRsp();

        $info->invaliduser = Utils::arrayGet($arr, "invaliduser"); 
        $info->invalidparty = Utils::arrayGet($arr, "invalidparty"); 
        $info->invalidtag = Utils::arrayGet($arr, "invalidtag"); 

        return $info;
    } 
}
