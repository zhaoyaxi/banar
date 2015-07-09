<?php
/**
 * Created by PhpStorm.
 * User: niuwei
 * Date: 15/5/11
 * Time: 19:19
 */

include "../class/inc.php";

class OrderModel extends BaseModel{

    /**
     * 下订单
     * @param $wechat_id 微信id
     * @param $startTime 订单开始时间
     * @param $startLoc  开始位置
     * @param $endLoc    目的地
     * @param $cate_id    车型id
     * @param $phone     手机号码
     * @param $message   留言信息
     * @param $price     价格
     * @param $floorA     A需要司机搬运的楼层
     * @param $floorB     B需要司机搬运的楼层
     */
    public function makeOrder($wechat_id, $name, $startTime, $startLoc, $endLoc,
                           $cate_id, $phone, $message, $price, $floorA, $floorB, $coupons) {
        $sql = "select id from lb_user where weichat_id = '{$wechat_id}'";
        //echo "查询user_id sql = ".$sql;
        $user_id = $this->excuteSQL($sql);//User ID
        $user_id = $user_id[0]['id'];//User ID

        $state = 0;
        date_default_timezone_set('PRC');
        $createTime = date('Y-m-d H:i');

        $sql = "update lb_user set phone='{$phone}' where id={$user_id}";
        $this->excuteSQL($sql);//将用户信息更新

        $real_price = $this->get_realPrice((int)$price, (int)$coupons);
        $sql = "insert into lb_order (user_id, name, phone, car_id, price, pre_price,
          startLocation, endLocation, createTime, startTime, message, floorCount,
          toFloorCount, real_price) values ({$user_id}, '{$name}', '{$phone}', {$cate_id}, {$price}, {$coupons},
          '{$startLoc}', '{$endLoc}', '{$createTime}', '{$startTime}', '{$message}', {$floorA}, {$floorB}, {$real_price});";
        $this->excuteSQL($sql);

        //消费优惠券
        $sql = "update lb_coupons set isUsed = 1 where user_id = {$user_id} and worth = {$coupons} order by endTime limit 1;";
        $this->excuteSQL($sql);
    }

    /**
     * 计算支付给司机的价格
     * @param $price
     * @param $pre_price
     * @return int
     */
    public function get_realPrice($price,$pre_price){
        $realPrice = 0.0;
        $total_price = (double)($price + $pre_price);
        $sql = "SELECT * FROM lb_price_standed WHERE id = 1";
        $result = $this->excuteSQL($sql);
        if( $result[0]['state'] == 1){
            $realPrice = $total_price - $result[0]['s_price'];
        }else if( $result[0]['state'] == 2){
            $realPrice = $total_price *(1-$result[0]['s_per']/100);
        }else if( $result[0]['state'] == 3){
            if($total_price >= $result[0]['r_sta']){
                $realPrice = $total_price - $result[0]['r_price'];
            }else{
                $realPrice = $total_price *(1-$result[0]['r_per']/100);
            }
        }
        return (int)$realPrice;

    }

    /**
     * 支付订单
     * @param $order_id     订单id
     * @return data
     */
    public function payOrder($order_id) {
        $state = 1;
        $sql= "update lb_order set state={$state} where id={$order_id}";
        return $this->excuteSQL($sql);
    }


    /**
     * 完成订单
     * @param $order_id
     * @return 数组
     */
    public function completeOrder($order_id) {
        $state = 2;
        $sql= "update lb_order set state={$state} where id={$order_id}";
        return $this->excuteSQL($sql);
    }

    /**
     * 获取历史订单列表
     * @param $wechat_id 微信id
     * @return 返回数据
     */
    public function getHistoryOrderList($wechat_id) {
        $sql = "select id from lb_user where weichat_id = '{$wechat_id}'";
        $user_id = $this->excuteSQL($sql);//User ID
        $user_id = $user_id[0]['id'];//User ID

        $sql = "select lb_order.id as order_id, lb_car.name as car_name, lb_order.name as userName, startLocation, endLocation, price, state, createTime, startTime, isCancel, lb_user.phone, floorCount, toFloorCount, pre_price as coupons, message from lb_order, lb_car, lb_user where lb_order.car_id = lb_car.id and lb_user.id = lb_order.user_id and user_id = {$user_id} order by startTime DESC";
        return $this->excuteSQL($sql);
    }


    /**
     * 获取某一个历史订单
     * @param $wechat_id 微信id
     * @param $order_id 订单id
     * @return 数据数组
     */
    public function getHistoryOrderItem($wechat_id, $order_id) {
        $sql = "select id from lb_user where weichat_id = '{$wechat_id}'";
        $user_id = $this->excuteSQL($sql);//User ID
        $user_id = $user_id[0]['id'];//User ID

        //判断是否已经评论
        $sql = "select * from lb_comment where order_id='{$order_id}'";
        $comment = $this->excuteSQL($sql);
        $sql = "select * from lb_order where user_id={$user_id} and id={$order_id}";
        $data = $this->excuteSQL($sql);
        if (count($comment) > 0) {
            $data[0]['isComment'] = '1';//用户已经评论此订单
            return $data;
        } else {
            $data[0]['isComment'] = '0';//用户没有评论此订单
            return $data;
        }
    }

    /**
     * 取消订单
     * @param $order_id
     */
    public function cancelOrder($order_id) {
        $sql = "update lb_order set isCancel=1 where id={$order_id}";
        $this->excuteSQL($sql);
    }
}

//$orderModel = new OrderModel();
//$orderModel->makeOrder("niuwei","牛威","2015-05-20 12:00:00", "北京鸟不拉屎1", "北京鸡不生蛋1", 1, "15652953455"
//, "牛威好帅啊啊", 120, 1, 2, 20);
