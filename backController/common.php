<?php
//下载的文件必须放在该文件所在目录
//sendEmail('starxy154@126.com','hello','1111111');
function sendEmail($email,$account,$password)
{
    require("class.phpmailer.php");
    $mail = new PHPMailer(); //建立邮件发送类
    $address =$email;
    $mail->IsSMTP(); // 使用SMTP方式发送
    $mail->Host = "smtp.163.com"; // 您的企业邮局域名
    $mail->CharSet = "UTF-8";                     //chinese;
    $mail->SMTPAuth = true; // 启用SMTP验证功能
    $mail->Username = "sofaerfighter@163.com"; // 邮局用户名(请填写完整的email地址)
    $mail->Password = "buaaSofa12"; // 邮局密码
    $mail->Port=25;
    $mail->From = "sofaerfighter@163.com"; //邮件发送者email地址
    $mail->FromName = "banar";
    $mail->AddAddress("$address", "Dear sofaer");//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
    //$mail->AddReplyTo("", "");

    //$mail->AddAttachment("/var/tmp/file.tar.gz"); // 添加附件
    //$mail->IsHTML(true); // set email format to HTML //是否使用HTML格式


    $subject = "搬哪儿";
    $subject = "=?UTF-8?B?".base64_encode($subject)."?=";
    $mail->Subject = $subject; //邮件标题
    $text = "欢迎加入我们，你的初始登录名为：{$email}，初始登陆密码为：{$password}
				请尽快登陆并修改密码";
    $subject = $text;

    $mail->Body = $text; //邮件内容
    $mail->AltBody = "This is the body in plain text for non-HTML mail clients"; //附加信息，可以省略

    if(!$mail->Send())
    {

        echo "error: " . $mail->ErrorInfo;
        exit;
    }
    return true;

}


?>