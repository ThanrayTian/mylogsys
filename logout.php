<!--filename:   logout.php-->
<!--author  :   thanray-->

<?php

require_once('output_fcns.php');

session_start();

if(!isset($_SESSION['valid_user'])) {

    $result = session_destroy();
    do_html_header('Logout Failed');
    echo "You have not login yet.<br/>";
    do_html_url('login_form.php','go to login');
} 
else {

    $oldname = $_SESSION['valid_user'];
    unset($_SESSION['valid_user']);
    $result = session_destroy();

    if($result) {
        do_html_header('Logout Successful');
        echo "You have logout the user : ".$oldname."<br/>";
        echo "open the link to login again. <br/>";
        do_html_url('login_form.php','login');
    } else {
        do_html_header('Logout Failed');
        echo "You could not logout now - Please retry later.<br/>";
        display_menu();
    }
}
do_html_footer();

?>

