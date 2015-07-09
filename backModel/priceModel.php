<?php
/**
 * 用户操作类
 * Date:8.3
 * Author:star
 *
 */
include "../backController/include.php";

class priceModel extends BaseModel{

    //改变价格
    public function changePrice($gettype,$startPrice,$startLength,$perPrice,$elevatorPrice){
        $int_startPrice = (int)($startPrice);
        $int_startLength = (int)($startLength);
        $int_perPrice = (int)($perPrice);
        $int_elevatorPrice = (int)($elevatorPrice);
        $result = $this->excuteSQL("UPDATE `lb_price` SET startPrice = ".$int_startPrice.",startLength = ".$int_startLength.",perPrice = ".$int_perPrice.",elevatorPrice = ".$int_elevatorPrice."  WHERE car_id = ".$gettype."");
        if( $result){
            return true;
        }

        return false;
    }

    //
    public function flashPrice($gettype){

        $result = $this->excuteSQL("SELECT * FROM `lb_price` WHERE car_id = ".$gettype."");
        return $result[0];
    }

    public function priceStan1($s_price){

        $result = $this->excuteSQL("UPDATE lb_price_standed SET s_price = '{$s_price}',state = 1 where id = 1");
        return $result[0];
    }

    public function priceStan2($s_per){

        $result = $this->excuteSQL("UPDATE lb_price_standed SET s_per = '{$s_per}',state = 2 where id = 1");
        return $result[0];
    }

    public function priceStan3($r_sta,$r_price,$r_per){

        $result = $this->excuteSQL("UPDATE lb_price_standed SET r_sta = '{$r_sta}',r_price = '{$r_price}',r_per = '{$r_per}',state = 3 where id = 1");
        return $result[0];
    }
}