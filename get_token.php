<?php

$access_token = $_GET["access_token"];
setcookie("access_token",$access_token);

$date = date("Y-m-d");
setcookie("date",$date);

header("Location: http://www.kmoving.com/user/info/moves_show.php");