<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;
use shophy\wxwork\exception\QyApiException;

class MiniprogramMessageContent
{
    public $msgtype = "miniprogram_notice";
    public $appid = null; // string 小程序appid，必须是与当前小程序应用关联的小程序
    public $page = null; // string 点击消息卡片后的小程序页面，仅限本小程序内的页面。该字段不填则消息点击后不跳转。
    public $title = null; // string 消息标题，长度限制4-12个汉字（支持id转译）
    public $description = null; // string 消息描述，长度限制4-12个汉字（支持id转译）
    public $emphasis_first_item = null; // bool 是否放大第一个content_item
    public $content_item = null; // ContentItem array

	public function __construct($appid, $title, $content_item, $page=null, $description=null, $emphasis_first_item=true)
	{
        $this->appid = $appid;
        $this->page = $page;
        $this->title = $title;
        $this->description = $description;
        $this->emphasis_first_item = $emphasis_first_item;
		$this->content_item = $content_item;
	}

	public function CheckMessageSendArgs()
	{
        Utils::checkNotEmptyStr($this->appid, "appid");
        Utils::checkNotEmptyStr($this->title, "title");

        $size = count($this->content_item);
        if ($size < 1 || $size > 10) throw QyApiException("1~10 content_item should be given");

        foreach($this->content_item as $item) { 
            $item->CheckMessageSendArgs();
        }
	}

	public function MessageContent2Array(&$arr)
	{
        Utils::setIfNotNull($this->msgtype, "msgtype", $arr);
        
        $contentArr = array();
        Utils::setIfNotNull($this->appid, "appid", $contentArr);
        Utils::setIfNotNull($this->page, "page", $contentArr);
        Utils::setIfNotNull($this->title, "title", $contentArr);
        Utils::setIfNotNull($this->description, "description", $contentArr);
        Utils::setIfNotNull($this->emphasis_first_item, "emphasis_first_item", $contentArr);

        $contentItems = array();
        foreach($this->content_item as $item) {
            $contentItems[] = $item->ContentItem2Array();
        }
        Utils::setIfNotNull($contentItems, "content_item", $contentArr);

        Utils::setIfNotNull($contentArr, $this->msgtype, $arr);
	}
}
