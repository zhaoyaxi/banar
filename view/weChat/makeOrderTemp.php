<!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width,minimum-scale=1.0,initial-scale=1,maximum-scale=1.0,user-scalable=no" />
    <title>下订单</title>

    <!-- 新 Bootstrap 核心 CSS 文件 -->
	<link href="../../css/mobiscroll_002.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/foundation.min.css" />
    <link rel="stylesheet" type="text/css" href="../../css/jquery-ui.css" />


    <script src="../../js/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="../../js/jquery-1.8.3.min.js"></script>
    <script src="../../js/foundation.min.js"></script>
    <script src="../../js/modernizr.js"></script>
    <script type="text/coffeescript" src="../../js/common.js.coffee"></script>
    <script src="../../js/coffee-script.js"></script>
    <script src="../../js/jquery-ui-datepicker.js"></script>
    <script src="http://api.map.baidu.com/api?v=2.0&ak=bBzb0kqzC4qcZGV8M5igG9iD"></script>
    <!--<script src="http://webapi.amap.com/maps?v=1.3&key=8da6fcbedbc401690876869f67d98890"></script>-->
	<script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=9dade0652f322101fcea7b28d3b5d52b"></script>
    <script src="../../laydate/laydate.js"></script>

    <!--  时间选择器  -->
    <script src="../../js/mobiscroll_002.js"></script>
	<script src="../../js/mobiscroll_004.js"></script>
	<script src="../../js/mobiscroll.js"></script>
	<script src="../../js/mobiscroll_003.js"></script>
	<script src="../../js/mobiscroll_005.js"></script>
	

    <style>
        body {
            background-color: #F3F3F3;
            margin-top: 0;
        }
        .all {
            margin-top: 4%;
            margin-bottom: 10%;
            padding-bottom: 20%;
        }
        .start-end {
            background-color: #ffffff;
        }

        .locationText {
            height: 100%;
            width: 100%;
            font-size: 0.8em;
            border: 0px;
        }
        .floor {
            margin-left: 0;
            margin-right: 0;
        }


        .fixed-footer{
            background:lightblue;
            color:#333333;
            text-align:center;
            border:2px solid #999999; padding:5px;
            width: 100%;
            position:fixed; bottom:0; left:0;
            margin-left:0;
            _position: absolute; /* position fixed for IE6 */
            _top:expression(documentElement.scrollTop+documentElement.clientHeight-this.clientHeight-4);
            z-index:4;
        }

        .make-order {
            margin: 0 auto;
            width: 100%;
            display: block;
        }
        .font_size{
            font-size: 12px;
            color: #808080;
        }

		.dwwc table tbody tr td{
			padding:0;
		}
		

    </style>
	
