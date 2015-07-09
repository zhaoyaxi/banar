<?php
/**
 * Created by PhpStorm.
 * User: niuwei
 * Date: 15/5/16
 * Time: 21:29
 * 发送手机消息
 */

class PhoneMessage {

    private $cust_code = '351201';//账号
    private $password = 'bne351201';//密码
    private $url='http://112.5.125.188:8860/';//URL地址

    /**
     * 发送消息给单个用户
     * @param $phone 电话号码
     * @param $content 内容
     * @return 处理结果
     */
    public function sendAMessage($phone, $content) {
        $post_data = array();
        $post_data['cust_code'] = $this->cust_code;
        $post_data['destMobiles'] = $phone;
        $post_data['content'] =  mb_convert_encoding($content, 'utf-8', 'gb2312');
        $post_data['sign'] = md5(urlencode(mb_convert_encoding($content, 'utf-8', 'gb2312').$this->password));								//签名

        $o="";
        foreach ($post_data as $k=>$v)
        {
            $o.= "$k=".urlencode($v)."&";
        }
        $post_data=substr($o,0,-1);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL,$this->url);
        //为了支持cookie
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        return curl_exec($ch);
    }

    /**
     * 发送多个消息
     * @param $phones
     * @param $content
     * @return 如果处理结果正确返回true 否则返回false
     */
    public function sendAllMessage($phones, $content) {
        if (!is_array($phones)) {
            return false;
        }

        foreach ($phones as $value) {
            $this->sendAMessage($value, $content);
        }
        return true;
    }
}