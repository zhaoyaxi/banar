<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>我的优惠券</title>
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
            background-color: #ffffff;
            margin-top: 0;
        }

        .all {
            margin-top: 4%;
            margin-bottom: 5%;
            padding-bottom: 10%;
        }

        .base-div {
            text-align: center;
            width: auto;
            height: 120px;
            background-image: url(../../img/coupons.jpg);
            background-size: cover;
            margin-bottom: 10px;
        }

        .priceText {
            font-size: 1.2em;
            margin-right: 20px;
        }

        .commonText {
            font-size: 1.2em;
            margin-left: 0px;
            color: #ffffff;
        }

        .dateText {
            font-size: 0.8em;
            margin: 0 auto;
            color: #ffffff;
        }

        .inLeft {
            display: inline-block;
            text-align: center;
            margin-left: 5px;
            width: auto;
            height: 120px;
            float: left;
        }

        .inRight {
            display: inline-block;
            height: 120px;
            width: auto;
            text-align: center;
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

    <div id="hint" class="hidden" style="width:0;height:0;position:fixed;left:50%;rigth:50%;top:50%;bottom:50%;">
        <div style="width:250px;height:200px;margin-left:-100px;margin-top:-100px;">
            <span style="font-size: 1.5em">您还没有优惠券哦~</span>
        </div>
    </div>

    <div id="table-line" class="all row small-10">
        <!--第一项-->
        <div id="each-line" class="base-div hidden" style="text-align: center">
            <div class="inLeft" style="margin-left: 10px">
                <span id="price" style="color: #ffffff; display: block;margin-top: 34px;font-size: 1.2em">0元</span>
                <span style="color: #ffffff; display: block;font-size: 1.2em">搬家券</span>
            </div>
            <div class="inRight">
                <span style="color: #ffffff; display: block;margin-top: 34px;font-size: 1.2em">首次关注使用</span>
                <div style="display: block; width: 100%; text-align: right;">
                    <span class="dateText">截至日期：</span>
                    <span id="endTime" class="dateText"></span>
                </div>
            </div>
        </div>

    </div>
</body>

<script>
    window.onload = function() {
        getCouponsList();
    }

    /**
     * 显示数据
     */
    function processData(data) {
        var da = data;
        for (var i = 0; i < da.length; i++) {
            var price = da[i]['worth'];
            var startTime = da[i]['startTime'];
            var endTime = da[i]['endTime'];

            var newLine = $('#each-line').clone();
            //填充数据
            newLine.find('#price').html(price + "元");
            newLine.find('#endTime').html(endTime);

            newLine.attr('id', 'each-line' + (i + 1));
            newLine.removeClass("hidden");
            $('#table-line').append(newLine);
        }
        //$('#each-line').addClass('hidden');
    }

    /**
     * 获取数据
     */
    function getCouponsList() {
        $.ajax({
            url: "../../index/index.php",
            data: {
                action      : "getCouponsForList"
            },
            type: 'post',
            dataType: 'json',
            success: function(data) {
                if (data.length > 0) {
                    processData(data);
                } else {
                    $('#hint').removeClass("hidden");
                }
            },
            error: function(data) {
                alert("获取失败");
            }
        });
    }
</script>

</html>