</head>
<body>
    <?php
        include "../../common/WeChatAuth.php";
        $code = $_GET['code'];
        $weChatAuth = new WeChatAuth();
        $data = $weChatAuth->getOpenId($code);
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['openid'] = $data['openid'];//保存session
    ?>

    <div id="l-map" hidden></div>

    <div class="row small all" style="max-width: 82.5rem;margin-top:0.5rem;border">
        <!--起点终点-->
        <div class="panel start-end"
			 style="padding-top: 0.4rem; margin-bottom: 0.5rem;border:0;padding-bottom: 0;
				    border-bottom: 0px solid silver;border-radius: 0px;">
			<div class="small-11 " style="margin-left:auto;margin-right:auto;outline:none;box-shadow:none;">
				<!--起点-->
				<div class="row" style="height: 50px;border-radius: 5px;padding: 0">
					<div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
						<button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/startIcon.png) no-repeat;margin: auto">
						</button>
					</div>
					<div class="small-10 column" style="height: 100%;border-bottom: 1px solid #e3e3e3">
						<input placeholder="起点  ( 暂支持北京地区 )" id="startLocation" class="locationText">
					</div>
				</div>

				<!--终点-->
				<div class="row" style="height: 50px;border-radius: 5px;padding: 0">
					<div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
						<button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/endIcon.png) no-repeat;margin: auto">
						</button>
					</div>
					<div class="small-10 column" style="height: 100%;border-bottom: 1px solid #e3e3e3">
						<input  placeholder="目的地  ( 暂不支持大型家具搬运 )" id="endLocation"  class="locationText">
					</div>
				</div>

				<!--选择楼层-->
				<div class="row" style="margin-top: 20px">
					<div class="small-11" style="margin-left:auto;margin-right:auto;">
						<div class="small-6 column" style="margin-right: 0">
							<select name="startFloor" id="startFloor" onchange="calculateFloorPrice();" style="  background-color:white;">
								<option value="0" selected="selected">起点楼层</option>
								<option value="1">不需搬运0元</option>
                                <option value="8">有电梯搬运10元</option>
								<option value="2">无电梯搬一层 10元</option>
								<option value="3">无电梯搬二层 20元</option>
								<option value="4">无电梯搬三层 30元</option>
								<option value="5">无电梯搬四层 40元</option>
								<option value="6">无电梯搬五层 50元</option>
                                <option value="7">无电梯搬六层 60元</option>
							</select>
						</div>
						<div class="small-6 column" style="margin-left: 0">
							<select name="endFloor" id="endFloor" onchange="calculateFloorPrice();"  style="  background-color:white;">
								<option value="0" selected="selected">终点楼层</option>
                                <option value="1">不需搬运0元</option>
                                <option value="8">有电梯搬运10元</option>
                                <option value="2">无电梯搬一层 10元</option>
                                <option value="3">无电梯搬二层 20元</option>
                                <option value="4">无电梯搬三层 30元</option>
                                <option value="5">无电梯搬四层 40元</option>
                                <option value="6">无电梯搬五层 50元</option>
                                <option value="7">无电梯搬六层 60元</option>
							</select>
						</div>
					</div>
				</div>
            </div>
        </div>

        <div class="panel start-end"
             style="padding-top: 0.4rem; margin-bottom: 0.5rem;border:0;
				    border-bottom: 0px solid silver;border-radius: 0px;">
            <div class="small-11 " style="margin-left:auto;margin-right:auto;outline:none;box-shadow:none;">

                <!--选择车型-->
				<div class="row">
					<div class="small-6 column" style="text-align: center">
						<div class="small">
                            <button id="microbus_not_selected" class=""
                                    style="background: url(../../img/banar_btn_vehicle_xm_off1.png) no-repeat;
								height: 49px;width: 96px; margin: 0 auto"/>
                            <button id="microbus_selected" class="hidden"
                                    style="background: url(../../img/banar_btn_vehicle_xm_on.png) no-repeat;
								height: 49px;width: 96px; margin: 0 auto"/>
						</div>
                        <div>
                            <span style="color: #FF6501; font-size: 0.8em">小面</span>
                        </div>
					</div>
					<div class="small-6 column" style="text-align: center">
						<div class="small">
                            <button id="golden_cup_not_selected" class=""
                                    style="background: url(../../img/banar_btn_vehicle_jb_off1.png) no-repeat;
								height: 49px;width: 96px; margin: 0 auto"
                                />
                            <button id="golden_cup_selected" class="hidden"
                                    style="background: url(../../img/banar_btn_vehicle_jb_on.png) no-repeat;
								height: 49px;width: 96px; margin: 0 auto"
                                />
						</div>
                        <div>
                            <span style="color: #FF6501; font-size: 0.8em">金杯</span>
                        </div>
					</div>
				</div>


				<!--车型选择-->
				<div class="row">
					<div class="small" style="text-align: center">
						<span id="carName" style="font-size: 0.8em;color: black;margin: auto;"></span>
						<span id="dimension" style="font-size: 0.8em;color: black;margin: auto;">
						</span>
					</div>
					<div class="small" style="text-align: center">
						<span id="startCarPrice" style="font-size: 0.8em;color: #000000;font-weight: bold;margin: auto;">

						</span>
						<span id="afterCarPrice" style="font-size: 0.8em;color: #000000;margin: auto;">

						</span>
						<span id="carrying" hidden="hidden" style="font-size: 10px;color: #B1B4BB;margin: auto;">
							载重:10000公斤
						</span>
					</div>
				</div>
			</div>

        </div>

        <!--时间、电话、姓名-->
        <div class="panel start-end" 
			 style="padding-top: 0.4rem;border:0;
					border-top: 0px solid silver;
					border-bottom: 0px solid silver;
					border-radius: 0px;margin-bottom: 20%">
            <!--时间-->
			<div class="small-11 " style="margin-left:auto;margin-right:auto;outline:none;box-shadow:none;">
				<div class="row" style="height: 50px;border-radius: 5px;padding: 0">
					<div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
						<button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/time.png) no-repeat;margin: auto;height: 48px">
						</button>
					</div>
					<div class="small-10 column" style="height: 100%;border-bottom: 1px solid #e3e3e3;">
						<input class="locationText" placeholder="什么时候搬" readonly="readonly" name="appDateTime" id="appDateTime"
                               style="background: white;height: 100%;border:0px;outline:none;box-shadow:none;display: block;">
					</div>
				</div>

				<!--姓名-->
				<div class="row" style="height: 50px;border-radius: 5px;padding: 0">
					<div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
						<button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/custorm_name.png) no-repeat;margin: auto;height: 48px">
						</button>
					</div>
					<div class="small-10 column" style="height: 100%;border-bottom: 1px solid #e3e3e3">
						<input  placeholder="怎么称呼您" id="name" class="locationText">
					</div>
				</div>

				<!--电话-->
				<div class="row" style="height: 50px;border-radius: 5px;padding: 0">
					<div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
						<button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/phone.png) no-repeat;margin: auto">
						</button>
					</div>
					<div class="small-10 column" style="height: 100%;border-bottom: 1px solid #e3e3e3">
						<input  placeholder="您的电话号码" id="phone" class="locationText">
					</div>
				</div>

				<!--捎句话-->
				<div class="row" style="height: 50px;border-radius: 5px;padding: 0">
					<div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
						<button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/shaojuhua.png) no-repeat;margin: auto">
						</button>
					</div>
					<div class="small-10 column" style="height: 100%;border-bottom: 1px solid #e3e3e3">
						<input  placeholder="给司机捎句话，如物品类型和数量" id="message" class="locationText">
					</div>
				</div>
			</div>
        </div>


    <!--结束标签-->
    </div>

    <!--浮动文本-->
    <div class="fixed-footer" style="background:white;border:0;
					border-top: 0px solid silver;padding-top:0;padding-left:0;padding-right:0;">
        <div style="height:9px;background-color:#F3F3F3;margin-left:0;margin-right:0;">
        </div>
        <div class="row make-order" style="width:100%;">

            <div class="small-4 column" style="">
                <div class="small-3" style="margin-left: 13%;text-align: center;">
                    <div class="row">
                        <span class="font_size" style="color: silver;">行驶里程</span>
                    </div>
                    <div class="row" style="text-align: center;">
                        <span id="distance" class="font_size" style="color: #808080;">0</span>
                        <span class="font_size" style="color: silver">公里</span>
                    </div>
                </div>

            </div>

            <div class="small-4 column" style="">
                <div class="row ">
                    <span class="font_size" style="color: silver;">最终费用</span>
                </div>
                <div class="row">
                    <span class="font_size" style="color: silver">￥</span>
                    <span class="font_size" id="money" style="color: #808080">0</span>
                </div>

            </div>

            <div class="small-4 column" style="text-align: right;">
                <div class="small-3" style="float:right;margin-right: 13%;text-align: center;">
                    <div class="row">
                        <span class="font_size" style="color: silver;">已经优惠</span>
                    </div>
                    <div class="row" style="text-align: center;">
                        <span class="font_size" style="color: silver">￥</span>
                        <span class="font_size" id="coupons_money" style="color: #808080">0</span>
                    </div>
                </div>
            </div>

        </div>
        <button type="button" onclick="confirmOrder();" class="btn btn-primary btn-lg make-order"
                style="width:94%;background-color:#FF8A02;
				      padding: 5px 16px;
					  font-size: 20px;
					  line-height: 1;
					  border-radius: 15px;
					  border: 0;
					  font-weight: bold;
					  margin-left:3%;
					  margin-right:3%;">好了</button>
    </div>
    <div id="datePlugin"></div>
