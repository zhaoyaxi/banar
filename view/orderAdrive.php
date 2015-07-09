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
        background-color: #ffffff;
        cursor: default;
    }
    a:link{
        text-decoration:none;
    }
    .s{
        margin-left: 13%;
        margin-right: 13%;
    }



</style>
<link href="../js/select2.css" rel="stylesheet" type="text/css"/>
<script src="../js/select2.js"></script>
<div style="height: 100px" class="row">

</div>
<div class="row" >
    <div id="drive-add" class="small">
        <div class="panel" style="margin: 0">
            <h4 style="font-size: 25px">订单信息</h4>
            <h4 style="font-size: 15px">下单时间：2015-5-12</h4>
            <div class="row">
                <div class="small-3 column" >
                    <label>用户名称</label>
                    <input id='name' type="text" value="刘大师" name="username"  readonly>
                </div>
                <div class="small-3 column" >
                    <label>用户电话</label>
                    <input id='phone' type="tel" value="18899990000" name="username" readonly>
                </div>

                <div class="small-3 column" >
                    <label>搬家时间</label>
                    <input id='startTime' type="tel" value="2015-7-1" name="username" readonly>
                </div>
                <div class="small-3 column" >
                    <label>要求车型</label>
                    <input id='car_id' type="text" value="面包" name="username"  readonly>
                </div>
            </div>
            <div class="row">
                <div class="small-6 column" >
                    <label>起点</label>
                    <input id='startLocation' type="text" value="天通北苑xx楼" name="username" readonly style="background: #A0FD6F">
                </div>
                <div class="small-6 column" >
                    <label>终点</label>
                    <input id='endLocation' type="text" value="北京市海淀区学院路37号" name="username" readonly>
                </div>
            </div>

            <div class="row">

                <div class="small-2 column">
                    <label>起点楼层</label>
                    <input id='floorCount' type="text" value="2层" name="username" readonly>
                </div>
                <div class="small-2 column">
                    <label>终点楼层</label>
                    <input id='toFloorCount' type="text" value="2层" name="username" readonly>
                </div>
                <div class="small-8 column" >
                    <label>备注</label>
                    <input id='message' type="text" name="username" value="希望师傅能准时到达" readonly>
                </div>
            </div>

            <div class="row">
                <div class="small-3 column" >
                    <label>实际收费</label>
                    <input id='a_price' type="text" name="username" value="1"  readonly style="background: #A0FD6F">
                </div>
                <div class="small-3 column" >
                    <label>理论收费</label>
                    <input id='total_price' type="text" name="username" value="1" readonly style="background: #ffff00">
                </div>
                <div class="small-3 column" >
                    <label>优惠减价</label>
                    <input id='pre_price' type="text" name="username" value="1" readonly>
                </div>
				 <div class="small-3 column" >
                    <label>支付司机</label>
                    <input id='real_price' type="text" name="username" value="10" readonly>
                </div>

            </div>

        </div>
    </div>

    <div  class="small" style="margin-top: 4%">
        <div class="panel" style="margin: 0">
            <div class="row">
                <div id="drive-list" class="content active">
                    <div class="panel" style="margin: 0">
                        <form id="search-user"  data-pagination="#for-search-user">
                            <div class="row">

                                <div class="small-4 column" >
                                    <label>标签名称</label>
                                    <input id="se_name" value="" type="text" name="username" >
                                </div>
                                <div class="small-4 column" >
                                    <label>等级</label>
                                    <select id="se_level"  name="status">
                                        <option value="0">全部等级</option>
                                        <option value="1">一级</option>
                                        <option value="2">二级</option>
                                        <option value="3">三级</option>
                                    </select>
                                </div>
                                <div class="small-4 column" >
                                    <label>城市</label>
                                    <select id="se_city" name="status" >
                                        <option value="0">全部</option>
                                        <option value="1">北京</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row">



                                    <div class="small-4 column" >
                                        <label>地区</label>
                                        <select id="se_area"  name="status">
                                            <option value="0">全部</option>
                                                <option value="1">海淀</option>
                                                <option value="2">西城区</option>
												<option value="3">东城区</option>
												<option value="4">丰台</option>
												<option value="5">石景山</option>
												<option value="6">昌平</option>
												<option value="8">朝阳</option>
                                        </select>
                                    </div>
                                    <div class="small-4 column" >
                                        <label>街道</label>
                                        <select id="se_little_area" name="status">
                                            <option value="0">全部</option>
                                            <option value="10">——————海淀区——————</option>
											<option value="11">北下关</option>
											<option value="12">北京西站/军博</option>
											<option value="13">北京大学</option>
											<option value="14">牡丹园/北太平庄</option>
											<option value="15">大钟寺</option>
											<option value="16">公主坟/万寿路</option>
											<option value="17">航天桥</option>
											<option value="18">农业大学西区</option>
											<option value="19">清河</option>
											<option value="110">人民大学</option>
											<option value="111">四季青</option>
											<option value="112">双榆树</option>
											<option value="113">苏州桥</option>
											<option value="114">上地</option>
											<option value="115">五棵松</option>
											<option value="116">万柳</option>
											<option value="117">魏公村</option>
											<option value="118">五道口</option>
											<option value="119">西三旗</option>
											<option value="120">香山/植物园</option>
											<option value="121">学院路</option>
											<option value="122">远大路</option>
											<option value="123">颐和园</option>
											<option value="124">紫竹桥</option>
											<option value="125">知春路</option>
											<option value="126">中关村</option>
											<option value="20">——————西城区——————</option>
											<option value="21">白纸坊</option>
											<option value="22">菜市口/陶然亭</option>
											<option value="23">地安门</option>
											<option value="24">德外大街</option>
											<option value="25">阜成门</option>
											<option value="26">复兴门</option>
											<option value="27">广内大街</option>
											<option value="28">广外大街</option>
											<option value="29">后海/什刹海</option>
											<option value="210">和平门</option>
											<option value="211">虎坊桥</option>
											<option value="212">金融街</option>
											<option value="213">牛街</option>
											<option value="214">前门/大栅栏</option>
											<option value="215">西直门/动物园</option>
											<option value="216">西单</option>
											<option value="217">西便门</option>
											<option value="218">宣武门</option>
											<option value="219">新街口</option>
											<option value="220">西四</option>
											<option value="221">月坛</option>
											<option value="20">——————东城区——————</option>
											<option value="31">安定门</option>
											<option value="32">北新桥/簋街</option>
											<option value="33">朝阳门</option>
											<option value="34">崇文门新世界</option>
											<option value="35">崇文门</option>
											<option value="36">东四</option>
											<option value="37">东四十条</option>
											<option value="38">东直门</option>
											<option value="39">广渠门</option>
											<option value="310">和平里</option>
											<option value="311">建国门/北京站</option>
											<option value="312">南锣鼓巷</option>
											<option value="313">沙子口</option>
											<option value="314">天坛</option>
											<option value="315">王府井/东单</option>
											<option value="316">雍和宫</option>
											<option value="317">左安门</option>
											<option value="40">——————丰台区——————</option>
											<option value="41">北京西站/六里桥</option>
											<option value="42">北大地/万丰路</option>
											<option value="43">草桥/公益西桥</option>
											<option value="44">大红门</option>
											<option value="45">分钟寺/成寿寺</option>
											<option value="46">方庄/蒲黄榆</option>
											<option value="47">花乡/新发地</option>
											<option value="48">看丹桥</option>
											<option value="49">北京南站/开阳里</option>
											<option value="410">刘家窑/宋家庄</option>
											<option value="411">卢沟桥</option>
											<option value="412">丽泽桥/丰管路</option>
											<option value="413">马家堡/角门</option>
											<option value="414">南苑/东高地</option>
											<option value="415">青塔</option>
											<option value="416">世界公园</option>
											<option value="417">夏家胡同/纪家庙</option>
											<option value="418">云岗</option>
											<option value="419">洋桥/木樨园</option>
											<option value="50">——————石景山区——————</option>
											<option value="51">八大处</option>
											<option value="52">古城/八角</option>
											<option value="53">鲁谷</option>
											<option value="54">模式口</option>
											<option value="55">苹果园</option>
											<option value="60">——————昌平区——————</option>
											<option value="61">北七家</option>
											<option value="62">昌平镇</option>
											<option value="63">回龙观</option>
											<option value="64">南口镇</option>
											<option value="65">沙河</option>
											<option value="66">天通苑</option>
											<option value="67">小汤山镇</option>
											<option value="80">——————朝阳——————</option>
												<option value="81">安贞</option>
												<option value="82">北京东站</option>
												<option value="83">北沙滩</option>
												<option value="84">北苑家园</option>
												<option value="85">八里庄</option>
												<option value="86">北京欢乐谷</option>
												<option value="87">百子湾</option>
												<option value="88">朝阳大悦城</option>
												<option value="89">朝外大街</option>
												<option value="810">常营</option>
												<option value="811">朝阳公园</option>
												<option value="812">大望路</option>
												<option value="813">对外经贸</option>
												<option value="814">大屯</option>
												<option value="815">东坝</option>
												<option value="816">国贸</option>
												<option value="817">工体</option>
												<option value="818">管庄</option>
												<option value="819">高碑店</option>
												<option value="820">酒仙桥</option>
												<option value="821">劲松</option>
												<option value="822">建外大街</option>
												<option value="823">蓝色港湾</option>
												<option value="824">亮马桥</option>
												<option value="825">立水桥</option>
												<option value="826">鸟巢/水立方</option>
												<option value="827">农业展览馆</option>
												<option value="828">潘家园</option>
												<option value="829">四惠东</option>
												<option value="830">四惠</option>
												<option value="831">石佛营</option>
												<option value="832">双井</option>
												<option value="833">双桥</option>
												<option value="834">十里堡</option>
												<option value="835">三里屯</option>
												<option value="836">世贸天阶</option>
												<option value="837">十八里店</option>
												<option value="838">三元桥</option>
												<option value="839">十里河</option>
												<option value="840">团结湖</option>
												<option value="841">甜水园</option>
												<option value="842">太阳宫</option>
												<option value="843">望京</option>
												<option value="844">霄云路</option>
												<option value="845">小营</option>
												<option value="846">悠唐生活广场</option>
												<option value="847">燕莎</option>
												<option value="848">姚家园</option>
												<option value="849">亚运村</option>
												<option value="850">左家庄</option>
                                        </select>

                                    </div>
                                <div class="small-4 column">
                                    <label>.</label>
                                    <span id="se_" class="button postfix info small" type="submit">查询</span>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="panel">
                        <table width="100%" id="data-user">
                            <thead>
                            <tr>
                                <td>名称</td>
                                <td>电话</td>
                                <td>操作</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="hidden">
                                <td data-name="username">李婕妤</td>
                                <td data-name="phone">18811881188</td>
                                <td class="centered">
                                    <ul class="button-group round operation00 operation01 operation11" >
                                        <li><button  class="tiny button info" data-id="0">查看</button></li>
                                        <li><button class="tiny button warning" data-id="0">绑定</button></li>
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
                </div>
            </div>
        </div>
    </div>


