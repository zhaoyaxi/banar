<?php
/**
 * 用户操作类
 * Date:8.3
 * Author:star
 *
 */
include "../backController/include.php";

class messageModel extends BaseModel{

	public function sendMessage1($oid){
        $result = $this->excuteSQL("SELECT * FROM lb_order WHERE id={$oid}");
        $destMobiles = $result[0]['phone'];
		$content = "尊敬的用户，您已支付成功，我们正在为您挑选最适合您的优质搬家师傅，请耐心等待。如有任何疑问，欢迎来电：400-880-7870。搬哪儿随时为您服务～";
        $this->send($destMobiles,$content);
		return true;
       
    }

	public function sendMessage2($oid,$did){
        $result1 = $this->excuteSQL("SELECT * FROM lb_order WHERE id={$oid}");
		$result2 = $this->excuteSQL("SELECT * FROM lb_driver WHERE id={$did}");
        $destMobiles = $result1[0]['phone'];
		$car = "小型面包车";
		if( $result1[0]['car_id'] == 2)
			$car = "金杯车";

		$content = "尊敬的用户，您预定".$result1[0]['startTime']."从".$result1[0]['startLocation']."出发的搬家将由".$result2[0]['name']."师傅（".$result2[0]['phone']."）驾驶".$car."为您服务，请耐心等待。如有疑问或搬运过程中遇到任何问题，欢迎来电：400-880-7870";
		//尊敬的用户，您预定5月21日下午5:30从XXX出发的搬家将由张师傅（18600078630）驾驶金杯车（小型面包车）为您服务，请耐心等待。如有疑问或搬运过程中遇到任何问题，欢迎来电
        $this->send($destMobiles,$content);
		$destMobiles = $result2[0]['phone'];
		$i_floorCount = $result2[0]['floorCount'];
		$i_toFloorCount = $result2[0]['toFloorCount'];
		$floorCount = "";
        $toFloorCount = "";
        if( $i_floorCount == 0)
			$floorCount = "有电梯";
		else
			$floorCount = "需搬".$floorCount."层";
		if( $i_toFloorCount == 0)
			$toFloorCount = "有电梯";
		else
			$toFloorCount = "需搬".$toFloorCount."层";
		$content = "尊敬的".$result2[0]['name']."师傅您好，搬哪儿已经为您派好订单：".$result1[0]['startTime']."从".$result1[0]['startLocation']."（".$floorCount."）到".$result1[0]['endLocation']."（".$toFloorCount."），请携带基本工具，着装得体，提前10分钟到达。搬家过程中有任何问题，请给我们来电：400-880-7870。";
        $this->send($destMobiles,$content);
		return true;
       
    }

	public function sendMessage3($oid){
		$result = $this->excuteSQL("SELECT * FROM lb_order WHERE id={$oid}");
        $destMobiles = $result[0]['phone'];
		$content ="尊敬的用户，您已完成搬家服务。感谢选择搬哪儿，如有疑问，欢迎来电：400-880-7870。搬哪儿随时为您服务～";
        $this->send($destMobiles,$content);
		
		$result = $this->excuteSQL("SELECT startLocation,endLocation,startTime, d.name name ,d.phone phone FROM lb_driver d,lb_order o ,lb_order_relation ore 
									WHERE  o.id={$oid} AND o.id = ore.order_id AND ore.driver_id = d.id");
        $destMobiles = $result[0]['phone'];
		$content ="尊敬的".$result[0]['name']."师傅你好，".$result[0]['startTime']."由".$result[0]['startLocation']."到".$result[0]['endLocation']."的搬家，顾客已经确认完成，我们将于当天为您打款，请注意查收。如有疑问，请咨询：400-880-7870。";
		//X师傅你好，5月21日下午5:30由XX到YY的搬家，顾客已经确认完成，我们将于当天为您打款，请注意查收。如有疑问，请咨询：400-880-7870。
        $this->send($destMobiles,$content);
		return true;
	}

	public function sendMessage4($oid){
        $result = $this->excuteSQL("SELECT real_price, d.name name ,d.phone phone FROM lb_driver d,lb_order o ,lb_order_relation ore 
									WHERE  o.id={$oid} AND o.id = ore.order_id AND ore.driver_id = d.id");
        $destMobiles = $result[0]['phone'];
		$content = $result1[0]['name']."师傅你好，搬哪儿已经为您打款".$result1[0]['real_price']."元，请注意查收。如有疑问，请咨询：400-880-7870。";

		//张师傅你好，搬哪儿已经为您的（支付方式）打款100元，请注意查收。如有疑问，请咨询：400-880-7870。
        $this->send($destMobiles,$content);
		return true;
       
    }

	public function sendMessage5($oid){
        $result = $this->excuteSQL("SELECT o.startTime,o.startLocation,d.phone FROM lb_driver d,lb_order o ,lb_order_relation ore WHERE  o.id={$oid} AND o.id = ore.order_id AND ore.driver_id = d.id");
        $destMobiles = $result[0]['phone'];
		$startTime = $result[0]['startTime'];
		$startTime = strtotime($startTime);
		$startTime = date("m月d日H:i");
		$startLocation = $result[0]['startLocation'];
		//尊敬的用户，您预约5月11日16点从XXX出发的搬家订单已支付成功。我们正在为您匹配搬家师傅，请耐心等待。如需帮助，请致电：400-880-7870。
		//温馨提示：
		//1、请您提前打包物品，精简包裹，以便司机师傅为您搬家；
		//2、贵重、易碎物品请随身携带，如需搬运请提前告知，并做好标示。
		//感谢选择搬哪儿。祝您生活愉快！
		$content = "尊敬的用户，您预约{$startTime}从{$startLocation}出发的搬家订单已支付成功。我们正在为您匹配搬家师傅，请耐心等待。如需帮助，请致电：400-880-7870。\r\n";
		$content .= "温馨提示：1、请您提前打包物品，精简包裹，以便司机师傅为您搬家；2、贵重、易碎物品请随身携带，如需搬运请提前告知，并做好标示。感谢选择搬哪儿。祝您生活愉快！";
        $this->send($destMobiles,$content);
		return true;
       
    }



	public function send($destMobiles,$content){
		

		$cust_code = '351201';									//账号
		$password = 'bne351201';						//密码
		$sp_code = '';										//扩展码
		//$destMobiles = '18811399342';		 						//手机号码，使用逗号隔开可以发送多个号码
		$url='http://112.5.125.188:8860/';												//URL地址
		$post_data = array();
		$post_data['cust_code'] = $cust_code;																	
		$post_data['destMobiles'] = $destMobiles;									
		$post_data['content'] =  $content;
		$post_data['sign'] = md5(urlencode($content.$password));								//签名

		$o="";
		foreach ($post_data as $k=>$v)
		{
			$o.= "$k=".urlencode($v)."&";
		}
		$post_data=substr($o,0,-1);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_URL,$url);
		//为了支持cookie
		curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$result = curl_exec($ch);
	}
}