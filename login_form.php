<!--filename:   login_form.php-->
<!--author  :   thanray-->

<?php

    require_once('output_fcns.php');

    do_html_header('User Login');
    display_login_form();
    do_html_url('register_form.php','register');
    do_html_url('forgot_passwd_form.php','forgot password');
    do_html_footer();

?>