</body>

<script>
    var carCate = 0;
    var mbDimension ='';//面包车体积
    var mbCarrying ='';//面包车载重
    var mbStartMoney = 0;//起步价格
    var mbStartKm = 0;//起步公里
    var mbPerKm = 5;//每公里价格
    var mbStartPrice = '';//面包车起步价格
    var mbAfterPrice = '';//面包车每公里价格

    var jbDimension = '';//金杯车体积
    var jbCarrying ='';//金杯车载重
    var jbStartPrice = '';//金杯车起步价格
    var jbStartMoney = 0;//起步价格
    var jbStartKm = 0;//起步公里
    var jbPerKm = 0;//每公里价格
    var jbAfterPrice = '';//金杯车每公里价格

    var floorPrice = 10;//楼层价格
    var startFloorPrice = 0;//起点楼层
    var endFloorPrice = 0;//终点楼层

    var priceDistance = 0;
    var money = 0;


    //提前加载
    window.onload = function () {
        getPrice();
        getCouponsPrice();
		
    }

	//时间选择器
	$(document).ready(function () {
			var currYear = (new Date()).getFullYear();
            var currMonth = (new Date()).getMonth();
			var start_interval = 7200000;
			var end_interval = 1296000000;
			var nowDate = new Date();
			var opt={};
			opt.date = {preset : 'date'};
			opt.datetime = {preset : 'datetime'};
			opt.time = {preset : 'time'};
			opt.default = {
				theme: 'android-ics light', //皮肤样式
		        display: 'modal', //显示方式 
		        mode: 'scroller', //日期选择模式
				dateFormat: 'yyyy-mm-dd',
				lang: 'zh',
				showNow: true,
				nowText: "今天",
		        startYear: currYear, //开始年份
		        endYear: currYear, //结束年份
                height: 45,
                width: 90,
                rows: 3,
				stepMinute: 30,
				minDate: new Date(nowDate.setTime(nowDate.getTime() + start_interval)),
				maxDate: new Date(nowDate.setTime(nowDate.getTime() + end_interval))
			};

		  	$("#appDate").mobiscroll($.extend(opt['date'], opt['default']));
		  	var optDateTime = $.extend(opt['datetime'], opt['default']);
		  	var optTime = $.extend(opt['time'], opt['default']);
		    $("#appDateTime").mobiscroll(optDateTime).datetime(optDateTime);
		    $("#appTime").mobiscroll(optTime).time(optTime);
			$('.dwbg').css('margin-left','10%');
			/*$('#startLocation,#endLocation').change(function(){
				calculateDistance();
			});*/
			
    });

	$('#appDateTime').click(function (){
		alert(1);
		//setTimeout("alert('5 seconds!')",5000);
	});

	function changeCss(){
		$('.dwbg').css('margin-left','10%');
	}

	//
	
    //选择小面
    $("#microbus_not_selected").click(function(){
        selectXMCar();
    });

    function selectXMCar() {
        $('#golden_cup_selected').addClass('hidden');
        $('#golden_cup_not_selected').removeClass('hidden');
        $('#microbus_selected').removeClass('hidden');
        $('#microbus_not_selected').addClass('hidden');
        carCate = 1;
        $('#carrying').html(mbCarrying);
        $('#dimension').html(mbDimension);
        $('#startCarPrice').html(mbStartPrice);
        $('#afterCarPrice').html(mbAfterPrice);
        //$('#carName').html("小面");
        //计算费用
        //alert("起点楼层价格"+startFloorPrice+",终点楼层价格"+endFloorPrice+",距离"+parseInt(priceDistance)+",起步价"+mbStartMoney+", 每公里"+mbPerKm);
        selectXMPrice();
        $('#carHint').addClass('hidden');
    }

    function selectXMPrice() {
        money = startFloorPrice + endFloorPrice;
		mbPerKm = 5;
        if (parseInt(priceDistance) > mbStartKm) {
            money += parseInt((parseInt(priceDistance) - mbStartKm) * mbPerKm + parseInt(mbStartMoney));
        } else {
            money += parseInt(mbStartMoney);
        }
        money -= parseInt(couponsPrice);
        $('#money').html(money);
    }

    //选择金杯
    $("#golden_cup_not_selected").click(function(){
        selectJBCar();
    });

    function selectJBCar() {
        $('#golden_cup_selected').removeClass('hidden');
        $('#golden_cup_not_selected').addClass('hidden');
        $('#microbus_selected').addClass('hidden');
        $('#microbus_not_selected').removeClass('hidden');
        carCate = 2;
        $('#carrying').html(jbCarrying);
        $('#dimension').html(jbDimension);
        $('#startCarPrice').html(jbStartPrice);
        $('#afterCarPrice').html(jbAfterPrice);
        //$('#carName').html("金杯");
        //计算费用
        //alert("起点楼层价格"+startFloorPrice+",终点楼层价格"+endFloorPrice+",距离"+parseInt(priceDistance)+",起步价"+jbStartMoney+", 每公里"+jbPerKm);
        selectJBPrice();
        $('#carHint').addClass('hidden');
    }

    function selectJBPrice() {
        money = startFloorPrice + endFloorPrice;
		mbPerKm = 6;
        if (parseInt(priceDistance) > jbStartKm) {
            money += parseInt((parseInt(priceDistance) - jbStartKm) * jbPerKm + parseInt(jbStartMoney));
        } else {
            money += parseInt(jbStartMoney);
        }
        money -= parseInt(couponsPrice);
        $('#money').html(money);
    }

    /**
     * 处理函数
     */
    function confirmOrder() {

        //起始地
        var startLocation = $('#startLocation').val();
        //目的地
        var endLocation = $('#endLocation').val();
        //出发地的楼层
        var startFloor = getSelectValue("startFloor");
        //目的地的楼层
        var endFloor = getSelectValue("endFloor");
        //alert("startFloor = " + startFloor + ", endFloor = " + endFloor);
        //时间
        var dateTime = $('#appDateTime').val();
        //var dateTime = "2015-07-01 12:00:00";
        //姓名
        var name = $('#name').val();
        //手机号码
        var phone = $('#phone').val();
        //留言
        var message = $('#message').val();
        if (message == "") {
            message = "用户没有留言";
        }
        //价格
        var money = $('#money').html();
        money = parseInt(money);//转整数


        //如果信息完整,则跳转;否则弹出消息
        if (isValid(startLocation, endLocation, carCate, dateTime, name, phone)) {
            $.ajax({
                url: "../../index/index.php",
                data: {
                    action : "saveOrderToSession",
                    startLocation: startLocation,
                    endLocation: endLocation,
                    startFloor: startFloor - 1,
                    endFloor: endFloor - 1,
                    dateTime: dateTime,
                    name: name,
                    phone: phone,
                    message: message,
                    money: money,
                    carCate: carCate,
                    coupons:couponsPrice+" ",
                    priceDistance: priceDistance
                },
                type: 'post',
                dataType: 'json',
                success: function(data) {
                    window.location.href = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx85b682b8eb28c8b0&redirect_uri=http://www.banar.cn/wbanar/view/weChat/makeOrderConfirm.php?totalFee=" + (money * 100) + "&response_type=code&scope=snsapi_base&state=1#wechat_redirect";
                },
                error: function(data) {
                    alert("获取失败1");
                }
            });
        }
    }

    /**
     * 获取优惠价格
     */
    var couponsPrice = 0;
    function getCouponsPrice() {
        $.ajax({
            url: "../../index/index.php",
            data: {
                action : "getCouponsList"
            },
            type: 'post',
            dataType: 'json',
            success: function(data) {
                if (data !== null) {
                    $('#coupons_money').html(data['worth']);
                    couponsPrice = parseInt(data['worth']);
                }
            },
            error: function(data) {
                alert("获取失败2");
            }
        });
    }

    /**
     * 获取车、楼层价格
     */
    function getPrice() {
        $.ajax({
            url: "../../index/index.php",
            data: {
                action : "getPrice"
            },
            type: 'post',
            dataType: 'json',
            success: function(data) {
                mbCarrying = data[0]['carrying'];
                mbDimension = data[0]['dimension'];
                mbStartPrice = data[0]['startPrice'] + '元(' + data[0]['startLength'] + '公里)';
                mbAfterPrice = "其后" + data[0]['perPrice'] + '元每公里';
                mbStartMoney = data[0]['startPrice'];//起步价格
                mbStartKm = data[0]['startLength'];//起步公里
                mbPerKm = data[0]['perPrice'];//每公里的价格

                jbCarrying = data[1]['carrying'];
                jbDimension = data[1]['dimension'];
                jbStartPrice = data[1]['startPrice'] + '元(' + data[1]['startLength'] + '公里)';
                jbAfterPrice = "其后" + data[1]['perPrice'] + '元每公里';
                jbStartMoney = data[1]['startPrice'];//起步价格
                jbStartKm = data[1]['startLength'];//起步公里
                jbPerKm = data[1]['perPrice'];//每公里的价格

                //selectXMCar();
            },
            error: function(data) {
                alert("获取失败3");
            }
        });
    }

    /**
     * 获取选择器的值
     * @param selectId
     */
    function getSelectValue(varId) {
        var selector = document.getElementById(varId);
        return selector.options[selector.selectedIndex].value;
    }

    /**
     * 验证消息是否完整
     * @param startLocation 起点
     * @param endLocation 终点
     * @param car_cate 车型
     * @param time 时间
     * @param name 姓名
     * @param phone 电话
     */
    function isValid(startLocation, endLocation, car_cate, time, name, phone) {
        var startFloor = getSelectValue("startFloor");
        var endFloor = getSelectValue("endFloor");


        if (priceDistance <= 0 || isNaN(priceDistance)) {
            alert("请输入更加详细的地址");
            return false;
        } else if(startLocation == "") {
            alert("请填写起点");
            return false;
        } else if (endLocation == "") {
            alert("请填写终点");
            return false;
        } else if (car_cate == 0) {
            alert("请选择车型");
            return false;
        } else if (time == "") {
            alert("请选择时间");
            return false;
        } else if (phone == "" || !isFormatValid(phone)) {
            alert("请填写正确的联系方式");
            return false;
        } else if (startFloor == 0) {
            alert("请输入起点楼层");
            return false;
        } else if (endFloor == 0) {
            alert("请输入终点楼层");
            return false;
        }
        return true;
    }

    var calculateFirst = true;
    /**
     * 计算里程
     */
    function calculateDistance() {
        var startLocation = $('#startLocation').val();
        var endLocation = $('#endLocation').val();
        startLocation = startLocation.replace('-', '');
        endLocation = endLocation.replace('-', '');


        $.ajax({
            url: "../../index/index.php",
            data: {
                action : "getDistanceByArea",
                startLocation : startLocation,
                endLocation : endLocation
            },
            type: 'post',
            dataType: 'json',
            success: function(data) {
                alert("success");
                priceDistance = parseInt(data['distance']) / 1000;
                priceDistance = parseInt(priceDistance) + 1;//计算出来的距离
                if (!isNaN(priceDistance)) {
                    $('#distance').html(parseInt(priceDistance));
                }
                calculateFirst = false;
                if (carCate == 1) {//如果当前选择的是小面包车
                    selectXMPrice();
                } else if (carCate == 2) {//如果现在选择的是金杯车
                    selectJBCar();
                }
            },
            error: function(data) {
				console.log(data);
                alert("获取失败4");
            }
        });

    }


    /**
     * 计算楼层价格
     */
    function calculateFloorPrice() {
//        $('#carHint').addClass('hidden');
//        $('#golden_cup_selected').addClass('hidden');
//        $('#golden_cup_not_selected').removeClass('hidden');
//        $('#microbus_selected').addClass('hidden');
//        $('#microbus_not_selected').removeClass('hidden');

        var startFloor = getSelectValue("startFloor");
        var endFloor = getSelectValue("endFloor");

        money = money - startFloorPrice - endFloorPrice;//清除之前的价格

        if (startFloor == 8) {
            startFloorPrice = 10;
        }else if (startFloor >= 1) {
            startFloorPrice = (startFloor - 1) * floorPrice;
        }

        if (endFloor == 8) {
            endFloorPrice = 10;
        }else if (endFloor >= 1) {
            endFloorPrice = (endFloor - 1) * floorPrice;
        }
        money = money + startFloorPrice + endFloorPrice;
        $('#money').html(money);
    }


    /**
     * 验证信息是否为电话号码或者email
     * @param textValue 内容
     */
    function isFormatValid(textValue) {
        var regEmail = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
        var regPhone = /^(((14[0-9]{1})|(17[0-9]{1})|(13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
        return regEmail.test(textValue) || regPhone.test(textValue);
    }

</script>
</html>

<!--<script src="../../js/BaiduMap.js"></script>-->
<script src="../../js/Amap.js"></script>
<script>
AMap.autoOptions={
	city:"北京"
};
autocomplete("#startLocation");
autocomplete("#endLocation");
$("#startLocation").blur(function(){
	setTimeout(function(){
		var startLocatioin = $("#startLocation").val();
		var endLocation = $("#endLocation").val();
		if(trim(startLocatioin) && trim(endLocation)){
			$("#distance").getDistance(startLocatioin,endLocation);
		}
	},200);
});
$("#endLocation").blur(function(){
	setTimeout(function(){
		var startLocatioin = $("#startLocation").val();
		var endLocation = $("#endLocation").val();
		if(trim(startLocatioin) && trim(endLocation)){
			$("#distance").getDistance(startLocatioin,endLocation);
		}
	},200);
});
</script>