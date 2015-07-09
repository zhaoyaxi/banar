<?php
/**
 * Created by PhpStorm.
 * User: niuwei
 * Date: 15/5/11
 * Time: 18:36
 */

include "../class/inc.php";

class OtherModel extends BaseModel {

    public function getUserIdByOpenId($openId) {
        $sql = "select id from lb_user where weichat_id = '{$openId}'";
        $user_id = $this->excuteSQL($sql);
        $user_id = $user_id[0]['id'];
        return $user_id;
    }

    /**
     * 处理首次关注事件
     * @param $openId OpenId
     * @return true or false
     */
    public function firstConcern($openId) {
        $sql = "select * from lb_user where weichat_id='{$openId}'";
        if (count($this->excuteSQL($sql)) > 0) {
            return false;//不是第一次关注,记录已经存在
        }
        $sql = "insert into lb_user (weichat_id, phone) value ('{$openId}', '')";
        $this->excuteSQL($sql);
        return true;
    }

    /**
     * 获取优惠券列表
     * @param $weChatId
     * @return 结果数组
     */
    public function getCouponsList($weChatId) {
        $sql = "select id from lb_user where weichat_id = '{$weChatId}'";
        $user_id = $this->excuteSQL($sql);
        $user_id = $user_id[0]['id'];

        $sql = "select * from lb_coupons where user_id = {$user_id} and isUsed=0 order by worth desc;";
        $result = $this->excuteSQL($sql);
        return $result[0];
    }

    public function getCouponsForList($weChatId) {
        $sql = "select id from lb_user where weichat_id = '{$weChatId}'";
        $user_id = $this->excuteSQL($sql);
        $user_id = $user_id[0]['id'];

        $sql = "select * from lb_coupons where user_id = {$user_id} and isUsed=0 order by worth desc;";
        return $this->excuteSQL($sql);
    }

    /**
     * 将优惠券给某一个用户
     * @param $price price
     * @param $user_id id
     * @param $startTime 开始时间
     * @param $endTime 结束时间
     * @return Data Array
     */
    public function giveCouponToUser($price, $startTime, $endTime, $user_id) {
        $sql = "insert into lb_coupons (user_id, worth, startTime, endTime, isUsed) value ({$user_id}, {$price}, '{$startTime}', '{$endTime}', 0)";
        echo ",sql1 = ".$sql;
        $this->excuteSQL($sql);
        $sql = "update lb_coupons_admin as coupons set coupons.total_count = coupons.total_count + 1 where id = 1";
        echo ",sql2 = ".$sql;
        $this->excuteSQL($sql);
    }

    /**
     * 获取价格
     */
    public function getPrice() {
        $sql = "select startPrice, startLength, perPrice, perLength, name, dimension, carrying from lb_price as price, lb_car as car where price.car_id = car.id";
        return $this->excuteSQL($sql);
    }

    /**
     * 将数据插入到问题列表
     * @param $wechat_id weichat_id
     * @param $question 问题内容
     * @param $name
     * @param $email
     * @return 结果数组
     */
    public function question($wechat_id, $name, $email, $question) {
        $sql = "select id from lb_user where weichat_id = '{$wechat_id}'";
        $user_id = $this->excuteSQL($sql);
        $user_id = $user_id[0]['id'];

        $sql = "insert into lb_question (user_id, name, email, message) values ({$user_id}, '{$name}', '{$email}', '{$question}')";
        return  $this->excuteSQL($sql);
    }

    /**
     * 获取车型
     */
    public function getCarCate() {
        $sql = "select * from lb_car";
        return $this->excuteSQL($sql);
    }
}
