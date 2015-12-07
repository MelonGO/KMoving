<?php
$client_id = "5rZnyvbwM90";
$redirect_uri = "https://melongo.sinaapp.com/get_access_token.php";
$scope = "basic_read extended_read location_read friends_read mood_read move_read sleep_read meal_read weight_read generic_event_read";
$url  = "Location: https://jawbone.com/auth/oauth2/auth?response_type=code&client_id=$client_id&redirect_uri=$redirect_uri&scope=$scope";
header($url);