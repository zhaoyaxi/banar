<?php
/**
* 价格逻辑类
* Author: star
* Date: 5.16
*/  
include "include.php";
class priceController extends BaseController{

	public $status = null;
	public $error = null;
	public $datas = null;
	
	public function changePrice($gettype,$startPrice,$startLength,$perPrice,$elevatorPrice){
		if(!$gettype ||!$startPrice||!$startLength||!$perPrice||!$elevatorPrice){
			$this->status = 0;
			$this->error = '信息不全';
			echo json_encode($this);
			return;
		}
		$price = new priceModel();
		if($price->changePrice($gettype,$startPrice,$startLength,$perPrice,$elevatorPrice)){
			$this->error = 0;
			$this->status = 1;
		}else{
			$this->error = "信息有误";
			$this->status = 0;
		}
		echo json_encode($this);
	}

	public function flashPrice($gettype){
		if(!$gettype){
			$this->status = 0;
			$this->error = '信息不全';
			echo json_encode($this);
			return;
		}
		$price = new priceModel();
		$this->datas = $price->flashPrice($gettype);
		$this->error = 0;
		$this->status = 1;
		
		echo json_encode($this);
	}

	public function priceStan1($s_price){
		if(!$s_price){
			$this->status = 0;
			$this->error = '信息不全';
			echo json_encode($this);
			return;
		}
		$price = new priceModel();
		$this->datas = $price->priceStan1($s_price);
		$this->error = 0;
		$this->status = 1;
		
		echo json_encode($this);
	}

	public function priceStan2($s_per){
		if(!$s_per){
			$this->status = 0;
			$this->error = '信息不全';
			echo json_encode($this);
			return;
		}
		$price = new priceModel();
		$this->datas = $price->priceStan2($s_per);
		$this->error = 0;
		$this->status = 1;
		
		echo json_encode($this);
	}

	public function priceStan3($r_sta,$r_price,$r_per){
		if(!$r_sta){
			$this->status = 0;
			$this->error = '信息不全';
			echo json_encode($this);
			return;
		}
		$price = new priceModel();
		$this->datas = $price->priceStan3($r_sta,$r_price,$r_per);
		$this->error = 0;
		$this->status = 1;
		
		echo json_encode($this);
	}

}