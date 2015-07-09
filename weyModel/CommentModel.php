<?php
/**
 * Created by PhpStorm.
 * User: niuwei
 * Date: 15/5/11
 * Time: 22:16
 * Description: 微信接口 -- 评价
 */

include "../class/inc.php";

class CommentModel extends BaseModel {


    /**
     * @param $wechat_id
     * @param $order_id
     * @param $driver_id
     * @param $comment
     * @param $star
     * @param $l1
     * @param $l2
     * @param $l3
     * @param $l4
     * @param $l5
     * @param $l6
     * @param $l7
     */
    public function commentOrder($wechat_id, $order_id, $driver_id, $comment, $star, $l1, $l2, $l3, $l4, $l5, $l6, $l7 = 0) {
        $sql = "select id from lb_user where weichat_id = '{$wechat_id}'";
        $user_id = $this->excuteSQL($sql);//User ID
        $user_id = $user_id[0]['id'];//User ID

        $commentTime = date("Y-m-d H:i");
        $sql = "insert into lb_comment (order_id, user_id, driver_id,comment, commentTime, label, star) values({$order_id}, {$user_id}, {$driver_id},'{$comment}', '{$commentTime}', '00', {$star})";
        $this->excuteSQL($sql);

        //插入数据到lb_comment_lab
        $sql = "select * from lb_comment_lab where driver_id = {$driver_id}";
		$result = $this->excuteSQL($sql);
		$result = $result[0];
        if (empty($result)) {
            $sql = "insert into lb_comment_lab (driver_id, lab1, lab2, lab3, lab4, lab5, lab6, lab7) value ({$driver_id}, {$l1}, {$l2}, {$l3}, {$l4}, {$l5}, {$l6}, {$l7});";
        } else {
            $sql = "update lb_comment_lab set lab1 = lab1+{$l1}, lab2 = lab2+{$l2}, lab3 = lab3+{$l3}, lab4 = lab4+{$l4}, lab5 = lab5+{$l5}, lab6 = lab6+{$l6}, lab7 = lab7+{$l7}  where driver_id={$driver_id} ";
        }
        $this->excuteSQL($sql);

        //插入数据到lb_comment_lab_2
        $sql = "insert into lb_comment_lab_2 (order_id, lab1, lab2, lab3, lab4, lab5, lab6, lab7) value ({$order_id}, {$l1}, {$l2}, {$l3}, {$l4}, {$l5}, {$l6}, {$l7});";
        $this->excuteSQL($sql);
    }


    /**
     * 获取待评论订单的司机的消息
     * @param $order_id
     * @return mixed
     */
    public function getCommentOrder($order_id) {

        //司机信息
        $sql = "select lb_driver.name, lb_driver.id, lb_driver.phone, lb_driver.license from lb_driver, lb_order_relation where lb_driver.id = lb_order_relation.driver_id and lb_order_relation.order_id = {$order_id}";
        $driver_data = $this->excuteSQL($sql);
        $driver_data = $driver_data[0];

        //司机订单星星的平均值
        $driver_data['star'] = $this->excuteSQL("select avg(star) as star from lb_comment where driver_id = {$driver_data['id']}");
        $driver_data['star'] = $driver_data['star'][0]['star'];

        //司机的接单数
        $driver_data['orderCount'] = $this->excuteSQL("select count(order_id) as orderCount from lb_order_relation where driver_id = {$driver_data['id']}");
        $driver_data['orderCount'] = $driver_data['orderCount'][0]['orderCount'];

        return $driver_data;
    }
}

//($wechat_id, $order_id, $driver_id, $comment, $star, $l1, $l2, $l3, $l4, $l5, $l6, $l7);
//$test = new CommentModel();
//$test->commentOrder('weserds', 7, 18, "你好帅比", 3, 1,1,1,1,1,1,1);