<!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <title>联系我们</title>
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
        .container {
            text-align: center;
        }

        .container>section>div {
            display: inline-block;
            vertical-align: top;
            position: relative;
        }
        .all {
            margin-top: 4%;
            margin-bottom: 5%;
            padding-bottom: 10%;
        }
        td{
            padding-top: 10px;
        }
        .container>section {
            padding-top: 50px;
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

        button {
            display: block;
            position: relative;

            background-color: #ff8f4c;
            width: 100%;
            margin: auto;
            margin-top: 10px;
            box-sizing: border-box;
            color: #fff;
            font-family: "微软雅黑", "Microsoft Yahei", Arial, Helvetica, sans-serif, "宋体";
            /*letter-spacing: .5em;*/
            padding: 10px;
            font-size: 16px;
            border-radius: 3px;
            border: none;
            cursor: pointer;
            transition: all ease .3s;
        }
        button:hover {
            background-color: #f60;
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

    <!--联系我们-->
    <div class="row small-10 all" style="padding-bottom: 50px">
        <section>
            <div style="width: 100%">
                <form style="width: 100%" action="#" id="feed-back-form">
                    <input type="text" name="name" id="name" placeholder="留下您的大名" required="required"/>
                    <input type="email" name="address" id="email" placeholder="邮件地址/电话号码" required="required"/>
                    <textarea name="content" id="content" placeholder="留下您想说的话" required="required" ></textarea>
                    <button type="button" onclick="sendQuestion();">发&nbsp;送</button>
                </form>
            </div>
        </section>

    </div>

    <div class="container" style="padding-bottom: 50px;margin-top:50px;background-color: #215085">
        <div>
            <h2 style="color: #ffffff">
                客户服务
            </h2>
        </div>
        <div>
            <a href="tel:400-880-7870"><h2 style="color: #ffffff">400-880-7870</h2></a>
        </div>
        <div>
            <a href="mailto:hi@banar.cn"><h2 style="color: #ffffff">hi@banar.cn</h2></a>
        </div>
    </div>

<!--处理数据-->
<script>

    function sendQuestion() {
        var email = document.getElementById("email");
        var content = document.getElementById("content");
        var name = document.getElementById("name");

        //postData(name.value, email.value, content.value);

        if (email.value == "" || content.value == "" || name == "") {
            alert("请填写完整信息");
        } else if (!isValid(email.value)) {
            alert("联系信息格式不正确");
        } else {
            postData(name.value, email.value, content.value);
        }
    }

    /**
     * 验证信息是否为电话号码或者email
     * @param textValue 内容
     */
    function isValid(textValue) {
        var regEmail = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
        var regPhone = /^(((13[0-9]{1})|159|153)+\d{8})$/;
        return regEmail.test(textValue) || regPhone.test(textValue);
    }

    /**
     * 将数据发送到数据库
     * @param name
     * @param email
     * @param content
     */
    function postData(name, email, content) {
        $.ajax({
            url: "../../index/index.php",
            async:false,
            data: {
                action : "postQuestion",
                name      : name,
                email     : email,
                content   : content
            },
            type: 'post',
            dataType: 'json',
            success: function(data) {
                //alert("修改成功");
            },
            error: function(data) {
                alert("验证过期,请刷新后重试");
            }
        });
    }

</script>


</body>
</html>