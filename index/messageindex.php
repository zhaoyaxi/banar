<?php
include "../backController/include.php";
$cont = new BaseController();

$action = $cont->secParam("action");
switch($action){
    case "sendMessage1"://用户下订单
        $messageController = new messageController();
        $messageController->sendMessage1($cont->getParam("oid"));
        break;
	 case "sendMessage2"://
        $messageController = new messageController();
        $messageController->sendMessage2($cont->getParam("oid"),$cont->getParam("did"));
        break;
	 case "sendMessage3"://用户完成的时候
        $messageController = new messageController();
        $messageController->sendMessage3($cont->getParam("oid"));
        break;
	 case "sendMessage4"://
        $messageController = new messageController();
        $messageController->sendMessage4($cont->getParam("oid"));
        break;
}