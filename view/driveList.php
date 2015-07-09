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


    <script src="../js/jquery.min.js"></script>
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
            
            <li id="driveList" class="has-dropdown active">
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

    </style>
        <link href="../js/select2.css" rel="stylesheet" type="text/css"/>
        <script src="../js/select2.js"></script>
        <div style="height: 100px" class="row">

        </div>
            <div class="row" style="width: 100%">

                <dl class="tabs vertical" data-tab>
                    <dd class="active "><a href="#drive-list">司机列表</a></dd>
                    <dd class="  "><a href="#drive-add">司机添加</a></dd>
                </dl>
                <div class="tabs-content vertical">
                    <div data-alert class="alert-box success radius " id="success-alerter" style="display: none">
                        <label id="success-info">操作成功</label>
                        <!--<a href="#" class="close">&times;</a>-->
                    </div>
                    <section id="drive-list" class="content active">
                        <div class="panel" style="margin: 0">
                            <form id="search-user"  data-pagination="#for-search-user">
                                <div class="row">
                                    <div class="small-4 column">
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
                                        <label>车型</label>
                                        <select id="se_car_cate" name="status">
                                            <option value="0">全部车型</option>
                                            <option value="1">面包</option>
                                            <option value="2">金杯</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">

                                        <div class="small-4 column" >
                                            <label>城市</label>
                                            <select id="se_city" name="status" >
                                                <option value="0">全部</option>
                                                <option value="1">北京</option>
                                            </select>
                                        </div>
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


                                </div>
                                <div class="row">
                                    <label>.</label>
                                    <span id="se_" class="button postfix info small" type="submit">查询</span>
                                </div>
                            </form>
                        </div>
                        <div class="panel">
                            <table width="100%" id="data-user">
                                <thead>
                                <tr>
                                    <td>姓名</td>
                                    <td>电话</td>
                                    <td>操作</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="theData hidden">
                                    <td data-name="username">admin</td>
                                    <td data-name="phone">18811881188</td>
                                    <td class="centered">
                                        <ul class="button-group round operation00 operation01 operation11" >
                                            <li><button  class="tiny button info" data-id="0">查看</button></li>
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
                    <section id="drive-add" class="content">
                        <div class="panel" style="margin: 0">
                            <div class="row">
                                <div class="small-4 column" >
                                    <label>司机名称</label>
                                    <input id="name" value="" type="text" name="username" >
                                </div>
                                <div class="small-4 column" >
                                    <label>司机电话</label>
                                    <input id="phone" type="text" name="username" >
                                </div>
                                <div class="small-4 column" >
                                    <label>等级</label>
                                    <select id="level"  name="status">
                                        <option value="1">一级</option>
                                        <option value="2">二级</option>
                                        <option value="2">三级</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-6 column" >
                                    <label>车型</label>
                                    <select id="car_cate" name="status">

                                        <option value="1">面包</option>
                                        <option value="2">金杯</option>
                                    </select>
                                </div>
                                <div class="small-6 column" >
                                    <label>牌照</label>
                                    <input id="license" type="text" name="username">
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-4 column" >
                                    <label>城市</label>
                                    <select id="city" name="status" >
                                        <option value="1">北京</option>
                                    </select>
                                </div>
                                <div class="small-4 column" >
                                    <label>地区</label>
                                    <select id="area"  name="status">
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
                                    <select id="little_area" name="status">
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
                            </div>
                            <div class="row">
                                <div class="small-4 column" >
                                    <label>银行卡号</label>
                                    <input id="bank_number" type="text" name="username" >
                                </div>
                                <div class="small-4 column" >
                                    <label>姓名</label>
                                    <input id="bank_name" type="text" name="username" >
                                </div>
                                <div class="small-4 column" >
                                    <label>开户行</label>
                                    <input id="bank_type" type="text" name="username" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-4 column" >
                                    <label>支付宝号</label>
                                    <input id="zhifubao_id" type="text" name="username" >
                                </div>
                                <div class="small-4 column" >
                                    <label>支付宝名称</label>
                                    <input id="zhifubao_name" type="text" name="username" >
                                </div>
                                <div class="small-4 column" >
                                    <label>微信号</label>
                                    <input id="wechat_id" type="text" name="username" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="small column" >
                                    <label>地址查询标签</label>
                                    <input id="lab"  type="text" name="username" placeholder="可以输入五个，每个之间用<，>隔开">
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-4 column" >
									<label>上传照片</label>
                                    <button onclick="photo()" id="photo" class="button"> 上传</button>
                                </div>
								
                            </div>

                        </div>
                        <div class="panel">
                            <script src="../js/bootstrap.min.js"></script>
                            <button class="button postfix info small" data-toggle="modal" data-target="#myModal">添加</button>
                        </div>
                    </section>
                </div>
            </div>


        <script>
		var level = <?php echo $_SESSION['level'];?>;
            window.onload = function() {
                //alert(1);
                $(document).foundation();
                //flash();
                $('#addDriver').click(function(){
                    //alert(1);
                    submit();
                });

                $('#se_').click(function(){
                    //alert(1);
                    search();
                });

            }

            function submit(){

                var name = $('#name').val();
                var phone = $('#phone').val();
                var level = $('#level').val();
                var car_cate = $('#car_cate').val();
                var license = $('#license').val();
                var city = $('#city').val();
                var area = $('#area').val();
                var little_area = $('#little_area').val();
                var bank_number = $('#bank_number').val();
                var bank_name = $('#bank_name').val();
                var bank_type = $('#bank_type').val();
                var zhifubao_id = $('#zhifubao_id').val();
                var zhifubao_name = $('#zhifubao_name').val();
                var wechat_id = $('#wechat_id').val();
                //var lab = $('#lab').val();


                $.ajax({
                    url:"../index/backindex.php",
                    async:false,
                    type:"POST",
                    dataType:"json",
                    data:{
                        name:name,
                        phone:phone,
                        level:level,
                        car_cate:car_cate,
                        license:license,
                        city:city,
                        area:area,
                        little_area:little_area,
                        bank_number:bank_number,
                        bank_name:bank_name,
                        bank_type:bank_type,
                        zhifubao_id:zhifubao_id,
                        zhifubao_name:zhifubao_name,
                        wechat_id:wechat_id,
                        action:"driverRegister"
                    },
                    success:function(data){
                        if(data.status){
                            alert("注册成功");
                        }
                        else{
                            alert(data.error);
                        }
                    }
                });
            }

            function search(){
                var se_name = $('#se_name').val();
                var se_level = $('#se_level').val();
                var se_car_cate = $('#se_car_cate').val();
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
                        se_car_cate:se_car_cate,
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
							if( level == 1){
								for(var i = 0;i < datas.length;i++){
									var id = datas[i]['id'];
									var name = datas[i]['name'];
									var phone = datas[i]['phone'];
									//alert(name);

									$("<tr class=\" theData\">" +
											"<td >"+name+"</td>" +
											"<td >"+phone+"</td>" +
											"<td class=\"centered\">" +
											"<ul class=\"button-group round operation00 operation01 operation11\" >" +
											"<li><button  onclick='information("+id+")' class=\"tiny button info tolook\" data-id=\""+id+"\">查看</button></li>" +
											"<li><button onclick='deleteDriver("+id+")' class=\"tiny button alert todelete      \" data-id=\""+id+"\">删除</button></li>" +
											"</ul></td></tr>")
											.insertAfter($("#data-user tr:last"));

								}
							}else{
								for(var i = 0;i < datas.length;i++){
									var id = datas[i]['id'];
									var name = datas[i]['name'];
									var phone = datas[i]['phone'];
									//alert(name);

									$("<tr class=\" theData\">" +
											"<td >"+name+"</td>" +
											"<td >"+phone+"</td>" +
											"<td class=\"centered\">" +
											"<ul class=\"button-group round operation00 operation01 operation11\" >" +
											"<li><button  onclick='information("+id+")' class=\"tiny button info tolook\" data-id=\""+id+"\">查看</button></li>" +
											"</ul></td></tr>")
											.insertAfter($("#data-user tr:last"));

								}
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

			function deleteDriver(id){
				$.ajax({
					url:"../index/backindex.php",
					async:false,
					type:"POST",
					dataType:"json",
					data:{
						id:id,
						action:"deleteDriver"
					},
					success:function(data){
						if(data.status){
							alert('删除成功！');
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
                window.location.href = "driveDetail.php?id="+id ;
            }

			function photo(){
				var phone = $('#phone').val();
				window.open("photo.php?id="+phone);
			}

        </script>
    </div>>
    <!--Modal 区-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 20%">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    确认对司机的添加？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">关闭
                    </button>
                    <button type="button" class="btn btn-primary"
                            data-dismiss="modal"
                            id="addDriver">
                        提交确认
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
</body>
</html>