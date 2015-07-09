<!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <title>我的订单</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../../css/foundation.min.css" />
    <script src="../../js/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../../js/foundation.min.js"></script>
    <script type="text/javascript" src="../../js/modernizr.js"></script>
    <script type="text/coffeescript" src="../../js/common.js.coffee"></script>
    <script src="../../js/coffee-script.js"></script>

    <style>

        .cancel-order {
            margin: 0 auto;
            width: 80%;
            display: block;
        }

        .line-inBox {
            display: block;
        }

        .left-image {
            width:40%;
            display:block;
            /*margin:0 auto;*/
            margin-top: 10%
        }

        .middle-content {
            height: 100%;
            font-size: 1.6em;
            background-color:papayawhip;
            border: 0px;
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
        $_SESSION['openid'] = 'oz7dctyIeCJHjK3hSIgczBaqNX3s';//保存session
        echo "openId = ".$_SESSION['openid'];
    ?>

    <div id="table-line" class="container" style="background-color: #ffffff">
        <!--第一项-->
        <div id="each-line" style="background-color: papayawhip; padding-top: 10px;margin-top: 10px">
            <div style="display:block;background-color: #ffffff;">
                <div class="col-xs-1">
                    <img src="../../img/person_center_my_owe_fee.png" class="left-image">
                </div>
                <span class="col-xs-11 middle-content" id="price">费用￥(未支付)</span>
            </div>
            <hr>
            <div class="line-inBox">
                <div class="col-xs-1">
                    <img src="../../img/adapter_order_time.png" class="left-image">
                </div>
                <span class="col-xs-11 middle-content" id="startTime">2015-05-14 12:30</span>
            </div>
            <div class="line-inBox">
                <div class="col-xs-1">
                    <img src="../../img/cartype_jb.png" class="left-image">
                </div>
                <span class="col-xs-11 middle-content" id="car_cate">金杯车</span>
            </div>
            <div class="line-inBox">
                <div class="col-xs-1">
                    <img src="../../img/confirm_order_r.png" class="left-image">
                </div>
                <span class="col-xs-11 middle-content" id="startLocation">起点：北京市海淀区校园南路</span>
            </div>

            <div class="line-inBox">
                <div class="col-xs-1">
                    <img src="../../img/confirm_order_b.png" class="left-image">
                </div>
                <span class="col-xs-11 middle-content" id="endLocation">终点：清华大学</span>
            </div>
            <hr>
            <div style="margin-bottom: 0 auto; width:100%;">
                <button id="cancelBtn" type="button" onclick="onCancelOrder()" class="btn btn-primary btn-lg cancel-order">取消订单</button>
            </div>
        </div>
    </div>
</body>



<script>
    window.onload = function() {
        getOrderList();
    }

    /**
     * 处理数据
     */
    function processData(data) {
        var da = data;
        for (var i = 0; i < da.length; i++) {
            var order_id = da[0]['order_id'];
            var startLocation = da[0]['startLocation'];//起点
            var endLocation = da[0]['endLocation'];//终点
            var startTime = da[0]['startTime'];//下单时间
            var price = da[0]['price'];//价格
            var state = da[0]['state'];//状态
            var car_name = da[0]['car_name'];//车型

            var newLine = $('#each-line').clone();
            //填充数据
            if (state == 0) {
                newLine.find('#price').html("费用 ￥" + price + " (未支付)");
            } else {
                newLine.find('#price').html("费用 ￥" + price + " (已支付)");
            }

            newLine.find('#startLocation').html("起点: " + startLocation);
            newLine.find('#endLocation').html("终点: " + endLocation);
            newLine.find('#startTime').html("时间: " + startTime);
            newLine.find('#car_cate').html("车型: " + car_name);

            newLine.attr('id', 'each-line' + (i + 1));
            $('#table-line').append(newLine);
        }
        $('#each-line').addClass('hidden');
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
                //processData(data);
                alert("获取成功");
            },
            error: function(data) {
                alert("获取失败");
            }
        });
    }

    /**
     * 取消订单
     */
    function onCancelOrder($order_id) {
        alert("取消号码为{$order_id}的订单,请联系客服,客服电话为15652953455");
    }
</script>
</html>