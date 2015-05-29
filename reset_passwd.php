<!--filename:   reset_passwd.php-->
<!--author  :   thanray-->

<?php

require_once('output_fcns.php');
require_once('data_valid_fcns.php');
require_once('user_auth_fcns.php');

$url_wrong = false;
if(!isset($_GET['p'])) {
    $url_wrong = true;
}
else {
    $p = $_GET['p'];
    $array = explode('.',base64_decode($p));
    $username = $array[0];
    try {
        if( md5($username. "+" .get_passwd($username)) != $array[1]) {
            $url_wrong = true;
        }
    } catch(Exception $e) {
        do_html_header("Reset Password Problem");
        echo $e->getMessage() . "<br/>"; 
        exit;
    }
}

if($url_wrong) {
    do_html_header('Reset Password Failed');
    echo "You should visit via the right url address in the email<br/>";
    do_html_footer();
    exit;
}

do_html_header('Reset Password');
display_reset_passwd_form();
do_html_footer();

if(count($_POST)) {
    
    $new_passwd1 = $_POST['new_passwd1'];
    $new_passwd2 = $_POST['new_passwd2'];

    try {
        if(!filled_out($_POST)) {
            throw new Exception('You have not filled the form out 
                correctly - Please try again.');
        }
        if($new_passwd1 != $new_passwd2) {
            throw new Exception('The two password do not match 
                - Please try again.');
        }
        if( (strlen($new_passwd1)<6) || (strlen($new_passwd1)>16) ) {
            throw new Exception('Your password must be between 6 to 16 
                characters - Please try again.');
        }
        reset_passwd($username,$new_passwd1);    
    } catch(Exception $e) {
        echo $e->getMessage() . "<br/>";
        exit; 
    }
    //重设密码成功后,自动跳转到登录页面
    echo "<script language='javascript' type='text/javascript'>";    
    echo "alert('Reset Password Successful!');";
    echo "window.location.href=\"http://localhost/login_form.php\";";    
    echo "</script>"; 
}

?>
