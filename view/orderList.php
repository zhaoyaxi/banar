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
    <script type="text/javascript" src="../js/jquery-1.8.3.min.js"></script>
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
            <li id="orderList" class="has-dropdown active">
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
			<li id="cardList" class="has-dropdown <?php
														if($_SESSION['level'] != 1)
														echo 'hidden';?>">
                <a href="cardList.php" >卡券管理</a>
                
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
        <dd class="active "><a id="freshnewOrder" href="#newOrder">新下达订单</a></dd>
        <dd class="  "><a id="freshfixedOrder" href="#fixedOrder">已绑定订单</a></dd>
        <dd class="  "><a id="freshsureOrder" href="#sureOrder">已确认订单</a></dd>
        <dd class="  "><a id="freshcomplectOrder" href="#complectOrder">已完成订单</a></dd>
    </dl>

    <div class="tabs-content vertical">
        <div data-alert class="alert-box warning radius " id="error-alerter" style="display: none">
            <label id="alert-info"></label>
            <!--<a href="#" class="close">&times;</a>-->
        </div>
        <div data-alert class="alert-box success radius " id="success-alerter" style="display: none">
            <label id="success-info">操作成功</label>
            <!--<a href="#" class="close">&times;</a>-->
        </div>
        <section id="newOrder" class="content active">

            <div class="panel">
                <table width="100%" id="data-user">
                    <thead>
                    <tr>
                        <td>下单人</td>
                        <td>下达时间</td>
                        <td>已等待</td>
                        <td>操作</td>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <div class="pagination-centered" role="menubar" aria-label="Pagination" id="for-search-user" data-for="#search-user">
                    <input type="hidden" name="page" value="0">
                    <input type="hidden" name="size" value="5">
                    <ul class="pagination">
                        <li class="arrow"><a href="javascript:void(0)">&laquo;</a></li>
                        <li class="arrow"><a href="javascript:void(0)">&raquo;</a></li>
                    </ul>
                </div>
            </div>

        </section>
        <section id="fixedOrder" class="content ">

            <div class="panel">
                <table width="100%" id="data-user2">
                    <thead>
                    <tr>
                        <td>名字</td>
                        <td>下达时间</td>
                        <td>绑定人员</td>
                        <td>绑定司机</td>
                        <td>操作</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="theData">
                        <td data-name="username">刘杰</td>
                        <td data-name="create_at">2015-5-18 13:13:22</td>
                        <td data-name="create_at">lin</td>
                        <td data-name="create_at">黄星1</td>
                        <td class="centered">
                            <ul class="button-group round operation00 operation01 operation11" >
                                <li><button  class="tiny button success">查看详情</button></li>
                            </ul>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="pagination-centered" role="menubar" aria-label="Pagination"  data-for="#search-user">
                    <input type="hidden" name="page" value="0">
                    <input type="hidden" name="size" value="5">
                    <ul class="pagination">
                        <li class="arrow"><a href="javascript:void(0)">&laquo;</a></li>
                        <li class="arrow"><a href="javascript:void(0)">&raquo;</a></li>
                    </ul>
                </div>
            </div>

        </section>
        <section id="sureOrder" class="content ">

            <div class="panel">
                <table width="100%" id="data-user3">
                    <thead>
                    <thead>
                    <tr>
                        <td>名字</td>
                        <td>确定时间</td>
                        <td>绑定人员</td>
                        <td>绑定司机</td>
                        <td>操作</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="theData">
                        <td data-name="username">刘杰</td>
                        <td data-name="create_at">2015-5-18 13:15:22</td>
                        <td data-name="create_at">lin</td>
                        <td data-name="create_at">黄星1</td>
                        <td class="centered">
                            <ul class="button-group round operation00 operation01 operation11" >
                                <li><button  class="tiny button info" data-id="0">查看详情</button></li>
                                <li><button  class="tiny button warning" data-id="0">打款通知</button></li>
                                <li><button class="tiny button alert" data-id="0">确认完成</button></li>
                            </ul>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="pagination-centered" role="menubar" aria-label="Pagination"  data-for="#search-user">
                    <input type="hidden" name="page" value="0">
                    <input type="hidden" name="size" value="5">
                    <ul class="pagination">
                        <li class="arrow"><a href="javascript:void(0)">&laquo;</a></li>
                        <li class="arrow"><a href="javascript:void(0)">&raquo;</a></li>
                    </ul>
                </div>
            </div>

        </section>
        <section id="complectOrder" class="content ">

            <div class="panel">
                <table width="100%" id="data-user4">
                    <thead>
                    <tr>
                        <td>名字</td>
                        <td>完成时间</td>
                        <td>绑定人员</td>
                        <td>绑定司机</td>
                        <td>操作</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="theData">
                        <td data-name="username">刘杰</td>
                        <td data-name="create_at">2015-5-18 13:15:22</td>
                        <td data-name="create_at">lin</td>
                        <td data-name="create_at">黄星1</td>
                        <td class="centered">
                            <ul class="button-group round operation00 operation01 operation11" >
                                <li><button  class="tiny button success">查看详情</button></li>
                            </ul>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="pagination-centered" role="menubar" aria-label="Pagination"  data-for="#search-user">
                    <input type="hidden" name="page" value="0">
                    <input type="hidden" name="size" value="5">
                    <ul class="pagination">
                        <li class="arrow"><a href="javascript:void(0)">&laquo;</a></li>
                        <li class="arrow"><a href="javascript:void(0)">&raquo;</a></li>
                    </ul>
                </div>
            </div>

        </section>


    </div>
