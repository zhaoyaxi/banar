<?php

include "../class/inc.php";
$cont = new BaseController();

$action = $cont->secParam("action");
switch($action){
    case "postQuestion"://问题
        $otherController = new OtherController();
        $wechat_id = getWeChatId();
        $otherController->question($wechat_id,getParam("name"), getParam("email"), getParam("content"));
        break;
    case "getCarCate"://获取车型
        $otherController = new OtherController();
        $otherController->getCarCate();//并且可以将json数据返回
        break;
    case "makeOrder"://下单
        $orderController = new OrderController();
        //测试
        $wechat_id = getWeChatId();
        $startLocation = session('startLocation');//出发地OK
        $endLocation = session('endLocation');//目的地OK
        $startFloor = (int)session('startFloor');//开始楼层OK
        $endFloor = (int)session('endFloor');//目的地楼层OK
        $dateTime = session('dateTime');//开始时间OK
        $name = session('name');//姓名OK
        $phone = session('phone');//电话OK
        $coupons = (int)session('coupons');//优惠价格
        $message = session('message');//留言OK
        $price = (int)session('money');//价格OK
        $priceDistance = (int)session('priceDistance');//距离OK
        $carCate = (int)session('carCate');//车型OK
        //var_dump($_SESSION);
        $orderController->makeOrder($wechat_id, $name, $dateTime,$startLocation,
            $endLocation,$carCate,$phone,$message,$price,$startFloor,$endFloor, $coupons);
        break;
    case "payOrder"://支付订单
        $orderController = new OrderController();
        $orderController->payOrder(getParam("order_id"));
        break;
    case "completeOrder"://完成订单
        $orderController = new OrderController();
        $orderController->completeOrder(getParam("order_id"));
        break;
    case "getHistoryOrderList"://获取历史订单列表
        $orderController = new OrderController();
        $wechat_id = getWeChatId();
        //$wechat_id = 'niuwei';
        $orderController->getHistoryOrderList($wechat_id);
        break;
    case "getHistoryOrderItem"://获取历史订单详情
        $orderController = new OrderController();//getParam("wechat_id")
        $orderController->getHistoryOrderItem("niuwei", getParam("order_id"));
        break;
    case "commentOrder"://评论
        $commentController = new CommentController();
        $commentController->commentOrder(getWeChatId(), getParam("order_id"),
            getParam("driver_id"), getParam("message"), getParam("star"), getParam("label1"),
            getParam("label2"),getParam("label3"),getParam("label4"),getParam("label5"),
            getParam("label6"),getParam("label7"));
        break;
    case "getCommentOrder"://获取待评论订单的司机的消息
        $commentController = new CommentController();
        $commentController->getCommentOrder(getParam("order_id"));
        break;
    case "getPrice"://获取价格
        $otherController = new OtherController();
        $otherController->getPrice();
        break;
    case "getCouponsList"://获取优惠券
        $otherController = new OtherController();
        $wechat_id = getWeChatId();
        //$wechat_id = "niuwei";
        $otherController->getCouponsList($wechat_id);
        break;
    case "getCouponsForList"://获取优惠券列表，上面的不是
        $otherController = new OtherController();
        $wechat_id = getWeChatId();
        //$wechat_id = "niuwei";
        $otherController->getCouponsForList($wechat_id);
        break;
    case "cancelOrder"://取消订单
        $orderController = new OrderController();
        $order_id = getParam("order_id");
        $orderController->cancelOrder($order_id);
        break;
    case "saveOrderToSession"://降临时订单信息保存到session
        $startLocation = getParam("startLocation");
        session('startLocation', $startLocation);//开始位置

        $endLocation = getParam("endLocation");
        session('endLocation', $endLocation);//结束位置

        $startFloor = getParam("startFloor");
        session('startFloor', $startFloor);//开始楼层

        $endFloor = getParam("endFloor");
        session('endFloor', $endFloor);//结束楼层

        $dateTime = getParam("dateTime");
        session('dateTime', $dateTime);//时间

        $name = getParam("name");
        session('name', $name);//姓名

        $phone = getParam("phone");
        session('phone', $phone);//电话

        $message = getParam("message");
        session('message', $message);//信息

        $money = getParam("money");
        session('money', $money);//总价格

        $coupons = getParam("coupons");
        session('coupons', $coupons);//优惠价格

        $carCate = getParam("carCate");
        session('carCate', $carCate);

        $priceDistance = getParam("priceDistance");
        session('priceDistance', $priceDistance);//最终距离
        break;

    case "getDistanceByArea"://根据位置名称获取距离
		$startLocation = getParam("startLocation");
        $endLocation = getParam("endLocation");
        $url = "http://api.map.baidu.com/direction/v1?mode=driving&origin={$startLocation}&destination={$endLocation}&origin_region=北京&destination_region=北京&output=json&ak=bBzb0kqzC4qcZGV8M5igG9iD";
        $content = json_decode(file_get_contents($url));//获取信息
		if($content->status ==0 && $content->type == 2){		
			
//        var_dump($content);
        $result = array();
        $distance = $content->result->routes[0]->distance;
//        if (isset($distance)&&!empty($distance)) {
//            $result['distance'] = $distance;
//        } else {
//            $origin = $content->result->origin->content[0];
//            $originLat = $origin->location->lat;
//            $originLng = $origin->location->lng;
//            $startLocation = $startLocation."|".$originLat.",".$originLng;
//            $destination = $content->result->destination->content[0];
//            $destinationLat = $destination->location->lat;
//            $destinationLng = $destination->location->lng;
//            $endLocation = $endLocation."|".$destinationLat.",".$destinationLng;
//            $url = "http://api.map.baidu.com/direction/v1?mode=driving&tactics=11&origin={$startLocation}&destination={$endLocation}&origin_region=北京&destination_region=北京&output=json&ak=bBzb0kqzC4qcZGV8M5igG9iD";
//            echo $url;
//        }
        $result['distance'] = $distance;
        echo json_encode($result);
		
		}
        break;

}


/**
 * @param string $key
 * @param string $default
 *
 * @return string
 */
function getParam($key, $default = '')
{
    if ($_GET && isset($_GET[$key]))
    {
        return $_GET[$key];
    }
    elseif ($_POST && isset($_POST[$key]))
    {
        return $_POST[$key];
    }
    return $default;
}

/**
 * 得到安全的页面参数
 * @param        $key           关键字
 * @param string $default       默认值
 * @return string               返回_POST或_GET中的关键字对应值
 */
function secParam($key, $default = '')
{
    $data = $this->getParam($key, $default);
    $data = trim($data);
    return htmlspecialchars($data);
}

function getWeChatId() {
    if (!isset($_SESSION)) {
        session_start();
    }
	return 'oz7dctyIeCJHjK3hSIgczBaqNX3s';
    return $_SESSION['openid'];
}

/**
 *设置或获取session
 * @param $key     键
 * @param $value=0     值
 * @return bool  or   值
 */
function session($key,$value = 0){
    if (!isset($_SESSION)) {
        session_start();
    }
    if(isset($value)&&$value){
        $_SESSION[$key] = $value;
        return true;
    }
    return $_SESSION[$key];
}

