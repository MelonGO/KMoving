<?php

function NumToDate($num){
    return date("Y-m-d H:i:s", $num);
}
function DateToNum($date){
    return strtotime($date);
}

function get_workouts($date) {
    $start_time = strtotime($date);
    $date_clear = date("Ymd",$start_time);
    $end_time = strtotime($date) + 86400;
    $updated_after = 0;
    $limit = 0;
    $page_token = 0;
//    $access_token = $_COOKIE["access_token"];
//    $url ="https://jawbone.com/nudge/api/v.1.1/users/@me/workouts?date=$date_clear&start_time=$start_time&end_time=$end_time";
    $date = $_COOKIE['date'];
    $userName = $_COOKIE['username'];
    $url = "http://www.kmoving.com/data/".$userName."/workouts/".$date.".json";

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

function update_workouts($title,$steps,$km,$calories,$time){
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {}

    $userName = $_COOKIE['username'];
    $date = $_COOKIE['date'];
    $sql =<<<EOF
    SELECT * FROM User,Workouts WHERE User.name='$userName' and User.id=Workouts.userId and Workouts.createAt='$date';
EOF;

    $ret = $db->query($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    } else {
        if($row = $ret->fetchArray(SQLITE3_ASSOC)){
            $userId = $row['userId'];
            $sql =<<<EOF
            UPDATE Workouts SET title='$title',steps='$steps',
            distance='$km',calories='$calories',time='$time'
            where userId=$userId and createAt=$date;
EOF;
            $ret = $db->exec($sql);
            if(!$ret){
                echo $db->lastErrorMsg();
            } else {}
        }else{
            $userId = get_userId($userName);
            $sql =<<<EOF
            INSERT INTO Workouts (userId, title, steps, distance, calories, time, createAt)
            VALUES ('$userId', '$title', '$steps', '$km', '$calories', '$time', '$date');
EOF;
            $ret = $db->exec($sql);
            if(!$ret){
                echo $db->lastErrorMsg();
            } else {}
        }
    }
    $db->close();
}

function read_workouts($output){
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
        $route = $item->route;
        $image = $item->image;

        $details = $item->details;                    //array
        $date = $item->date;
        $shared = $item->shared;
        $snapshot_image = $item->snapshot_image;
        $sub_type = $item->sub_type;
        $place_acc = $item->place_acc;
        $place_name = $item->place_name;

        $tz = $details->tz;
        $goal = $details->goal;
        $calories = $details->calories;
        $place_acc = $details->place_acc;
        $bmr = $details->bmr;
        $intensity = $details->intensity;
        $bg_calories = $details->bg_calories;
        $meters = $details->meters;
        $km = $details->km;
        $time = $details->time;
        $bg_active_time = $details->bg_active_time;
        $steps = $details->steps;
        $bmr_calories = $details->bmr_calories;

        echo
        "
        <div class='row workouts-detail'>
            <div class='col-md-12'>
                <div class='pull-left' id='workouts-title'>
                    <div>
                        <h2>锻炼类型</h2>
                        <p class='fa fa-star-o fa-2x'>$title</p>
                    </div>
                    <div class='pull-left animated bounceInDown' id='workouts-steps'>
                        <h3>步数</h3>
                        <p class='fa fa-paper-plane-o fa-2x'>$steps</p>
                    </div>
                    <div class='pull-right animated bounceInDown' id='workouts-distance'>
                        <h3>距离</h3>
                        <p class='fa fa-angle-double-right fa-2x'>$km km</p>
                    </div>
                    <div class='pull-left animated bounceInUp' id='workouts-calories'>
                        <h3>卡路里</h3>
                        <p class='fa fa-fire fa-2x'>$calories cal</p>
                    </div>
                    <div class='pull-right animated bounceInUp' id='workouts-time'>
                        <h3>耗时</h3>
                        <p class='fa fa-clock-o fa-2x'>$time sec</p>
                    </div>
                </div>
            </div>
        </div>
        ";
        update_workouts($title,$steps,$km,$calories,$time);
    }
}
$date = $_COOKIE["date"];
$output = get_workouts($date);
read_workouts($output);
//        <p>经度：$place_lat,纬度：$place_lon</p>
//        <p>创建时间：$time_created</p>
//        <p>完成时间：$time_completed</p>
//        <p>更新时间：$time_updated</p>
//        <p>标题：$title</p>
//        <p>日期：$date</p>
//        <p>运动类型：$sub_type</p>
//        <h3>Details</h3>
//        <img src='http://jawbone.com/$snapshot_image'/>
//        <p>时区：$tz</p>
//        <p>燃烧总热量：$calories</p>
//        <p>基础代谢率：$bmr</p>
//        <p>锻炼强度：$intensity</p>
//        <p>UP band记录热量：$bg_calories</p>
//        <p>运动米数：$meters</p>
//        <p>公里数：$km</p>
//        <p>时间：$time</p>
//        <p>UP band记录时间：$bg_active_time</p>
//        <p>步数：$steps</p>