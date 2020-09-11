<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;

class ContentItem { 
	public $key = null; // string 长度10个汉字以内
	public $value = null; // 长度30个汉字以内（支持id转译）

    public function __construct(
        $key=null, 
        $value=null)
	{
		$this->key = $key;
		$this->value = $value;
	}

    public function CheckMessageSendArgs()
    { 
        Utils::checkNotEmptyStr($this->key, "key");
        Utils::checkNotEmptyStr($this->value, "value");
    }

    public function ContentItem2Array() 
    {
        $args = array();
        Utils::setIfNotNull($this->key, "key", $args);
        Utils::setIfNotNull($this->value , "value", $args);

        return $args;
    }
}