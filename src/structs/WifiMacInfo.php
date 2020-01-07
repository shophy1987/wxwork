<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;

class WifiMacInfo { 
    public $wifiname = null; // string
    public $wifimac = null; // string

    public static function ParseFromArray($arr)
    {
        $info = new WifiMacInfo();

        $info->wifiname = Utils::arrayGet($arr, "wifiname");
        $info->wifimac = Utils::arrayGet($arr, "wifimac");

        return $info;
    }
}
