<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;
use shophy\wxwork\exception\QyApiException;

class MpNewsMessageContent
{
    public $msgtype = "mpnews"; 
    public $articles = null; // MpNewsArticle array

	public function __construct($articles)
	{
		$this->articles = $articles;
	}

	public function CheckMessageSendArgs()
	{
        $size = count($this->articles);
        if ($size < 1 || $size > 8) throw QyApiException("1~8 articles should be given");

        foreach($this->articles as $item) { 
            $item->CheckMessageSendArgs();
        }
	}

	public function MessageContent2Array(&$arr)
	{
		Utils::setIfNotNull($this->msgtype, "msgtype", $arr);

        $articleList = array();
        foreach($this->articles as $item) {
            $articleList[] = $item->Article2Array();
        }
        $arr[$this->msgtype]["articles"] = $articleList;
	}
}
