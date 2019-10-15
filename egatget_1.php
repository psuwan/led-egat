<?php

$vstatus = filter_input(INPUT_GET, 'status');

$namefile = "./log/" . date("Y-m-d") . ".dat";
//$datfile = fopen($namefile, "w") or die("Unable to open file!");
$txt = date("Y-m-d") . "," . date("h:i:sa");
//$txt .= ", cpu temperature = ".$vcputemp/1000;
$txt .= ", IoT status = " . $vstatus;
$txt .= ", IoT ip-addr = " . $_SERVER['REMOTE_ADDR'];
$txt .= "\n";
//fwrite($datfile, $txt);
file_put_contents($namefile, $txt, FILE_APPEND | LOCK_EX);
fclose($datfile);
?>