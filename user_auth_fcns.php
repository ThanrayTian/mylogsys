<!--filename  :   user_auth_fcns.php-->
<!--author    :   thanray-->

<?php

require_once('db_fcns.php');

function register($username,$passwd,$email) {

    $conn = db_connect();
    $query = 'select * from myuser where username=\''.$usernmae.'\'';
    $result = $conn->query($query);
    if(!$result) {
        throw new Exception('Could not execute query.');
    }

    if( $result->num_rows > 0 ) {
        throw new Exception('That username is taken - go back and choose another
            one.');
    }

    $query = 'insert into myuser values
        (\''.$username.'\',\''.sha1($passwd).'\',\''.$email.'\')';

    $result = $conn->query($query);
    if(!$result) {
        throw new Exception('Could not register you in database - Please try 
            again later.');
    }

    return true;
}

function login($username,$passwd) {
    
    $conn = db_connect();
    $query = 'select * form myuser where username=\''.$username.'\'and passwd=\''
        .$passwd.'\''; 
    $result = $conn->query($query);
    if(!$result) {
        throw new Exception('Could not log you in.');
    }

    if($result->num_rows > 0) {
        return true;
    } else {
        throw new Exception('Could not log you in.');        
    }
}

function check_valid_user() {
    
    if(!isset($_SESSION['valid_user'])) {
        do_html_header('Problem:');
        echo 'You have not login yet.'."<br/>";
        do_html_url("login_form.php",'login');
        do_html_footer();
        exit;
    }
}



?>
