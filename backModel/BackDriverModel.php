<?php
/**
 * Created by PhpStorm.
 * User: niuwei
 * Date: 15/5/17
 * Time: 12:33
 * 司机接口
 */
include "../backController/include.php";
class BackDriverModel extends BaseModel {

    /**
     * 未测试
     * 获取某一个司机对应的前几条评论降序排列
     * @param $driver_id
     * @param $count
     * @return 返回前$count条评论信息
     */
    public function getDriverCommentInfo($driver_id, $count) {
        $sql = "select * from lb_comment where driver_id = {$driver_id} order by commentTime desc limit {$count}";
        $data = $this->excuteSQL($sql);
        return $data;
    }

    /**
     * 未测试
     * 通过driver_id 获取司机的信息
     * @param $driverId 司机的id
     * @return 司机的注册信息 + 接单数 + 评价的平均值
     */
    public function getDriverInfo($driverId) {
        //司机信息
        $sql = "select * from lb_driver where id={$driverId}";
        $driver_data['info'] = $this->excuteSQL($sql);
        $driver_data['info'] = $driver_data['info'][0];
        //司机订单星星的平均值
        $driver_data['star'] = $this->excuteSQL("select avg(star) as star from lb_comment where driver_id = {$driverId}");
        $driver_data['star'] = $driver_data['star'][0]['star'];
        //司机的接单数
        $driver_data['orderCount'] = $this->excuteSQL("select count(order_id) as orderCount from lb_order_relation where driver_id = {$driverId}");
        $driver_data['orderCount'] = $driver_data['orderCount'][0]['orderCount'];
        return $driver_data;
    }

    /**
     * 未测试
     * 司机注册
     * @param $name
     * @param $phone
     * @param $car_cate
     * @param $area
     * @param $license
     * @param $bank_number
     * @param $bank_name
     * @param $bank_type
     * @return 返回司机id
     */
    public function driverRegister($name, $phone,$level, $car_cate,
                                   $license,$city,$area,$little_area,
                                   $bank_number, $bank_name, $bank_type, $zhifubao_id, $zhifubao_name,
                                   $wechat_id) {
        $sql = "insert into lb_driver (name, phone,level, car_cate,license,city,area,little_area,bank_number, bank_name, bank_type, zhifubao_id, zhifubao_name,wechat_id)  values ('{$name}','{$phone}',".$level.",".$car_cate.",'{$license}','{$city}','{$area}','{$little_area}','{$bank_number}','{$bank_name}','{$bank_type}','{$zhifubao_id}','{$zhifubao_name}','{$wechat_id}')";
        $data = $this->excuteSQL($sql);
        $sql = "select * from lb_driver where name = '{$name}' AND  phone = '{$phone}'";
        $data = $this->excuteSQL($sql);
        $driver_id = $data[0]['id'];

        if(!isset($_SESSION)){
            session_start();
        }
        $admin_name = $_SESSION['name'];
        $sql = "insert into lb_admin_action_driver (admin_name,type,driver_name,driver_id) values ('{$admin_name}',1,'{$name}', {$driver_id})";
        $this->excuteSQL($sql);

        return true;
    }

    public function changeDriver($id, $name, $phone,$level, $car_cate,
                                 $license,$city,$area,$little_area,
                                 $bank_number, $bank_name, $bank_type, $zhifubao_id, $zhifubao_name,
                                 $wechat_id) {

        $sql = "update lb_driver
				set name = '{$name}',
					phone = '{$phone}',
					level = {$level},
					car_cate = {$car_cate},
					license = '{$license}',
					city = '{$city}',
					area = '{$area}',
					little_area =  '{$little_area}',
					bank_number = '{$bank_number}',
					bank_name = '{$bank_name}',
					bank_type = '{$bank_type}',
					zhifubao_id = '{$zhifubao_id}',
					zhifubao_name = '{$zhifubao_name}',
					wechat_id = '{$wechat_id}' 
					where id={$id}";
        $this->excuteSQL($sql);

        if(!isset($_SESSION)){
            session_start();
        }
        $admin_name = $_SESSION['name'];
        $sql = "insert into lb_admin_action_driver (admin_name,type,driver_name,driver_id) values ('{$admin_name}',2,'{$name}', {$id})";
        $this->excuteSQL($sql);

        return true;
    }

    /**
     * 未测试
     * 获取司机列表,按照地理位置排序
     */
    public function getDriverList($orderBy='area', $isDesc=true) {
        if ($isDesc)
            $sql = "select * from lb_driver order by {$orderBy} desc";
        else
            $sql = "select * from lb_driver order by {$orderBy} asc";
        $data = $this->excuteSQL($sql);
        return $data;
    }

