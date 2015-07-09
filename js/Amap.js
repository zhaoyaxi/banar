/**********************
projName:高德地图
author:zhaoyx
E-mail:zhaoyaxiphp@163.com
date:2015.6.28
**********************/
//地图加载
var map = new AMap.Map("mapContainer",{
	resizeEnable: true,
	keyboardEnable:false
});
/*
 *[autocomplete] 自动完成
 *[@param] {obj} [input对象]
 *[@return] {none} [description]
 */
var autocomplete = function(keywordObj){
	if(typeof keywordObj == "string"){
		var prefix_index = keywordObj.indexOf("#");
		var str = prefix_index == -1 ? keywordObj : keywordObj.substring(prefix_index+1);
		var keywordObj = document.getElementById(str);
	}else if(typeof keywordObj == "object"){
		var keywordObj = keywordObj instanceof jQuery ? keywordObj[0] : keywordObj;
	}else{
		console.log("error:格式错误");
	}
	//结果div
	var resultObj=document.createElement("div");
	keywordObj.parentNode.appendChild(resultObj);
	//设置高度
	var height = keywordObj.parentNode.style.height;
	if(!height){
		height = keywordObj.parentNode.clientHeight;
	}
	keywordObj.parentNode.style.minHeight = height +"px";
	keywordObj.parentNode.style.height = "auto";
	keywordObj.onkeyup = keydown;
	//输入提示
	function autoSearch() {
		var keywords = keywordObj.value;
		var auto;
		//加载输入提示插件
			map.plugin(["AMap.Autocomplete"], function() {
			auto = new AMap.Autocomplete(AMap.autoOptions);
			//查询成功时返回查询结果
			if ( keywords.length > 0) {
				AMap.event.addListener(auto,"complete",autocomplete_CallBack);
				auto.search(keywords);
			}
			else {
				resultObj.style.display = "none";
			}
		});
	}
	function autocomplete_CallBack(data) {
		var resultStr = "";
		var tipArr = data.tips;
		if(!data.tips)  return ;
		//var len=tipArr.length;
		var id = str+"_divid";
		if (tipArr&&tipArr.length>0) {                 
			for (var i = 0; i < tipArr.length; i++) {
				resultStr += "<div id='"+ id + (i + 1) + "' style=\"font-size: 13px;cursor:pointer;padding:5px 5px 5px 5px;position:relative;z-index:100;background-color:white \">" + tipArr[i].name + "<span style='color:#C1C1C1;'>"+ tipArr[i].district + "</span></div>";
			}
		}
		else  {
			resultStr = " π__π 亲,人家找不到结果!<br />要不试试：<br />1.请确保所有字词拼写正确<br />2.尝试不同的关键字<br />3.尝试更宽泛的关键字";
		}
		resultObj.curSelect = -1;
		resultObj.tipArr = tipArr;
		resultObj.innerHTML = resultStr;
		resultObj.style.display = "block";
		resultObj.id = str+"_result";
		for(var i = 1; i < tipArr.length+1; i++){
			var subResult = document.getElementById( id + i );
			subResult.onclick = function(e) {    //鼠标点击下拉列表后的事件
				var text = this.innerHTML.replace(/<[^>].*?>.*<\/[^>].*?>/g,"");
				keywordObj.value = text;
				resultObj.style.display = "none";
			};
			subResult.mouseover = function(e) {    //鼠标点击下拉列表后的事件
				this.style.background = '#CAE1FF';
			};
			subResult.mouseout = function(e) {    //鼠标点击下拉列表后的事件
				this.style.background = "";
			};
			/*subResult.addEventListener("onclick", function(e) {    //鼠标点击下拉列表后的事件
				var text = this.innerHTML.replace(/<[^>].*?>.*<\/[^>].*?>/g,"");
				keywordObj.value = text;
				resultObj.style.display = "none";
			});
			subResult.addEventListener("onmouseover", function(e) {    //鼠标点击下拉列表后的事件
				this.style.background = '#CAE1FF';
			});
			subResult.addEventListener("onmouseout", function(e) {    //鼠标点击下拉列表后的事件
				this.style.background = "";
			});	*/
				
		}
	}
	 
	
	function keydown(event){
		var key = (event || window.event).keyCode;
		var result = resultObj;
		var cur = result.curSelect;
		if(key===40){//down key
		if(cur + 1 < result.childNodes.length){
				if(result.childNodes[cur]){
					result.childNodes[cur].style.background='';
				}
				result.curSelect=cur+1;
				result.childNodes[cur+1].style.background='#CAE1FF';
				keywordObj.value = result.tipArr[cur+1].name;
			}
		}else if(key===38){//up key
			if(cur-1>=0){
				if(result.childNodes[cur]){
					result.childNodes[cur].style.background='';
				}
				result.curSelect=cur-1;
				result.childNodes[cur-1].style.background='#CAE1FF';
				keywordObj.value = result.tipArr[cur-1].name;
			}
		}else if(key === 13){
			var res = resultObj;
			if(res && res['curSelect'] !== -1){
				selectResult(resultObj.curSelect,str);
			}
		   
		}else{
			autoSearch();
		}
	}
}
/*
 *[trim] 取出字符两边空格
 *[@param] {string} 
 *[@return] {string} [description] 
 */
function trim(str){
	return str.replace(/(^\s*)|(\s*$)/g,"");
}
$.fn.getDistance = function(addr_start,addr_end){
	var $obj = $(this);
	if( !addr_start || !addr_end ){
		return false;
	}
	AMap.service('AMap.Driving',function(){
		walking = new AMap.Driving();
		keywords = [];
		keywords.push({keyword:addr_start},{keyword:addr_end});
		walking.search(keywords, function(status, data){
			if(status === 'complete'){
				priceDistance = parseInt(data.routes[0].distance/1000);
				priceDistance = priceDistance < 1 ? 1 : priceDistance ;
				if (!isNaN(priceDistance)) {
					$obj.text(priceDistance);
					if (carCate == 1) {//如果当前选择的是小面包车
						selectXMPrice();
					} else if (carCate == 2) {//如果现在选择的是金杯车
						selectJBCar();
					}
				}
			}else{
			  document.getElementsByClassName('result')[0].style.display='block'
			  document.getElementById("list").innerHTML = '<error>'+data.info+'</error>';
			}
		});
	});
}