</div>


<!--Modal 区-->
<div id="extend">
    <!--编辑用户-->
    <div id="edit-factory" class="reveal-modal" data-reveal>
        <form method="POST" id="form-edit-factory">
            <div class="row">
                <div class="row">
                    <div class="small-4 column">
                        <div>
                            <h4>厂家信息</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label>厂家名称
                        <input type="text" required name="name">
                        <input type="hidden" required name="id">
                    </label>
                </div>
                <div class="row">
                    <label>管理账户
                        <input type="text" required name="account">
                    </label>
                </div>
                <div class="row">
                    <div class="small-6 column">
                        <label>登录密码
                            <input type="password" name="passwd">
                        </label>
                    </div>
                    <div class="small-6 column">
                        <label>重复密码
                            <input type="password" name="passwd_confirmation">
                        </label>
                    </div>
                </div>
                <div class="row">
                    <label>关联车系
                        <select data-select="3" name="series_id" class="select-brand" multiple>

                        </select>
                    </label>
                </div>
            </div>
            <button class="alert button small">保&nbsp;&nbsp;存</button>
        </form>
        <a class="close-reveal-modal">&#215;</a>
    </div>
    <!--/编辑用户-->



</div>


</div>



<script>
window.onload = function(){
    $(document).foundation();
    //fresh0();
    $('#freshnewOrder').click(function(){
        //alert(1);
        fresh0();
    });
    $('#freshfixedOrder').click(function(){
        //alert(2);
        fresh1();
    });
    $('#freshsureOrder').click(function(){
        //alert(3);
        fresh2();
    });
    $('#freshcomplectOrder').click(function(){
        //alert(4);
        fresh3();
    });
}

