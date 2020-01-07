<?php

namespace wxwork\structs;

use wxwork\common\Utils;

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
