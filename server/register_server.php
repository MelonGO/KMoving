<?php
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('/Users/melon/Sites/test.db');
    }
}

function user_register($userName, $userPassword, $checkbox){
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {
        echo "Opened database successfully</br>";
    }

    $sql =<<<EOF
    SELECT * FROM User WHERE name = '$userName';
EOF;

    $ret = $db->query($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    } else {
        if($row = $ret->fetchArray(SQLITE3_ASSOC)){
            header("Location: http://www.kmoving.com/user/register.php?Error=userExist");
        }else{
            $sql =<<<EOF
            INSERT INTO User (name, password, last, doctor, gender, height, weight, country, city, address)
            VALUES ('$userName', '$userPassword', '$userName', '$checkbox', '--', '--', '--', '--', '--', '--');
EOF;

            $ret = $db->exec($sql);
            if(!$ret){
                echo $db->lastErrorMsg();
            } else {
                $db->close();
                setcookie("username",$userName,null,"/");
                header("Location: http://www.kmoving.com/server/user/user_details.php");
            }
        }
    }
    $db->close();
}

$userName = strval($_POST["username"]);
$userPassword = strval( $_POST["password"]);
$checkbox = $_POST['checkbox'];
if($userName!=null && $userPassword!=null){
    user_register($userName, $userPassword, $checkbox);
}
