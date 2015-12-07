<?php

function NumToDate($num){
    return date("Y-m-d H:i:s", $num);
}
function DateToNum($date){
    return strtotime($date);
}

function get_moves($date) {
    $start_time = strtotime($date);
    $date_clear = date("Ymd",$start_time);
    $end_time = strtotime($date) + 86400;
    $updated_after = 0;
    $limit = 0;
    $page_token = 0;
//    $access_token = $_COOKIE["access_token"];
//    $url ="https://jawbone.com/nudge/api/v.1.1/users/@me/moves?date=$date_clear&start_time=$start_time&end_time=$end_time";
    $date = $_COOKIE['date'];
    $userName = $_COOKIE['username'];
    $url = "http://www.kmoving.com/data/".$userName."/moves/".$date.".json";
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

function update_moves($active_time,$inactive_time,$calories,$wo_calories,
                      $bg_calories,$bmr_day,$steps,$km){
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {}

    $userName = $_COOKIE['username'];
    $date = $_COOKIE['date'];
    $sql =<<<EOF
    SELECT * FROM User,Moves WHERE User.name='$userName' and User.id=Moves.userId and Moves.createAt='$date';
EOF;

    $ret = $db->query($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    } else {
        if($row = $ret->fetchArray(SQLITE3_ASSOC)){
            $userId = $row['userId'];
            $sql =<<<EOF
            UPDATE Moves
            SET active='$active_time',free='$inactive_time',
            total_calories='$calories',workouts_calories='$wo_calories',
            static_calories='$bg_calories',daixie='$bmr_day',steps='$steps',distance='$km'
            where userId=$userId and createAt=$date;
EOF;
            $ret = $db->exec($sql);
            if(!$ret){
                echo $db->lastErrorMsg();
            } else {}
        }else{
            $userId = get_userId($userName);
            $sql =<<<EOF
            INSERT INTO Moves (userId, active, free, total_calories, workouts_calories, static_calories, daixie, steps, distance, createAt)
            VALUES ('$userId', '$active_time', '$inactive_time', '$calories', '$wo_calories', '$bg_calories', '$bmr_day', '$steps', '$km' , '$date');
EOF;
            $ret = $db->exec($sql);
            if(!$ret){
                echo $db->lastErrorMsg();
            } else {}
        }
    }
    $db->close();
}

function read_moves($output){

    $obj = json_decode($output);
    $meta = $obj->meta;
    $user_xid = $obj->user_xid;

    $data = $obj->data;
    $items = $data->items;
    $size = $data->size;

    for($index=0;$index<$size;$index++){
        $item = $items[$index];
        $time_completed = $item->time_completed;
        $time_completed = NumToDate($time_completed);
        $xid = $item->xid;
        $title = $item->title;
        $type = $item->type;
        $time_created = $item->time_created;
        $time_created = NumToDate($time_created);
        $time_updated = $item->time_updated;
        $time_updated = NumToDate($time_updated);
        $details = $item->details;                    //array
        $date = $item->date;
        $snapshot_image = $item->snapshot_image;

        $active_time = $details->active_time;
        $inactive_time = $details->inactive_time;
        $wo_count = $details->wo_count;
        $wo_longest = $details->wo_longest;
        $bmr = $details->bmr;
        $bg_calories = $details->bg_calories;
        $hourly_totals= $details->hourly_totals;     //array
        $bmr_day = $details->bmr_day;
        $wo_active_time = $details->wo_active_time;
        $distance = $details->distance;
        $longest_active = $details->longest_active;
        $longest_idle = $details->longest_idle;
        $calories = $details->calories;
        $km = $details->km;
        $series_ids = $details->series_ids;
        $steps = $details->steps;
        $wo_calories = $details->wo_calories;
        $wo_time = $details->wo_time;
        $sunrise = $details->sunrise;
        $sunrise = NumToDate($sunrise);
        $sunset = $details->sunset;
        $sunset = NumToDate($sunset);

//        update_moves($active_time,$inactive_time,$calories,$wo_calories,
//            $bg_calories,$bmr_day,$steps,$km);

        echo "
        <div class='row moves-detail'>
                <div class='col-md-12'>
                    <div class='pull-left animated bounceInLeft' id='moves-active-time'>
                        <h2>活动时间</h2>
                        <p class='fa fa-clock-o fa-2x'>$active_time sec</p>
                    </div>
                    <div class='pull-right animated bounceInRight' id='moves-free-time'>
                        <h2>空闲时间</h2>
                        <p class='fa fa-clock-o fa-2x'>$inactive_time sec</p>
                    </div>
                    <div class='pull-left animated bounceInDown' id='moves-total-calories'>
                        <div>
                            <h2>总消耗热量</h2>
                            <p class='fa fa-fire fa-2x'>$calories cal</p>
                        </div>
                        <div class='pull-left animated bounceInLeft' id='moves-workouts-calories'>
                            <h4>锻炼消耗热量</h4>
                            <p class='fa fa-fire fa-1x'>$wo_calories cal</p>
                        </div>
                        <div class='pull-right animated bounceInRight' id='moves-static-calories'>
                            <h4>非锻炼消耗热量</h4>
                            <p class='fa fa-fire fa-1x'>$bg_calories cal</p>
                        </div>
                    </div>
                    <div class='pull-left animated bounceInUp' id='moves-metabolic-rate'>
                        <h2>代谢速率</h2>
                        <p class='fa fa-heartbeat fa-2x'>$bmr_day</p>
                    </div>
                    <div class='pull-left animated bounceInLeft' id='moves-steps'>
                        <h2>步数</h2>
                        <p class='fa fa-paper-plane-o fa-2x'>$steps</p>
                    </div>
                    <div class='pull-right animated bounceInRight' id='moves-km'>
                        <h2>距离</h2>
                        <p class='fa fa-angle-double-right fa-2x'>$km km</p>
                    </div>
                </div>
            </div>
        ";

        update_moves($active_time,$inactive_time,$calories,$wo_calories,
            $bg_calories,$bmr_day,$steps,$km);

    }
}
$date = $_COOKIE["date"];
$output = get_moves($date);
read_moves($output);
//        <p>活动时间：$active_time</p>
//        <p>空闲时间：$inactive_time</p>
//        <p>锻炼消耗热量：$wo_calories</p>
//        <p>非锻炼消耗热量：$bg_calories</p>
//        <p>基础代谢率：$bmr_day</p>
//        <p>总热量燃烧：$calories</p>
//        <p>运动公里数(km)：$km</p>
//        <p>步数：$steps</p>"
//        <p>标题：$title</p>
//        <p>日期：$date</p>
//        <p>创建时间：$time_created</p>
//        <p>完成时间：$time_completed</p>
//        <p>更新时间：$time_updated</p>
//        <p>锻炼次数：$wo_count</p>
//        <p>类型：$type</p>
//        <p>最长锻炼时间：$wo_longest</p>
//        <img src='http://jawbone.com/$snapshot_image'/>
//        <p>锻炼过程中的实际活动时间：$wo_active_time</p>
//        <p>连续最长的活跃时间：$longest_active</p>
//        <p>连续最长的不活跃时间：$longest_idle</p>
//        <p>锻炼总时间：$wo_time</p>
//        <p>燃烧热量：$bmr</p>
//        <p>运动距离：$distance</p>