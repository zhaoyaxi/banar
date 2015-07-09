<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>司机评价</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,initial-scale=1,maximum-scale=1.0,user-scalable=no" />

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
        .make-order {
            margin: 0 auto;
            width: 80%;
            display: block;
        }


        input,textarea{
            width: 100%;
            outline: none;
            font-size: 14px;
            line-height: 1.4em;
            box-sizing: border-box;
            padding: 8px 15px;
            border-radius: 3px;
            border: 2px solid #efb685;
            transition: all ease .3s;
            margin-top: 10px;
        }

        input:focus, textarea:focus{
            border-color: #ff8f4c;
        }

        label {
            font-size: 1.2em;
        }

        textarea{
            /*width: 100%;*/
            min-height: 120px;
            resize: vertical;
            outline: none;
        }
        .panel{
            background: #FDFCFC;
        }
        .labeldiv{
            margin-top: 3%;
            margin-right: 3%;
        }

        .all {
            margin-top: 4%;
            margin-bottom: 5%;
            padding-bottom: 10%;
        }

    </style>
</head>
<body style="background-color: #FE6601;">
    <?php
        $comment_id = $_GET['order_id'];
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['comment_id'] = $comment_id;
    ?>


    <!--整体-->
    <div class="row small-10 all" >
        <div  class="active small column">
            <div class="panel" >
                <div class="row">
                    <div class="small-6 column" >
                        <img src="../../img/box_bus_not_selected.png" height="400px" width="400px" id="driverPortrait">
                    </div>
                    <div class="small-6 column" >
                        <div>
                            <label id="name" style="font-size: 20px;margin-top: 4%"></label>
                        </div>
                        <div>
                            <label id="phone" style="font-size: 20px;margin-top: 4%"></label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="panel" style="margin-top: 4%">
                <label style="color: #b92c28;font-size: 10px">请客观评价司机</label>
                <div style="margin-top: 3%;">
                    <link rel="stylesheet" type="text/css" href="../../css/new-detail.min.css" />
                    <span class="yellowstar45 star-icon" ></span>
                </div>

                <div style="margin-top: 3%">
                    <label id="lab1" class="label label-success labeldiv" style="background-color: #60BA62">能够准时到达</label>
                    <label id="lab2" class="label label-success labeldiv" style="background-color: #60BA62">热情周到</label>
                    <label id="lab3" class="label label-success labeldiv" style="background-color: #60BA62">服务认真，举止文明</label>
                    <label id="lab4" class="label label-success labeldiv" style="background-color: #F0AF53">不够热情</label>
                    <label id="lab5" class="label label-success labeldiv" style="background-color: #F0AF53">没有送到终点</label>
                    <label id="lab6" class="label label-success labeldiv" style="background-color: #DB5552">服务态度恶劣</label>
                    <label id="lab7" class="label label-success labeldiv" style="background-color: #DB5552">迟到严重</label>
                </div>
                <div>
                    <textarea name="content" id="message"  placeholder="留下您想说的话" required="required" ></textarea>
                </div>

            </div>
            <button type="button" onclick="confirmComment()" class="btn btn-primary btn-lg make-order">提交评价</button>

        </div>
    </div>

</body>

<script>
    var order_id = <?php echo $_GET['order_id'];?>;
    var driver_id = 0;
    var label1Clicked = 0;
    var label2Clicked = 0;
    var label3Clicked = 0;
    var label4Clicked = 0;
    var label5Clicked = 0;
    var label6Clicked = 0;
    var label7Clicked = 0;


    window.onload = function () {
        $.ajax({
            url: "../../index/index.php",
            data: {
                action      : "getCommentOrder",
                order_id    : order_id
            },
            type: 'post',
            dataType: 'json',
            success: function(data) {
                processData(data);
            },
            error: function(data) {
                alert("获取失败");
            }
        });


        $('#lab1').click(function () {
            if (label1Clicked == 0) {
                label1Clicked = 1;
                $('#lab1').css("background-color","#14880B");
            } else {
                label1Clicked = 0;
                $('#lab1').css("background-color","#60BA62");
            }
        });
        $('#lab2').click(function () {
            if (label2Clicked == 0) {
                label2Clicked = 1;
                $('#lab2').css("background-color","#14880B");
            } else {
                label2Clicked = 0;
                $('#lab2').css("background-color","#60BA62");
            }
        });
        $('#lab3').click(function () {
            if (label3Clicked == 0) {
                label3Clicked = 1;
                $('#lab3').css("background-color","#14880B");
            } else {
                label3Clicked = 0;
                $('#lab3').css("background-color","#60BA62");
            }
        });
        $('#lab4').click(function () {
            if (label4Clicked == 0) {
                label4Clicked = 1;
                $('#lab4').css("background-color","#8C8F03");
            } else {
                label4Clicked = 0;
                $('#lab4').css("background-color","#F0AF53");
            }
        });
        $('#lab5').click(function () {
            if (label5Clicked == 0) {
                label5Clicked = 1;
                $('#lab5').css("background-color","#8C8F03");
            } else {
                label1Clicked = 0;
                $('#lab5').css("background-color","#F0AF53");
            }
        });
        $('#lab6').click(function () {
            if (label6Clicked == 0) {
                label6Clicked = 1;
                $('#lab6').css("background-color","maroon");
            } else {
                label6Clicked = 0;
                $('#lab6').css("background-color","#DB5552");
            }
        });
        $('#lab7').click(function () {
            if (label7Clicked == 0) {
                label7Clicked = 1;
                $('#lab7').css("background-color","maroon");
            } else {
                label1Clicked = 0;
                $('#lab7').css("background-color","#DB5552");
            }
        });
    }

    function processData(data) {
        console.log(data);
        var driverName = data['name'];//司机名称
        var driverPhone = data['phone'];//司机电话
        var driverStar = data['star'];//司机星星
        var driverImg = "../dphoto/" + driverPhone + ".jpg";//司机头像
        driver_id = data['id'];//司机id

        $('#name').html(driverName);
        $('#phone').html(driverPhone);
        $('#driverPortrait').attr('src', driverImg);
    }


    /**
     * 确认操作
     */
    function confirmComment() {
        var starCount = 0;
        var message = $('#message').val();
        postData(order_id, driver_id, message, starCount);
    }



    /**
     * 上传数据
     */
    function postData(order_id, driver_id, message, starCount) {
        $.ajax({
            url: "../../index/index.php",
            data: {
                action      : "commentOrder",
                order_id    : order_id,
                star        : 1,
                label1      : label1Clicked,
                label2      : label2Clicked,
                label3      : label3Clicked,
                label4      : label4Clicked,
                label5      : label5Clicked,
                label6      : label6Clicked,
                label7      : label7Clicked,
                message     : message,
                driver_id   : driver_id
            },
            type: 'post',
            dataType: 'json',
            success: function(data) {
                alert("评价成功");
            },
            error: function(data) {
                alert("获取失败");
            }
        });
    }

</script>
</html>