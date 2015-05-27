<!--filename  :   data_valid_fcns.php-->
<!--author    :   thanray-->

<?php
    
function filled_out($array) {
    
    foreach ($array as $key => $value) {
        if(!isset($key) || !isset($value)) {
            return false;
        }
    }
    return true;
}

function valid_email($email) {

    if( ereg('^[0-9a-zA-Z_\.\-]+@[0-9a-zA-Z\-]+\.[0-9a-zA-Z\-\.]+$' , $email) ) {
        return true;
    }
    return false;
}


?>
