<?php
/**
 * Created by PhpStorm.
 * User: niuwei
 * Date: 15/5/11
 * Time: 18:24
 * 微信接口 -- 其他部分
 */

include "../class/inc.php";

class OtherController extends BaseController {
	public $price = 10;
    /**
     * 处理首次关注事件
     * @param $openId OpenId
     * @return true or false
     */
    public function firstConcern($openId) {
        $otherModel = new OtherModel();
        $isFirst = $otherModel->firstConcern($openId);
        if ($isFirst) {
            $user_id = $otherModel->getUserIdByOpenId($openId);
            $otherModel->giveCouponToUser($this->price, date("Y-m-d"), "2015-08-30", $user_id);
        }
        return $isFirst;
    }

    /**
     * 获取价格
     */
    public function getPrice() {
        $otherModel = new OtherModel();
        $data = $otherModel->getPrice();
        echo json_encode($data);
    }

    /**
     * 获取优惠券
     */
    public function getCouponsList($weChatId) {
        $otherModel = new OtherModel();
        $data = $otherModel->getCouponsList($weChatId);
        echo json_encode($data);
    }

    public function getCouponsForList($weChatId) {
        $otherModel = new OtherModel();
        $data = $otherModel->getCouponsForList($weChatId);
        echo json_encode($data);
    }

    /**
     * 问题反馈
     */
    public function question($wechat_id, $name, $email,$question) {
        $otherModel = new OtherModel();
        $data = $otherModel->question($wechat_id, $name, $email, $question);
        echo json_encode($data);
    }

    /**
     * 获取车型
     */
    public function getCarCate() {
        $otherModel = new OtherModel();
        echo json_encode($otherModel->getCarCate());
    }
}

//$otherController = new OtherController();
//$otherController->getCouponsList("niuwei");
