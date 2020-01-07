<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;

class LoginCorpInfo
{ 
    public $corpid = null; // string

    static public function ParseFromArray($arr)
    { 
        $info = new LoginCorpInfo();

        $info->corpid = Utils::arrayGet($arr, "corpid");
        return $info;
    } 
}
