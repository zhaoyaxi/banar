<?php
/**
 * 管理员逻辑类
 * Author: star
 * Date: 5.16
 */
include "include.php";
class messageController extends BaseController{
	public $status = null;
    public $error = null;
    public $datas = null;

	public function sendMessage1($oid){
        
        $user = new messageModel();
        if($user->sendMessage1($oid)){
            $this->error = 0;
            $this->status = 1;
        }
        else{
            $this->error = "信息错误";
            $this->status = 0;
        }
        echo json_encode($this);
    }

	public function sendMessage2($oid,$did){
        
        $user = new messageModel();
        if($user->sendMessage2($oid,$did)){
            $this->error = 0;
            $this->status = 1;
        }
        else{
            $this->error = "信息错误";
            $this->status = 0;
        }
        echo json_encode($this);
    }

	public function sendMessage3($oid){
		 $user = new messageModel();
        if($user->sendMessage3($oid)){
            $this->error = 0;
            $this->status = 1;
        }
        else{
            $this->error = "信息错误";
            $this->status = 0;
        }
        echo json_encode($this);
       
    }

	public function sendMessage4($oid){
        
        $user = new messageModel();
        if($user->sendMessage4($oid)){
            $this->error = 0;
            $this->status = 1;
        }
        else{
            $this->error = "信息错误";
            $this->status = 0;
        }
        echo json_encode($this);
    }
	public function sendMessage5($oid){
        
        $user = new messageModel();
        if($user->sendMessage5($oid)){
            $this->error = 0;
            $this->status = 1;
        }
        else{
            $this->error = "信息错误";
            $this->status = 0;
        }
        echo json_encode($this);
    }
}