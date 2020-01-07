<?php

namespace wxwork\structs;

use wxwork\common\Utils;

class Children
{
    public $userid = null; // string
    public $relation = null; // string

    public function __construct($userid = null, $relation = null)
	{
		$this->userid = $userid;
		$this->relation = $relation;
    }
    
    static public function Children2Array($children)
    {
		$args = array();

		Utils::setIfNotNull($children->userid, "student_userid", $args);
		Utils::setIfNotNull($children->relation, "relation", $args);

        return $args;
    }
}