function fresh0(){
    $.ajax({
        url:"../index/backindex.php",
        async:false,
        type:"POST",
        dataType:"json",
        data:{
            state:0,
            action:"orderFresh"
        },
        success:function(data){
            if(data.status){
                //alert("注册成功");
                $('.theData').addClass('hidden');

                var datas = data.datas;
                if(data.datas.length != 0){
                    //alert(datas.length);
                    if(datas.length != 0){
                        for(var i = 0;i < datas.length;i++){
							var isCancel = datas[i]['isCancel'];
							if( isCancel == 0){
								var id = datas[i]['id'];
								var name = datas[i]['name'];
								var time = datas[i]['time'];
								var wait_time = datas[i]['wait_time'];
								//alert(name);
								var str = "";
								if( wait_time < 10){
									//alert(10);
									str = "green";
								}else if(wait_time < 20){
									//alert(20);
									str = "yellow";
								}else{
									//alert(30);
									str = "red";
								}


								$("<tr class=\"theData\">" +
								"<td data-name=\"username\">"+name+"</td>" +
								"<td data-name=\"create_at\">"+time+"</td>" +
								"<td data-name=\"waittime\">" +
								"<label class=\"label label-info\" style=\"background:"+str+" \">"+wait_time+"min</label>" +
								"</td>" +
								"<td class=\"centered\">" +
								"<ul class=\"button-group round operation00 operation01 operation11\" >" +
								"<li><button onclick='fixed("+id+")' class=\"tiny button success\" data-id=\""+id+"\">查看与绑定</button></li>" +
								"</ul></td></tr>")
									.insertAfter($("#data-user tr:last"));
							}

                        }
                    }
                }
            }
            else{
                alert(data.error);
            }
        },
        error:function(){
            alert('没有数据');
        }
    });

}

function fresh1(){
    $.ajax({
        url:"../index/backindex.php",
        async:false,
        type:"POST",
        dataType:"json",
        data:{
            state:1,
            action:"orderFresh1"
        },
        success:function(data){
            if(data.status){
                //alert("返回成功");
                $('.theData').addClass('hidden');
                var datas = data.datas;
                for(var i = 0;i < datas.length;i++){
					var isCancel = datas[i]['isCancel'];
					if( isCancel == 0){
						var id = datas[i]['id'];
						var name = datas[i]['name'];
						var createTime = datas[i]['createTime'];
						var aname = datas[i]['aname'];
						var dname = datas[i]['dname'];
						//alert(name);

						$("<tr class=\"theData\">" +
						"<td data-name=\"username\">"+name+"</td>" +
						"<td data-name=\"create_at\">"+createTime+"</td>" +
						"<td data-name=\"create_at\">"+aname+"</td>" +
						"<td data-name=\"create_at\">"+dname+"</td>" +
						"<td class=\"centered\">" +
						"<ul class=\"button-group round operation00 operation01 operation11\" >" +
						"<li><button onclick='information("+id+")' class=\"tiny button success\" data-id=\""+id+"\">查看详情</button></li>" +
						"<li><button onclick=\"complect("+id+",'fresh1')\" class=\"tiny button success\" data-id=\""+id+"\">强制完成</button></li>" +
						"</ul></td></tr>")
							.insertAfter($("#data-user2 tr:last"));
					}

                }
            }
            else{
                alert(data.error);
            }
        },
        error:function(){
            alert('没有数据');
        }
    });

}

function fresh2(){
    $.ajax({
        url:"../index/backindex.php",
        async:false,
        type:"POST",
        dataType:"json",
        data:{
            state:2,
            action:"orderFresh1"
        },
        success:function(data){
            if(data.status){
                //alert("注册成功");
                $('.theData').addClass('hidden');
                var datas = data.datas;
                for(var i = 0;i < datas.length;i++){
					var isCancel = datas[i]['isCancel'];
					if( isCancel == 0){
						var id = datas[i]['id'];
						var name = datas[i]['name'];
						var createTime = datas[i]['createTime'];
						var aname = datas[i]['aname'];
						var dname = datas[i]['dname'];
						//alert(name);

						$("<tr class=\"theData\">" +
						"<td data-name=\"username\">"+name+"</td>" +
						"<td data-name=\"create_at\">"+createTime+"</td>" +
						"<td data-name=\"create_at\">"+aname+"</td>" +
						"<td data-name=\"create_at\">"+dname+"</td>" +
						"<td class=\"centered\">" +
						"<ul class=\"button-group round operation00 operation01 operation11\" >" +
						"<li><button onclick='information("+id+")' class=\"tiny button info\" data-id=\""+id+"\">查看详情</button></li>" +
						"<li><button onclick='sendmessage("+id+")' class=\"tiny button warning\" data-id=\""+id+"\">打款通知</button></li>" +
						"<li><button onclick=\"complect("+id+",'fresh2')\" class=\"tiny button alert\" data-id=\""+id+"\">确认完成</button></li>" +
						"</ul></td></tr>")
							.insertAfter($("#data-user3 tr:last"));
					}


                }
            }
            else{
                alert(data.error);
            }
        },
        error:function(){
            alert('没有数据');
        }
    });

}

