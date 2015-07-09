<?php
/**
 * Created by PhpStorm.
 * User: niuwei
 * Date: 15/5/17
 * Time: 12:20
 */

class BackOrderController extends BaseController {

    public $status = null;
    public $error = null;
    public $datas = null;
    /**
     * 通过订单状态获取订单列表
     * @param $state
     *          订单状态 0=>用户新下达,1=>已绑定,2=>已确认,3=>已完成订单
     * @param $orderBy
     *          按照什么字段排序,默认为按照下单时间
     * @param $isDesc
     *          是不是降序
     * @return 返回处于$state的订单
     */
    public function getOrderListByState($state) {
        $orderBy='createTime';
        $isDesc = true;
        $orderModel = new BackOrderModel();

        $this->datas = $orderModel->getOrderListByState($state, $orderBy, $isDesc);
        $this->status = 1;
        $this->error = 0;
        echo json_encode($this);
    }

    /**
     * 通过订单id获取订单详细信息
     * @param $order_id 订单id
     * @return 订单详细信息
     */
    public function getOrderById($order_id) {
        $orderModel = new BackOrderModel();
        $this->datas = $orderModel->getOrderById($order_id);
        $this->status = 1;
        $this->error = 0;

        echo json_encode($this);
    }

    public function orderFresh($state) {
        $orderBy='createTime';
        $isDesc = true;
        $orderModel = new BackOrderModel();
        date_default_timezone_set('PRC');
        $datas_ = $orderModel->getOrderListByState($state, $orderBy, $isDesc);
        for($i = 0; $i < count($datas_); $i++){
            $this->datas[$i]['id'] = $datas_[$i]['id'];
            $this->datas[$i]['name'] = $datas_[$i]['name'];
            $this->datas[$i]['time'] = $datas_[$i]['createTime'];
			$this->datas[$i]['isCancel'] = $datas_[$i]['isCancel'];

            $zero1=strtotime (date("y-m-d H:i:s")); //当前时间  ,注意H 是24小时 h是12小时
            $zero2=strtotime ($datas_[$i]['createTime']);
            $guonian=ceil(($zero1-$zero2)/60); //60s*60min*24h
            $this->datas[$i]['wait_time'] = $guonian;
        }
        $this->status = 1;
        $this->error = 0;

        echo json_encode($this);
    }

    public function orderFresh1($state) {
        $orderBy='createTime';
        $isDesc = true;
        $orderModel = new BackOrderModel();
        $this->datas = $orderModel->getOrderListByState1($state, $orderBy, $isDesc);
        $this->status = 1;
        $this->error = 0;

        echo json_encode($this);
    }

    public function ordercomplect($id) {

        $orderModel = new BackOrderModel();
        if( $orderModel->ordercomplect($id)){
            $this->status = 1;
            $this->error = 0;
        }else{
            $this->status = 0;
            $this->error = 1;
        }

        echo json_encode($this);
    }

    public function rtime($time){
        date_default_timezone_set('PRC');
        //echo date("y-m-d H:i:s");
        $zero1=strtotime (date("y-m-d H:i:s")); //当前时间  ,注意H 是24小时 h是12小时
        $zero2=strtotime ("2015-5-18 00:00:00");  //过年时间，不能写2014-1-21 24:00:00  这样不对
        $guonian=ceil(($zero1-$zero2)/60); //60s*60min*24h
        return $guonian;

    }

    public function getOrderDetailById($order_id) {
        $orderModel = new BackOrderModel();
        $this->datas = $orderModel->getOrderDetailById($order_id);
        $this->status = 1;
        $this->error = 0;

        echo json_encode($this);
    }

    public function orderfix($order_id,$did) {
        $orderModel = new BackOrderModel();
        if( $orderModel->orderfix($order_id,$did)){
            $this->status = 1;
            $this->error = 0;
        }else{
            $this->status = 0;
            $this->error = 1;
        }

        echo json_encode($this);
    }

    public function cancelOrder($id) {
        $orderModel = new BackOrderModel();
        if( $orderModel->cancelOrder($id)){
            $this->status = 1;
            $this->error = 0;
        }else{
            $this->status = 0;
            $this->error = 1;
        }

        echo json_encode($this);
    }


    public function getCancel() {
        $orderModel = new BackOrderModel();
        $this->datas = $orderModel->getCancel();
        $this->status = 1;
        $this->error = 0;

        echo json_encode($this);
    }

	public function getCard() {
        $orderModel = new BackOrderModel();
        $this->datas = $orderModel->getCard();
        $this->status = 1;
        $this->error = 0;

        echo json_encode($this);
    }

	public function changeCard($card) {
        $orderModel = new BackOrderModel();
        $this->datas = $orderModel->changeCard($card);
        $this->status = 1;
        $this->error = 0;

        echo json_encode($this);
    }
}