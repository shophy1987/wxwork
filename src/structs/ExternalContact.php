<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;

class ExternalContact
{
	public $external_userid = null;  // string 
	public $name = null;  // string
	public $position = null;  // string
	public $avatar = null;  // string
	public $corp_name = null;  // string
	public $corp_full_name = null;  // string
	public $type = null;  // uint
	public $gender = null;  // uint [bug]
	public $unionid = null;  // string

	static public function Array2ExternalContact($arr)
	{
        $externalContact = new ExternalContact();
        if (isset($arr['external_contact'])) {
            $externalContact->external_userid = Utils::arrayGet($arr['external_contact'], "external_userid");
            $externalContact->name = Utils::arrayGet($arr['external_contact'], "name");
            $externalContact->position = Utils::arrayGet($arr['external_contact'], "position");
            $externalContact->avatar = Utils::arrayGet($arr['external_contact'], "avatar");
            $externalContact->corp_name = Utils::arrayGet($arr['external_contact'], "corp_name");
            $externalContact->corp_full_name = Utils::arrayGet($arr['external_contact'], "corp_full_name");
            $externalContact->type = Utils::arrayGet($arr['external_contact'], "type");
            $externalContact->gender = Utils::arrayGet($arr['external_contact'], "gender");
            $externalContact->unionid = Utils::arrayGet($arr['external_contact'], "unionid");
        }
        
		return $externalContact;
	}
}
