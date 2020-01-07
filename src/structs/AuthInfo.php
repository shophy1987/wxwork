<?php

namespace wxwork\structs;

use wxwork\common\Utils;

class AuthInfo 
{ 
    public $agent = null; // AgentBriefEx array

    static public function ParseFromArray($arr)
    { 
        $info = new AuthInfo();

        foreach($arr["agent"] as $item) { 
            $info->agent[] = AgentBriefEx::ParseFromArray($item);
        }

        return $info;
    }
}
