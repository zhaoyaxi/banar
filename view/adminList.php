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
            <li id="adminList " class="has-dropdown active<?php
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
			<li id="sendMessage" class="has-dropdown ">
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
<div style="height: 100px" class="row">

</div>
<div class="row" style="width: 100%">

    <dl class="tabs vertical" data-tab>
        <dd class="active "><a href="#user-list">管理员列表</a></dd>
        <dd class="  "><a href="#config-list">管理员添加</a></dd>
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
        <section id="user-list" class="content active">
            <div class="panel" style="margin: 0">
                <form id="search-user"  data-pagination="#for-search-user">
                    <div class="row">
                        <div class="small-4 column">
                            <input id="getAdminName"type="text" name="username" value="" placeholder="管理员名称">
                        </div>
                        <div class="small-4 column">
                            <select id="getStatus" name="status">
                                <option value="0">显示全部</option>
                                <option value="1">激活状态</option>
                                <option value="3">已删除</option>
                            </select>
                        </div>
                        <div class="small-4 column">
                            <span id="getAdmin"class="button postfix info small">查询</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel">
                <table width="100%" id="data-user">
                    <thead>
                    <tr>
                        <td>名称</td>
                        <td>级别</td>
                        <td>最近登陆时间</td>
                        <td>操作</td>
                    </tr>
                    </thead>
                    <tbody >
                    <tr class="theData hidden">
						<td id="xsid" class="hidden xsid" data-id="ad">123</td>
                        <td class="xsname">admin</td>
                        <td class="xslevel">二级</td>
                        <td class="xstime">2014-9-28</td>
                        <td class="centered">
                            <ul class="button-group round operation00 operation01 operation11" >
                                <li><button   class="tiny button info" data-id="0">查看</button></li>
                                <li><button class="tiny button alert" data-id="0">删除</button></li>
                            </ul>
                        </td>
                    </tr>
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
        <section id="config-list" class="content ">
            <div class="panel" style="margin: 0">
                  <div class="small " >
                       <input type="text" id="adminEmail" name="username" placeholder="新管理员邮箱">
                  </div>
				  <div class="small ">
                       <input type="text" id="adminPassword"  name="username" placeholder="初始密码">
                  </div>
				  <div class="row">
					  <div class="small-6 column">
						   <input type="text" id="adminName"  name="username" placeholder="昵称">
					  </div>
					  <div class="small-6 column">
								<select id="adminLevel" name="status" onchange="a()">
									<option value="">管理员级别</option>
									<option id="adminLevel1"  value=1>一级</option>
									<option id="adminLevel2"  value=2>二级</option>
								</select>
					  </div>
				  </div>
				  
            </div>
			<div class="panel">
				<script src="../js/bootstrap.min.js"></script>
                <button class="button postfix info small" type="submit" data-toggle="modal" data-target="#myModal">添加</button>
            </div>
        </section>
       
    </div>
</div>


	<!--Modal 区-->
	<div id="extend">
		<!--编辑用户-->
		

		

	</div>

</div>
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
                <button id="submit" type="button" class="btn btn-primary"
						data-dismiss="modal">
                    提交确认
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>


