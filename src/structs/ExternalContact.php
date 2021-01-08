<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;

class ExternalContact
{
	public $external_userid = null;  // string 
	public $foreign_key = null; // string
	public $name = null;  // string
	public $avatar = null;  // string
	public $type = null;  // uint
	public $gender = null;  // uint [bug]
	public $unionid = null;  // string
	public $position = null;  // string
	public $is_subscribe = null; // uint
	public $corp_name = null;  // string
	public $corp_full_name = null;  // string
	
	static public function Array2ExternalContact($arr)
	{
		$externalContact = new ExternalContact();
		if (isset($arr['external_contact'])) {
			$externalContact->external_userid = Utils::arrayGet($arr['external_contact'], "external_userid");
			$externalContact->foreign_key = Utils::arrayGet($arr['external_contact'], "foreign_key");
			$externalContact->name = Utils::arrayGet($arr['external_contact'], "name");
			$externalContact->avatar = Utils::arrayGet($arr['external_contact'], "avatar");
			$externalContact->type = Utils::arrayGet($arr['external_contact'], "type");
			$externalContact->gender = Utils::arrayGet($arr['external_contact'], "gender");
			$externalContact->unionid = Utils::arrayGet($arr['external_contact'], "unionid");
			$externalContact->position = Utils::arrayGet($arr['external_contact'], "position");
			$externalContact->is_subscribe = Utils::arrayGet($arr['external_contact'], "is_subscribe");
			$externalContact->corp_name = Utils::arrayGet($arr['external_contact'], "corp_name");
			$externalContact->corp_full_name = Utils::arrayGet($arr['external_contact'], "corp_full_name");
		}

		return $externalContact;
	}
}
