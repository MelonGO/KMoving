<?php

function NumToDate($num){
    return date("Y-m-d H:i:s", $num);
}
function DateToNum($date){
    return strtotime($date);
}

function get_sleeps($date) {
    $start_time = strtotime($date);
    $date_clear = date("Ymd",$start_time);
    $end_time = strtotime($date) + 86400;
    $updated_after = 0;
    $limit = 0;
    $page_token = 0;
    $access_token = $_COOKIE["access_token"];
//    $url ="https://jawbone.com/nudge/api/v.1.1/users/@me/sleeps?date=$date_clear&start_time=$start_time&end_time=$end_time";
    $date = $_COOKIE['date'];
    $userName = $_COOKIE['username'];
    $url = "http://www.kmoving.com/data/".$userName."/sleeps/".$date.".json";
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

function update_sleeps($asleep_time,$awakenings,$awake,$light,$deep,$duration){
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {}

    $userName = $_COOKIE['username'];
    $date = $_COOKIE['date'];
    $sql =<<<EOF
    SELECT * FROM User,Sleeps WHERE User.name='$userName' and User.id=Sleeps.userId and Sleeps.createAt='$date';
EOF;

    $ret = $db->query($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    } else {
        if($row = $ret->fetchArray(SQLITE3_ASSOC)){
            $userId = $row['userId'];
            $sql =<<<EOF
            UPDATE Sleeps
            SET asleep='$asleep_time',wake_up_time='$awakenings',
            sober='$awake',light='$light',deep='$deep',total='$duration'
            where userId=$userId and createAt=$date;
EOF;
            $ret = $db->exec($sql);
            if(!$ret){
                echo $db->lastErrorMsg();
            } else {}
        }else{
            $userId = get_userId($userName);
            $sql =<<<EOF
            INSERT INTO Sleeps (userId, asleep, wake_up_time, sober, light, deep, total, createAt)
            VALUES ('$userId', '$asleep_time', '$awakenings', '$awake', '$light', '$deep', '$duration', '$date');
EOF;
            $ret = $db->exec($sql);
            if(!$ret){
                echo $db->lastErrorMsg();
            } else {}
        }
    }
    $db->close();
}

function read_sleeps($output){
    $obj = json_decode($output);
    $meta = $obj->meta;
    $user_xid = $obj->user_xid;

    $data = $obj->data;
    $items = $data->items;
    $size = $data->size;

    for($index=0;$index<$size;$index++){
        $item = $items[$index];

        $place_lat = $item->place_lat;
        $place_lon = $item->place_lon;
        $time_created = $item->time_created;
        $time_created = NumToDate($time_created);
        $time_completed = $item->time_completed;
        $time_completed = NumToDate($time_completed);
        $time_updated = $item->time_updated;
        $time_updated = NumToDate($time_updated);
        $xid = $item->xid;
        $title = $item->title;

        $details = $item->details;                    //array
        $date = $item->date;
        $shared = $item->shared;
        $snapshot_image = $item->snapshot_image;
        $sub_type = $item->sub_type;
        $place_acc = $item->place_acc;
        $place_name = $item->place_name;

        $body = $details->body;
        $sound =$details->sound;
        $tz = $details->tz;
        $awakenings =$details->awakenings;
        $light = $details->light;
        $place_acc = $details->place_acc;
        $mind = $details->mind;
        $asleep_time = $details->asleep_time;
        $awake = $details->awake;
        $rem = $details->rem;
        $duration = $details->duration;
        $smart_alarm_fire = $details->smart_alarm_fire;
        $quality = $details->quality;
        $sunrise = $details->sunrise;
        $sunrise = NumToDate($sunrise);
        $sunset = $details->sunset;
        $sunset = NumToDate($sunset);

        $deep = $duration - $light;

        echo
        "
            <div class='row'>
                <div class='col-md-12'>
                    <div id='sleeps-content'>
                        <div class='pull-left animated bounceInLeft' id='sleeps-fall-time'>
                            <h2>入睡用时</h2>
                            <p class='fa fa-clock-o fa-2x'>$asleep_time min</p>
                        </div>
                        <div class='pull-left animated bounceInDown' id='sleeps-awake-num'>
                            <h2>醒来次数</h2>
                            <p class='fa fa-eye fa-2x'>$awakenings</p>
                        </div>
                        <div class='pull-right animated bounceInRight' id='sleeps-awake-time'>
                            <h2>清醒时间</h2>
                            <p class='fa fa-clock-o fa-2x'>$awake min</p>
                        </div>
                        <div class='pull-left animated bounceInLeft' id='sleeps-light'>
                            <h2>轻度睡眠</h2>
                            <p class='fa fa-eye-slash fa-2x'>$light h</p>
                        </div>
                        <div class='pull-right animated bounceInRight' id='sleeps-deep'>
                            <h2>深度睡眠</h2>
                            <p class='fa fa-eye-slash fa-2x'>$deep h</p>
                        </div>
                        <div class='pull-left animated bounceInUp' id='sleeps-total-time'>
                            <h2>总睡眠</h2>
                            <p class='fa fa-clock-o fa-2x'>$duration h</p>
                        </div>
                    </div>
                </div>
            </div>
        ";
        update_sleeps($asleep_time,$awakenings,$awake,$light,$deep,$duration);
    }
}
$date = $_COOKIE["date"];
$output = get_sleeps($date);
read_sleeps($output);
//        <p>创建时间：$time_created</p>
//        <p>完成时间：$time_completed</p>
//        <p>更新时间：$time_updated</p>
//        <p>标题：$title</p>
//        <p>日期：$date</p>
//        <p>睡眠类型：$sub_type</p>
//        <h3>Details</h3>
//        <img src='http://jawbone.com/$snapshot_image'/>
//        <p>时区：$tz</p>
//        <p>醒来次数：$awakenings</p>
//        <p>醒来时间：$awake</p>
//        <p>轻度睡眠：$light</p>
//        <p>入睡时间：$asleep_time</p>
//        <p>睡眠总时间：$duration</p>
//        <p>smart_alarm_fire：$smart_alarm_fire</p>
//        <p>质量：$quality</p>
//        <p>Sunrise：$sunrise</p>
//        <p>Sunset：$sunset</p>