<?php
/**
 * Created by PhpStorm.
 * User: niuwei
 * Date: 15/5/17
 * Time: 12:33
 */
class BackDriverController extends BaseController {


    public $status = null;
    public $error = null;
    public $datas = null;
    /**
     * 获取某一个司机对应的前几条评论降序排列
     * @param $driver_id
     * @param $count
     * @return 返回前$count条评论信息
     */
    public function getDriverCommentInfo($driver_id, $count) {
        $driverModel = new BackDriverModel();
        echo json_encode($driverModel->getDriverCommentInfo($driver_id, $count));
    }

    /**
     * 未测试
     * 通过driver_id 获取司机的信息
     * @param $driverId 司机的id
     * @return 司机的注册信息 + 接单数 + 评价的平均值
     */
    public function getDriverInfo($driverId) {
        $driverModel = new BackDriverModel();
        $this->datas =$driverModel->getDriverInfo($driverId);
        $this->error = 0;
        $this->status = 1;
        echo json_encode($this);
    }

	//删除司机
	public function deleteDriver($driverId) {
        $driverModel = new BackDriverModel();
        $this->datas =$driverModel->deleteDriver($driverId);
        $this->error = 0;
        $this->status = 1;
        echo json_encode($this);
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
     * @return 返回数据
     */
    public function driverRegister($name, $phone,$level, $car_cate,
                                   $license,$city,$area,$little_area,
                                   $bank_number, $bank_name, $bank_type, $zhifubao_id, $zhifubao_name,
                                   $wechat_id) {
        $driverModel = new BackDriverModel();
        $driverModel->driverRegister($name, $phone,$level, $car_cate,
            $license,$city,$area,$little_area,
            $bank_number, $bank_name, $bank_type, $zhifubao_id, $zhifubao_name,
            $wechat_id);
        $this->error = 0;
        $this->status = 1;
        echo json_encode($this);
    }

    public function changeDriver($id,$name, $phone,$level, $car_cate,
                                 $license,$city,$area,$little_area,
                                 $bank_number, $bank_name, $bank_type, $zhifubao_id, $zhifubao_name,
                                 $wechat_id) {
        $driverModel = new BackDriverModel();
        $driverModel->changeDriver($id, $name, $phone,$level, $car_cate,
            $license,$city,$area,$little_area,
            $bank_number, $bank_name, $bank_type, $zhifubao_id, $zhifubao_name,
            $wechat_id);
        $this->error = 0;
        $this->status = 1;
        echo json_encode($this);
    }

    public function driverSearch($se_name,$se_level,$se_car_cate,$se_city,$se_area,$se_little_area){
        $driverModel = new BackDriverModel();
        $this->datas = $driverModel->driverSearch($se_name,$se_level,$se_car_cate,$se_city,$se_area,$se_little_area);
        $this->error = 0;
        $this->status = 1;
        echo json_encode($this);
    }

    public function getDriverInfoFromOid($id){
        $driverModel = new BackDriverModel();
        $this->datas = $driverModel->getDriverInfoFromOid($id);
        $this->error = 0;
        $this->status = 1;
        echo json_encode($this);
    }

	public function get_driver_lab($id){
        $driverModel = new BackDriverModel();
        $this->datas = $driverModel->get_driver_lab($id);
        $this->error = 0;
        $this->status = 1;
        echo json_encode($this);
    }

	public function add_driver_lab($id,$new_lab){
        $driverModel = new BackDriverModel();
        $this->datas = $driverModel->add_driver_lab($id,$new_lab);
        $this->error = 0;
        $this->status = 1;
        echo json_encode($this);
    }

	public function delete_driver_lab($id){
        $driverModel = new BackDriverModel();
        $this->datas = $driverModel->delete_driver_lab($id);
        $this->error = 0;
        $this->status = 1;
        echo json_encode($this);
    }
}