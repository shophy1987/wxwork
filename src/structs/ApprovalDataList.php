<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;

class ApprovalDataList 
{
    public $count = null; // uint
    public $total = null; // uint
    public $next_spnum = null; // uint
    public $data = null; // ApprovalData array

    static public function ParseFromArray($arr)
    { 
        $info = new ApprovalDataList();

        $info->count = Utils::arrayGet($arr, "count"); 
        $info->total = Utils::arrayGet($arr, "total"); 
        $info->next_spnum = Utils::arrayGet($arr, "next_spnum"); 
        foreach($arr["data"] as $item) { 
            $info->data[] = ApprovalData::ParseFromArray($item);
        }

        return $info;
    }
}
