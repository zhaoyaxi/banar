<?php
if(!isset($_SESSION)){  
           session_start();  
        } 
	if( !($_SESSION['login'] ==  1)){
		 header("Location:../err/rooterr.html");
	}
include "../backController/include.php";
$cont = new BaseController();

$action = $cont->secParam("action");
switch($action){
    case "login"://����
        $adminController = new adminController();
        $adminController->login($cont->getParam("identification"),$cont->getParam("password"));
        break;
	case "changePassword"://����
        $adminController = new adminController();
        $adminController->changePassword($cont->getParam("oldone"),$cont->getParam("newone"));
        break;
	case "addAdmin"://����
        $adminController = new adminController();
        $adminController->addAdmin($cont->getParam("adminEmail"),$cont->getParam("adminPassword"),$cont->getParam("adminName"),$cont->getParam("adminLevel"));
        break;
	case "deleteAdmin"://����
        $adminController = new adminController();
        $adminController->deleteAdmin($cont->getParam("id"));
        break;
	case "reBackAdmin"://����
        $adminController = new adminController();
        $adminController->reBackAdmin($cont->getParam("id"));
        break;
	case "adminAction"://����
        $adminController = new adminController();
        $adminController->adminAction($cont->getParam("type"));
        break;
	case "adminActionCerten"://����
        $adminController = new adminController();
        $adminController->adminActionCerten($cont->getParam("type"),$cont->getParam("id"));
        break;
	case "adminActionDriver"://����
        $adminController = new adminController();
        $adminController->adminActionDriver($cont->getParam("type"));
        break;
	 case "getAdmin"://����
        $adminController = new adminController();
        $adminController->getAdmin($cont->getParam("getAdminName"),$cont->getParam("getStatus"));
        break;
	case "changePrice"://����
        $priceController = new priceController();
        $priceController->changePrice($cont->getParam("gettype"),$cont->getParam("startPrice"),$cont->getParam("startLength"),$cont->getParam("perPrice"),$cont->getParam("elevatorPrice"));
        break;
	case "flashPrice"://����
        $priceController = new priceController();
        $priceController->flashPrice($cont->getParam("gettype"));
        break;
	case "priceStan1"://����
        $priceController = new priceController();
        $priceController->priceStan1($cont->getParam("s_price"));
        break;
	case "priceStan2"://����
        $priceController = new priceController();
        $priceController->priceStan2($cont->getParam("s_per"));
        break;
	case "priceStan3"://����
        $priceController = new priceController();
        $priceController->priceStan3($cont->getParam("r_sta"),$cont->getParam("r_price"),$cont->getParam("r_per"));
        break;
	case "driverRegister"://����
        $BackDriverController = new BackDriverController();
        $BackDriverController->driverRegister($cont->getParam("name"),$cont->getParam("phone"),$cont->getParam("level"),$cont->getParam("car_cate"),$cont->getParam("license"),$cont->getParam("city"),$cont->getParam("area"),$cont->getParam("little_area"),$cont->getParam("bank_number"),$cont->getParam("bank_name"),$cont->getParam("bank_type"),$cont->getParam("zhifubao_id"),$cont->getParam("zhifubao_name"),$cont->getParam("wechat_id"));
        break;
	case "changeDriver"://����
        $BackDriverController = new BackDriverController();
        $BackDriverController->changeDriver($cont->getParam("id"),$cont->getParam("name"),$cont->getParam("phone"),$cont->getParam("level"),$cont->getParam("car_cate"),$cont->getParam("license"),$cont->getParam("city"),$cont->getParam("area"),$cont->getParam("little_area"),$cont->getParam("bank_number"),$cont->getParam("bank_name"),$cont->getParam("bank_type"),$cont->getParam("zhifubao_id"),$cont->getParam("zhifubao_name"),$cont->getParam("wechat_id"));
        break;
	case "driverSearch"://����
        $BackDriverController = new BackDriverController();
        $BackDriverController->driverSearch($cont->getParam("se_name"),$cont->getParam("se_level"),$cont->getParam("se_car_cate"),$cont->getParam("se_city"),$cont->getParam("se_area"),$cont->getParam("se_little_area"));
        break;
	case "getDriverInfo"://����
        $BackDriverController = new BackDriverController();
        $BackDriverController->getDriverInfo($cont->getParam("id"));
        break;
	case "deleteDriver"://����
        $BackDriverController = new BackDriverController();
        $BackDriverController->deleteDriver($cont->getParam("id"));
        break;
	case "getDriverInfoFromOid"://����
        $BackDriverController = new BackDriverController();
        $BackDriverController->getDriverInfoFromOid($cont->getParam("id"));
        break;
	case "get_driver_lab"://����
        $BackDriverController = new BackDriverController();
        $BackDriverController->get_driver_lab($cont->getParam("id"));
        break;
	case "add_driver_lab"://����
        $BackDriverController = new BackDriverController();
        $BackDriverController->add_driver_lab($cont->getParam("id"),$cont->getParam("new_lab"));
        break;
	case "delete_driver_lab"://����
        $BackDriverController = new BackDriverController();
        $BackDriverController->delete_driver_lab($cont->getParam("id"));
        break;
	case "getOrderById"://����
        $BackOrderController = new BackOrderController();
        $BackOrderController->getOrderById($cont->getParam("id"));
        break;
	case "getOrderDetailById"://����
        $BackOrderController = new BackOrderController();
        $BackOrderController->getOrderDetailById($cont->getParam("id"));
        break;
	case "ordercomplect"://����
        $BackOrderController = new BackOrderController();
        $BackOrderController->ordercomplect($cont->getParam("id"));
        break;
	case "orderfix"://����
        $BackOrderController = new BackOrderController();
        $BackOrderController->orderfix($cont->getParam("oid"),$cont->getParam("did"));
        break;
	case "cancelOrder"://����
        $BackOrderController = new BackOrderController();
        $BackOrderController->cancelOrder($cont->getParam("id"));
        break;
	case "orderFresh"://����
        $BackOrderController = new BackOrderController();
        $BackOrderController->orderFresh($cont->getParam("state"));
        break;
	case "orderFresh1"://����
        $BackOrderController = new BackOrderController();
        $BackOrderController->orderFresh1($cont->getParam("state"));
        break;
	case "getCancel"://����
        $BackOrderController = new BackOrderController();
        $BackOrderController->getCancel();
        break;
	case "getCard"://����
        $BackOrderController = new BackOrderController();
        $BackOrderController->getCard();
        break;
	case "changeCard"://����
        $BackOrderController = new BackOrderController();
        $BackOrderController->changeCard($cont->getParam("card"));
        break;
	case "getCommentList"://����
        $commentController = new commentController();
        $commentController->getCommentList($cont->getParam("driver_id"));
        break;
	case "getLab"://����
        $commentController = new commentController();
        $commentController->getLab($cont->getParam("id"));
        break;
	case "getCommentSum"://����
        $commentController = new commentController();
        $commentController->getCommentSum($cont->getParam("id"));
        break;
	case "intiComment"://����
        $commentController = new commentController();
        $commentController->intiComment($cont->getParam("id"));
        break;
	case "intilab"://����
        $commentController = new commentController();
        $commentController->intilab($cont->getParam("id"));
        break;
	case "intiAdmin"://����
        $commentController = new commentController();
        $commentController->intiAdmin($cont->getParam("id"));
        break;
	
		
}

