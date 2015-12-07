<?php

function get_custom_list($url, $access_token) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Authorization: Bearer $access_token")
    );
    $output = curl_exec($ch);
    curl_close($ch);
    print_r($output);

//    $obj=json_decode($output)
//    $data = $obj->data;;

//    header("Location: http://www.kmoving.com/user/user_details_show.php?xid=$xid&weight=$weight&gender=$gender&image=$image&height=$height&last=$last&first=$first");

}

$date = 20151014;
$start_time = 1444780800;
$end_time = 0;
$updated_after =0;
$limit =0;
$url = "https://jawbone.com/nudge/api/v.1.1/users/@me/generic_events?date=$date&start_time=$start_time";
$access_token = $_COOKIE["access_token"];
get_custom_list($url, $access_token);