<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;

class Parents
{
    public $userid = null; // string
    public $mobile = null; // srting
    public $to_invite = null;  // uint array
    public $children = null; // Children array

    static public function Parents2Array($parent)
    {
		$args = array();

		Utils::setIfNotNull($parent->userid, "parent_userid", $args);
		Utils::setIfNotNull($parent->mobile, "mobile", $args);
        Utils::setIfNotNull($parent->to_invite, "to_invite", $args);

        if (is_array($parent->children)) {
            $children = [];
            foreach ($parent->children as $_children) {
                $children[] = Children::Children2Array($_children);
            }
            empty($children) || Utils::setIfNotNull($children, "children", $args);
        }

        return $args;
    }

    static public function Array2Parents($arr)
	{
		$parent = new Parents();
        $parent->userid = Utils::arrayGet($arr, "parent_userid");
        $parent->mobile = Utils::arrayGet($arr, "mobile");
        $parent->to_invite = Utils::arrayGet($arr, "to_invite");

        if (array_key_exists("children", $arr)) { 
            if (is_array($arr["children"])) {
                foreach ($arr["children"] as $item) {
                    $parent->children[] = new Children($item["student_userid"], $item["relation"]);
                }
            }
        }

		return $parent;
	}

	static public function Array2ParentsList($arr)
	{
        $retParentList = array();
        if (is_array($arr["parents"])) {
            foreach ($arr["parents"] as $item) {
                $retParentList[] = Parents::Array2Parents($item);
            }
        }
        return $retParentList;
	}

    static public function CheckParentsCreateArgs($parent)
    { 
        Utils::checkNotEmptyStr($parent->userid, "userid"); 
        Utils::checkNotEmptyStr($parent->mobile, "mobile");
        Utils::checkNotEmptyArray($parent->children, "children");
        if (count($parent->children) > 10) {
            throw QyApiError("no more than 10 children once");
        }
    }

    static public function CheckParentsBatchCreateArgs($parents)
    {
        Utils::checkNotEmptyArray($parents, "parents");
        foreach ($parents as $parent) {
            self::CheckParentsCreateArgs($parent);
        }
        if (count($parents) > 100) {
            throw QyApiError("no more than 100 parents once");
        }
    }

    static public function CheckParentsUpdateArgs($parent)
    { 
		Utils::checkNotEmptyStr($parent->userid, "userid");
    } 

    static public function CheckStudentBatchUpdateArgs($parents)
    {
        Utils::checkNotEmptyArray($parents, "parents");
        foreach ($parents as $parent) {
            self::CheckParentsUpdateArgs($parent);
        }
        if (count($parents) > 100) {
            throw QyApiError("no more than 100 parents once");
        }
    }

    static public function CheckParentsBatchDeleteArgs($userIdList)
    {
		Utils::checkNotEmptyArray($userIdList, "userid list");
		foreach ($userIdList as $userId) {
			Utils::checkNotEmptyStr($userId, "userid");
		}
        if (count($userIdList) > 100) {
            throw QyApiError("no more than 100 userid once");
        }
    }
}
