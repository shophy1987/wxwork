<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;

class CodeSession
{
	public $corpid = null;  // string 
	public $userid = null;  // string
	public $session_key = null;  // string

	static public function Array2CodeSession($arr)
	{
        $session = new CodeSession();
        $session->corpid = Utils::arrayGet($arr, "corpid");
        $session->userid = Utils::arrayGet($arr, "userid");
        $session->session_key = Utils::arrayGet($arr, "session_key");
        
		return $session;
	}
}
