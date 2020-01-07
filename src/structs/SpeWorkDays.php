<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;

class SpeWorkDays { 
    public $timestamp = null; // uint 
    public $notes = null; // string
    public $checkintime = null; // CheckinTime array 

    public static function ParseFromArray($arr)
    {
        $info = new SpeWorkDays();

        $info->timestamp = Utils::arrayGet($arr, "timestamp");
        $info->notes = Utils::arrayGet($arr, "notes");

        foreach($arr["checkintime"] as $item) { 
            $info->checkintime[] = CheckinTime::ParseFromArray($item);
        }

        return $info;
    }
}
