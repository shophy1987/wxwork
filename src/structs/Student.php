<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;

class Student
{
    public $userid = null; // string
    public $name = null; // srting
    public $department = null;  // uint array
    public $parents = null; // Relation array

    static public function Student2Array($student)
    {
		$args = array();

		Utils::setIfNotNull($student->userid, "student_userid", $args);
		Utils::setIfNotNull($student->name, "name", $args);
		Utils::setIfNotNull($student->department, "department", $args);

        return $args;
    }

    static public function Array2Student($arr)
	{
		$student = new Student();
        $student->userid = Utils::arrayGet($arr, "student_userid");
        $student->name = Utils::arrayGet($arr, "name");
        $student->department = Utils::arrayGet($arr, "department");

        if (array_key_exists("parents", $arr)) { 
            if (is_array($arr["parents"])) {
                foreach ($arr["parents"] as $item) {
                    $student->parents[] = Relation::Array2Relation($item);
                }
            }
        }

		return $student;
	}

	static public function Array2StudentList($arr)
	{
        $retStudentList = array();
        if (is_array($arr["students"])) {
            foreach ($arr["students"] as $item) {
                $retStudentList[] = Student::Array2Student($item);
            }
        }
        return $retStudentList;
	}

    static public function CheckStudentCreateArgs($student)
    { 
        Utils::checkNotEmptyStr($student->userid, "userid"); 
        Utils::checkNotEmptyStr($student->name, "name");
        Utils::checkNotEmptyArray($student->department, "department");
    }

    static public function CheckStudentBatchCreateArgs($students)
    {
        Utils::checkNotEmptyArray($students, "students");
        foreach ($students as $student) {
            self::CheckStudentCreateArgs($student);
        }
        if (count($students) > 100) {
            throw QyApiError("no more than 100 students once");
        }
    }

    static public function CheckStudentUpdateArgs($student)
    { 
		Utils::checkNotEmptyStr($student->userid, "userid");
    } 

    static public function CheckStudentBatchUpdateArgs($students)
    {
        Utils::checkNotEmptyArray($students, "students");
        foreach ($students as $student) {
            self::CheckStudentUpdateArgs($student);
        }
        if (count($students) > 100) {
            throw QyApiError("no more than 100 students once");
        }
    }

    static public function CheckStudentBatchDeleteArgs($userIdList)
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
