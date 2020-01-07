<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;

class GetAdminListRsp
{ 
    public $admin = null; // AppAdmin array

    static public function ParseFromArray($arr)
    { 
        $info = new GetAdminListRsp();

        foreach($arr["admin"] as $item) {
            $info->admin[] = AppAdmin::ParseFromArray($item);
        }

        return $info;
    }
}
