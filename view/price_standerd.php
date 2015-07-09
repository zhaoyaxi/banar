<?php
	if(!isset($_SESSION)){  
           session_start();  
        } 
	if( !($_SESSION['login'] ==  1) || !( $_SESSION['level'] == 1)){
		 header("Location:../err/rooterr.html");
	}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>"搬哪儿"后台管理</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/foundation.min.css" />


    <script src="../js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="../js/foundation.min.js"></script>
    <script type="text/javascript" src="../js/modernizr.js"></script>

    <script type="text/coffeescript" src="../js/common.js.coffee"></script>
    <script src="../js/coffee-script.js"></script>



    <style>
        body{
            font-family: "Helvetica Neue",Helvetica,Arial,"Hiragino Sans GB","华文细黑","STHeiti","微软雅黑";
            background: rgb(245,245,245);
        }
        .active{
            border-bottom: solid rgb(0,140,186) 4px;
        }
        #container .row{
            max-width: none;
        }
        .demo{
            display: none !important;
        }
    </style>

</head>
<body>
<nav class="top-bar sticky" data-topbar role="navigation">
    <ul class="title-area">
        <li class="name">
            <h1><a href="/index.php">"搬哪儿"后台管理</a></h1>
        </li>
        <li class="divider"></li>
    </ul>

   <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="left">
            <li id="adminList " class="has-dropdown <?php
														if(!isset($_SESSION)){  
															session_start();  
														} 
														if($_SESSION['level'] != 1)
														echo 'hidden';?>">
                <a href="adminList.php">人员管理</a>
                
            </li>
            
            <li id="driveList" class="has-dropdown ">
                <a href="driveList.php" >司机管理</a>
                
            </li>
            <li id="orderList" class="has-dropdown ">
                <a href="orderList.php" >订单管理</a>
                
            </li>
			<li id="price" class="has-dropdown <?php
														if($_SESSION['level'] != 1)
														echo 'hidden';?>">
                <a href="price.php">定价管理</a>
                
            </li>
            <li id="price_standerd" class="has-dropdown active<?php
														if($_SESSION['level'] != 1)
														echo 'hidden';?>">
                <a href="price_standerd.php" >价标管理</a>
                
            </li>
            <li id="adminAction" class="has-dropdown  <?php
														if($_SESSION['level'] != 1)
														echo 'hidden';?>">
                <a href="adminAction.php" >管理员订单操作</a>
                
            </li>
            <li id="adminActionDriver" class="has-dropdown <?php
														if($_SESSION['level'] != 1)
														echo 'hidden';?>">
                <a href="adminActionDriver.php" >管理员司机操作</a>
                
            </li>
			<li id="cancelorderList" class="has-dropdown <?php
														if($_SESSION['level'] != 1)
														echo 'hidden';?>">
                <a href="cancelorderList.php" >取消订单管理</a>
                
            </li>
			<li id="sendMessage" class="has-dropdown ">
                <a href="sendMessage.php" >发送短信</a>
                
            </li>
			<li  class="has-dropdown ">
                <a href="password.php" >修改密码</a>
                
            </li>
        </ul>

        <!-- Left Nav Section -->
        <ul class="right">
            <li><a >欢迎，
                <?php
			if(!isset($_SESSION)){  
				session_start();  
			} 
			echo $_SESSION['name']?></a></li>
            <li><a href="../backController/exit.php" class="button info">退出</a></li>
        </ul>
    </section>
