<?php
	if(!isset($_SESSION)){  
           session_start();  
        } 
	if( !($_SESSION['login'] ==  1)){
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
                                <select id="getStatus" name="status" >
                                    <option value="0">显示全部</option>
                                    <option value="1">好评</option>
                                    <option value="2">中评</option>
                                    <option value="3">差评</option>
                                </select>
                            </div>
                            <div class="small-4 column">
                                <span id="getFresh"class="button postfix info small">查询</span>
                            </div>
                            <div class="small-4 column">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel">
                    <table width="100%" id="data-user">
                        <thead>
                        <tr>
                            <td>用户名</td>
                            <td>下单时间</td>
                            <td>评论时间</td>
                            <td>得分</td>
                            <td>评论</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="theData hidden">
                            <td class="small-1">admin</td>
                            <td class="small-2">2014-9-28 10:10:10</td>
                            <td class="small-2">2014-9-28 10:10:10</td>
                            <td class="small-1">4</td>
                            <td class="centered">
                                不错
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
    </div>
 </div>
<script>
    window.onload = function(){
        var driver_id = <?php echo $_GET['id'];?>;
        getCommentList(driver_id,0);
        $("#getFresh").click(function(){
            var type = $('#getStatus').val();
            //alert(type);
            getCommentList(driver_id,type);
        });
    }

    function getCommentList(driver_id,type){
        $.ajax({
            url:"../index/backindex.php",
            async:false,
            type:"POST",
            dataType:"json",
            data:{
                driver_id:driver_id,
                action:"getCommentList"
            },
            success:function(data){
                if(data.status){
                    //alert(1);
                    var datas =  data.datas;
                    $('.theData').addClass('hidden');
                    for(var i = 0; i < datas.length; i++){
                        if(type == 0){
                            $("<tr class=\"theData\">" +
                                    "<td class=\"small-1\">"+datas[i]['name']+"</td>" +
                                    "<td class=\"small-2\">"+datas[i]['createTime']+"</td>" +
                                    "<td class=\"small-2\">"+datas[i]['commentTime']+"</td>" +
                                    "<td class=\"small-1\">"+datas[i]['star']+"</td>" +
                                    "<td class=\"centered\">"+datas[i]['comment']+"</td>" +
                                    "</tr>")
                                    .insertAfter($("#data-user tr:last"));
                        }else if(type == 1){
                            if(datas[i]['star'] >= 4 ){
                                $("<tr class=\"theData\">" +
                                        "<td class=\"small-1\">"+datas[i]['name']+"</td>" +
                                        "<td class=\"small-2\">"+datas[i]['createTime']+"</td>" +
                                        "<td class=\"small-2\">"+datas[i]['commentTime']+"</td>" +
                                        "<td class=\"small-1\">"+datas[i]['star']+"</td>" +
                                        "<td class=\"centered\">"+datas[i]['comment']+"</td>" +
                                        "</tr>")
                                        .insertAfter($("#data-user tr:last"));
                            }


                        }else if(type == 2){
                            if( datas[i]['star'] == 3){
                                $("<tr class=\"theData\">" +
                                        "<td class=\"small-1\">"+datas[i]['name']+"</td>" +
                                        "<td class=\"small-2\">"+datas[i]['createTime']+"</td>" +
                                        "<td class=\"small-2\">"+datas[i]['commentTime']+"</td>" +
                                        "<td class=\"small-1\">"+datas[i]['star']+"</td>" +
                                        "<td class=\"centered\">"+datas[i]['comment']+"</td>" +
                                        "</tr>")
                                        .insertAfter($("#data-user tr:last"));
                            }

                        }else if(type == 3){
                            if( datas[i]['star'] <= 2){
                                $("<tr class=\"theData\">" +
                                        "<td class=\"small-1\">"+datas[i]['name']+"</td>" +
                                        "<td class=\"small-2\">"+datas[i]['createTime']+"</td>" +
                                        "<td class=\"small-2\">"+datas[i]['commentTime']+"</td>" +
                                        "<td class=\"small-1\">"+datas[i]['star']+"</td>" +
                                        "<td class=\"centered\">"+datas[i]['comment']+"</td>" +
                                        "</tr>")
                                        .insertAfter($("#data-user tr:last"));
                            }
                        }



                    }
                }
                else{
                    alert('error');
                }
            }
        });
    }
</script>
</body>
</html>