<?php
/**
 * 用户操作类
 * Date:8.3
 * Author:star
 *
 */
include "../backController/include.php";

class commentModel extends BaseModel{

    public $level = null;
    public $email = null;
    public $error = null;

    public function getCommentList($driver_id){
        $sql = "SELECT comment,star,commentTime,createTime,o.name name
					FROM lb_comment c,lb_order o,lb_user u
					WHERE c.driver_id = {$driver_id}
						  AND c.order_id = o.id
						  AND c.user_id = u.id";
        $data = $this->excuteSQL($sql);
        //echo json_encode($data);
        return $data;

    }

    public function getLab($driver_id){
        $sql = "SELECT *
					FROM lb_comment_lab
					WHERE driver_id = {$driver_id}
					";
        $data = $this->excuteSQL($sql);
        //echo json_encode($data);
        return $data[0];

    }

    public function getCommentSum($driver_id){
        $sql = "SELECT count(*) as count
					FROM lb_comment
					WHERE driver_id = {$driver_id}
					";
        $data = $this->excuteSQL($sql);
        //echo json_encode($data);
        return $data[0];

    }

    public function intiComment($order_id){
        $sql = "SELECT *
					FROM lb_comment
					WHERE order_id = {$order_id}
					";
        $data = $this->excuteSQL($sql);
        //echo json_encode($data);
        return $data[0];

    }


    public function intilab($order_id){
        $sql = "SELECT *
					FROM lb_comment_lab_2
					WHERE order_id = {$order_id}
					";
        $data = $this->excuteSQL($sql);
        //echo json_encode($data);
        return $data[0];

    }


    public function intiAdmin($order_id){
        $sql = "SELECT a.name name
					FROM lb_order_relation lor, lb_admin a
					WHERE lor.order_id = {$order_id} AND lor.admin_id = a.id
					";
        $data = $this->excuteSQL($sql);
        //echo json_encode($data);
        return $data[0];

    }
}
//$comment = new commentModel();
//$comment->getCommentList(1);