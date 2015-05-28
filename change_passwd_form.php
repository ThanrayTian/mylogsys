<!--filename:   change_passwd_form.php-->
<!--author  ：  thanray-->

<?php

require_once('output_fcns.php');
require_once('user_auth_fcns.php');

session_start();
check_valid_user();

do_html_header('Change PassWord');
display_change_passwd_form();
display_menu();
do_html_footer();

?>
