<?php
/**
 * Created by PhpStorm.
 * User: niuwei
 * Date: 15/5/11
 * Time: 18:09
 * Description: 微信接口--订单处理
 */
include "../class/inc.php";

class OrderController extends BaseController {

    /**
     * 下单
     */
    public function makeOrder($wechat_id, $name, $startTime, $startLoc, $endLoc,
                              $cate_id, $phone, $message, $price, $floorA, $floorB, $coupons) {
        $orderModel = new OrderModel();
        $orderModel->makeOrder($wechat_id, $name, $startTime, $startLoc, $endLoc,
            $cate_id, $phone, $message, $price, $floorA, $floorB,$coupons);
        echo json_encode(array());
    }

    /**
     * 支付订单
     */
    public function payOrder($order_id) {
        $orderModel = new OrderModel();
        return $orderModel->payOrder($order_id);
    }

    /**
     * 完成订单
     */
    public function completeOrder($order_id) {
        $orderModel = new OrderModel();
        echo json_encode($orderModel->completeOrder($order_id));
    }


    /**
     * 获取历史订单列表
     */
    public function getHistoryOrderList($wechat_id) {
        $orderModel = new OrderModel();
        $data = $orderModel->getHistoryOrderList($wechat_id);
        echo json_encode($data);
    }


    /**
     * 获取某一个历史订单:还需要添加是否完成
     */
    public function getHistoryOrderItem($wechat_id, $order_id) {
        $orderModel = new OrderModel();
        $data = $orderModel->getHistoryOrderItem($wechat_id, $order_id);
        $this->json($data);
    }

    /**
     * 取消订单
     */
    public function cancelOrder($order_id) {
        $orderModel = new OrderModel();
        $orderModel->cancelOrder($order_id);
        echo json_encode(array());
    }
}
