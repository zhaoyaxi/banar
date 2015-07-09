<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/foundation.min.css" />
    <style>
        body{
            font-family: "Helvetica Neue",Helvetica,Arial,"Hiragino Sans GB","华文细黑","STHeiti","微软雅黑";
            background: rgb(245,245,245);
        }
        header{
            background: rgb(86,90,92);
        }
        header a {
            color: rgb(204,204,204);
            font-weight: bold;
        }
        header li :hover{
            color:#ffffff;
        }
        #loginTitle{
            margin-top: 60px;
            margin-bottom: 60px;
        }
        #loginBtn{
            background: rgb(255,147,106);
            border: none;
        }
    </style>
	<script src="js/jquery-1.8.3.min.js"></script>
    <title>
        “搬哪儿”后台管理登录
    </title>
</head>
<body>
<header>
    <div class="top-bar">
        <ul class="title-aread">
            <li class="name"><h1><a>“搬哪儿”后台管理系统</a></h1></li>
        </ul>
       
    </div>
</header>

<div class="container-fluid text-center" id="loginTitle">
    <h1>欢迎登录</h1>
    <span class="text">“搬哪儿”后台管理系统</span>
</div>
<div class="small-4 small-offset-4 text-center" >
   
    <div class="container-fluid" id="loginDiv">
        <form role="form" id="dataForm" method="POST" class="small-10 small-offset-1">
            <div class="form-group has-feedback" id="usernameDiv">
                <input type="text" id="usernameInput" placeholder="请输入用户名" name="username" required>
            </div>

            <div class="form-group" id="passwordDiv">
                <input type="password" class="form-control" id="passwordInput" placeholder="请输入密码" name="passwd" required>
            </div>

            <button type="submit" class="tiny radius button expand" onclick="submitForm()" id="loginBtn">管理员登录</button>
            <!--<div class="form-group" id="signupDiv">
                <a type="button" class="form-control" id="signupBtn" href="./signup.html">Registruj se</a>
            </div>-->
        </form>
    </div>
</div>
<script>
//提交数据
	
    function submitForm(){
        var username = usernameInput.value;
        var password = passwordInput.value;
        var objRsbs = $.ajax({
            url:"index/login.php",
            async:false,
            type:"POST",
            dataType:"json",
            data:{
                identification:username,
                password:password,
                action:"login"
            },
            error:function(XMLHttpRequest, textStatus, errorThrown) {
                        alert(XMLHttpRequest.status);
                        alert(XMLHttpRequest.readyState);
                        alert(textStatus);
                    },
            success:function(data){
                if(data.status){
                    //alert("登陆成功，正在跳转");
                    window.open( "view/orderList.php");
					window.close();
                }
                else{
                    alert(data.error);
                }
            }
        });
    }
</script>
</body>
</html>