</nav>
<div class="container small-10 small-offset-1" id="container">
    <style>
        .diviation{
            padding: 0 20px 0;
            margin: 20px 0;
            line-height: 1px;
            border-left: 200px solid #ddd;
            border-right: 200px solid #ddd;
            text-align: center;
        }

        /*from WCQ*/
        .departments{
            padding:10px;
            text-align: left;
            background-color: #f6f6f6;
            display: inline-block;
            height: 50px;
            width: 97.3%;
            cursor: pointer;
            box-shadow: 0px 0px 1px 1px rgba(0,0,0,0.3);
            margin: 7px 1%;
            line-height: 30px;
        }

        .edit-department,.rm-department,.edit-doctor,.rm-doctor{
            color: #fff;
            float: right;
            display: block;
            height: 30px;
            padding:  10px;
            line-height: 10px;
        }
        .edit-department{
            background-color: #00b810;
        }
        .edit-department:hover{
            background-color: #3ec537;
        }
        .rm-department{
            background-color: #c00000;
        }
        .rm-department:hover{
            background-color: #df0000;
        }
        .departments:hover{
            /*background-color: #f6f6f6;*/
            background-color: #fffbd8 !important;
        }
        .selected{
            background-color: #fffbd8 !important;
        }
        #manage-department{
            padding-top:7px;
            padding-bottom: 7px;
            padding-left: 1%;
            padding-right: 1%;
            margin-bottom: 15px;
            cursor: default;
            border: 1px solid #ccc;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
        }
        #add-department{
            text-align: center;
            padding:10px;
            width: 47.3%;
            background-color: #fff;
            display: inline-block;
            height: 50px;
            color: #008CBA;
            cursor: pointer;
            box-shadow: 0px 0px 1px 1px rgba(0,0,0,0.3);
            margin: 7px 1%;
            line-height: 30px;
        }
        #add-department:hover{
            background-color: #f6f6f6;
            color: #00b9ef;
            box-shadow: 0px 0px 2px 2px rgba(0,0,0,0.5);
        }

    </style>
    <link href="../js/select2.css" rel="stylesheet" type="text/css"/>
    <script src="../js/select2.js"></script>
    <div style="height: 100px" class="row">

    </div>
    <div class="row" style="width: 100%">

        <dl class="tabs vertical" data-tab>
            <dd class="active "><a href="#a_price">定额抽取</a></dd>
			<dd class=" "><a href="#b_price">比例抽取</a></dd>
			<dd class=" "><a href="#c_price">标杆抽取</a></dd>
        </dl>
        <div class="tabs-content vertical">
            <div data-alert class="alert-box success radius " id="success-alerter" style="display: none">
                <label id="success-info">操作成功</label>
                <!--<a href="#" class="close">&times;</a>-->
            </div>

            <section id="a_price" class="content active">
                <div class="panel" style="margin: 0">
                    
                    <div class="row">
                        <div class="small-6 column" >
                            <label>抽取金额</label>
                            <input id="aprice" type="text"  name="username" placeholder="单位：元">
                        </div>

                    </div>


                </div>
                <div class="panel">
                    <script src="../js/bootstrap.min.js"></script>
                    <button onclick="priceStan1()" class="button postfix info small" data-toggle="modal" data-target="#myModal">修改</button>
                </div>
            </section>
			<section id="b_price" class="content ">
                <div class="panel" style="margin: 0">
                    
                    <div class="row">
                        <div class="small-6 column" >
                            <label>抽取比例</label>
                            <input id="bprice" type="text"  name="username" placeholder="%">
                        </div>

                    </div>


                </div>
                <div class="panel">
                    <script src="../js/bootstrap.min.js"></script>
                    <button onclick="priceStan2()" class="button postfix info small" data-toggle="modal" data-target="#myModal">修改</button>
                </div>
            </section>
			<section id="c_price" class="content ">
                <div class="panel" style="margin: 0">
                    
                    <div class="row">
                        <div class="small-6 column" >
                            <label>标杆金额</label>
                            <input id="cprice1" type="text"  name="username" placeholder="单位：元">

                        </div>
						<div class="small-6 column" >
                            <label>少于时抽取金额</label>
                            <input id="cprice2" type="text"  name="username" placeholder="单位：元">

                        </div>
						<div class="small-6 column" >
                            <label>多于时抽取比例</label>
                            <input id="cprice3" type="text"  name="username" placeholder="%">

                        </div>

                    </div>


                </div>
                <div class="panel">
                    <script src="../js/bootstrap.min.js"></script>
                    <button onclick="priceStan3()" class="button postfix info small" data-toggle="modal" data-target="#myModal">修改</button>
                </div>
            </section>
        </div>
    </div>


    <script>
       window.onload = function() {
                //alert(1);
                $(document).foundation();
	   }

	   function priceStan1(){
		   //alert(1);
		  var s_price = $('#aprice').val();
			 $.ajax({
				url:"../index/backindex.php",
				async:false,
				type:"POST",
				dataType:"json",
				data:{
					s_price:s_price,
					action:"priceStan1"
				},
				success:function(data){
					if(data.status){
						alert('操作成功！');
					}
					else{
						alert(data.error);
					}
				},
				error:function(){
					alert('没有信息');
				}
			});
	
	   }
	   function priceStan2(){
		   //alert(2);
		   var s_per = $('#bprice').val();
			 $.ajax({
				url:"../index/backindex.php",
				async:false,
				type:"POST",
				dataType:"json",
				data:{
					s_per:s_per,
					action:"priceStan2"
				},
				success:function(data){
					if(data.status){
						alert('操作成功！');
					}
					else{
						alert(data.error);
					}
				},
				error:function(){
					alert('没有信息');
				}
			});
	   }
	   function priceStan3(){
		   //alert(3);
		   var r_sta = $('#cprice1').val();
		   var r_price = $('#cprice2').val();
		   var r_per = $('#cprice3').val();
			 $.ajax({
				url:"../index/backindex.php",
				async:false,
				type:"POST",
				dataType:"json",
				data:{
					r_sta:r_sta,
					r_price:r_price,
					r_per:r_per,
					action:"priceStan3"
				},
				success:function(data){
					if(data.status){
						alert('操作成功！');
					}
					else{
						alert(data.error);
					}
				},
				error:function(){
					alert('没有信息');
				}
			});
	   }

    </script>
</div>>
<!--Modal 区-->

</body>
</html>