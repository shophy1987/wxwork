<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;

class CheckinInfo
{ 
    public $userid = null; // string
    public $group = null; // CheckinGroup

    static public function ParseFromArray($arr)
    { 
        $info = new CheckinInfo();

        $info->userid = Utils::arrayGet($arr, "userid"); 
        $info->group = CheckinGroup::ParseFromArray($arr["group"]);

        return $info;
    }
}
