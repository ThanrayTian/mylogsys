<?php

function db_connect() {
    $result = new mysqli('localhost','ml_user','mlpasswd123','mylogsys');
    if(!$result) {
        echo mysqli_errno($conn) . ": " . mysqli_error($conn) . " ";
        throw new Exception ('Can not connect to database server');
    } else {
        return $result;
    }
}

?>
