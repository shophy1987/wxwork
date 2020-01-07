<?php

namespace wxwork\structs;

use wxwork\common\Utils;

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
