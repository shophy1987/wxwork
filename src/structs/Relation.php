<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;

class Relation
{
    public $userid = null; // string
    public $mobile = null; // string
    public $relation = null; // string
    public $is_subscribe = null; // uint
    public $external_userid = null; // string

    static public function Array2Relation($arr)
    {
        $relation = new Relation();
        $relation->userid = Utils::arrayGet($arr, "parent_userid");
        $relation->mobile = Utils::arrayGet($arr, "mobile");
        $relation->relation = Utils::arrayGet($arr, "relation");
        $relation->is_subscribe = Utils::arrayGet($arr, "is_subscribe");
        $relation->external_userid = Utils::arrayGet($arr, "external_userid");

        return $relation;
    }
}
