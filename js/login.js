    window.onload=function() {
		
		$('#loginBtn').click(function(){
			login();
		});
       
    }
    function login(){
            submitForm();
    }

    //提交数据
    function submitForm(from){
        var username = usernameInput.value;
        var password = passwordInput.value;
		alert(username);
		alert(password);
        var objRsbs = $.ajax({
            url:"./class/index.php",
            async:false,
            type:"POST",
            dataType:"json",
            data:{
                identification:username,
                password:password,
                action:"login"
            },
            error:function(XMLHttpRequest, textStatus, errorThrown) {
                        alert(XMLHttpRequest.status);
                        alert(XMLHttpRequest.readyState);
                        alert(textStatus);
                    },
            success:function(data){
                if(data.status){
                    alert("登陆成功，正在跳转");
                    //window.location.href= from+".html";
                }
                else{
                    alert(data.error);
                }
            }
        });
    }
    //ajax连接失败
    function disConn(a,b,c)
    {
        console.log(a+b+c);
        alert("网络连接失败，请稍后重试！");
        conn = 0;
    }