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
<div class="container small-10" id="container" style="margin-top: 4%">
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

    <div class="row" style="width: 100%">
            <section id="user-list" class="content active">
                <div class="panel" style="margin: 0">
                    <form id="search-user"  data-pagination="#for-search-user">
                        <div class="row">

                            <div class="small-4 column">
                               <input id="driver_name" value="" type="text" name="username" >
                            </div>
                            <div class="small-4 column">
                               <input id="new_lab" value="" type="text" name="username" placeholder="新标签">
                            </div>
                            <div class="small-4 column">
								<span id="add_driver_lab"class="button postfix info small" onclick="add_driver_lab()">添加查询</span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel">
                    <table width="100%" id="data-user">
                        <thead>
                        <tr>
                            <td>标签</td>
                            <td>操作</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="theData hidden">
                            <td class="small-6">北航</td>
                            <td class="small-6">
								<ul class="button-group round operation00 operation01 operation11" >
									<li><button class="tiny button alert" data-id="0">删除</button></li>
								</ul>
							</td>
                            
                        </tr>

                        </tbody>
                    </table>
                </div>

            </section>
    </div>
 </div>
<script>
	var id = <?php echo $_GET['id'];?>;
	var name = "<?php echo $_GET['name'];?>";
    window.onload = function(){
		$('#driver_name').val(name);
        getList();
    }

    function getList(){
		//alert(1);
        $.ajax({
            url:"../index/backindex.php",
            async:false,
            type:"POST",
            dataType:"json",
            data:{
				id:id,
                action:"get_driver_lab"
            },
            success:function(data){
                if(data.status){
                    //alert(1);
                    var datas =  data.datas;
                    $('.theData').addClass('hidden');
                    for(var i = 0; i < datas.length; i++){
								$("<tr class=\"theData\">" +
										"<td class=\"small-6\">"+datas[i]['dri_lab']+"</td>" +
										"<td class=\"small-6\">"+
											"<ul class=\"button-group round operation00 operation01 operation11\" >"+
												"<li><button  onclick=\"delete_("+datas[i]['id']+")\" class=\"tiny button alert\" >删除</button></li>"+
											"</ul>"+
										"</td></tr>")
										.insertAfter($("#data-user tr:last"));

							
                    }
                }
                else{
                    alert('error');
                }
            }
        });
    }

	function add_driver_lab(){
        //alert(id);
		var new_lab = $('#new_lab').val();
		if(new_lab != ""){
			 $.ajax({
				url:"../index/backindex.php",
				async:false,
				type:"POST",
				dataType:"json",
				data:{
					id:id,
					new_lab:new_lab,
					action:"add_driver_lab"
				},
				success:function(data){
					if(data.status){
						alert('操作成功！');
						getList();
					}
					else{
						alert('hjhj');
					}
				},
				error:function(){
					alert('添加失败');
				}
			});
		}else{
			alert("标签为空！");
		}
	}

	function delete_(id){
		$.ajax({
				url:"../index/backindex.php",
				async:false,
				type:"POST",
				dataType:"json",
				data:{
					id:id,
					action:"delete_driver_lab"
				},
				success:function(data){
					if(data.status){
						alert('操作成功！');
						getList();
					}
					else{
						alert('hjhj');
					}
				},
				error:function(){
					alert('删除失败');
				}
		});
	}
</script>
</body>
</html>