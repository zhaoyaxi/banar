<?php
/**
 * 管理员逻辑类
 * Author: star
 * Date: 5.16
 */
include "include.php";
include "common.php";
class adminController extends BaseController{

    public $level = null;
    public $user_name = null;
    public $status = null;
    public $error = null;
    public $datas = null;

    public function login($user_name,$password){
        //echo 1;
        if(!$user_name ||!$password){
            $this->status = 0;
            $this->error = '用户名或密码未输入';
            echo json_encode($this);
            return;
        }
        $user = new adminModel();
        if($user->login($user_name,$password)){
            $this->error = 0;
            $this->status = 1;
        }
        else{
            $this->error = "用户名或密码不正确";
            $this->status = 0;
        }
        echo json_encode($this);
    }

    public function addAdmin($adminEmail,$adminPassword,$adminName,$adminLevel){
        if(!$adminEmail ||!$adminPassword ||!$adminName ||!$adminLevel){
            $this->status = 0;
            $this->error = '信息不完整';
            echo json_encode($this);
            return;
        }
        $user = new adminModel();
        if($user->addAdmin($adminEmail,$adminPassword,$adminName,$adminLevel)){
            $this->error = "0";
            $this->status = 1;
            sendEmail($adminEmail,$adminName,$adminPassword);
            //sendEmail('starxy154@126.com','hello','1111111');
        }
        else{
            $this->error = "信息由错误";
            $this->status = 0;
        }
        echo json_encode($this);

    }

    public function getAdmin($getAdminName,$getStatus){

        $user = new adminModel();
        $this->datas = $user->getAdmin($getAdminName,$getStatus);
        $this->error = 0;
        $this->status = 1;


        //$this->error = "信息由错误";
        //$this->status = 0;

        echo json_encode($this);

    }

    public function deleteAdmin($id){

        $user = new adminModel();
        if($user->deleteAdmin($id)){
            $this->error = 0;
            $this->status = 1;
        }else{
            $this->error = "没有权限";
            $this->status = 0;
        }
        echo json_encode($this);

    }

	public function reBackAdmin($id){

        $user = new adminModel();
        if($user->reBackAdmin($id)){
            $this->error = 0;
            $this->status = 1;
        }else{
            $this->error = "没有权限";
            $this->status = 0;
        }
        echo json_encode($this);

    }

    public function adminAction($type){

        $user = new adminModel();
        $this->datas = $user->adminAction($type);
        $this->error = 0;
        $this->status = 1;

        echo json_encode($this);

    }

	public function adminActionCerten($type,$id){

        $user = new adminModel();
        $this->datas = $user->adminActionCerten($type,$id);
        $this->error = 0;
        $this->status = 1;

        echo json_encode($this);

    }

    public function adminActionDriver($type){

        $user = new adminModel();
        $this->datas = $user->adminActionDriver($type);
        $this->error = 0;
        $this->status = 1;

        echo json_encode($this);

    }

    public function changePassword($oldone,$newone){

        $user = new adminModel();
        if($user->changePassword($oldone,$newone)){
            $this->error = 0;
            $this->status = 1;
        }else{
            $this->error = '密码错误';
            $this->status = 0;
        }

        echo json_encode($this);

    }


}
?>
