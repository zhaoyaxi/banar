<?php
	if(!isset($_SESSION)){  
           session_start();  
        } 
	if( !($_SESSION['login'] ==  1) ){
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
            <li id="price_standerd" class="has-dropdown <?php
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
    .label-success{
        margin-top: 2%;
        margin-right: 4%;
    }
    .panel{
        background: #FDFCFC;
    }
    .dorder{
        margin-top: 4%;


    }
    input[type="text"][disabled], input[type="text"][readonly], fieldset[disabled] input[type="text"], input[type="password"][disabled], input[type="password"][readonly], fieldset[disabled] input[type="password"], input[type="date"][disabled], input[type="date"][readonly], fieldset[disabled] input[type="date"], input[type="datetime"][disabled], input[type="datetime"][readonly], fieldset[disabled] input[type="datetime"], input[type="datetime-local"][disabled], input[type="datetime-local"][readonly], fieldset[disabled] input[type="datetime-local"], input[type="month"][disabled], input[type="month"][readonly], fieldset[disabled] input[type="month"], input[type="week"][disabled], input[type="week"][readonly], fieldset[disabled] input[type="week"], input[type="email"][disabled], input[type="email"][readonly], fieldset[disabled] input[type="email"], input[type="number"][disabled], input[type="number"][readonly], fieldset[disabled] input[type="number"], input[type="search"][disabled], input[type="search"][readonly], fieldset[disabled] input[type="search"], input[type="tel"][disabled], input[type="tel"][readonly], fieldset[disabled] input[type="tel"], input[type="time"][disabled], input[type="time"][readonly], fieldset[disabled] input[type="time"], input[type="url"][disabled], input[type="url"][readonly], fieldset[disabled] input[type="url"], input[type="color"][disabled], input[type="color"][readonly], fieldset[disabled] input[type="color"], textarea[disabled], textarea[readonly], fieldset[disabled] textarea {
        background-color: #f1f1f1;
        cursor: default;
    }


</style>
<link href="../js/select2.css" rel="stylesheet" type="text/css"/>
<script src="../js/select2.js"></script>
<div style="height: 100px" class="row">

</div>
<div class="row" >
    <div id="drive-add" class="small-6 column">
        <div class="panel" style="margin: 0">
            <h4 style="font-size: 25px">订单信息</h4>
            <h4 id="order_time" style="font-size: 15px">下单时间：2015-5-12</h4>
            <div class="row">
                <div class="small-6 column" >
                    <label>用户名称</label>
                    <input id='name' type="text" value="刘大师" name="username"  readonly>
                </div>
                <div class="small-6 column" >
                    <label>用户电话</label>
                    <input id='phone' type="tel" value="18899990000" name="username" readonly>
                </div>
            </div>
            <div class="row">
                <div class="small-6 column" >
                    <label>搬家时间</label>
                    <input id='startTime' type="tel" value="2015-7-1" name="username" readonly>
                </div>
                <div class="small-6 column" >
                    <label>要求车型</label>
                    <input id='car_id' type="text" value="面包" name="username"  readonly>
                </div>
            </div>
            <div class="row">
                <div class="small column" >
                    <label>起点</label>
                    <input id='startLocation' type="text" value="天通北苑xx楼" name="username" readonly style="background: #A0FD6F">
                </div>
            </div>
            <div class="row">
                <div class="small column" >
                    <label>终点</label>
                    <input id='endLocation' type="text" value="北京市海淀区学院路37号" name="username" readonly>
                </div>
            </div>
            <div class="row">

                <div class="small-6 column">
                    <label>起点楼层</label>
                    <input id='floorCount' type="text" value="2层" name="username" readonly>
                </div>
                <div class="small-6 column">
                    <label>终点楼层</label>
                    <input id='toFloorCount' type="text" value="2层" name="username" readonly>
                </div>

            </div>
            <div class="row">
                <div class="small column" >
                    <label>备注</label>
                    <input id='message' type="text" name="username" value="希望师傅能准时到达" readonly>
                </div>
            </div>

            <div class="row">

                <div class="small-6 column" >
                    <label>理论收费</label>
                    <input id='total_price' type="text" name="username" value="160" readonly style="background: #ffff00">
                </div>
                <div class="small-6 column" >
                    <label>优惠减价</label>
                    <input id='pre_price' type="text" name="username" value="15" readonly>
                </div>

            </div>
            <div class="row">
                <div class="small-6 column" >
                    <label>实际收费</label>
                    <input id='a_price' type="text" name="username" value="145"  readonly style="background: #A0FD6F">
                </div>
				<div class="small-6 column" >
                    <label>应付司机</label>
                    <input id='real_price' type="text" name="username" value="145"  readonly style="background: #A0FD6F">
                </div>
            </div>
        </div>
    </div>

    <div id="add" class="small-6 column ">

        <div class="panel small " >
            <h4 style="font-size: 25px">操作管理员</h4>
            <h3 id="adminName" class="">Adase</h3>

        </div>

        <div id="no_driver" class="panel small " >
            <h4 style="font-size: 25px">绑定司机信息</h4>
            <button id="gotofix" class="button success" style="margin-top: 5%">尚未绑定去绑定</button>

        </div>
        <div id="driver" class="panel small " >
                <h4 style="font-size: 25px">司机信息</h4>
                <div class="row">
                    <div class="small-6 column" >
                        <label>司机名称</label>
                        <input id="driverName" type="text" name="username" placeholder="刘" readonly>
                    </div>
                    <div class="small-6 column" >
                        <label>司机电话</label>
                        <input id="driverPhone"type="text" name="username"placeholder="13311655542" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="small-6 column" >
                        <label>牌照</label>
                        <input id="driverLicense"type="text" name="username" placeholder="sde2123" readonly>
                    </div>
                </div>
                <button id="gotodrive" class="button "  onclick="gotodrive(id)" style="background-color: #F0AF53">查看完整细节</button>

        </div>
        <div id="comment" class="panel " >
            <h4 style="font-size: 25px">用户评价</h4>
            <div style="margin-top: 3%">

                <link rel="stylesheet" type="text/css" href="../css/new-detail.min.css" />
                <span class="yellowstar45 star-icon" ></span>
                <span id="orderStar" class="star-rating" style="margin-left: 2%">4</span>
            </div>

            <div style="margin-top: 3%">
                <label id="lab1" class="label label-success hidden" style="background-color: #60BA62">能够准时到达</label>
                <label id="lab2" class="label label-success hidden" style="background-color: #60BA62">热情周到</label>
                <label id="lab3" class="label label-success hidden" style="background-color: #60BA62">服务认真，举止文明</label>
                <label id="lab4" class="label label-success hidden" style="background-color: #F0AF53">不够热情</label>
                <label id="lab5" class="label label-success hidden" style="background-color: #F0AF53">没有送到终点</label>
                <label id="lab6" class="label label-success hidden" style="background-color: #DB5552">服务态度恶劣</label>
                <label id="lab7" class="label label-success hidden" style="background-color: #DB5552">迟到严重</label>
            </div>
            <input id="orderComment" type="text" name="username" placeholder="并未留言" readonly style="margin-top: 5%">
        </div>
        <div id="no_comment" class="panel" >
            <h4 style="font-size: 25px">用户评价</h4>

            <h2  style="font-size: 20px">用户并未评价</h2>
        </div>
		<div id="state4" class="panel hidden" >
            <h4 style="font-size: 50px">已退单</h4>

        </div>
    </div>
</div>


<script>
    window.onload = function(){
        $(document).foundation();
         var id = <?php echo $_GET['id'];?>;
        intiOrder(id);
        $('#gotofix').click(function(){
            window.open("orderAdrive.php?id="+id);
        });
    }

    function intiOrder(id){
        //alert(id);
        $.ajax({
            url:"../index/backindex.php",
            async:false,
            type:"POST",
            dataType:"json",
            data:{
                id:id,
                action:"getOrderById"
            },
            success:function(data){
                if(data.status){
                    //alert("注册成功");
                    var datas = data.datas;
                    //alert(datas);
                    $('#name').val(datas['name']);
                    $('#phone').val(datas['phone']);
                    $('#car_id').val(datas['car_id']);
                    $('#a_price').val(datas['price']);
                    $('#pre_price').val(datas['pre_price']);
                    $('#startLocation').val(datas['startLocation']);
                    $('#endLocation').val(datas['endLocation']);
                    $('#startTime').val(datas['startTime']);
                    $('#message').val(datas['message']);
                    $('#floorCount').val(datas['floorCount']);
                    $('#toFloorCount').val(datas['toFloorCount']);
					$('#real_price').val(datas['real_price']);

                    $('#total_price').val(parseInt(datas['price'])+parseInt(datas['pre_price']));

					$('#order_time').html('下单时间：'+datas['createTime']);

                    var state = datas['state'];
                    if(state == 0){
                        //alert(0);

                        $('#admin').addClass('hidden');
                        $('#no_driver').removeClass('hidden');
                        $('#driver').addClass('hidden');
                        $('#no_comment').removeClass('hidden');
                        $('#comment').addClass('hidden');
                    }else if(state == 1){
                        //alert(1);
                        $('#admin').removeClass('hidden');
                        $('#driver').removeClass('hidden');
                        $('#no_driver').addClass('hidden');
                        $('#no_comment').removeClass('hidden');
                        $('#comment').addClass('hidden');
						intiAdmin(id);
                        intiDriver(id);
                    }else if(state == 2){
                        //alert(2);
                        $('#admin').removeClass('hidden');
                        $('#driver').removeClass('hidden');
                        $('#no_driver').addClass('hidden');
                        $('#no_comment').addClass('hidden');
                        $('#comment').removeClass('hidden');

                        intiDriver(id);
						intiComment(id);
						intilab(id);
						intiAdmin(id);
                    }else if(state == 3){
                        //alert(3);
                        $('#admin').removeClass('hidden');
                        $('#driver').removeClass('hidden');
                        $('#no_driver').addClass('hidden');
                        $('#no_comment').addClass('hidden');
                        $('#comment').removeClass('hidden');

                        intiDriver(id);
						intiComment(id);
						intilab(id);
						intiAdmin(id);
                    }
					else if(state == 4){
                        //alert(3);
                        $('#admin').addClass('hidden');
                        $('#driver').addClass('hidden');
                        $('#no_driver').addClass('hidden');
                        $('#no_comment').addClass('hidden');
                        $('#comment').addClass('hidden');
						
						$('#state4').removeClass('hidden');
                    }
                }
                else{
                    alert(data.error);
                }
            },
            error:function(){
                alert('error');
            }
        });
    }

    function intiDriver(id){
        $.ajax({
            url:"../index/backindex.php",
            async:false,
            type:"POST",
            dataType:"json",
            data:{
                id:id,
                action:"getDriverInfoFromOid"
            },
            success:function(data){
                if(data.status){
                    var datas = data.datas;

                    $('#driverName').val(datas[0]['name']);
                    $('#driverPhone').val(datas[0]['phone']);
                    $('#driverLicense').val(datas[0]['license']);
                    $('#gotodrive').attr('id',datas[0]['id']);//写

                }
                else{
                    alert('error');
                }
            }
        });
    }

    function intiComment(id){
		$.ajax({
            url:"../index/backindex.php",
            async:false,
            type:"POST",
            dataType:"json",
            data:{
                id:id,
                action:"intiComment"
            },
            success:function(data){
                if(data.status){
                    var datas = data.datas;
					$('#orderComment').val(datas['comment']);
					//alert(datas['comment']);
					$('#orderStar').html(datas['star']);

                }
                else{
                    alert('error');
                }
            }
        });

    }

	function intiAdmin(id){
		$.ajax({
            url:"../index/backindex.php",
            async:false,
            type:"POST",
            dataType:"json",
            data:{
                id:id,
                action:"intiAdmin"
            },
            success:function(data){
                if(data.status){
                    var datas = data.datas;
					
					//alert(datas['comment']);
					$('#adminName').html(datas['name']);

                }
                else{
                    alert('error');
                }
            }
        });

    }

	function intilab(id){
		$.ajax({
            url:"../index/backindex.php",
            async:false,
            type:"POST",
            dataType:"json",
            data:{
                id:id,
                action:"intilab"
            },
            success:function(data){
                if(data.status){
					//alert(1);
                    var datas = data.datas;
					//alert(datas['lab1']);
                   if(datas['lab1'] == 1){
					   $('#lab1').removeClass('hidden');
				   }
				   if(datas['lab2'] == 1){
					   $('#lab2').removeClass('hidden');
				   }
				   if(datas['lab3'] == 1){
					   $('#lab3').removeClass('hidden');
				   }
				   if(datas['lab4'] == 1){
					   $('#lab4').removeClass('hidden');
				   }
				   if(datas['lab5'] == 1){
					   $('#lab5').removeClass('hidden');
				   }
				   if(datas['lab6'] == 1){
					   $('#lab6').removeClass('hidden');
				   }
				   if(datas['lab7'] == 1){
					   $('#lab7').removeClass('hidden');
				   }
                }
                else{
                    alert('error');
                }
            }
        });

    }

    function gotodrive(id){
        //alert(id);
        window.open("driveDetail.php?id="+id);
    }
</script>
</div>>
<!--Modal 区-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 20%">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                确认对修改？
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">关闭
                </button>
                <button type="button" class="btn btn-primary">
                    提交确认
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
</body>
</html>