<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;
use shophy\wxwork\exception\QyApiException;

class ExternalMessageText
{
    public $msgtype = "text"; 
	private $content = null; // string

	public function __construct($content=null)
	{
		$this->content = $content;
	}

	public function CheckMessageSendArgs()
	{
		$len = strlen($this->content);
		if ($len == 0 || $len > 2048) {
            throw new QyApiException("invalid content length " . $len);
		}
	}

	public function MessageContent2Array(&$arr)
	{
		Utils::setIfNotNull($this->msgtype, "msgtype", $arr);

        $contentArr = array("content" => $this->content);
		Utils::setIfNotNull($contentArr, $this->msgtype, $arr);
	}
}
