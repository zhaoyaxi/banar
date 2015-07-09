<!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <title>下订单</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />

    <!-- 新 Bootstrap 核心 CSS 文件 -->

    <link rel="stylesheet" type="text/css" href="../../css/foundation.min.css" />


    <script src="../../js/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="../../js/jquery-1.8.3.min.js"></script>
    <script src="../../js/foundation.min.js"></script>
    <script src="../../js/modernizr.js"></script>
    <script type="text/coffeescript" src="../../js/common.js.coffee"></script>
    <script src="../../js/coffee-script.js"></script>


    <script type="text/javascript" src="../../js/jquery-1.9.1.min.js" ></script>
    <script type="text/javascript" src="../../js/jquery.mobile-1.3.0.min.js" ></script>
    <script type="text/javascript" src="../../js/mobiscroll.js" ></script>

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

        .divborder{
            margin-top: 5px;
        }
        .panel{
            background: #ffffff;
        }


    </style>
</head>
<body style="background-color: #ffff00;margin-top: 0">

    <?php
        if (!isset($_SESSION)) {
            session_start();
        }
    ?>

    <!--主体部分-->
    <div class="row small" style="margin-bottom: 30%;background-color: #FFFF2F;margin-top: 3%;padding-top: 1%;padding-bottom: 1%">
        <div class="panel" style="margin-left: 5%;margin-right: 5%">
            <div class="divborder" style="height: 50px;border-radius: 5px;padding: 0">

                <input class="small-1 column"
                       style="height: 30px;background-color: #ffffff;border: 0px;
                               background: url(../../img/confirm_order_phone_pressed.png) no-repeat;
                              ">

                <div class="small-10 column" style="height: 100%;border-bottom: 1px solid lightskyblue">
                    <input  placeholder="你的称呼"
                            style="height: 100%;width: 100%;font-size: 1.2em;background-color: #ffffff;border: 0px;
                                          ">
                </div>
            </div>
            <div class="divborder" style="height: 50px;border-radius: 5px;padding: 0">
                <input class="small-1 column"
                       style="height: 30px;background-color: #ffffff;border: 0px;
                               background: url(../../img/confirm_order_phone_pressed.png) no-repeat;
                              ">
                <div class="small-10 column" style="height: 100%;border-bottom: 1px solid lightskyblue">
                    <input  placeholder="您的手机"
                            style="height: 100%;width: 100%;font-size: 1.2em;background-color: #ffffff;border: 0px;
                                          ">
                </div>
            </div>

        </div>
        <div class="panel" style="margin-left: 5%;margin-right: 5%">
            <link href="../../css/mobiscroll.custom-2.5.0.min.css" rel="stylesheet" type="text/css" />
            <input type="text" id="text" placeholder="时间选择"
                   style="height: 100%;width: 100%;font-size: 1.2em;background-color: #ffffff;border: 0px;
                                          " />

        </div>
        <div class="panel" style="margin-left: 5%;margin-right: 5%">
            <textarea rows="3" cols="18" placeholder="备注说明"></textarea>

        </div>

    </div>
    <!--点击开始-->
    <div class="fixed-footer" >

        <button type="button" onclick="confirmOrder()" class="btn btn-primary btn-lg make-order">确认提交</button>
    </div>
<script type="text/javascript">
    $(function () {
        var newjavascript={
        plugdatetime:function ($dateTxt,type) {
        //var curr = new Date().getFullYear();
        var opt = {}
        opt.time = {preset : type};
        opt.date = {preset : type};
        opt.datetime = {
        preset : type,
        minDate: new Date(2010,1,01,00,00),
        maxDate: new Date(2020,12,31,24,59),
        stepMinute: 1
    };

    $dateTxt.val('').scroller('destroy').scroller($.extend(opt[type], {
            theme: "sense-ui",
            mode: "scroller",
            display: "modal",
            lang: "english",
            monthText: "月",
            dayText: "日",
            yearText: "年",
            hourText: "时",
            minuteText: "分",
            ampmText:"上午/下午",
            setText: '确定',
            cancelText: '取消',
            dateFormat: 'yy-mm-dd'
            })
        );
        }
        }
        newjavascript.plugdatetime($("#text"), "datetime")
    });
</script>
</body>