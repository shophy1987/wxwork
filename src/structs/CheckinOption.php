<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;

class CheckinOption 
{
    public $info = null; // CheckinInfo array

    static public function ParseFromArray($arr)
    { 
        $info = new CheckinOption();

        foreach($arr["info"] as $item) { 
            $info->info[] = CheckinInfo::ParseFromArray($item);
        }

        return $info;
    }
}
