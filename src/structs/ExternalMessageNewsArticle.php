<?php

namespace shophy\wxwork\structs;

use shophy\wxwork\common\Utils;

class ExternalMessageNewsArticle { 
    public $title = null; // string
    public $description = null; // string
    public $url = null; // string
    public $picurl = null; // string

    public function __construct($title=null, $description=null, $url=null, $picurl=null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->picurl = $picurl;
    }

    public function CheckMessageSendArgs()
    { 
        Utils::checkNotEmptyStr($this->title, "title");
        Utils::checkNotEmptyStr($this->url, "url");
    }

    public function Article2Array() 
    {
        $args = array();

        Utils::setIfNotNull($this->title, "title", $args); 
        Utils::setIfNotNull($this->description, "description", $args); 
        Utils::setIfNotNull($this->url, "url", $args); 
        Utils::setIfNotNull($this->picurl, "picurl", $args); 

        return $args;
    }
}