function fresh3(){
    $.ajax({
        url:"../index/backindex.php",
        async:false,
        type:"POST",
        dataType:"json",
        data:{
            state:3,
            action:"orderFresh1"
        },
        success:function(data){
            if(data.status){
                //alert("注册成功");
                $('.theData').addClass('hidden');
                var datas = data.datas;
                for(var i = 0;i < datas.length;i++){
					var isCancel = datas[i]['isCancel'];
					if( isCancel == 0){
						var id = datas[i]['id'];
						var name = datas[i]['name'];
						var completeTime = datas[i]['completeTime'];
						var aname = datas[i]['aname'];
						var dname = datas[i]['dname'];
						//alert(name);

						$("<tr class=\"theData\">" +
						"<td data-name=\"username\">"+name+"</td>" +
						"<td data-name=\"create_at\">"+completeTime+"</td>" +
						"<td data-name=\"create_at\">"+aname+"</td>" +
						"<td data-name=\"create_at\">"+dname+"</td>" +
						"<td class=\"centered\">" +
						"<ul class=\"button-group round operation00 operation01 operation11\" >" +
						"<li><button onclick='information("+id+",'fresh3')' class=\"tiny button success\" data-id=\""+id+"\">查看详情</button></li>" +
						"</ul></td></tr>")
							.insertAfter($("#data-user4 tr:last"));
					}

                }
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

function information(id){
    //alert(id);
    //window.location.href = "driveDetail.php?id="+id ;
    window.open("orderDetail.php?id="+id);
}
function fixed(id){
    //alert(id);
    //window.location.href = "driveDetail.php?id="+id ;
    window.open("orderAdrive.php?id="+id);
}

function sendmessage(id){
    //、、alert('尚未开通');
    //window.location.href = "driveDetail.php?id="+id ;
    //window.open("http://5.allthetest.sinaapp.com/PhPDemo.php");
	$.ajax({
            url:"../index/messageindex.php",
            async:false,
            type:"POST",
            dataType:"json",
            data:{
				oid:id,
                action:"sendMessage4"
            },
            success:function(data){
                if(data.status){
                   alert("通知成功！");
                }
                else{
                    alert('操作有误,信息发送失败！');
                }
            },
            error:function(){
                alert('没有信息');
            }
        });

}

function cancelOrder(id){
    $.ajax({
        url:"../index/backindex.php",
        async:false,
        type:"POST",
        dataType:"json",
        data:{
            id:id,
            action:"cancelOrder"
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

function complect(id){
	var section  = typeof arguments[1] == "string" ? arguments[1] : "";
    $.ajax({
        url:"../index/backindex.php",
        async:false,
        type:"POST",
        dataType:"json",
        data:{
            id:id,
            action:"ordercomplect"
        },
        success:function(data){
            if(data.status){
                alert('操作成功！');
				if(section){
					switch(section){
						case 'fresh1':
							fresh1();
							break;
						case 'fresh2':
							fresh2();
							break;
						case 'fresh3':
							fresh3();
							break;
					}
				}
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
</body>
</html>