<?php
/**
 * Created by PhpStorm.
 * User: niuwei
 * Date: 15/5/14
 * Time: 18:00
 */
//include "../class/inc.php";

define("TOKEN", "zhaoyx");
define("AppId", "wx07f088fba46d7d85");
define("AppSecret", "2876158daaea17228786cd5039c2eee7");
define("Welcome", "(^o^)/嘿…你终于来啦, 今后你就是我的人了! \n我们是互联网时代的搬家神器。\n专为年轻人，专注小型搬家。\n简单、便宜、安心。欢迎来电骚扰：\n400-880-7870。^_^");

$weChat = new WeChatIndex();
//$weChat->valid();
$weChat->responseMsg();

$weChatButton = new WeChatButton();
$weChatButton->createAppMenu();


class WeChatIndex {

    /**
     * 接收用户消息,并处理
     */
    public function responseMsg() {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            switch ($postObj->MsgType) {
                case "text":
                    echo $this->handlerText($postObj);
                    break;
                case "event":
                    echo $this->handlerEvent($postObj);
                    break;
            }
        } else {
            exit;
        }
    }

    /**
     * 处理消息回复
     * @param $postObj
     * @return mixed
     */
    private function handlerText($postObj) {
        //$resultStr = $this->responseText($postObj, "我知道了,你说的是: ".$postObj->Content);
        $resultStr = $this->responseText($postObj, "您的消息已收到，我们将及时为您回复。\n如需联系客服，请拨：400-880-7870。\n感谢关注搬哪儿！🌹");
        return $resultStr;
    }

    /**
     * 处理消息订阅、取消订阅
     * @param $postObj
     * @return mixed
     */
    private function handlerEvent($postObj) {
        $contentStr = "";
        switch ($postObj->Event)
        {
            case "subscribe"://首次关注的时候
                $contentStr = Welcome;
                $openId = $postObj->FromUserName;
                //$contentStr = $contentStr." openId = {$openId}";
                $otherController = new OtherController();
                if ($otherController->firstConcern($openId)) {
                    $contentStr = $contentStr."\n谢谢您的首次关注";
                }
                break;
            case "CLICK":
                if ($postObj->EventKey == "A1") {
                    $contentStr = "亲，您有任何问题，请给我们来电：\n400-880-7870:)";
                }
                break;
            default:
                $contentStr = "UnKnow Event: ".$postObj->Event;
                break;
        }
        $resultStr = $this->responseText($postObj, $contentStr);
        return $resultStr;
    }

    /**
     * 封装消息
     * @param $object
     * @param $content
     * @param int $flag
     * @return string
     */
    private function responseText($object, $content, $flag=0) {
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>%d</FuncFlag>
                    </xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content, $flag);
        return $resultStr;
    }

    /**
     * 认证
     * @throws Exception
     */
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }

    /**
     * 认证
     */
    public function checkSignature() {
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }

        $signature = $_GET['signature'];
        $timestamp = $_GET['timestamp'];
        $nonce = $_GET["nonce"];
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}

/**
 * Class WeChatButton
 * 自定义菜单的创建
 */
class WeChatButton {
    public $appId = "wx07f088fba46d7d85";
    public $appSecret = "2876158daaea17228786cd5039c2eee7";

    /**
     * 获得凭证接口
     * 返回数组，access_token 和  time 有效期
     * @return mixed
     */
    public function access_token() {
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appId}&secret={$this->appSecret}";
        $cont = file_get_contents($url);
        return json_decode($cont, 1);
    }


    /**
     * 创建自定义菜单
     */
    function createAppMenu() {
        $data = ' {
            "button":[
                {
                    "type": "view",
                    "name": "我要搬家",
                    "url" : "http://123.57.218.251/view/weChat/makeOrderTemp.php?response_type=code&scope=snsapi_base&state=1#wechat_redirect"
                },
                {
                    "type": "view",
                    "name": "我的订单",
                    "url" : "http://123.57.218.251/view/weChat/myOrderTemp.php?response_type=code&scope=snsapi_base&state=1#wechat_redirect"
                },
                {
                    "name": "搬家助手",
                    "sub_button": [
                        {
                            "type": "view",
                            "name": "优惠劵",
                            "url" : "http://123.57.218.251/view/weChat/myCouponsTemp.php?response_type=code&scope=snsapi_base&state=1#wechat_redirect"
                        },
                        {
                            "type": "click",
                            "name": "联系客服",
                            "key": "A1"
                        },
                        {
                            "type": "view",
                            "name": "收费标准",
                            "url": "http://123.57.218.251/view/weChat/price.html"
                        }
                    ]
                }
            ]
        } ';
        $access_token = $this -> access_token();
        $ch = curl_init('https://api.weixin.qq.com/cgi-bin/menu/create?access_token=' . $access_token['access_token']);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data)));
        $data = curl_exec($ch);
        print_r($data);
    }
}


