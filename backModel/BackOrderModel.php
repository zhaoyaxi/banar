<?php
/**
 * Created by PhpStorm.
 * User: niuwei
 * Date: 15/5/17
 * Time: 12:20
 * 订单Model
 */
include "../backController/include.php";
class BackOrderModel extends BaseModel {

    /**
     * 未测试
     * 通过订单状态获取订单列表
     * @param $state
     *          订单状态 0=>用户新下达,1=>已绑定,2=>已确认,3=>已完成订单
     * @param $orderBy
     *          按照什么字段排序,默认为按照下单时间
     * @param $isDesc
     *          是不是降序
     * @return 返回处于$state的订单
     */
    public function getOrderListByState($state, $orderBy='createTime', $isDesc = true) {
        //不能加引号'{$order_id}'

        //$sql = "select * from lb_order where state='{$state}' order by createTime desc";
        $sql = "select * from lb_order where state='{$state}' order by createTime desc";
        $data = $this->excuteSQL($sql);
        return $data;
    }

    public function getOrderListByState1($state, $orderBy='createTime', $isDesc = true) {
        //不能加引号'{$order_id}'
            $sql = "select o.id id,o.name name,a.name aname,d.name dname,o.completeTime completeTime ,o.createTime createTime,o.isCancel isCancel
					from lb_order_relation orr
					LEFT JOIN lb_order o ON o.id = orr.order_id
					LEFT JOIN lb_admin a ON a.id=orr.admin_id
					LEFT JOIN lb_driver d ON d.id=orr.driver_id 
					WHERE o.state={$state}
					order by '{$orderBy}' desc
					";
        /*$sql = "SELECT S.SID SID,S.source source,S.personNum personNum,D.title title,L.prov prov,L.city city1,S.city city2,L.stre stre
                FROM Sofa S
                LEFT JOIN Description D ON S.SID = D.SID
                LEFT JOIN location L ON S.SID = L.SID
                limit {$start},{$end}";
                select o.name name,a.name aname,d.name dname,O.createTime createTime
                "select *
                from lb_order_relation orr
                LEFT JOIN lb_order o ON o.id = orr.order_id
                LEFT JOIN lb_admin a ON a.id=orr.admin_id
                LEFT JOIN or_driver d ON d.id=orr.dirver_id
                where state={$state}
                order by '{$orderBy}' desc";
                */

        $data = $this->excuteSQL($sql);
        return $data;
    }

    /**
     * 未测试
     * 通过订单id获取订单详细信息
     * @param $order_id 订单id
     * @return 订单详细信息
     */
    public function getOrderById($order_id) {
        $sql = "select * from lb_order where id={$order_id}";
        $data = $this->excuteSQL($sql);
        return $data[0];
    }

    /**
     * 通过order_id获取详细的订单信息
     * @param $order_id
     * @return 数据 司机信息 + 评论信息 + 操作管理员信息
     * select * from lb_order,lb_driver, lb_comment, lb_order_relation
    where
    lb_order.id = lb_order_relation.order_id
    and lb_order.id = lb_comment.order_id
    and lb_order_relation.driver_id = lb_driver.id
     */
    public function getOrderDetailById($order_id) {
        $sql1 = "select * from lb_order where id={$order_id}";
        $sql2 = "select o.id id,o.name name,a.name aname,d.name dname,d.id did,d.phone dphone
					from lb_order_relation orr
					LEFT JOIN lb_order o ON o.id = orr.order_id
					LEFT JOIN lb_admin a ON a.id=orr.admin_id
					LEFT JOIN lb_driver d ON d.id=orr.driver_id 
					WHERE o.id={$order_id}
					order by '{$orderBy}' desc
					";
        $data['order'] = $this->excuteSQL($sql1);

        return $data;
    }

    public function ordercomplect($id) {
        date_default_timezone_set('PRC');
        $time = date("y-m-d H:i:s");
        $sql = "SELECT state FROM lb_order WHERE id = {$id}";
        $re = $this->excuteSQL($sql);
        $admin_id = $this->session("admin_id");
        if($re[0]['state'] == 2){
            $sql = "UPDATE lb_order SET state = 3 WHERE id = {$id} ";
            $sql1 = "insert into lb_admin_action (order_id,admin_id,type,time) values ({$id},{$admin_id},2,'{$time}')";

        }
        else if($re[0]['state'] == 1){
            $sql = "UPDATE lb_order SET state = 2 WHERE id = {$id} ";
            $sql1 = "insert into lb_admin_action (order_id,admin_id,type,time) values ({$id},{$admin_id},4,'{$time}')";
        }

        $re = $this->excuteSQL($sql);
        $re = $this->excuteSQL($sql1);
        if($re)
            return true;
        else
            return false;
    }

    public function cancelOrder($id) {
        /*if(!isset($_SESSION)){
               session_start();
            }
        if( !$_SESSION['admin_id'])
            $aid = 1;
        else
            $aid = $_SESSION['admin_id'];*/
        date_default_timezone_set('PRC');
        $time = date("y-m-d H:i:s");
        $admin_id = $this->session("admin_id");
        $sql = "UPDATE lb_order SET state = 4 WHERE id = {$id}";
        $sql1 = "insert into lb_admin_action (order_id,admin_id,type,time) values ({$id},{$admin_id},3,'{$time}')";
        $re = $this->excuteSQL($sql);

        return true;
    }

    public function orderfix($oid,$did) {
        $sql = "SELECT * FROM lb_order_relation WHERE order_id = {$oid}";
        if(!$this->excuteSQL($sql)){
            if(!isset($_SESSION)){
                session_start();
            }
            if( !$_SESSION['admin_id'])
                $admin_id = 2;
            else
                $admin_id = $_SESSION['admin_id'];
            date_default_timezone_set('PRC');
            $time = date("y-m-d H:i:s");
            $sql = "UPDATE lb_order SET state = 1 WHERE id = {$oid} AND state = 0";
            $sql1 = "INSERT INTO lb_order_relation (driver_id,order_id,admin_id) VALUES ({$did},{$oid},{$admin_id})";
            $sql2 = "insert into lb_admin_action (order_id,admin_id,type,time) values ({$oid},{$admin_id},1,'{$time}')";

            $re = $this->excuteSQL($sql);
            $re = $this->excuteSQL($sql1);
            $re = $this->excuteSQL($sql2);
            return true;

        }
        else
            return false;
    }

    public function getCancel() {
        $sql = "SELECT * FROM lb_order WHERE isCancel = 1";
        $re = $this->excuteSQL($sql);
        return $re;
    }

	 public function getCard() {
        $sql = "SELECT * FROM lb_coupons_admin WHERE id = 1";
        $re = $this->excuteSQL($sql);
        return $re;
    }

	 public function changeCard($card) {
		 $money = (int)($card);
        $sql = "UPDATE lb_coupons_admin SET worth = {$money} WHERE id = 1";
        $re = $this->excuteSQL($sql);
        return $re;
    }
}
//$r = new BackOrderModel();
//$r->excuteSQL("select * from lb_comment where order_id=4");
//$r->orderfix(3,5);
