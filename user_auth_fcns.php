
<!--filename  :   user_auth_fcns.php-->
<!--author    :   thanray-->

<?php

require_once('db_fcns.php');

function register($username,$passwd,$email) {

    $conn = db_connect();
    $query = 'select * from myuser where username=\''.$username.'\'';
    $result = $conn->query($query);
    if(!$result) {
        echo mysqli_errno($conn) . ": " . mysqli_error($conn) . " ";
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
        echo mysqli_errno($conn) . ": " . mysqli_error($conn) . " ";
        throw new Exception('Could not register you in database - Please try 
            again later.');
    }

    return true;
}

function login($username,$passwd) {
    
    $conn = db_connect();
    $query = 'select * from myuser where username =\'' . $username.'\' and '
        . 'passwd =\'' . sha1($passwd) . '\''; 
    $result = $conn->query($query);
    if(!$result) {
        echo mysqli_errno($conn) . ": " . mysqli_error($conn) . " ";
        throw new Exception('Login in: Could not execute the query.');
    }

    if($result->num_rows > 0) {
        return true;
    } else {
        throw new Exception('Wrong username or password.');        
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


function change_passwd($username,$old_passwd,$new_passwd) {

    //can use login() to replace.
    $conn = db_connect();
    $query = 'select * from myuser 
            where username = \'' . $username . '\' and 
            passwd = \'' . sha1($old_passwd) . '\'';
    $result = $conn->query($query);
    if(!$result) {
        echo mysqli_errno() . " : " . mysqli_error() . "<br/>";
        throw new Exception('Check old password : 
            Could not execute the query.');
    }
    if($result->num_rows <= 0) {
        throw new Exception('Your old password could not match the username.');
    }

    //
    $query = 'update myuser set passwd = \''. sha1($new_passwd) .
        '\' where username = \'' . $username . '\'';    
    $result = $conn->query($query);
    if(!$result) {
        throw new Exception('Update the password : 
            Could not execute the query');
    }
    return true;
}

?>
