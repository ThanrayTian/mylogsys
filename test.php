<?php

require_once('mailclass.php');
require_once('data_valid_fcns.php');

?>

<form action="" method="post">
    <table border="0">
    <tr>
        <td>email:</td>
        <td align="center"><input type="email" name="email" size="3"
            maxlength="50" style="width:200px;"/></td>
    </tr>
    <tr>
        <td>text:</td>
        <td align="center"><input type="text" name="text" size="3"
            maxlength="140" style="width:200px;height:100px;"/></td>
    </tr>
    <tr>
        <td colspan="2" align="center"><input type="submit" value="Send"/></td>
    </tr>
</form>

<?php


$smtpserver = "smtp.qq.com";
$smtpserverport = 25;
$smtpusermail = "1142120038@qq.com";
$smtpuser = "1142120038@qq.com";
$smtppass = "hsq3681236812hsq##";
$smtpsender = "1142120038@qq.com";

if(isset($_POST['email'])) {
    
    $user_email = $_POST['email'];
    $text = $_POST['text'];
    try {
        if(!valid_email($user_email)) {
            throw new Exception('Not a valid email address');
        }
    }
    catch(Exception $e) {
        echo $e->getMessage() . "<br\>";
        exit; 
    }
     
    $smtpmailto = $user_email;
    //
    $mailtheme = "PHP mail test";
    $mailbody = $text . "<br/>";
    $mailtype = "HTML";
    //这里面的一个true是表示使用身份验证,否则不使用身份验证
    $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass,$smtpsender);
    $smtp->debug = true;
    $smtp->sendmail($smtpmailto, $smtpusermail, $mailtheme, $mailbody, $mailtype);
    
}

?>
