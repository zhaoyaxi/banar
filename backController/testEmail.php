<?php
sendEmail('starxy154@126.com','1111','name');


function sendEmail($adminEmail,$adminPassword,$adminName){
    require("class.phpmailer.php");
    $mail = new PHPMailer(); //建立邮件发送类
    $address =$email;
    $mail->IsSMTP(); // 使用SMTP方式发送
    $mail->Host = "smtp.163.com"; // 您的企业邮局域名
    $mail->SMTPAuth = true; // 启用SMTP验证功能
    $mail->Username = "starxy154@163.com"; // 邮局用户名(请填写完整的email地址)
    $mail->Password = "illxy1634434"; // 邮局密码
    $mail->Port=25;
    $mail->From = "starxy154@163.com"; //邮件发送者email地址
    $mail->FromName = "banar";
    $mail->AddAddress("$adminEmail", "Dear admin");//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
    //$mail->AddReplyTo("", "");

    //$mail->AddAttachment("/var/tmp/file.tar.gz"); // 添加附件
    //$mail->IsHTML(true); // set email format to HTML //是否使用HTML格式

    $mail->Subject = "welcome join us"; //邮件标题
    $mail->Body = "您好，".$adminName.":\n    欢迎你加入我们搬哪儿，你的初始登录名为:".$adminEmail.",初始登陆密码为：'{$adminPassword}'
							请您尽快登陆，网址http:...."; //邮件内容
    $mail->AltBody = "This is the body in plain text for non-HTML mail clients"; //附加信息，可以省略

    if(!$mail->Send())
    {

        echo "error: " . $mail->ErrorInfo;

    }else{
        echo 12;
    }

}