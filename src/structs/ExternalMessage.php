<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;
use shophy\wxwork\exception\QyApiException;

class ExternalMessage 
{ 
    public $toall = null; // bool, 是否全员发送, 即文档所谓 @all
    public $to_external_user = null; // string array
    public $to_parent_userid = null; // string array
    public $to_student_userid = null; // string array
    public $to_party = null; // uint array
    public $to_tag = null; // uint array 
    public $agentid = null; // uint
    public $enable_id_trans = null; // uint 表示是否开启id转译，0表示否，1表示是，默认0
    public $messageContent = null; // xxxMessageContent

	public function CheckMessageSendArgs()
    { 
        is_array($this->to_external_user) || $this->to_external_user = [];
        is_array($this->to_parent_userid) || $this->to_parent_userid = [];
        is_array($this->to_student_userid) || $this->to_student_userid = [];
        is_array($this->to_party) || $this->to_party = [];
        is_array($this->to_tag) || $this->to_tag = [];
        if (count($this->to_external_user) > 1000) throw new QyApiException("to_external_user should be no more than 1000");
        if (count($this->to_parent_userid) > 1000) throw new QyApiException("to_parent_userid should be no more than 1000");
        if (count($this->to_student_userid) > 1000) throw new QyApiException("to_student_userid should be no more than 1000");
        if (count($this->to_party) > 100) throw new QyApiException("to_party should be no more than 100");
        if (count($this->to_tag) > 100) throw new QyApiException("to_tag should be no more than 100");

        if (is_null($this->messageContent)) throw new QyApiException("messageContent is empty");
        $this->messageContent->CheckMessageSendArgs();
    }

	public function Message2Array()
    { 
        $args = array();

        if (is_null($this->toall)) {
            Utils::setIfNotNull($this->to_tag, "to_tag", $args);
            Utils::setIfNotNull($this->to_party, "to_party", $args);
            Utils::setIfNotNull($this->to_external_user, "to_external_user", $args);
            Utils::setIfNotNull($this->to_parent_userid, "to_parent_userid", $args);
            Utils::setIfNotNull($this->to_student_userid, "to_student_userid", $args);
        } else { 
            Utils::setIfNotNull($this->toall, "toall", $args);
        }

        Utils::setIfNotNull($this->agentid, "agentid", $args);
        Utils::setIfNotNull($this->enable_id_trans, "enable_id_trans", $args);

        $this->messageContent->MessageContent2Array($args);

        return $args;
    }
}
