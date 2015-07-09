/**
 * Created by niuwei on 15/5/19.
 */
// 百度地图API功能
function G(id) {
    return document.getElementById(id);
}

var map = new BMap.Map("l-map");
map.centerAndZoom("北京",12);                   // 初始化地图,设置城市和地图级别。

//startLocation
var startLocation = new BMap.Autocomplete(    //建立一个自动完成的对象
    {
        "input" : "startLocation",
        "location" : map
    });

startLocation.addEventListener("onhighlight", function(e) {  //鼠标放在下拉列表上的事件
    calculateFirst = true;
    var str = "";
    var _value = e.fromitem.value;
    var value = "";
    if (e.fromitem.index > -1) {
        value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
    }
    str = "FromItem<br />index = " + e.fromitem.index + "<br />value = " + value;

    value = "";
    if (e.toitem.index > -1) {
        _value = e.toitem.value;
        value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
    }
    str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
    $('#endLocation').val('');
    $('#distance').html(0);
});

var startLocationValue;
var startPoint;
startLocation.addEventListener("onconfirm", function(e) {    //鼠标点击下拉列表后的事件
    var _value = e.item.value;
    startPoint = e.point;
    //var value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
    startLocationValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
});



//endLocation
var endLocation = new BMap.Autocomplete(    //建立一个自动完成的对象
    {
        "input" : "endLocation",
        "location" : map
    });

endLocation.addEventListener("onhighlight", function(e) {  //鼠标放在下拉列表上的事件
    var str = "";
    var _value = e.fromitem.value;
    var value = "";
    if (e.fromitem.index > -1) {
        value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
    }
    str = "FromItem<br />index = " + e.fromitem.index + "<br />value = " + value;

    value = "";
    if (e.toitem.index > -1) {
        _value = e.toitem.value;
        value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
    }
    str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
});

var endLocationValue;
endLocation.addEventListener("onconfirm", function(e) {    //鼠标点击下拉列表后的事件
    var _value = e.item.value;
    var value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
    getDistanceByJS(value);
    endLocationValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
});



function getDistanceByJS(endLocation) {
    var startLocation = $('#startLocation').val();
    startLocation = startLocation.replace('-', '');
    endLocation = endLocation.replace('-', '');


    $.ajax({
        url: "../../index/index.php",
        data: {
            action : "getDistanceByArea",
            startLocation : startLocation,
            endLocation : endLocation
        },
        type: 'post',
        dataType: 'json',
        success: function(data) {
            priceDistance = parseInt(data['distance']) / 1000;
            priceDistance = parseInt(priceDistance) + 1;
            if (!isNaN(priceDistance)) {
                $('#distance').html(parseInt(priceDistance));
                if (carCate == 1) {//如果当前选择的是小面包车
                    selectXMPrice();
                } else if (carCate == 2) {//如果现在选择的是金杯车
                    selectJBCar();
                }
            }
        },
        error: function(data) {
            alert("获取失败");
        }
    });
}



