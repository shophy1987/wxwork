<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;

class DepartmentAdmin
{
    public $userid = null; // string
    public $type = null; // uint
    public $subject = null; // string

    public function __construct($userid = null, $type = null)
	{
		$this->userid = $userid;
		$this->type = $type;
    }
    
    static public function DepartmentAdmin2Array($department_admins)
    {
		$args = array();
		
        Utils::setIfNotNull($department_admins->type, "type", $args);
        Utils::setIfNotNull($department_admins->userid, "userid", $args);
        Utils::setIfNotNull($department_admins->subject, "subject", $args);

        return $args;
    }
}
