<?php
/**
 * Created by PhpStorm.
 * User: niuwei
 * Date: 15/5/11
 * Time: 18:22
 * 微信接口 -- 评价
 * 单独提出主要是为了以后的扩展
 */

include "../class/inc.php";

class CommentController extends BaseController {

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
    public function commentOrder($wechat_id, $order_id, $driver_id, $comment, $star, $l1, $l2, $l3, $l4, $l5, $l6, $l7) {
        $commentModel = new CommentModel();
        $commentModel->commentOrder($wechat_id, $order_id, $driver_id, $comment, $star, $l1, $l2, $l3, $l4, $l5, $l6, $l7);
        $this->json(array('status'=>'ok'));
    }

    public function getCommentOrder($order_id) {
        $commentModel = new CommentModel();
        $this->json($commentModel->getCommentOrder($order_id));
    }
}