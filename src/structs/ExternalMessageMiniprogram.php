<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;
use shophy\wxwork\exception\QyApiException;

class ExternalMessageMiniprogram
{
    public $msgtype = "miniprogram";
    public $appid = null; // string 小程序appid，必须是与当前小程序应用关联的小程序
    public $pagepath = null; // string 点击消息卡片后进入的小程序页面路径
    public $title = null; // string 小程序消息标题，最多64个字节，超过会自动截断（支持id转译）
    public $thumb_media_id = null; // string 小程序消息封面的mediaid，封面图建议尺寸为520*416

	public function __construct($appid, $title, $pagepath=null, $thumb_media_id=null)
	{
        $this->appid = $appid;
        $this->title = $title;
        $this->pagepath = $pagepath;
        $this->thumb_media_id = $thumb_media_id;
	}

	public function CheckMessageSendArgs()
	{
        Utils::checkNotEmptyStr($this->appid, "appid");
        Utils::checkNotEmptyStr($this->pagepath, "pagepath");
	}

	public function MessageContent2Array(&$arr)
	{
        Utils::setIfNotNull($this->msgtype, "msgtype", $arr);
        
        $contentArr = array();
        Utils::setIfNotNull($this->appid, "appid", $contentArr);
        Utils::setIfNotNull($this->title, "title", $contentArr);
        Utils::setIfNotNull($this->pagepath, "pagepath", $contentArr);
        Utils::setIfNotNull($this->thumb_media_id, "thumb_media_id", $contentArr);

        Utils::setIfNotNull($contentArr, $this->msgtype, $arr);
	}
}