    /**
     * 获取更加详细的司机列表信息
     * getDriverList()信息 + star(平均星星数) + count(接单数)
     * @param $orderBy='area' 排序
     * @param $isDesc=true 顺序
     * @return 数据数组
     */
    public function getDriverListDetail($orderBy='area', $isDesc=true) {
        if ($isDesc) {
            $sql = "select lb_driver.*, avg(star) as star, count(order_id) as count from lb_driver left join lb_comment ON lb_comment.driver_id = lb_driver.id group by lb_driver.name order by {$orderBy} DESC ";
        } else {
            $sql = "select lb_driver.*, avg(star) as star, count(order_id) as count from lb_driver left join lb_comment ON lb_comment.driver_id = lb_driver.id group by lb_driver.name order by {$orderBy} ASC ";
        }
        $data = $this->excuteSQL($sql);
        return $data;
    }

    /**
     * 未测试
     * 删除司机
     * @param $driver_id
     * @return 删除的id
     */
    public function deleteDriver($driver_id) {
        $sql = "delete from lb_driver where id={$driver_id}";
        return $this->excuteSQL($sql);
    }

    public function getDriverInfoFromOid($order_id) {
        $sql = "SELECT d.id id,d.name name,d.phone phone,d.license license
				FROM lb_driver d,lb_order_relation orr
				where d.id = orr.driver_id AND orr.order_id = {$order_id}";
        return $this->excuteSQL($sql);
        //echo  json_encode($this->excuteSQL($sql));
    }

    /**
     * 修改司机的信息
     * @param $driver_id
     * @param $name
     * @param $phone
     * @param $car_cate
     * @param $area
     * @param $license
     * @param $bank_number
     * @param $bank_name
     * @param $bank_type
     * @param $wechat_id
     * @param $zhifubao_id
     * @param $zhifubao_name
     * @return driver_id
     */
    public function updateDriver($driver_id, $name, $phone, $car_cate, $area,
                                 $license, $bank_number, $bank_name, $bank_type,
                                 $wechat_id, $zhifubao_id, $zhifubao_name) {
        $sql = "update lb_driver set where id={$driver_id}";
        return $this->excuteSQL($sql);
    }

    //对应 drivelist加载driver信息
    public function driverSearch($se_name,$se_level,$se_car_cate,$se_city,$se_area,$se_little_area){

        $key = 0;
        $sql = "SELECT ld.id id,ld.name name,ld.phone phone FROM lb_driver ld ,lb_driver_lab ldl";
		
        if($se_name != ""){
            $sql = $sql." WHERE dri_lab = '{$se_name}' AND driver_id = ld.id ";
            $key = 1;
        }
        if($se_level != 0){
            if($key == 0)
                $sql = $sql." WHERE level = ".$se_level;
            else
                $sql = $sql." AND level = ".$se_level;
            $key = 1;
        }
        if($se_car_cate != 0){
            if($key == 0)
                $sql = $sql." WHERE car_cate = ".$se_car_cate;
            else
                $sql = $sql." AND car_cate = ".$se_car_cate;
            $key = 1;
        }
        if($se_city != 0){
            if($key == 0)
                $sql = $sql." WHERE city = ".$se_city;
            else
                $sql = $sql." AND city = ".$se_city;
            $key = 1;
        }
        if($se_area != 0){
            if($key == 0)
                $sql = $sql." WHERE area = ".$se_area;
            else
                $sql = $sql." AND area = ".$se_area;
            $key = 1;
        }
        if($se_little_area != 0){
            if($key == 0)
                $sql = $sql." WHERE little_area = ".$se_little_area;
            else
                $sql = $sql." AND little_area = ".$se_little_area;
            $key = 1;
        }
        //echo $sql;
		$sql .= " GROUP BY id";
        $result = $this->excuteSQL($sql);
        return $result;
        //echo json_encode($result);
    }

	public function get_driver_lab($id){
		$sql = "select * from lb_driver_lab where driver_id={$id}";
		$data = $this->excuteSQL($sql);
		return $data;
	}

	public function add_driver_lab($id,$new_lab){
		$sql = "insert into lb_driver_lab (driver_id,dri_lab) values ({$id},'{$new_lab}')";
		$data = $this->excuteSQL($sql);
		return $data;
	}

	public function delete_driver_lab($id){
		$sql = "DELETE FROM lb_driver_lab WHERE id = {$id} ";
		$data = $this->excuteSQL($sql);
		return $data;
	}
}

//$b = new BackDriverModel();
//$b->getDriverInfoFromOid(1);
//$b = new BackDriverModel();
//$b->driverSearch("刘德华",0,0,0,0,0);