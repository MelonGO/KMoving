<?php
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('/Users/melon/Sites/test.db');
    }
}

function get_user_settings(){
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
            $birth = $row["birth"];
            $country = $row["country"];
            $city = $row["city"];
            $address = $row["address"];
            $url = "http://www.kmoving.com/user/info/settings.php?name=$name&gender=$gender&height=$height&weight=$weight&birth=$birth&country=$country&city=$city&address=$address";
            header("Location: $url");
        }
    }
    $db->close();
}

function set_user_settings($gender, $height, $weight, $birth, $country, $city, $address){
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {
        echo "Opened database successfully</br>";
    }

    $userName = $_COOKIE["username"];
    $sql =<<<EOF
      UPDATE User set gender='$gender', height='$height', weight='$weight', birth='$birth',country='$country',city='$city',address='$address' where name='$userName';
EOF;

    $ret = $db->exec($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    } else {
        header("Location: http://www.kmoving.com/server/user/settings.php");
    }
    $db->close();
}

$name = $_POST["name"];
$gender = $_POST["gender"];
$height = $_POST["height"];
$weight = $_POST["weight"];
$birth = $_POST["birth"];
$country = $_POST["country"];
$city = $_POST["city"];
$address = $_POST["address"];
if($gender!=null || $height!=null || $height!=null || $weight!=null || $country!=null || $city!=null || $address!=null){
    set_user_settings($gender, $height, $weight, $birth, $country, $city, $address);
}else{
    get_user_settings();
}