<script>
    window.onload = function(){
        $(document).foundation();
        //var id = var id = <?php echo $_GET['id'];?>;
         var id = <?php echo $_GET['id'];?>;
        inti(id);
        $('#se_').click(function(){
            //alert(1);
            search();
        });
    }
    function inti(id){
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
					if(datas['name'] != null){
						$('#name').val(datas['name']);
					}
					if(datas['phone'] != null){
						$('#phone').val(datas['phone']);
					}
					if(datas['car_id'] != null){
						$('#car_id').val(getCar(datas['car_id']));
					}
					
					//alert(datas['price']);
					$('#a_price').val(datas['price']);
					
					if(datas['pre_price'] != null){
						$('#pre_price').val(datas['pre_price']);
					}
					if(datas['startLocation'] != null){
						$('#startLocation').val(datas['startLocation']);
					}
					if(datas['endLocation'] != null){
						$('#endLocation').val(datas['endLocation']);
					}
					if(datas['startTime'] != null){
						$('#startTime').val(datas['startTime']);
					}
					if(datas['message'] != null){
						$('#message').val(datas['message']);
					}
					if(datas['floorCount'] != null){
						$('#floorCount').val(datas['floorCount']);
					}
					if(datas['toFloorCount'] != null){
						$('#toFloorCount').val(datas['toFloorCount']);
					}
					if(datas['real_price'] != null){
						$('#real_price').val(datas['real_price']);
					}
					if(datas['price'] != null){
						$('#total_price').val(parseInt(datas['price'])+parseInt(datas['pre_price']));
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

	function getCar(num){
		if(num == 1)
			return "小面包车";
		else
			return "金杯车";
	}

    function search(){
        var se_name = $('#se_name').val();
        var se_level = $('#se_level').val();
        var se_city = $('#se_city').val();
        var se_area = $('#se_area').val();
        var se_little_area = $('#se_little_area').val();
        //alert(se_level);

        $.ajax({
            url:"../index/backindex.php",
            async:false,
            type:"POST",
            dataType:"json",
            data:{
                se_name:se_name,
                se_level:se_level,
                se_city:se_city,
                se_area:se_area,
                se_little_area:se_little_area,
                action:"driverSearch"
            },
            success:function(data){
                if(data.status){
                    //alert("注册成功");
                    $('.theData').addClass('hidden');
                    //alert("注册成功");
                    var datas = data.datas;
                    //alert("注册成功");
                    for(var i = 0;i < datas.length;i++){

                        var id = datas[i]['id'];
						alert(id);
                        var name = datas[i]['name'];
                        var phone = datas[i]['phone'];
                        //alert(name);

                        $("<tr class=\" theData\">" +
                                "<td >"+name+"</td>" +
                                "<td >"+phone+"</td>" +
                                "<td class=\"centered\">" +
                                "<ul class=\"button-group round operation00 operation01 operation11\" >" +
                                "<li><button  onclick='information("+id+")' class=\"tiny button info tolook\" data-id=\""+id+"\">查看</button></li>" +
                                "<li><button onclick='fix("+id+")' class=\"tiny button warning todelete\" data-id=\""+id+"\">绑定</button></li>" +
                                "</ul></td></tr>")
                                .insertAfter($("#data-user tr:last"));

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

    function information(id){
        //alert(id);
        //window.location.href = "driveDetail.php?id="+id ;
        window.open("driveDetail.php?id="+id);
    }

	function fix(id){
        //alert(id);
		var oid = <?php echo $_GET['id'];?>;
		$.ajax({
            url:"../index/backindex.php",
            async:false,
            type:"POST",
            dataType:"json",
            data:{
                oid:oid,
				did:id,
                action:"orderfix"
            },
            success:function(data){
                if(data.status){
                    alert('操作成功！');
					sendMessage(oid,id,2);
					
                }
                else{
					sendMessage(oid,id,2);
                    alert('操作有误');
                }
            },
            error:function(){
                alert('没有信息');
            }
        });
    }

	function sendMessage(oid,id){
		$.ajax({
            url:"../index/messageindex.php",
            async:false,
            type:"POST",
            dataType:"json",
            data:{
				oid:oid,
				did:id,
                action:"sendMessage2"
            },
            success:function(data){
                if(data.status){
                   window.location.href = "orderList.php";
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

</script>
</div>
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
</div>
</body>
</html>