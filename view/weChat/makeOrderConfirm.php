<?php
    /**
     * JS_API支付demo
     * ====================================================
     * 在微信浏览器里面打开H5网页中执行JS调起支付。接口输入输出数据格式为JSON。
     * 成功调起支付需要三个步骤：
     * 步骤1：网页授权获取用户openid
     * 步骤2：使用统一支付接口，获取prepay_id
     * 步骤3：使用jsapi调起支付
     */
    include_once("./WxPayPubHelper/WxPayPubHelper.php");
    if (!isset($_SESSION)) {
        session_start();
    }
    //使用jsapi接口
    $jsApi = new JsApi_pub();

    //=========步骤1：网页授权获取用户openid============
    //通过code获得openid
    if (!isset($_GET['code']))
    {
        //触发微信返回code码
        $url = $jsApi->createOauthUrlForCode(WxPayConf_pub::JS_API_CALL_URL);
        Header("Location: $url");
    }else
    {
        //获取code码，以获取openid
        $code = $_GET['code'];
        $jsApi->setCode($code);
        $openid = $jsApi->getOpenId();
        $money = $_GET['totalFee'];
    }

    //=========步骤2：使用统一支付接口，获取prepay_id============
    //使用统一支付接口
    $unifiedOrder = new UnifiedOrder_pub();

    //设置统一支付接口参数
    //设置必填参数
    //appid已填,商户无需重复填写
    //mch_id已填,商户无需重复填写
    //noncestr已填,商户无需重复填写
    //spbill_create_ip已填,商户无需重复填写
    //sign已填,商户无需重复填写
    $unifiedOrder->setParameter("openid","$openid");//商品描述
    $unifiedOrder->setParameter("body","搬家费用");//商品描述
    //自定义订单号，此处仅作举例
    $timeStamp = time();
    $out_trade_no = WxPayConf_pub::APPID."$timeStamp";
    $unifiedOrder->setParameter("out_trade_no","$out_trade_no");//商户订单号
    $unifiedOrder->setParameter("total_fee","$money");//总金额
    $unifiedOrder->setParameter("notify_url",WxPayConf_pub::NOTIFY_URL);//通知地址
    $unifiedOrder->setParameter("trade_type","JSAPI");//交易类型
    //非必填参数，商户可根据实际情况选填
    //$unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号
    //$unifiedOrder->setParameter("device_info","XXXX");//设备号
    //$unifiedOrder->setParameter("attach","XXXX");//附加数据
    //$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
    //$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间
    //$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记
    //$unifiedOrder->setParameter("openid","XXXX");//用户标识
    //$unifiedOrder->setParameter("product_id","XXXX");//商品ID

    $prepay_id = $unifiedOrder->getPrepayId();
    //=========步骤3：使用jsapi调起支付============
    $jsApi->setPrepayId($prepay_id);

    $jsApiParameters = $jsApi->getParameters();
    //var_dump($_SESSION);
    //echo "openid = ".$openid;
    //echo "jsApiParameters = ".$jsApiParameters;
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>确认订单</title>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/foundation.min.css" />
    <link rel="stylesheet" type="text/css" href="../../css/jquery-ui.css" />


    <script src="../../js/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="../../js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="../../js/foundation.min.js"></script>
    <script type="text/javascript" src="../../js/modernizr.js"></script>
    <script type="text/coffeescript" src="../../js/common.js.coffee"></script>
    <script src="../../js/coffee-script.js"></script>
    <script type="text/javascript" src="../../js/jquery-ui-datepicker.js"></script>

    <style>
        body {
            background-color: #F3F3F3;
        }

        .all {
            margin-top: 4%;
            margin-bottom: 10%;
            padding-bottom: 30%;
        }

        .fixed-footer{
            background-color: lightseagreen;
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

        .line-style {
            height: 40px;
            line-height: 40px;
            border-bottom: 1px solid #e3e3e3;
        }

        .make-order {
            margin: 0 auto;
            width: 100%;
            display: block;
        }

        .spanText {
            height: 50px;
            line-height: 50px;
            font-size: 0.8em;
            display: block;
            overflow: hidden;
			color: silver;
        }

        .font_size{
            font-size: 12px;
            color: #808080;
        }
    </style>

    <script type="text/javascript">

        //调用微信JS api 支付
        function jsApiCall()
        {
            WeixinJSBridge.invoke(
                'getBrandWCPayRequest',
                <?php echo $jsApiParameters; ?>,
                function(res){
                    WeixinJSBridge.log(res.err_msg);
                    if (res.err_msg == "get_brand_wcpay_request:ok") {
                        completeOrder();
                    } else {
                        //completeOrder();
                    }
                    //alert(res.err_code+res.err_desc+res.err_msg);
                }
            );
        }

        function callpay()
        {
            if (typeof WeixinJSBridge == "undefined"){
                if( document.addEventListener ){
                    document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                }else if (document.attachEvent){
                    document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                    document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                }
            }else{
                jsApiCall();
            }
        }

        /**
         * 完成订单
         */
        function completeOrder() {
            $.ajax({
                url: "../../index/index.php",
                data: {
                    action : "makeOrder"
                },
                type: 'post',
                dataType: 'json',
                success: function(data) {
                    alert("下单成功");
                },
                error: function(data) {
                    alert("下单失败，请联系客服");
                }
            });
        }
    </script>
</head>
<body>
    <?php
        //var_dump($_SESSION);
    ?>
    <div class="row small all" style="max-width: 82.5rem;margin-top:0;border">
        <!--订单信息: 时间、车型、起始地、目的地-->
        <div class="panel" style="padding-top: 0.4rem; margin-bottom: 0.2rem;border:0;
				    background-color:white">
			<div class="small-11 " style="margin-left:auto;margin-right:auto;outline:none;box-shadow:none;">
				<!--时间、车型-->
				<div class="row" style="height: 50px;border-radius: 5px;padding: 0">
					<div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
						<button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/time.png) no-repeat;margin: auto">
						</button>
					</div>
					<div class="small-10 column line-style" style="height: 50px; line-height: 50px">
						<span class="spanText"><?php echo $_SESSION['dateTime'];?></span>
					</div>
				</div>


				<div class="row" style="height: 50px;border-radius: 5px;padding: 0">
					<div class="small-1 column " style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
						<button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/amap_car.png) no-repeat;margin: auto">
						</button>
					</div>
					<div class="small-10 column line-style" style="height: 50px; line-height: 50px">
						<span class="spanText"><?php if(((int)$_SESSION['carCate']) == 1) echo "小面包车"; else echo "金杯车";?></span>
					</div>
				</div>

				<!--起始地-->
				<div class="row" style="height: 50px;border-radius: 5px;padding: 0">
					<div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
						<button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/startIcon.png) no-repeat;margin: auto">
						</button>
					</div>
					<div class="small-10 column line-style" style="height: 50px; line-height: 50px">
						<span class="spanText">
                            <?php
                                if ((int)$_SESSION['startLocation'] != 7) {
                                    $endFloorCount = (int)$_SESSION['startLocation'] > 0 ? "(需搬{$_SESSION['startLocation']}层)" : "";
                                } else {
                                    $endFloorCount = "(有电梯搬运)";
                                }
                                echo $_SESSION['startLocation'].$startFloorCount;
                            ?>
                        </span>
					</div>
				</div>

				<!--目的地-->
				<div class="row" style="height: 50px;border-radius: 5px;padding: 0">
					<div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
						<button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/endIcon.png) no-repeat;margin: auto">
						</button>
					</div>
					<div class="small-10 column line-style" style="height: 50px; line-height: 50px">
						<span class="spanText">
                            <?php
                                if ((int)$_SESSION['endFloor'] != 7) {
                                    $endFloorCount = (int)$_SESSION['endFloor'] > 0 ? "(需搬{$_SESSION['endFloor']}层)" : "";
                                } else {
                                    $endFloorCount = "(有电梯搬运)";
                                }
                                echo $_SESSION['endLocation'].$endFloorCount;
                            ?>
                        </span>
					</div>
				</div>

				<!--姓名-->
				<div class="row" style="height: 50px;border-radius: 5px;padding: 0">
					<div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
						<button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/custorm_name.png) no-repeat;margin: auto">
						</button>
					</div>
					<div class="small-10 column line-style">
						<span class="spanText"><?php echo $_SESSION['name']?></span>
					</div>
				</div>

				<!--电话-->
				<div class="row" style="height: 50px;border-radius: 5px;padding: 0">
					<div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
						<button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/ic_confirm_phone.png) no-repeat;margin: auto">
						</button>
					</div>
					<div class="small-10 column line-style">
						<span class="spanText"><?php echo $_SESSION['phone']?></span>
					</div>
				</div>

				<!--捎句话-->
				<div class="row" style="height: 50px;border-radius: 5px;padding: 0">
					<div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
						<button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/shaojuhua.png) no-repeat;margin: auto">
						</button>
					</div>
					<div class="small-10 column line-style">
						<span class="spanText"><?php echo $_SESSION['message'];?></span>
					</div>
				</div>
			</div>

        </div>


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
                        <span id="distance" class="font_size" style="color: #808080;"><?php echo $_SESSION['priceDistance'];?></span>
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
                    <span class="font_size" id="money" style="color: #808080"><?php echo $_SESSION['money'];?></span>
                </div>

            </div>

            <div class="small-4 column" style="text-align: right;">
                <div class="small-3" style="float:right;margin-right: 13%;text-align: center;">
                    <div class="row">
                        <span class="font_size" style="color: silver;">已经优惠</span>
                    </div>
                    <div class="row" style="text-align: center;">
                        <span class="font_size" style="color: silver">￥</span>
                        <span class="font_size" id="coupons_money" style="color: #808080"><?php echo isset($_SESSION['coupons']) ? $_SESSION['coupons']:0;?></span>

                    </div>
                </div>
            </div>

        </div>
        <button type="button" onclick="callpay();" class="btn btn-primary btn-lg make-order"
                style="width:94%;background-color:#FF8A02;
				      padding: 5px 16px;
					  font-size: 20px;
					  line-height: 1;
					  border-radius: 15px;
					  border: 0;
					  font-weight: bold;
					  margin-left:3%;
					  margin-right:3%;">支付</button>
    </div>
</body>

</html>