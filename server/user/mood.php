<?php

function NumToDate($num){
    return date("Y-m-d H:i:s", $num);
}
function DateToNum($date){
    return strtotime($date);
}

function get_mood($date) {
    $temp = strtotime($date);
    $date_clear = date("Ymd",$temp);
    $access_token = $_COOKIE["access_token"];
//    $url ="https://jawbone.com/nudge/api/v.1.1/users/@me/mood?date=$date_clear";
    $date = $_COOKIE['date'];
    $userName = $_COOKIE['username'];
    $url = "http://www.kmoving.com/data/".$userName."/mood/".$date.".json";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//            "Content-Type: application/json",
//            "Authorization: Bearer $access_token")
//    );
    $output= curl_exec($ch);
    curl_close($ch);

    return $output;
}

class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('/Users/melon/Sites/test.db');
    }
}

function get_userId($userName){
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {
    }

    $sql =<<<EOF
    SELECT * FROM User WHERE name = '$userName';
EOF;

    $ret = $db->query($sql);
    if($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        $authorId = $row['id'];
        $db->close();
        return $authorId;
    }
    $db->close();
}

function update_mood($mood_image){
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {}

    $userName = $_COOKIE['username'];
    $date = $_COOKIE['date'];
    $sql =<<<EOF
    SELECT * FROM User,Mood WHERE User.name='$userName' and User.id=Mood.userId and Mood.createAt='$date';
EOF;

    $ret = $db->query($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    } else {
        if($row = $ret->fetchArray(SQLITE3_ASSOC)){
            $userId = $row['userId'];
            $sql =<<<EOF
            UPDATE Mood
            SET mood='$mood_image'
            where userId=$userId and createAt=$date;
EOF;
            $ret = $db->exec($sql);
            if(!$ret){
                echo $db->lastErrorMsg();
            } else {}
        }else{
            $userId = get_userId($userName);
            $sql =<<<EOF
            INSERT INTO Mood (userId, mood, createAt)
            VALUES ('$userId', '$mood_image', '$date');
EOF;
            $ret = $db->exec($sql);
            if(!$ret){
                echo $db->lastErrorMsg();
            } else {}
        }
    }
    $db->close();
}

function read_mood($output){
    $obj = json_decode($output);
    $meta = $obj->meta;
    $user_xid = $obj->user_xid;

    $data = $obj->data;

    $place_lat = $data->place_lat;
    $place_lon = $data->place_lon;
    $time_created = $data->time_created;
    $time_created = NumToDate($time_created);
    $time_updated = $data->time_updated;
    $time_updated = NumToDate($time_updated);
    $xid = $data->xid;
    $title = $data->title;

    $details = $data->details;                    //array
    $date = $data->date;
    $shared = $data->shared;
    $sub_type = $data->sub_type;
    $place_acc = $data->place_acc;
    $place_name = $data->place_name;

    $tz = $details->tz;
    $place_acc = $details->place_acc;

    $mood_image = "";
    switch($sub_type){
        case 1:
            $mood_image = "../../img/Amazing.png";
            break;
        case 2:
            $mood_image = "../../img/Pumped_UP.png";
            break;
        case 3:
            $mood_image = "../../img/Energized.png";
            break;
        case 4:
            $mood_image = "../../img/Meh.png";
            break;
        case 5:
            $mood_image = "../../img/Dragging.png";
            break;
        case 6:
            $mood_image = "../../img/Exhausted.png";
            break;
        case 7:
            $mood_image = "../../img/Totally_Done.png";
            break;
    }

    echo
    "
        <div class='row'>
            <div class='col-md-12'>
                <div class='pull-left animated jello' id='mood-content'>
                    <h2 style='color: white'>今日心情:</h2>
                    <img class='img-responsive img-rounded center-block mood-img' src='$mood_image'>
                </div>
            </div>
        </div>
    ";

    update_mood($mood_image);

}
$date = $_COOKIE["date"];
$output = get_mood($date);
read_mood($output);
//    <p>经度：$place_lat,纬度：$place_lon</p>
//    <p>创建时间：$time_created</p>
//    <p>更新时间：$time_updated</p>
//    <p>日期：$date</p>
//    <img src='$mood_image'/>
//    <p>心情：$title</p>
//    <p>时区：$tz</p>