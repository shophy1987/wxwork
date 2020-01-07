<?php

namespace shophy\wxwork;

use shophy\wxwork\common\Utils;
use shophy\wxwork\common\HttpUtils;

use shophy\wxwork\structs\GetLoginInfoRsp;
use shophy\wxwork\structs\GetRegisterCodeReq;
use shophy\wxwork\structs\GetRegisterInfoRsp;
use shophy\wxwork\structs\SetAgentScopeReq;
use shophy\wxwork\structs\SetAgentScopeRsp;

class ServiceProviderAPI extends API
{
    protected $corpid = null; // string
    protected $provider_secret = null; // string
    protected $provider_access_token = null; // string

    /**
     * 调用SetAgentScope/SetContactSyncSuccess 两个接口可以不用传corpid/provider_secret
     */
    public function __construct($corpid=null, $provider_secret=null)
    {
        $this->corpid = $corpid;
        $this->provider_secret = $provider_secret;
    }

    protected function GetProviderAccessToken()
    { 
        if ( ! Utils::notEmptyStr($this->provider_access_token)) { 
            $this->RefreshProviderAccessToken();
        } 
        return $this->provider_access_token;
    }
    protected function RefreshProviderAccessToken($bflush=false)
    {
        Utils::checkNotEmptyStr($this->corpid, "corpid");
        Utils::checkNotEmptyStr($this->provider_secret, "provider_secret");

        // 尝试从缓存读取,这里是服务商接口的accesstoken,忽略缓存前缀
        $this->provider_access_token = $bflush ? '' : ''/*\Yii::$app->cache->get($this->corpid)*/;
        if( ! Utils::notEmptyStr($this->provider_access_token)) {
            $args = array(
                "corpid" => $this->corpid, 
                "provider_secret" => $this->provider_secret
            ); 
            $url = HttpUtils::MakeUrl("/cgi-bin/service/get_provider_token");
            $this->_HttpPostParseToJson($url, $args, false);
            $this->_CheckErrCode();
    
            // 写入缓存
            $this->provider_access_token = $this->rspJson["provider_access_token"];
            //\Yii::$app->cache->set($this->corpid, $this->provider_access_token, $this->rspJson['expires_in']);
        }
    }

    // ------------------------- 单点登录 -------------------------------------
    //

    /**
     * @brief GetLoginInfo : 获取登录用户信息
     *
     * @link https://work.weixin.qq.com/api/doc#10991/获取登录用户信息
     *
     * @param $auth_code : string
     *
     * @return : GetLoginInfoRsp
     */
    public function GetLoginInfo($auth_code)
    { 
        Utils::checkNotEmptyStr($auth_code, "auth_code");
        $args = array("auth_code" => $auth_code); 
        self::_HttpCall(self::GET_LOGIN_INFO, 'POST', $args);
        return GetLoginInfoRsp::ParseFromArray($this->rspJson);
    }

    // ------------------------- 注册定制化 -----------------------------------
    //
    /**
     * @brief GetRegisterCode : 获取注册码
     *
     * @link https://work.weixin.qq.com/api/doc#11729/获取注册码
     *
     * @param $GetRegisterCodeReq
     *
     * @return : string register_code
     */
    public function GetRegisterCode(GetRegisterCodeReq $GetRegisterCodeReq)
    { 
        $args = $GetRegisterCodeReq->FormatArgs();
        self::_HttpCall(self::GET_REGISTER_CODE, 'POST', $args);
        return $this->rspJson["register_code"];
    }

    /**
     * @brief GetRegisterInfo : 查询注册状态
     *
     * @link https://work.weixin.qq.com/api/doc#11729/查询注册状态
     *
     * @param $register_code : string
     *
     * @return : GetRegisterInfoRsp
     */
    public function GetRegisterInfo($register_code)
    { 
        Utils::checkNotEmptyStr($register_code, "register_code");
        $args = array("register_code" => $register_code); 
        self::_HttpCall(self::GET_REGISTER_INFO, 'POST', $args);
        return GetRegisterInfoRsp::ParseFromArray($this->rspJson);
    }

    /**
     * @brief SetAgentScope : 设置授权应用可见范围
     *
     * @link https://work.weixin.qq.com/api/doc#11729/设置授权应用可见范围
     *
     * @param $access_token : 该接口只能使用注册完成回调事件或者查询注册状态返回的access_token
     * @param $SetAgentScopeReq : SetAgentScopeReq
     *
     * @return : SetAgentScopeRsp
     */
    public function SetAgentScope($access_token, SetAgentScopeReq $SetAgentScopeReq)
    { 
        $args = $SetAgentScopeReq->FormatArgs();
        self::_HttpCall(self::SET_AGENT_SCOPE."?access_token={$access_token}", 'POST', $args);
        return SetAgentScopeRsp::ParseFromArray($this->rspJson);
    }

    /**
     * @brief SetContactSyncSuccess : 设置通讯录同步完成
     *
     * @link https://work.weixin.qq.com/api/doc#11729/设置通讯录同步完成
     *
     * @param $access_token : 该接口只能使用注册完成回调事件或者查询注册状态返回的access_token
     */
    public function SetContactSyncSuccess($access_token)
    { 
        self::_HttpCall(self::SET_CONTACT_SYNC_SUCCESS."?access_token={$access_token}", 'GET', null); 
    }
}
