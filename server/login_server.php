<?php

$userName = strval($_POST["username"]);
$userPassword = strval( $_POST["password"]);

class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('/Users/melon/Sites/test.db');
    }
}

$db = new MyDB();
if(!$db){
    echo $db->lastErrorMsg();
} else {
    echo "Opened database successfully</br>";
}

$sql =<<<EOF
    SELECT * FROM User WHERE name = '$userName' and password = '$userPassword';
EOF;

$ret = $db->query($sql);
if(!$ret){
    echo $db->lastErrorMsg();
} else {
    if($row = $ret->fetchArray(SQLITE3_ASSOC)){
//        $client_id = "5rZnyvbwM90";
//        $redirect_uri = "https://melongo.sinaapp.com/get_access_token.php";
//        $scope = "basic_read extended_read location_read friends_read mood_read move_read sleep_read meal_read weight_read generic_event_read";
//        $url  = "Location: https://jawbone.com/auth/oauth2/auth?response_type=code&client_id=$client_id&redirect_uri=$redirect_uri&scope=$scope";
        setcookie("username",$userName,null,"/");
        header("Location: http://www.kmoving.com/server/user/user_details.php");
    }else{
        header("Location: http://www.kmoving.com/user/login.php?Error=loginError");
    }
}
$db->close();