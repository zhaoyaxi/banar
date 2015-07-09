<?php
/**
 * Created by PhpStorm.
 * User: niuwei
 * Date: 15/5/17
 * Time: 12:33
 */

class BackCommentModel extends BaseModel {

    /**
     * 未测试
     * 通过评论id获取评论相关的信息
     * @param $what
     * @param $id 评论的id
     * @return 返回评论相关的信息
     */
    public function getCommentInfo($id, $what='order_id') {
        $sql = "";
        if ($what == "order_id") {
            $sql = "select * from lb_comment where order_id = {$id}";
        } else if ($what == "comment_id") {
            $sql = "select * from lb_comment where id = {$id}";
        }
        $data = $this->excuteSQL($sql);
        return $data;
    }
}