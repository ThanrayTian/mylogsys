<!--filename  :   user_auth_fcns.php-->
<!--author    :   thanray-->

<?php

require_once('db_fcns.php');

function register($username,$passwd,$email) {

    db_connect();
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

?>
