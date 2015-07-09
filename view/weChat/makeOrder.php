<!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <title>下订单</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />

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
        .fixed-footer {
            width: 100%;
            position:fixed; bottom:0; left:0%;
            background-color: lightskyblue;
            padding-top: 20px;
            margin-left:0;
            _position: absolute; /* position fixed for IE6 */
            _top:expression(documentElement.scrollTop+documentElement.clientHeight-this.clientHeight-4);
            z-index:4;
        }

        .make-order {
            margin: 0 auto;
            width: 80%;
            display: block;
        }

        .input-group .input-type {
            width: 100%;
            border: 1px solid #000;
            -moz-border-radius: 10px;
            -webkit-border-radius: 10px;
        }

        .fill-parent {
            width: 100%;
            margin-bottom: 10px;
        }

        .vertical-content {
            display:table-cell;
            text-align:center;
            vertical-align:middle;
        }
        .divborder{
            margin-top: 5px;
        }
        .panel{
            background: #ffffff;
        }
        .select-option {
            background: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 3px #e5e5e5;
            font-size: 14px;
            left: 0;
            position: absolute;
            top: 29px;
            width: 123px;
            z-index: 2;
        }
        .select-box {
            float: left;
            height: 30px;
            line-height: 30px;
            padding-right: 10px;
            position: relative;
        }
        .atest {
            display: block;
            height: 30px;
            line-height: 30px;
            font-size: 14px;
            color: #4b4b4b;
            text-decoration: none;
            padding: 0 5px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

    </style>
</head>
<body style="background-color: #ffff00;margin-top: 0;">

    <?php
        include "../../common/WeChatAuth.php";
        $code = $_GET['code'];
        $weChatAuth = new WeChatAuth();
        $data = $weChatAuth->getOpenId($code);
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['openid'] = $data['openid'];//保存session
        echo "openId = ".$data['openid'];
    ?>

    <!--主体部分-->
    <div class="row small" style="margin-bottom: 0%;background-color: #FFFF2F;margin-top: 0%;padding-top: 0%;padding-bottom: 1%">
        <div class="panel" style="margin-left: 5%;margin-right: 5%">
                <div class="divborder" style="height: 50px;border-radius: 5px;padding: 0">
                    <input class="small-1 column"
                          style="height: 100%;background-color: #ffffff;border: 0px;
                           background: url(../../img/confirm_order_r.png) no-repeat;
                          ">
                    <div class="small-10 column" style="height: 100%;border-bottom: 1px solid lightskyblue">
                       <input  placeholder="出发地"
                               style="height: 100%;width: 100%;font-size: 1.2em;background-color: #ffffff;border: 0px;
                                      ">
                    </div>
                </div>
                <div class="divborder" style="height: 50px;border-radius: 5px;padding: 0">
                    <input class="small-1 column"
                           style="height: 100%;background-color: #ffffff;border: 0px;
                           background: url(../../img/confirm_order_b.png) no-repeat;
                          ">
                    <div class="small-10 column" style="height: 100%;border-bottom: 1px solid lightskyblue">
                        <input  placeholder="目的地"
                               style="height: 100%;width: 100%;font-size: 1.2em;background-color: #ffffff;border: 0px;
                                  ">
                    </div>
                </div>

        </div>
        <div class="panel" style="margin-left: 5%;margin-right: 5%">
            <div class="row">
                <div class="small-6 column">
                    <button id="golden_cup_not_selected" class=" "
                            style="background: url(../../img/golden_cup_not_selected.png);
                            height: 64px;width: 64px"/>

                    <button id="golden_cup_selected" class="  hidden"
                            style="background: url(../../img/golden_cup_selected.png);
                            height: 64px;width: 64px"/>
                </div>
                <div class="small-6 column">
                    <button id="microbus_not_selected" class="  "
                            style="background: url(../../img/microbus_not_selected.png);
                            height: 64px;width: 64px;"
                            />
                    <button id="microbus_selected" class="  hidden"
                            style="background: url(../../img/microbus_selected.png);
                            height: 64px;width: 64px;"
                            />

                </div>
            </div>
            <div class="row">
                <div class="small">
                    <span style="font-size: 17px;color: #FF5F11;
                                font-weight: bold;
                                margin-left: 5%;
                    ">55元(5公里)</span>
                    <span   style="font-size: 10px;color: #B1B4BB;
                                margin-left: 5%;"
                           >
                        运输体积:4.5立方米
                    </span>
                </div>
                <div class="small">
                    <span style="font-size: 10px;color: #FF5F11;
                                margin-left: 5%;
                    ">其后:8元/公里</span>
                    <span   style="font-size: 10px;color: #B1B4BB;
                                margin-left: 5%;"
                            >
                        载重:10000公斤
                    </span>
                </div>
            </div>



        </div>
        <div class="panel" style="margin-left: 5%;margin-right: 5%">
            <div class="row">
                    <div class="small-6 column" style="margin-right: 0">
                        <select name="status">
                            <option value="">起点楼层</option>
                            <option value="0">有电梯不收费</option>
                            <option value="1">一层 0元</option>
                            <option value="2">二层 10元</option>
                        </select>
                    </div>
                <div class="small-6 column" style="margin-left: 0">
                    <select name="status">
                        <option value="">起点楼层</option>
                        <option value="0">有电梯不收费</option>
                        <option value="1">一层 0元</option>
                        <option value="2">二层 10元</option>
                    </select>
                </div>

            </div>
        </div>
        <div class="panel" style="margin-left: 5%;margin-right: 5%;">
                <div class="divborder" style="border: 0px solid black;height: 50px;border-radius: 5px;padding: 0">
                    <input class="small-2"
                           style="height: 100%;background-color: #ffffff;border: 0px;
                           background: url(../../img/use_coupon_checked.png) no-repeat;
                          ">
                    <input class="small-9" placeholder="已使用，立减50元"
                           style="height: 100%;font-size: 1.6em;background-color: #ffffff;border: 0px;
                                  ">
                </div>

        </div>
        <!--点击开始-->
        <div class="panel" style="margin-left: 5%;margin-right: 5%;">
            <div class="make-order" style="display: block; margin-bottom: 0%">
                <div style="display: inline; float: left;font-size: 1.8em"><span>费用</span></div>
                <div style="display: inline-block; float: right; font-size: 1.8em"><span>￥元</span></div>
            </div>
            <button type="button" onclick="confirmOrder()" class="btn btn-primary btn-lg make-order">确定订单</button>
        </div>
    </div>

</body>

<script>
    $("#date_9").datepicker({
        onSelect: function(dateText,inst){
            alert("您选择的日期是："+dateText)
        }
    });

    $("#microbus_not_selected").click(function(){
        $('#golden_cup_selected').addClass('hidden');
        $('#golden_cup_not_selected').removeClass('hidden');
        $('#microbus_selected').removeClass('hidden');
        $('#microbus_not_selected').addClass('hidden');
    });
    $("#golden_cup_not_selected").click(function(){
        $('#golden_cup_selected').removeClass('hidden');
        $('#golden_cup_not_selected').addClass('hidden');
        $('#microbus_selected').addClass('hidden');
        $('#microbus_not_selected').removeClass('hidden');
    });

    /**
     * 处理函数
     */
    function confirmOrder() {
        var startLocation = document.getElementById("startLocation");
        var endLocation = document.getElementById("endLocation");
        var dateTime = document.getElementById("dateTime");
        var car_cate = document.getElementById("car_cate");
        var phone = document.getElementById("phone");
        var coupons = document.getElementById("coupons");
        var elevator = document.getElementById("elevator");
        var message = document.getElementById("message");

        window.location.href = "makeOrderRest.php";
    }


    /**
     * 发送消息
     * @param startLocation
     * @param endLocation
     * @param dateTime
     * @param car_cate
     * @param phone
     * @param coupons
     * @param elevator
     * @param message
     */
    function postData(startLocation, endLocation, dateTime, car_cate, phone, coupons, elevator, message) {

    }

    function textDown(e) {
        textevent = e;
        if (textevent.keyCode == 8) {
            return;
        }
        if (document.getElementById('textarea').value.length >= 100) {
            alert("大侠，手下留情，此处限字100")
            if (!document.all) {
                textevent.preventDefault();
            } else {
                textevent.returnValue = false;
            }
        }
    }

    function textUp() {
        var s = document.getElementById('textarea').value;
        //判断ID为text的文本区域字数是否超过100个
        if (s.length > 100) {
            document.getElementById('textarea').value = s.substring(0, 100);
        }
    }
</script>
</html>