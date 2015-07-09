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

		.span_com{
           cursor:pointer;
        }

    </style>
    
    <script src="../js/select2.js"></script>
    <div style="height: 100px" class="row">

    </div>
    <div class="row" >
        <div id="-add" class=" active small-8 column">
            <section id="" class="small">
                <div class="panel" style="margin: 0">
                    <div class="row">
                        <div class="small-4 column" >
                            <img id="driverPhoto" src="">
                        </div>
                    </div>
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
                        <div class="small-6 column" >
                            <label>地址标签</label>
                            <button onclick="driver_lab()" class="button postfix info small" style="background-color:#68FB37;">标签管理</button>
                        </div>
                    </div>
                    

                </div>
                <div class="panel">
                    <script src="../js/bootstrap.min.js"></script>
                    <button class="button postfix info small" data-toggle="modal" data-target="#myModal">确认修改</button>
                </div>
            </section>

        </div>
        <div id="add" class=" active small-4 column">
            <div class="panel" >
                <h4 style="font-size: 25px">司机评价</h4>
                <div style="margin-top: 3%">

                    <link rel="stylesheet" type="text/css" href="../css/new-detail.min.css" />
                    <span class="yellowstar45 star-icon" ></span>
                    <span id="point" class="star-rating" style="margin-left: 2%"></span>
                </div>
                <div style="margin-top: 2%">
                    <span id="gotoComment" class="lab span_com" >共有 <span id="commentSum"></span> 人评价，点击查看</span>
                </div>

                <div style="margin-top: 3%">
                    <label class="label label-success" style="background-color: #60BA62">能够准时到达 <span id="lab1"></span> </label>
                    <label class="label label-success" style="background-color: #60BA62">热情周到 <span id="lab2"></span> </label>
                    <label class="label label-success" style="background-color: #60BA62">服务认真，举止文明 <span id="lab3"></span> </label>
                    <label class="label label-success" style="background-color: #F0AF53">不够热情 <span id="lab4"></span> </label>
                    <label class="label label-success" style="background-color: #F0AF53">没有送到终点 <span id="lab5"></span> </label>
                    <label class="label label-success" style="background-color: #DB5552">服务态度恶劣 <span id="lab6"></span></label>
                    <label class="label label-success" style="background-color: #DB5552">迟到严重 <span id="lab7"></span> </label>
                </div>
            </div>
        </div>
    </div>


    <script>
		var id = <?php echo $_GET['id'];?>;
		var name = "";
        window.onload = function() {
            $(document).foundation();
            
            Dflash(id);
			getLab(id);
			getCommentSum(id);
            $('#changeDriver').click(function(){
				//alert(1);
                submit(id);
            });

			$('#gotoComment').click(function(){
				//alert(1);
                gotoComment(id);
            });

        }

        function Dflash(id){
			//alert(id);
            $.ajax({
                url:"../index/backindex.php",
                async:false,
                type:"POST",
                dataType:"json",
                data:{
                    id:id,
                    action:"getDriverInfo"
                },
                success:function(data){
                    if(data.status){
                        //alert("修改成功");
                        var datas = data.datas['info'];

                        $('#name').val(datas['name']);
						name = datas['name'];
                        //alert(datas['name']);
                        $('#phone').val(datas['phone']);
						$('#driverPhoto').attr("src","dphoto/"+datas['phone']+".jpg");;
                        //alert(datas['phone']);
                        //$('#level').val(datas['level']);
                        level_se(datas['level']);
                        //$('#car_cate').val(datas['car_cate']);
                        car_cate_se(datas['car_cate']);
                        $('#license').val(datas['license']);
                        //alert(datas['license']);
                        //$('#city').val(datas['city']);
                        //$('#area').val(datas['area']);
                        //$('#little_area').val(datas['little_area']);
                        city_se(datas['city']);
                        area_se(datas['area']);
                        little_area_se(datas['little_area']);
                        $('#bank_number').val(datas['bank_number']);
                        //alert(datas['bank_number']);
                        $('#bank_name').val(datas['bank_name']);
                        //alert(datas['bank_name']);
                        $('#bank_type').val(datas['bank_type']);
                        //alert(datas['bank_type']);
                        $('#zhifubao_id').val(datas['zhifubao_id']);
                        //alert(datas['zhifubao_id']);
                         $('#zhifubao_name').val(datas['zhifubao_name']);
                        //alert(datas['zhifubao_name']);
                        $('#wechat_id').val(datas['wechat_id']);
                        //alert(datas['wechat_id']);

                        var star = data.datas['star'];
                        //star = star.substr(0, 3);
                        //$('#point').html(star);

                    }
                    else{
                        alert('error');
                    }
                }
            });

			//alert(id);
        }
		function getLab(id){

			 $.ajax({
                url:"../index/backindex.php",
                async:false,
                type:"POST",
                dataType:"json",
                data:{
                    id:id,
                    action:"getLab"
                },
                success:function(data){
                    if(data.status){
                        //alert("修改成功");
						var datas = data.datas;
						$("#lab1").html(datas['lab1']);
						$("#lab2").html(datas['lab2']);
						$("#lab3").html(datas['lab3']);
						$("#lab4").html(datas['lab4']);
						$("#lab5").html(datas['lab5']);
						$("#lab6").html(datas['lab6']);
						$("#lab7").html(datas['lab7']);
                    }
                    else{
                        alert('error');
                    }
                }
            });

		}

		function getCommentSum(id){

			 $.ajax({
                url:"../index/backindex.php",
                async:false,
                type:"POST",
                dataType:"json",
                data:{
                    id:id,
                    action:"getCommentSum"
                },
                success:function(data){
                    if(data.status){
                        //alert("修改成功");
						var datas = data.datas;
						$("#commentSum").html(datas['count']);
						
                    }
                    else{
                        alert('error');
                    }
                }
            });

		}


        function level_se(a)
        {
            var o = document.getElementById("level");
            for (var i = 0; i < o.options.length; i++) {
                if (o.options[i].value == a) {
                    o.options[i].selected = true;
                }
            }
        }

        function car_cate_se(a)
        {
            var o = document.getElementById("car_cate");
            for (var i = 0; i < o.options.length; i++) {
                if (o.options[i].value == a) {
                    o.options[i].selected = true;
                }
            }
        }

        function city_se(a)
        {
            var o = document.getElementById("city");
            for (var i = 0; i < o.options.length; i++) {
                if (o.options[i].value == a) {
                    o.options[i].selected = true;
                }
            }
        }

        function area_se(a)
        {
            var o = document.getElementById("area");
            for (var i = 0; i < o.options.length; i++) {
                if (o.options[i].value == a) {
                    o.options[i].selected = true;
                }
            }
        }

        function little_area_se(a)
        {
            var o = document.getElementById("little_area");
            for (var i = 0; i < o.options.length; i++) {
                if (o.options[i].value == a) {
                    o.options[i].selected = true;
                }
            }
        }

		function gotoComment(id)
        {
           window.open("comment.php?id="+id);
        }

		function submit(id){
				//alert(1);
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
						id:id,
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
                        action:"changeDriver"
                    },
                    success:function(data){
                        if(data.status){
                            alert("修改成功");
                        }
                        else{
                            alert(data.error);
                        }
                    }
                });
            }

			function driver_lab(){
				window.open( "driver_lab.php?id="+id+"&name="+name);
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
                <button id="changeDriver" type="button" class="btn btn-primary"
						data-dismiss="modal">
                    提交确认
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
</body>
</html>