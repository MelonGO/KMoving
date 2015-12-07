<?php
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('/Users/melon/Sites/test.db');
    }
}

function go_digital_panel() {
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {
        echo "Opened database successfully</br>";
    }

    $userName = $_COOKIE["username"];
    $sql =<<<EOF
    SELECT * FROM User WHERE name = '$userName';
EOF;

    $ret = $db->query($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    } else {
        if($row = $ret->fetchArray(SQLITE3_ASSOC)){
            $name = $row["name"];
            $gender = $row["gender"];
            $height = $row["height"];
            $weight = $row["weight"];
            $date = date("Y-m-d");
            setcookie("date",$date,null,"/");
            $url = "http://www.kmoving.com/home.php?name=$name&gender=$gender&height=$height&weight=$weight";
            header("Location: $url");
        }
    }
    $db->close();
}

go_digital_panel();