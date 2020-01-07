<?php

namespace wxwork\structs;

use wxwork\common\Utils;

class CheckinDataList
{
    public $checkindata = null; // CheckinData array

    static public function ParseFromArray($arr)
    { 
        $info = new CheckinDataList();

        foreach($arr["checkindata"] as $item) { 
            $info->info[] = CheckinData::ParseFromArray($item);
        }

        return $info;
    }
}
