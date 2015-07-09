<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,initial-scale=1,maximum-scale=1.0,user-scalable=no" />
    <title>我的订单</title>
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
            margin-top: 0;
        }

        .all {
            margin-top: 4%;
            margin-bottom: 5%;
            padding-bottom: 5%;
        }

        .locationText {
            height: 100%;
            width: 100%;
            font-size: 0.8em;
            border: 0px;
        }

        .locationTextBlock {
            width: 100%;
            font-size: 0.8em;
            border: 0px;
            display: inline-block;
        }

        .spanText {
            height: 25px;
            line-height: 25px;
            font-size: 1.0em;
            display: block;
            overflow: hidden;
        }

        .spanTextInLine {
            height: 25px;
            line-height: 25px;
            font-size: 1.0em;
            display: inline;
            overflow: hidden;
        }

        .cancel-order {
            margin: 0 auto;
            width: 80%;
            display: block;
        }

        .line-style {
            height: 40px;
            line-height: 40px;
            border-bottom: 1px solid #e3e3e3;
        }

        .dataItem {

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
        if (isset($data)&&!empty($data)) {
            if (empty($_SESSION['openid'])) {
                $_SESSION['openid'] = $data['openid'];//保存session
            }
        }
    ?>

    <div id="hint" class="hidden" style="width:0;height:0;position:fixed;left:50%;rigth:50%;top:50%;bottom:50%;">
        <div style="width:250px;height:200px;margin-left:-50px;margin-top:-100px;">
            <span style="font-size: 1.5em">您还没有下过订单哦~</span>
        </div>
    </div>



    <!--需要显示的消息,下单时间、执行时间、司机名称、起点、终点、价格-->
    <div id="table-line" class="small row all" style="max-width: 82.5rem;margin-top:0;border">
        <div id="each-line" class="dataItem hidden">
            <input id="order_id" value="1" hidden="hidden">
            <input id="state" value="1" hidden="hidden">

            <!--订单信息: 时间、车型、起始地、目的地-->
            <div class="panel" style="padding-top: 0.4rem; margin-bottom: 0.5rem;border:0;
				    border-bottom: 1px solid silver;border-radius: 0px;background-color:white">
                <!--下单时间-->
                <div class="row" style="height: 50px;border-radius: 5px;padding: 0">
                    <div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
                        <button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/time.png) no-repeat;margin: auto">
                        </button>
                    </div>
                    <div class="small-10 column line-style" >
                        <span class="locationText" id="startTime"></span>
                    </div>
                </div>

                <!--车型-->
                <div class="row" style="height: 50px;border-radius: 5px;padding: 0">
                    <div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
                        <button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/amap_car.png) no-repeat;margin: auto">
                        </button>
                    </div>
                    <div class="small-10 column line-style" >
                        <span id="carName" class="locationText"></span>
                    </div>
                </div>

                <!--起点-->
                <div class="row" style="height: 50px;border-radius: 5px;padding: 0">
                    <div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
                        <button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/startIcon.png) no-repeat;margin: auto">
                        </button>
                    </div>
                    <div class="small-10 column line-style" >
                        <span id="startLocation" class="locationText"></span>
                    </div>
                </div>

                <!--终点-->
                <div class="row" style="height: 50px;border-radius: 5px;padding: 0">
                    <div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
                        <button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/endIcon.png) no-repeat;margin: auto">
                        </button>
                    </div>
                    <div class="small-10 column line-style" >
                        <span id="endLocation" class="locationText"></span>
                    </div>
                </div>

                <!--捎句话-->
                <div class="row" style="height: 50px;border-radius: 5px;padding: 0">
                    <div class="small-1 column" style="margin:0 auto; height: 100%; text-align: center;padding-top: 10px">
                        <button  style="height: 100%;background-color: #ffffff;
							border: 0px;background: url(../../img/shaojuhua.png) no-repeat;margin: auto">
                        </button>
                    </div>
                    <div class="small-10 column line-style" >
                        <span id="message" class="locationText"></span>
                    </div>
                </div>

                <!--价格信息-->
                <div class="row" style="height: auto; width: 100%;border-radius: 5px;padding: 0">
                    <div class="small-6 column" style="text-align: center">
                        <span id="price" class="locationTextBlock">￥0</span>
                        <span id="price_status" class="locationTextBlock"></span>
                    </div>

                    <div class="small-6 column" style="text-align: center">
                        <span id="floorPrice" class="locationTextBlock">楼层搬运：￥0</span>
                        <span id="coupons" class="locationTextBlock">优惠：￥0</span>
                    </div>
                </div>
                <!--分界线-->
                <hr style=" height:2px;border:none;border-top:2px dotted #185598;"/>
                <div style="margin-bottom: 0 auto; width:100%;">
                    <button id="cancelBtn" type="button" class="btn btn-primary btn-lg cancel-order " style="width:94%;background-color:#FF8A02;
				      padding: 5px 16px;
					  font-size: 20px;
					  line-height: 1;
					  border-radius: 15px;
					  border: 0;
					  font-weight: bold;
					  margin-left:3%;
					  margin-right:3%;">取消订单</button>

                    <button id="completeBtn" type="button" class="btn btn-primary btn-lg complete-order " style="width:94%;background-color:#FF8A02;
				      padding: 5px 16px;
					  font-size: 20px;
					  line-height: 1;
					  border-radius: 15px;
					  border: 0;
					  font-weight: bold;
					  margin-left:3%;
					  margin-right:3%;margin-top: 5px;">完成订单</button>
                </div>
            </div>

            <!--<hr style=" height:1px;border:none;border-top:2px solid #185598;"/>-->
            <!--结束一条数据-->
        </div>
    <!--所有数据-->
    </div>
