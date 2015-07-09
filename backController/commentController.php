<?php
/**
 * 管理员逻辑类
 * Author: star
 * Date: 5.16
 */
include "include.php";
class commentController extends BaseController{

    public $status = null;
    public $error = null;
    public $datas = null;

    public function getCommentList($driver_id){

        $comment = new commentModel();
        $this->datas = $comment->getCommentList($driver_id);
        $this->error = 0;
        $this->status = 1;

        echo json_encode($this);

    }

    public function getLab($driver_id){

        $comment = new commentModel();
        $this->datas = $comment->getLab($driver_id);
        $this->error = 0;
        $this->status = 1;

        echo json_encode($this);

    }

    public function getCommentSum($driver_id){

        $comment = new commentModel();
        $this->datas = $comment->getCommentSum($driver_id);
        $this->error = 0;
        $this->status = 1;

        echo json_encode($this);

    }

    public function intiComment($order_id){

        $comment = new commentModel();
        $this->datas = $comment->intiComment($order_id);
        $this->error = 0;
        $this->status = 1;

        echo json_encode($this);

    }

    public function intilab($order_id){

        $comment = new commentModel();
        $this->datas = $comment->intilab($order_id);
        $this->error = 0;
        $this->status = 1;

        echo json_encode($this);

    }


    public function intiAdmin($order_id){

        $comment = new commentModel();
        $this->datas = $comment->intiAdmin($order_id);
        $this->error = 0;
        $this->status = 1;

        echo json_encode($this);

    }


}
