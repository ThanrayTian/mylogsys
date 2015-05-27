<?php

function db_connect() {
    $result = new mysqli('localhost','ml_user','mlpasswd123','mylogsys');
    if(!$result) {
        throw new Exception ('Can not connect to database server');
    } else {
        return $result;
    }
}

?>