</body>

<script>
    var order_id = new Array(100);
    var state = new Array(100);
    window.onload = function() {
        getOrderList();
    }


    $('.cancel-order').on('click', function () {
        alert("niuwei is handsome");
    });

    /**
     * 处理数据
     */
    function processData(data) {
        var da = data;

        for (var i = 0; i < da.length; i++) {
            order_id[i] = da[i]['order_id'];//订单id
            var carName = da[i]['car_name'];//车名
            var startLocation = da[i]['startLocation'];//起点
            var endLocation = da[i]['endLocation'];//终点
            var price = da[i]['price'];//价格
            state[i] = da[i]['state'];//状态
            var startTime = da[i]['startTime'];//订单执行时间
            var isCancel = da[i]['isCancel'];//是否被取消
            var floor = (parseInt(da[i]['floorCount']) + parseInt(da[i]['toFloorCount'])) * 10;//楼层
            var coupons = da[i]['coupons'];
            var message = da[i]['message'];


            var newLine = $('#each-line').clone();
            newLine.attr('id', 'each-line' + (i + 1));

            //填充数据
            newLine.find('#order_id').val(order_id[i]);
            newLine.find('#state').val(state[i]);
            newLine.find('#cancelBtn').attr('id', 'cancelBtn' + (i + 1));
            newLine.find('#completeBtn').attr('id', 'completeBtn' + (i + 1));

            if (state[i] == 0) {
                newLine.find('#price').html("￥" + price);
                newLine.find('#price_status').html(" (已支付) ");
            } else {
                newLine.find('#price').html("￥" + price);
                newLine.find('#price_status').html(" (已支付)");
            }


            if (state[i] >= 2) {//用户已经确认 => 只显示评论按钮
                newLine.find('#cancelBtn'+(i+1)).text("评价");
                //绑定事件
                newLine.find('#cancelBtn'+(i+1)).click(function () {
                    onCommentOrder($(this).attr('id'));
                });
                newLine.find('#completeBtn'+(i+1)).addClass('hidden');
            } else {//用户没有确认 => 取消、完成按钮
                if (isCancel == 0) {
                    newLine.find('#cancelBtn'+(i+1)).text("取消订单");
                    newLine.find('#cancelBtn'+(i+1)).click(function () {


                        onCancelOrder($(this).attr('id'));
                    });

                    newLine.find('#completeBtn'+(i+1)).text("完成订单");
                    newLine.find('#completeBtn'+(i+1)).click(function () {
                        onCompleteOrder($(this).attr('id'));
                    });
                } else {//用户已经取消 => 只显示已经取消
                    newLine.find('#cancelBtn'+(i+1)).text("已取消");
                    newLine.find('#completeBtn'+(i+1)).addClass('hidden');
                }
            }

            newLine.find('#startLocation').html("起点：" + startLocation);
            newLine.find('#endLocation').html("终点：" + endLocation);
            newLine.find('#startTime').html(startTime);
            newLine.find('#carName').html(carName);
            newLine.find('#floorPrice').html("楼层搬运：￥" + floor);
            newLine.find('#coupons').html("优惠：￥" + coupons);
            newLine.find('#message').html(message);
            newLine.removeClass("hidden");

            $('#table-line').append(newLine);
        }
        //$('#each-line').addClass('hidden');
    }

    /**
     * 获取订单信息
     */
    function getOrderList() {
        $.ajax({
            url: "../../index/index.php",
            data: {
                action      : "getHistoryOrderList"
            },
            type: 'post',
            dataType: 'json',
            success: function(data) {
                if (data.length > 0) {
                    processData(data);
                } else {
                    $('#hint').removeClass('hidden');
                }
            },
            error: function(data) {
                alert("获取失败");
            }
        });
    }

    /**
     * 取消订单
     */
    function onCancelOrder(B_id) {
        //alert("OrderId = " + order_id);
        var id = B_id.substr(9,2);//cancelBtn
        id = order_id[id - 1];
        $.ajax({
            url: "../../index/index.php",
            data: {
                action      : "cancelOrder",
                order_id    : id
            },
            type: 'post',
            dataType: 'json',
            success: function(data) {
                alert("订单已取消，我们的客服将会与您联系，并尽快退款");
                window.location.href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx85b682b8eb28c8b0&redirect_uri=http://www.banar.cn/wbanar/view/weChat/myOrderTemp.php&response_type=code&scope=snsapi_base&state=1#wechat_redirect";
            },
            error: function(data) {
                alert("获取失败");
            }
        });
    }

    /**
     * 评论订单
     */
    function onCommentOrder(B_id) {
        var id = B_id.substr(9,2);//cancelBtn
        id = order_id[id - 1];
        window.location.href = "comment.php?order_id="+id;
    }

    /**
     * 完成订单
     * @param order_id
     */
    function onCompleteOrder(B_id) {
        var id = B_id.substr(11,2);//completeBtn1
        id = order_id[id - 1];

        $.ajax({
            url: "../../index/index.php",
            data: {
                action      : "completeOrder",
                order_id    : id
            },
            type: 'post',
            dataType: 'json',
            success: function(data) {
                window.location.href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx85b682b8eb28c8b0&redirect_uri=http://www.banar.cn/wbanar/view/weChat/myOrderTemp.php&response_type=code&scope=snsapi_base&state=1#wechat_redirect";
            },
            error: function(data) {
                alert("获取失败");
            }
        });
    }
</script>

</html>