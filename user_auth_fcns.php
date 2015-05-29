
<!--filename  :   user_auth_fcns.php-->
<!--author    :   thanray-->

<?php

require_once('db_fcns.php');
require_once('mailclass.php');

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
        echo mysqli_errno($conn) . " : " . mysqli_error($conn) . "<br/>";
        throw new Exception('Update the password : 
            Could not execute the query');
    }
    return true;
}

function passwd_findout_email($username,$email) {
    $conn = db_connect();
    $query = "select * from myuser where username = '$username' 
        and email = '$email'";
    $result = $conn->query($query);
    if(!$result) {
        echo mysqli_errno($conn) . " : " . mysqli_error($conn) . "<br/>";
        throw new Exception('Select User and Email: 
            Clould not execute the query');
    }
    if($result->num_rows > 0) {
        $row = $result->fetch_object();
        $passwd = $row->passwd;
        $x = md5($username . "+" . $passwd);
        $url = base64_encode($username . "." .$x);
        $url = "http://localhost/reset_passwd.php?p=" . $url;

        $message = "Dear $username , ";
        $message .= "This is the link to reset your password:<br/>";
        $message .= "<a href=\"$url\" target=\"_black\">$url</a><br/>";
        $message .= "This is the service email, don't response it.<br/>";

        $theme = "[Mylogsys] Password reset email";

        send_email($email,$theme,$message);

    } else {
        throw new Exception('your username and email not match');   
    }

}

function send_email($emailto,$theme,$message) {
    
    //$smtpserver = "smtp.qq.com";
    //$smtpserverport = 25;
    //$smtpusermail = "xxxxxxxxxx@qq.com";
    //$smtpuser = "xxxxxxxxxx@qq.com";
    //$smtppasswd = "xxxxxxxxxxxxxxxxxx";
    //$smtpsender = "xxxxxxxxxx@qq.com";
    
   
    $smtpmailto = $emailto;
    $mailtype = "HTML";
    $mailtheme = $theme; 
    $mailbody = $message;
    //这里面的一个true是表示使用身份验证,否则不使用身份验证
    $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppasswd,$smtpsender);
    $smtp->debug = true;
    $smtp->sendmail($smtpmailto, $smtpusermail, $mailtheme, $mailbody, $mailtype);
}

function get_passwd($username) {
    $conn = db_connect();
    $query = "select passwd from myuser where username='$username'";
    $result = $conn->query($query);
    if(!$result) {
        echo mysqli_errno($conn) . " : " . mysqli_error($conn) . "<br/>";
        throw new Exception("Get Password: Could not execute the query");
    }
    if($result->num_rows>0) {
        $row  = $result->fetch_object();
        $passwd = $row->passwd;
        return $passwd;
    }
    return "";
}

function reset_passwd($username,$new_passwd) {
    $conn = db_connect();
    $query = "update myuser set passwd='".sha1($new_passwd)."' 
        where username = '$username'";
    $result = $conn->query($query);
    if(!$result) {
        echo mysqli_errno($conn) . " : " . mysqli_error($conn) . "<br/>";
        throw new Exception('Could not reset the password 
            - Please wait and try again later');
    }
    return true;
}

?>
