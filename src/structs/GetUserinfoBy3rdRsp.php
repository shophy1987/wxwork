<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;

class GetUserinfoBy3rdRsp
{ 
    public $CorpId = null; // string
    public $UserId = null; // string
    public $DeviceId = null; // string
    public $user_ticket = null; // string
    public $expires_in = null; // uint 
    public $OpenId = null; // string
    public $open_userid = null; // string
    public $external_userid = null; // string
    public $parents = null; // array

    static public function ParseFromArray($arr)
    { 
        $info = new GetUserinfoBy3rdRsp();

        $info->CorpId = Utils::arrayGet($arr, "CorpId"); 
        $info->UserId = Utils::arrayGet($arr, "UserId"); 
        $info->DeviceId = Utils::arrayGet($arr, "DeviceId"); 
        $info->user_ticket = Utils::arrayGet($arr, "user_ticket"); 
        $info->expires_in = Utils::arrayGet($arr, "expires_in"); 
        $info->OpenId = Utils::arrayGet($arr, "OpenId"); 
        $info->open_userid = Utils::arrayGet($arr, "open_userid");
        $info->external_userid = Utils::arrayGet($arr, "external_userid"); 

        if (array_key_exists("parents", $arr)) { 
            $info->parents = ParentCorp::Array2ParentCorpList($arr);
        }

        return $info;
    }
}
