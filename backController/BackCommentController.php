<?php
/**
 * Created by PhpStorm.
 * User: niuwei
 * Date: 15/5/17
 * Time: 12:33
 */
class BackCommentController extends BaseController {
    /**
     * 通过评论id获取评论相关的信息
     * @param $what
     * @param $id 评论的id
     * @return 返回评论相关的信息
     */
    public function getCommentInfo($id, $what='order_id') {
        $commentModel = new BackCommentModel();
        echo json_encode(($commentModel->getCommentInfo($id, $what)));
    }
}