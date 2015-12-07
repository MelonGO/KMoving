<?php

function NumToDate($num){
    return date("Y-m-d H:i:s", $num);
}
function DateToNum($date){
    return strtotime($date);
}

function get_meals($date) {
    $start_time = strtotime($date);
    $date_clear = date("Ymd",$start_time);
    $end_time = strtotime($date) + 86400;
    $updated_after = 0;
    $page_token = 0;
//    $access_token = $_COOKIE["access_token"];
//    $url ="https://jawbone.com/nudge/api/v.1.1/users/@me/meals?date=$date_clear&start_time=$start_time&end_time=$end_time";
    $date = $_COOKIE['date'];
    $userName = $_COOKIE['username'];
    $url = "http://www.kmoving.com/data/".$userName."/meals/".$date.".json";
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

function update_meals($title,$calories,$fat,$protein,$calcium,
                      $carbohydrate,$sugar,$cholesterol,$vitamin_c,$vitamin_a){
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {}

    $userName = $_COOKIE['username'];
    $date = $_COOKIE['date'];
    $sql =<<<EOF
    SELECT * FROM User,Meals WHERE User.name='$userName' and User.id=Meals.userId and Meals.createAt='$date';
EOF;

    $ret = $db->query($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    } else {
        if($row = $ret->fetchArray(SQLITE3_ASSOC)){
            $userId = $row['userId'];
            $sql =<<<EOF
            UPDATE Meals
            SET title='$title',calories='$calories',fat='$fat',
            protein='$protein',calcium='$calcium',carbohydrate='$carbohydrate',
            vitamin_c='$vitamin_c',vitamin_a='$vitamin_a'
            where userId=$userId and createAt=$date;
EOF;
            $ret = $db->exec($sql);
            if(!$ret){
                echo $db->lastErrorMsg();
            } else {}
        }else{
            $userId = get_userId($userName);
            $sql =<<<EOF
            INSERT INTO Meals (userId, title, calories, fat, protein, calcium, carbohydrate, sugar, cholesterol, vitamin_c, vitamin_a, createAt)
            VALUES ('$userId', '$title', '$calories', '$fat', '$protein', '$calcium', '$carbohydrate', '$sugar', '$cholesterol', '$vitamin_c', '$vitamin_a', '$date');
EOF;
            $ret = $db->exec($sql);
            if(!$ret){
                echo $db->lastErrorMsg();
            } else {}
        }
    }
    $db->close();
}

function read_meals($output){
    $obj = json_decode($output);
    $meta = $obj->meta;
    $user_xid = $obj->user_xid;

    $data = $obj->data;
    $items = $data->items;
    $size = $data->size;

    for($index=0;$index<$size;$index++){
        $item = $items[$index];

//        $place_lat = $item->place_lat;
//        $place_lon = $item->place_lon;
        $time_created = $item->time_created;
        $time_created = NumToDate($time_created);
        $time_completed = $item->time_completed;
        $time_completed = NumToDate($time_completed);
        $time_updated = $item->time_updated;
        $time_updated = NumToDate($time_updated);
//        $xid = $item->xid;
        $title = $item->title;
//        $note = $item->note;
        $details = $item->details;                    //array
//        $shared = $item->shared;
        $date = $item->date;
        $sub_type = $item->sub_type;
//        $place_id = $item->place_id;
//        $place_acc = $item->place_acc;
//        $place_name = $item->place_name;

        $fiber = $details->fiber;
        $polyunsaturated_fat = $details->polyunsaturated_fat;
        $calories = $details->calories;
        $potassium = $details->potassium;
//        $num_mealitems_yellow = $details->num_mealitems_yellow;
        $calcium = $details->calcium;
//        $only_waters = $details->only_waters;
//        $client_trace = $details->client_trace;
        $carbohydrate = $details->carbohydrate;
//        $trans_fat = $details->trans_fat;
//        $num_mealitems_green = $details->num_mealitems_green;
        $saturated_fat = $details->saturated_fat;
        $protein = $details->protein;
        $num_foods = $details->num_foods;
        $monounsaturated_fat = $details->monounsaturated_fat;
        $tz = $details->tz;
        $sodium = $details->sodium;
        $vitamin_c = $details->vitamin_c;
        $vitamin_a = $details->vitamin_a;
        $fat = $details->fat;
        $unsaturated_fat = $details->unsaturated_fat;
//        $place_type = $details->place_type;
        $sugar = $details->sugar;
        $num_drinks = $details->num_drinks;
        $num_water = $details->num_water;
        $iron = $details->iron;
//        $num_mealitems_red = $details->num_mealitems_red;
        $food_score = $details->food_score;
//        $num_mealitems_with_score = $details->num_mealitems_with_score;
        $cholesterol = $details->cholesterol;
//        $accuracy = $details->accuracy;

        echo
        "
            <div class='row'>
                <div class='col-md-12'>
                    <div class='pull-left' id='meals-title'>
                        <div>
                            <h2>Today I eat</h2>
                            <p class='fa fa-spoon fa-2x' style='color: white'>$title</p>
                        </div>
                        <div class='pull-left animated bounceInDown' id='meals-calories'>
                            <h2>卡路里</h2>
                            <p class='fa fa-fire fa-2x' style='color: white'>$calories cal</p>
                        </div>
                        <div class='pull-right animated bounceInDown' id='meals-fat'>
                            <h2>脂肪</h2>
                            <p class='fa fa-cubes fa-2x' style='color: white'>$fat g</p>
                        </div>
                        <div>
                            <div class='pull-left animated bounceInDown' id='meals-protein'>
                                <h4>蛋白质</h4>
                                <p class='fa fa-cube animated bounceInLeft' style='color: white'>$protein mg</p>
                            </div>
                            <div class='pull-left animated bounceInLeft' id='meals-calcium'>
                                <h4>钙</h4>
                                <p class='fa fa-cube' style='color: white'>$calcium mg</p>
                            </div>
                            <div class='pull-right animated bounceInRight' id='meals-sugar'>
                                <h4>糖</h4>
                                <p class='fa fa-cube' style='color: white'>$sugar mg</p>
                            </div>
                            <div class='pull-right animated bounceInRight' id='meals-carbohydrate'>
                                <h4>碳水化合物</h4>
                                <p class='fa fa-cube' style='color: white'>$carbohydrate mg</p>
                            </div>
                        </div>
                        <div>
                            <div class='pull-left animated bounceInLeft' id='meals-cholesterol'>
                                <h4>胆固醇</h4>
                                <p class='fa fa-cube' style='color: white'>$cholesterol mg</p>
                            </div>
                            <div class='pull-left animated bounceInUp' id='meals-vitamin_c'>
                                <h4>维他命C</h4>
                                <p class='fa fa-cube' style='color: white'>$vitamin_c mg</p>
                            </div>
                            <div class='pull-right animated bounceInRight' id='meals-vitamin_a'>
                                <h4>维他命A</h4>
                                <p class='fa fa-cube' style='color: white'>$vitamin_a mg</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ";
        update_meals($title,$calories,$fat,$protein,$calcium,
            $carbohydrate,$sugar,$cholesterol,$vitamin_c,$vitamin_a);
    }
}
$date = $_COOKIE["date"];
$output = get_meals($date);
read_meals($output);

//        <p>经度：$place_lat,纬度：$place_lon</p>
//        <p>创建时间：$time_created</p>
//        <p>完成时间：$time_completed</p>
//        <p>更新时间：$time_updated</p>
//        <p>标题：$title</p>
//        <p>日期：$date</p>
//        <p>meal类型：$sub_type</p>
//        <h3>Details</h3>
//        <p>时区：$tz</p>
//        <p>总热量：$calories</p>
//        <p>纤维(克)：$fiber</p>
//        <p>钾(毫克)：$potassium</p>
//        <p>钙(毫克)：$calcium</p>
//        <p>钠(毫克)：$sodium</p>
//        <p>铁(毫克)：$iron</p>
//        <p>糖(克)：$sugar</p>
//        <p>碳水化合物(克)：$carbohydrate</p>
//        <p>饱和脂肪(克)：$saturated_fat</p>
//        <p>不饱和脂肪(克)：$unsaturated_fat</p>
//        <p>多不饱和脂肪(克)：$polyunsaturated_fat</p>
//        <p>单饱和脂肪(克)：$monounsaturated_fat</p>
//        <p>脂肪(克)：$fat</p>
//        <p>蛋白质(毫克)：$protein</p>
//        <p>胆固醇：$cholesterol</p>
//        <p>每日推荐的维他命C：$vitamin_c</p>
//        <p>每日推荐的维他命A：$vitamin_a</p>
//        <p>食物数量：$num_foods</p>
//        <p>饮料：$num_drinks</p>
//        <p>水：$num_water</p>
//        <p>分数：$food_score</p>