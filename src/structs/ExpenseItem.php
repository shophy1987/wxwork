<?php

namespace wxwork\structs;

use wxwork\common\Utils;

class ExpenseItem { 
    public $expenseitem_type = null; // int 
    public $time = null; // int 
    public $sums = null; // int 
    public $reason = null; // string 

    static public function ParseFromArray($arr)
    { 
        $info = new ExpenseItem();

        $info->expenseitem_type = Utils::arrayGet($arr, "expenseitem_type"); 
        $info->time = Utils::arrayGet($arr, "time"); 
        $info->sums = Utils::arrayGet($arr, "sums"); 
        $info->reason = Utils::arrayGet($arr, "reason"); 

        return $info;
    }
}
