<!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <title>价格表</title>
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
        h1 {
            margin: 0;
            text-align: center;
        }

        .coupons{
            margin: 0 auto;
            display: block;
            width: 299px;
            background: url(../../img/youhuiquanbg.jpg);
            background-repeat: no-repeat;
            background-position: center;
        }
        .price{
            font-size: 1.8em;
            margin-left: 30px;
        }
        .common-text-left {
            font-size: 1.0em;
            display: inline;
        }
        .common-text-right {
            font-size: 1.0em;
            margin: 0 auto;
            text-align: center;
            display: inline;
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

    <h1>我的优惠券</h1>

    <!--优惠券-->
    <div id="table-line" class="container">
        <div class="coupons" id="each-line">
            <span id="price" class="price">0</span>
            <span style="margin-left: 50px">元现金券</span>
            <div style="width: 100%">
                <div class="common-text-left">
                    <span style="margin-left: 20px">使用时间</span>
                </div>
                <div class="common-text-right">
                    <span id="endTime" style="margin-left: 10%">2015.0.0</span>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    window.onload = function() {
        //getCouponsList();
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
            newLine.find('#price').html(price);
            newLine.find('#endTime').html(endTime);

            newLine.attr('id', 'each-line' + (i + 1));
            $('#table-line').append(newLine);
        }
        $('#each-line').addClass('hidden');
    }

    /**
     * 获取数据
     */
    function getCouponsList() {
        $.ajax({
            url: "../../index/index.php",
            data: {
                action      : "getCouponsList"
            },
            type: 'post',
            dataType: 'json',
            success: function(data) {
                alert("获取成功");
                processData(data);
            },
            error: function(data) {
                alert("获取失败");
            }
        });
    }
</script>

</html>