<?php
include_once './include/connect2db.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $sqlcmd = "SELECT * FROM tbl_LedCtrller WHERE 1";
        $sqlres = mysqli_query($db_conn, $sqlcmd);
        if ($sqlres) {
            while ($sqlfet = mysqli_fetch_array($sqlres)) {
                echo "Controller no: [" . $sqlfet['id'] . "] IP-Address: [" . $sqlfet['ctrlIPAddr'] . "] ";
                if ($sqlfet['ctrlStatus'] == 1) {
                    echo "Status: [ON]";
                } else {
                    echo "Status: [OFF]";
                }
                echo " Last update at: [" . $sqlfet['updatedAt'] . "]";
                echo "<br/>";
            }
        }
        ?>
    </body>
</html>