//$adminController = new adminController();
//$adminController->login('star@126.com','1212121');
//$adminController = new adminController();
//$adminController->addAdmin('sr5@126.com','1212121','srom',1);
//$priceController = new priceController();
//$priceController->flashPrice(1);
//$priceController = new priceController();
//$priceController->changePrice(1,'13','12','12','12');
//$BackDriverController = new BackDriverController();
//$BackDriverController->driverRegister('13','12',1,2,'12','12','13','12','12','12','13','12','12','12','13','12','12','12');
//$BackDriverController = new BackDriverController();
//$BackDriverController->driverSearch("",0,2,0,0,0);
//$BackOrderController = new BackOrderController();
//$BackOrderController->getOrderById(1);
 //$BackOrderController = new BackOrderController();
 //$BackOrderController->getOrderListByState(2);
 //$BackOrderController = new BackOrderController();
 //$BackOrderController->orderFresh(0);
//$BackDriverController = new BackDriverController();
  //      $BackDriverController->getDriverInfoFromOid(1);

//   $commentController = new commentController();
//        $commentController->getCommentList(1);

//$BackOrderController = new BackOrderController();
//$BackOrderController->ordercomplect();

//$adminController = new adminController();
//$adminController->getAdmin('',0);
//$adminController = new adminController();
//$adminController->adminAction(1);
//$adminController = new adminController();
//$adminController->adminActionDriver(1);

//$commentController = new commentController();
//$commentController->getCommentList(18);
//$commentController = new commentController();
//        $commentController->intilab(7);
//$adminController = new adminController();
  //      $adminController->adminActionCerten(1,1);