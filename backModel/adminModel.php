<?php
/**
 * 用户操作类
 * Date:8.3
 * Author:star
 *
 */
include "../backController/include.php";

class adminModel extends BaseModel{
    public $id = null;
    public $user_name = null;
    public $password = null;
    public $level = null;
    public $email = null;
    public $error = null;

    public function login($user_name,$password){
        $result = $this->excuteSQL("SELECT * FROM `lb_admin` WHERE user_name='{$user_name}'");
        if( ($result[0]['password'] == $password)&&( $result[0]['state'] != 3)  ){
            $this->id = $result[0]['id'];
            $this->updateTime();
            $this->session("login",1);
            $this->session("level",$result[0]['level']);
            $this->session("name",$result[0]['name']);
            $this->session("admin_id",$result[0]['id']);
            return true;
        }
        return false;
    }

    public function addAdmin($adminEmail,$adminPassword,$adminName,$adminLevel){
        //$result = $this->excuteSQL("SELECT * FROM `lb_admin` WHERE user_name='{$user_name}'");
        $result = $this->excuteSQL("SELECT * FROM `lb_admin` WHERE user_name='{$adminEmail}'");
        if($result){
            $this->error = "用户名已注册";
            return false;
            //echo "用户名已注册";
        }

        $result = $this->excuteSQL("INSERT INTO `lb_admin` (user_name,password,name,level) VALUES ('{$adminEmail}','{$adminPassword}','{$adminName}',$adminLevel)");
        if($result){
            return true;
        }
        return false;
        //echo json_encode($this);
    }

    public function updateTime(){
        date_default_timezone_set('PRC');
        $date = date("Y-m-d H:i:s");
        //echo $date;
        $result = $this->excuteSQL("UPDATE `lb_admin` SET date = '{$date}' ,state = 2 WHERE id = {$this->id}");
    }

    public function getAdmin($getAdminName,$getStatus){
        if($getAdminName == ""){
            if($getStatus == "1")
                $result = $this->excuteSQL("SELECT * FROM `lb_admin` WHERE state < 3 ");
            else if($getStatus == "2")
                $result = $this->excuteSQL("SELECT * FROM `lb_admin` WHERE state=2 ");
            else if($getStatus == "3")
                $result = $this->excuteSQL("SELECT * FROM `lb_admin` WHERE state=3 ");
            else
                $result = $this->excuteSQL("SELECT * FROM `lb_admin` ");
        }else{
            $result = $this->excuteSQL("SELECT * FROM `lb_admin` WHERE name='{$getAdminName}'");
        }
        return $result;

    }


    public function deleteAdmin($id){

        if(!isset($_SESSION)){
            session_start();
        }
        if( !( $_SESSION['level'] == 1)){
            return false;
        }
        $sql = "UPDATE `lb_admin` SET state = 3 WHERE id = {$id}";
        $this->excuteSQL($sql);
        return true;
    }

	public function reBackAdmin($id){

        if(!isset($_SESSION)){
            session_start();
        }
        if( !( $_SESSION['level'] == 1)){
            return false;
        }
        $sql = "UPDATE `lb_admin` SET state = 1 WHERE id = {$id}";
        $this->excuteSQL($sql);
        return true;
    }

    public function adminAction($type){

        if(!isset($_SESSION)){
            session_start();
        }
        if( !( $_SESSION['level'] == 1)){
            return false;
        }
        $sql = "SELECT  a.name name, aa.order_id oid, aa.time time
					FROM lb_admin_action aa,lb_admin a 
					WHERE a.id = aa.admin_id AND aa.type = {$type}
					ORDER BY time DESC";
        $re = $this->excuteSQL($sql);
        return $re;
    }

	public function adminActionCerten($type,$id){

         if(!isset($_SESSION)){
            session_start();
        }
        if( !( $_SESSION['level'] == 1)){
            return false;
        }
		if( $type == 1){
			$sql = "SELECT  a.name name, aa.order_id oid, aa.time time, aa.type type
						FROM lb_admin_action aa,lb_admin a 
						WHERE a.id = aa.admin_id AND a.id = {$id}
						ORDER BY time DESC";
		}else{
			$sql = "SELECT *
					FROM lb_admin_action_driver laad,lb_admin la
					WHERE la.id = {$id} AND la.name = laad.admin_name
					ORDER BY time DESC";
		}
        $re = $this->excuteSQL($sql);
        return $re;

    }

    public function adminActionDriver($type){

        if(!isset($_SESSION)){
            session_start();
        }
        if( !( $_SESSION['level'] == 1)){
            return false;
        }
        $sql = "SELECT *
					FROM lb_admin_action_driver
					WHERE type = {$type}
					ORDER BY time DESC";
        $re = $this->excuteSQL($sql);
        return $re;
    }


    public function changePassword($oldone,$newone){
        $id = $this->session("admin_id");
        $sql = "SELECT  *
					FROM lb_admin 
					WHERE id = {$id}";
        $re = $this->excuteSQL($sql);
        if( $re[0]['password'] == $oldone){
            $sql = "UPDATE `lb_admin` SET password = '{$newone}' WHERE id = {$id}";

            $this->excuteSQL($sql);
            return true;
        }
        return false;

    }

}
//adminAction
//$adminModel = new adminModel();
//$adminModel->addAdmin('sr@126.com','1212121','sr',1);
//$adminModel->updataTime();