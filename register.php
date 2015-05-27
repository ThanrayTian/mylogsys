<!--filename:   register.php-->
<!--author  :   thanray-->

<?php

require_once('data_valid_fcns.php');
require_once('user_auth_fcns.php');

session_start();

$username = $_POST['username'];
$passwd1 = $_POST['passwd1'];
$passwd2 = $_POST['passwd2'];
$email = $_POST['email'];

try{

    if(!filled_out($_POST)) {
        throw new Exception('You have not filled the form out correctly. -
            Please go back and try again.');
    }

    if(!valid_email($email)) {
        throw new Exception('That is not a valid email address. -
            Please go back and try again.');
    }

    if($passwd1 != $passwd2) {
        throw new Exception('The two password do not match. -
            Please go back and try again.');
    }

    if( (strlen($passwd1)<6) || (strlen($passwd1)>16) ) {
        throw new Exception('Your password must be between 6 to 16 characters. -
            Please go back and try again.');
    }

    register($username,$passwd1,$email);
    $_SESSION['valid_user'] = $username;


    do_html_header('Registration Successful');
    echo 'Your registration was successful. Go to the login page to login.';
    do_html_url('login_form.php','login');
    do_html_footer();

}
catch (Exception $e) {
    do_html_header('Register Problem');
    echo $e->getMessage();
    do_html_url('register_form.php','retry register');
    do_html_footer();
    exit;
}

?>
