<!--filename:   login.php-->
<!--author  :   thanray-->

<?php

require_once('user_auth_fcns.php');
require_once('data_valid_fcns.php');
require_once('db_fcns.php');
require_once('output_fcns.php');

//四种情况：
//1.从login_form过来:   post数据不为空,进入数据库检验等正常流程
//2.从login_form过来：  post数据为空,提示输入有误,给一个跳转到login_form的页面
//3.直接输入url过来,但是有session： 没有post,可以直接给member页面
//4.直接输入url过来,但是没session： 没有post,给一个跳转到login_form的页面

session_start();
@$username=$_POST[username];
@$passwd=$_POST[passwd];

//echo count($_POST)."<br/>";
//POST:空的username提交上来时,$_POST['username']是set的,但值是""空的.

try {
    if(!filled_out($_POST)) {
        throw new Exception('You have not filled the form out correctly. -
            Please go back and try again.');
    }else if(count($_POST)!=0) {
        login($username,$passwd);
        $_SESSION['valid_user']=$username;
    }
} catch (Exception $e) {
    do_html_header('Login Failed');
    echo $e->getMessage()."<br/>";
    do_html_url('login_form.php','login');
    do_html_footer();
    exit;
}

check_valid_user();
do_html_header('User Home');
echo 'Hello, '.$_SESSION['valid_user'].' !' . "<br/>";
echo 'This is your personal homepage.<br/>';
display_menu();
do_html_footer();

?>