<script>

	window.onload = function(){
		$(document).foundation();
		var level = 2;
		$('#adminLevel1').click(function(){
			
			level = 1;
			//alert(level);
		});
		$('#adminLevel2').click(function(){
			level = 2;
		});
		$('#submit').click(function(){
			//alert(123);
			//alert(adminLevel);
			var adminEmail = $('#adminEmail').val();
			var adminPassword =  $('#adminPassword').val();
			var adminName =  $('#adminName').val();
			var adminLevel =  $('#adminLevel').val();
			$.ajax({
				url:"../index/backindex.php",
				async:false,
				type:"POST",
				dataType:"json",
				data:{
					action:"addAdmin",
					adminEmail:adminEmail,
					adminPassword:adminPassword,
					adminName:adminName,
					adminLevel:adminLevel
				},
				error:function(XMLHttpRequest, textStatus, errorThrown) {
							alert(XMLHttpRequest.status);
							alert(XMLHttpRequest.readyState);
							alert(textStatus);
						},
				success:function(data){
					if(data.status){
						alert("添加成功");

					}
					else{
						alert(data.error);
					}
				}
			});
		});

		$('#getAdmin').click(function(){
			var getAdminName = "";
			var getStatus = "";
			getAdminName = $('#getAdminName').val();
			getStatus = $('#getStatus').val();
			//开始ajax
			$.ajax({
				url:"../index/backindex.php",
				async:false,
				type:"POST",
				dataType:"json",
				data:{
					action:"getAdmin",
					getAdminName:getAdminName,
					getStatus:getStatus
				},
				error:function(XMLHttpRequest, textStatus, errorThrown) {
					alert(XMLHttpRequest.status);
					alert(XMLHttpRequest.readyState);
					alert(textStatus);
				},
				success:function(data){
					if(data.status){
						//alert("成功");
						$('.theData').addClass('hidden');
						

						//刷新列表
						var datas = data.datas;
						if(getStatus != 3 ){
							for(var i = 0;i < datas.length;i++){
								var id = datas[i]['id'];
								var name = datas[i]['name'];
								var level = datas[i]['level'];
								var time = datas[i]['date'];
								//alert(id);
								//alert(name);
								//alert(level);
								//alert(time);

								$("<tr class=\"theData\"><td class=\"hidden xsid\"></td><td class=\"xsname\">"+name+"</td><td class=\"xslevel\">"+level+"</td><td class=\"xstime\">"+time+"</td><td class=\"centered\"><ul class=\"button-group round operation00 operation01 operation11\" ><li><button onclick='tolookAdmin("+id+")' class=\"tiny button info\" data-id=\""+id+"\">查看</button></li><li><button onclick='deleteAdmin("+id+")' class=\"tiny button alert\">删除</button></li></ul></td></tr>").insertAfter($("#data-user tr:last"));
							}
						}else{
							for(var i = 0;i < datas.length;i++){
								var id = datas[i]['id'];
								var name = datas[i]['name'];
								var level = datas[i]['level'];
								var time = datas[i]['date'];
								//alert(id);
								//alert(name);
								//alert(level);
								//alert(time);

								$("<tr class=\"theData\"><td class=\"hidden xsid\"></td><td class=\"xsname\">"+name+"</td><td class=\"xslevel\">"+level+"</td><td class=\"xstime\">"+time+"</td><td class=\"centered\"><ul class=\"button-group round operation00 operation01 operation11\" ><li><button onclick='tolookAdmin("+id+")' class=\"tiny button info\" data-id=\""+id+"\">查看</button></li><li><button onclick='reBackAdmin("+id+")' class=\"tiny button alert\">恢复</button></li></ul></td></tr>").insertAfter($("#data-user tr:last"));
							}
						}
					}
					else{
						alert(data.error);
					}
				}
			});
			//结束ajax

		});
	}

	function deleteAdmin(id){
		//alert(id);
		$.ajax({
            url:"../index/backindex.php",
            async:false,
            type:"POST",
            dataType:"json",
            data:{
				action:"deleteAdmin",
				id:id
            },
            error:function(XMLHttpRequest, textStatus, errorThrown) {
                        alert(XMLHttpRequest.status);
                        alert(XMLHttpRequest.readyState);
                        alert(textStatus);
                    },
            success:function(data){
                if(data.status){
                    alert("删除成功");

                }
                else{
                    alert(data.error);
                }
            }
        });
	}

	function reBackAdmin(id){
		//alert(id);
		$.ajax({
            url:"../index/backindex.php",
            async:false,
            type:"POST",
            dataType:"json",
            data:{
				action:"reBackAdmin",
				id:id
            },
            error:function(XMLHttpRequest, textStatus, errorThrown) {
                        alert(XMLHttpRequest.status);
                        alert(XMLHttpRequest.readyState);
                        alert(textStatus);
                    },
            success:function(data){
                if(data.status){
                    alert("恢复成功");

                }
                else{
                    alert(data.error);
                }
            }
        });
	}

	function tolookAdmin(id){
		window.open("adminActionCerten.php?id="+id);
	}
</script>
</body>
</html>