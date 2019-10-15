<?php

$config_db = array(
    "db_host" => "localhost",
    "db_user" => "root",
    "db_pass" => "kittivud",
    "db_name" => "egatled",
    "db_char" => "utf8"
);

$db_conn = mysqli_connect($config_db['db_host'], $config_db['db_user'], $config_db['db_pass'], $config_db['db_name']);

if (mysqli_connect_errno($db_conn)) {
    echo "Failed to connect Database [ " . mysqli_connect_error($db_conn) . " ]";
} else {
    //echo "OK";
    mysqli_set_charset($db_conn, $config_db['db_char']);
}