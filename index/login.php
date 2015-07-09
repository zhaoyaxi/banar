<?php

include "../backController/include.php";
$cont = new BaseController();

$action = $cont->secParam("action");
switch($action){
    case "login":
        $adminController = new adminController();
        $adminController->login($cont->getParam("identification"),$cont->getParam("password"));
        break;
}

//$adminController = new adminController();
//$adminController->login('lai','1111111');