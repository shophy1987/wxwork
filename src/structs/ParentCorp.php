<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;

class ParentCorp
{
    public $corpid = null; // string
    public $parent_userid = null; // srting

    static public function ParentCorp2Array($parentCorp)
    {
		$args = array();

		Utils::setIfNotNull($parentCorp->corpid, "corpid", $args);
		Utils::setIfNotNull($parentCorp->parent_userid, "parent_userid", $args);

        return $args;
    }

    static public function Array2ParentCorp($arr)
	{
		$parent = new ParentCorp();
        $parent->corpid = Utils::arrayGet($arr, "corpid");
        $parent->parent_userid = Utils::arrayGet($arr, "parent_userid");

		return $parent;
	}

	static public function Array2ParentCorpList($arr)
	{
        $retParentList = array();
        if (is_array($arr["parents"])) {
            foreach ($arr["parents"] as $item) {
                $retParentList[] = ParentCorp::Array2ParentCorp($item);
            }
        }
        return $retParentList;
	}
}
