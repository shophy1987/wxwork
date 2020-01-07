<?php

namespace wxwork\structs;

use wxwork\common\Utils;

class SchoolDepartment
{
    public $name = null; // string
    public $parentid = null; // uint
    public $id = null; // uint
    public $type = null; // uint
    public $standard_grade = null; // uint
    public $register_year = null; // uint
    public $order = null; // uint
    public $department_admins = null; // DepartmentAdmin array

    static public function Department2Array($department)
    {
		$args = array();

		Utils::setIfNotNull($department->$name, "$name", $args);
		Utils::setIfNotNull($department->$parentid, "$parentid", $args);
		Utils::setIfNotNull($department->$id, "$id", $args);
        Utils::setIfNotNull($department->$order, "$order", $args);
        Utils::setIfNotNull($department->$type, "$type", $args);
		Utils::setIfNotNull($department->$standard_grade, "$standard_grade", $args);
        Utils::setIfNotNull($department->$register_year, "$register_year", $args);
        
        if (is_array($department->department_admins)) {
            $department_admins = [];
            foreach ($department->department_admins as $_department_admins) {
                $department_admins[] = DepartmentAdmin::DepartmentAdmin2Array($_department_admins);
            }
            empty($department_admins) || Utils::setIfNotNull($department_admins, "department_admins", $args);
        }

        return $args;
    }

    static public function Array2Department($arr)
	{
		$department = new SchoolDepartment();
        
        $department->name = Utils::arrayGet($arr, "name");
        $department->parentid = Utils::arrayGet($arr, "parentid");
        $department->id = Utils::arrayGet($arr, "id");
        $department->type = Utils::arrayGet($arr, "type");
        $department->standard_grade = Utils::arrayGet($arr, "standard_grade");
        $department->register_year = Utils::arrayGet($arr, "register_year");
        $department->order = Utils::arrayGet($arr, "order");

        if (array_key_exists("department_admins", $arr)) { 
            if (is_array($arr["department_admins"])) {
                foreach ($arr["department_admins"] as $item) {
                    $parent->department_admins[] = new DepartmentAdmin($item["userid"], $item["type"]);
                }
            }
        }

		return $department;
	}

	static public function Array2DepartmentList($arr)
	{
        $retDepartmentList = array();
        if (is_array($arr["departments"])) {
            foreach ($arr["departments"] as $item) {
                $retDepartmentList[] = SchoolDepartment::Array2Department($item);
            }
        }
        return $retDepartmentList;
	}

    static public function CheckDepartmentCreateArgs($department)
    { 
        Utils::checkIsUInt($department->parentid, "parentid"); 
        Utils::checkIsUInt($department->type, "type");

    }

    static public function CheckDepartmentUpdateArgs($department)
    { 
		Utils::checkIsUInt($department->id, "id"); 
    }
}
