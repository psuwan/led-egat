<?php

include_once './include/connect2db.php';

$vAddress = filter_input(INPUT_SERVER, 'REMOTE_ADDR');
$vTemper = filter_input(INPUT_GET, 'temperature');
$vStatus = filter_input(INPUT_GET, 'status');

$datFile = "./log/" . date("Y-m-d") . ".dat";
$errFile = "./log/" . date("Y-m-d") . ".err";

if (empty($vTemper)) {
    $vTemper = 'NULL';
}

$sqlchkcmd = "SELECT * FROM tbl_LedCtrller WHERE ctrlIPAddr='$vAddress'";
$sqlchkres = mysqli_query($db_conn, $sqlchkcmd);

if ($sqlchkres) {
    $sqlchknum = mysqli_num_rows($sqlchkres);
    if ($sqlchknum > 0) {
        $sqlcmd = "UPDATE tbl_LedCtrller SET ctrlStatus=1, ctrlTemper='$vTemper' WHERE ctrlIpAddr='$vAddress'";
    } else {
        $sqlcmd = "INSERT INTO tbl_LedCtrller (ctrlIPAddr, ctrlStatus, ctrlTemper, updatedAt) VALUES ('$vAddress', 1, '$vTemper', NOW())";
    }
    //echo $sqlcmd . "<br/>";
    $sqlres = mysqli_query($db_conn, $sqlcmd);

    if ($sqlres) {
        $txt = date("Y-m-d") . ", " . date("h:i:sa");
        $txt .= ", cpu temperature = " . $vTemper;
        $txt .= ", IoT status = " . $vStatus;
        $txt .= ", IoT ip-addr = " . $vAddress;
        $txt .= "\n";

        file_put_contents($datFile, $txt, FILE_APPEND | LOCK_EX);
        echo "OK logging...";
    } else {
        $txt = date("Y-m-d") . ", " . date("h:i:sa");
        $txt .= " [" . mysqli_errno($db_conn) . "]";
        $txt .= " [" . mysqli_error($db_conn) . "]";
        $txt .= "\n";

        file_put_contents($errFile, $txt, FILE_APPEND | LOCK_EX);
        echo "Error logging..!";
    }
} else {
    $txt = date("Y-m-d") . ", " . date("h:i:sa");
    $txt .= " [" . mysqli_errno($db_conn) . "]";
    $txt .= " [" . mysqli_error($db_conn) . "]";
    $txt .= "\n";

    file_put_contents($errFile, $txt, FILE_APPEND | LOCK_EX);
    echo "Error checking..!";
}
?>