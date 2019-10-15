<?php

include_once './include/connect2db.php';

$errFile = "log/" . date("Y-m-d") . ".err";

$sqlcmd = "UPDATE tbl_LedCtrller SET ctrlStatus=0 WHERE 1";
$sqlres = mysqli_query($db_conn, $sqlcmd);

if ($sqlres) {
    //do nothing
} else {

    $txt = date("Y-m-d") . ", " . date("h:i:sa");
    $txt .= " [" . mysqli_errno($db_conn) . "]";
    $txt .= " [" . mysqli_error($db_conn) . "]";
    $txt .= "\n";

    file_put_contents($errFile, $txt, FILE_APPEND | LOCK_EX);
    echo "Error checking..!";
}