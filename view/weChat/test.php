

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
            background-color: white;
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
                    if (res.return_code === "SUCCESS") {
                        completeOrder();
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
        if (!isset($_SESSION)) {
            session_start();
        }
    ?>
    <div class="row small all" style="max-width: 82.5rem;margin-top:0;border">
        <!--订单信息: 时间、车型、起始地、目的地-->
        <div class="panel" style="padding-top: 0.4rem; margin-bottom: 0.5rem;border:0;
				    border-bottom: 1px solid silver;border-radius: 0px;background-color:white">
			<div class="small-11 " style="margin-left:auto;margin-right:auto;outline:none;box-shadow:none;">
				<!--时间、车型-->
				<div class="row" style="height: 50px;border-radius: 5px;padding: 0">
					<div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
						<button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/banar_confirm_order_time.png) no-repeat;padding-left: 10px;margin: auto">
						</button>
					</div>
					<div class="small-10 column" style="height: 50px; line-height: 50px">
						<span class="spanText"><?php echo $_SESSION['dateTime'];?></span>
					</div>
				</div>


				<div class="row" style="height: 50px;border-radius: 5px;padding: 0">
					<div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
						<button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/amap_car.png) no-repeat;padding-left: 10px;margin: auto">
						</button>
					</div>
					<div class="small-10 column" style="height: 50px; line-height: 50px">
						<span class="spanText"><?php if(((int)$_SESSION['carCate']) == 1) echo "小面包车"; else echo "金杯车";?></span>
					</div>
				</div>

				<!--起始地-->
				<div class="row" style="height: 50px;border-radius: 5px;padding: 0">
					<div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
						<button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/confirm_order_r.png) no-repeat;padding-left: 10px;margin: auto">
						</button>
					</div>
					<div class="small-10 column" style="height: 50px; line-height: 50px">
						<span class="spanText"><?php echo $_SESSION['startLocation']."({$$_SESSION['startFloor']}层)";?></span>
					</div>
				</div>

				<!--目的地-->
				<div class="row" style="height: 50px;border-radius: 5px;padding: 0">
					<div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
						<button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/confirm_order_b.png) no-repeat;padding-left: 10px;margin: auto">
						</button>
					</div>
					<div class="small-10 column" style="height: 50px; line-height: 50px">
						<span class="spanText"><?php echo $_SESSION['endLocation']."({$_SESSION['endFloor']}层)"?></span>
					</div>
				</div>

				<!--姓名-->
				<div class="row" style="height: 50px;border-radius: 5px;padding: 0">
					<div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
						<button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/user_account_ico.png) no-repeat;padding-left: 10px;margin: auto">
						</button>
					</div>
					<div class="small-10 column">
						<span class="spanText"><?php echo $_SESSION['name']?></span>
					</div>
				</div>

				<!--电话-->
				<div class="row" style="height: 50px;border-radius: 5px;padding: 0">
					<div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
						<button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/ic_confirm_phone.png) no-repeat;padding-left: 10px;margin: auto">
						</button>
					</div>
					<div class="small-10 column">
						<span class="spanText"><?php echo $_SESSION['phone']?></span>
					</div>
				</div>

				<!--捎句话-->
				<div class="row" style="height: 50px;border-radius: 5px;padding: 0">
					<div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
						<button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/ic_confirm_phone.png) no-repeat;padding-left: 10px;margin: auto">
						</button>
					</div>
					<div class="small-10 column">
						<span class="spanText"><?php echo $_SESSION['message']?></span>
					</div>
				</div>
			</div>

        </div>


    </div>

    <!--浮动文本-->
    <div class="fixed-footer" style="background:white;border:0;
					border-top: 1px solid silver;">
        <div class="row make-order" style="width:100%;">
			<div class="small-1 column" style="">
				<span>.</span>
            </div>
            <div class="small-3 column" style="text-align: left;">
                <div class="row">
                    <span class="font_size" style="color:silver;">行驶里程</span>
                </div>
                <div class="row">
                    <span id="distance" class="font_size" style="color: #808080;"><?php echo $_SESSION['priceDistance'];?></span>
                    <span class="font_size" style="color:silver">公里</span>
                </div>


            </div>

            <div class="small-4 column" style="">
                <div class="row ">
                    <span class="font_size" style="color: silver;">最终费用</span>
                </div>
                <div class="row">
                    <span class="font_size" style="color: silver;">￥</span>
                    <span class="font_size" id="distance" style="color: #808080"><?php echo $_SESSION['money'];?></span>
                </div>

            </div>

            <div class="small-3 column" style="">
                <div class="row">
                    <span class="font_size" style="color: silver;">已经优惠</span>
                </div>
                <div class="row">
                    <span class="font_size" style="color: silver">￥</span>
                    <span class="font_size" id="money" style="color: #808080">0</span>
                </div>
            </div>
			<div class="small-1 column" style="">
				<span>.</span>
            </div>
        </div>
        <button type="button" onclick="callpay();" class="btn btn-primary btn-lg make-order">确定订单</button>
    </div>
</body>

</html>