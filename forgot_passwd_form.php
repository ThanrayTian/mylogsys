<!--filename:   forgot_passwd_form.php-->
<!--author  :   thanray-->

<?php

require_once('output_fcns.php');
require_once('data_valid_fcns.php');
require_once('user_auth_fcns.php');

//显示填写页面
do_html_header('Forgot Password');
display_forgot_passwd_form();
do_html_footer();

//同时也是处理数据的页面
if(count($_POST)) {
    try {
        @$email = $_POST['email'];
        @$username = $_POST['username'];

        if(!filled_out($_POST)) {
            throw new Exception('You have not filled the form out correctly 
                - Please try again.');
        }
        if(!valid_email($email)) {
            throw new Exception('That is not a valid email address
                - Please try again.');
        } 

        passwd_findout_email($username,$email);
        echo "Send email sucessful - Please login your email and check it<br/>"; 
        do_html_url('login_form.php','go back to Login');  
    }
    catch(Exception $e) {
        echo $e->getMessage() . "<br/>";
        exit;
    }
}

?>


