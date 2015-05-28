<!--filename:   change_passwd.php-->
<!--author  :   thanray-->

<?php

//
require_once('output_fcns.php');
require_once('user_auth_fcns.php');
require_once('data_valid_fcns.php');

session_start();
@$old_passwd = $_POST['old_passwd'];
@$new_passwd1 = $_POST['new_passwd1']; 
@$new_passwd2= $_POST['new_passwd2']; 

//1.从change_passwd_form来，由于在表单出做过会话检验：可直接做判断
//2.从url直接过来且session存在：需要返回填写表单
//3.从url直接过来且session不存在：需要先登录
//check
try{
    check_valid_user();
    if(count($_POST)==0 ) {
        throw new Exception('You should fill in the password changing form 
            before');  
    }
    if(!filled_out($_POST)) {
        throw new Exception('You have not filled the form out correctly 
            - Please go back and try again.');
    }
    if($new_passwd1 != $new_passwd2) {
        throw new Exception('The two new password do not match 
            - Please go back and try again.');
    }
    if(strlen($new_passwd1)<6 || strlen($new_passwd1)>16) {
        throw new Exception('Your new password must be between 6 to 16 character
            s - Please go back and try again.');
    }
    
    change_passwd($_SESSION['valid_user'],$old_passwd,$new_passwd1);
}
catch (Exception $e) {
    do_html_header('Change Password Failed');
    echo $e->getMessage() . "<br/>";
    do_html_url('change_passwd_form.php','change password');
    do_html_footer();
    exit;
}

do_html_header('Change Password Successful');
display_menu();
do_html_footer();

?>
