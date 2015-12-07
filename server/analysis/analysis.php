<?php
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('/Users/melon/Sites/test.db');
    }
}

function get_userId($db){
    $userName = $_COOKIE["username"];
    $sql =<<<EOF
    SELECT * FROM User WHERE name = '$userName';
EOF;

    $ret = $db->query($sql);
    if($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        $userId = $row['id'];
        return $userId;
    }
}

function analysis(){

    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {}

    $userId = get_userId($db);
    //moves
    $sql =<<<EOF
    SELECT sum(steps),count(createAt) FROM Moves WHERE userId=$userId;
EOF;
    $ret = $db->query($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    } else {
        if($row = $ret->fetchArray(SQLITE3_ASSOC)){
            $total_steps = $row['sum(steps)'];
            $times = $row['count(createAt)'];
            $avg_steps = number_format($total_steps/$times, 2, '.', '');
        }
    }
    //sleeps
    $sql =<<<EOF
    SELECT sum(total),count(createAt) FROM Sleeps WHERE userId=$userId;
EOF;
    $ret = $db->query($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    } else {
        if($row = $ret->fetchArray(SQLITE3_ASSOC)){
            $total_sleeps = $row['sum(total)'];
            $times = $row['count(createAt)'];
            $avg_sleep = number_format($total_sleeps/$times, 2, '.', '');
        }
    }
    //workouts
    $sql =<<<EOF
    SELECT sum(distance),count(createAt) FROM Workouts WHERE userId=$userId;
EOF;
    $ret = $db->query($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    } else {
        if($row = $ret->fetchArray(SQLITE3_ASSOC)){
            $total_run = $row['sum(distance)'];
            $times = $row['count(createAt)'];
            $avg_run = number_format($total_run/$times, 2, '.', '');
        }
    }
    //meals
    $total_fat =0;
    $total_protein = 0;
    $total_calcium = 0;
    $total_carbohydrate = 0;
    $total_sugar = 0;
    $total_cholesterol =0;
    $total_vitamin_c = 0;
    $total_vitamin_a = 0;
    $sql =<<<EOF
    SELECT sum(fat),sum(protein),
    sum(calcium),sum(carbohydrate),
    sum(sugar),sum(cholesterol),
    sum(vitamin_c),sum(vitamin_a) FROM Meals WHERE userId=$userId;
EOF;
    $ret = $db->query($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    } else {
        if($row = $ret->fetchArray(SQLITE3_ASSOC)){
            $total_fat = $row['sum(fat)'];
            $total_protein = $row['sum(protein)'];
            $total_calcium = $row['sum(calcium)'];
            $total_carbohydrate = $row['sum(carbohydrate)'];
            $total_sugar = $row['sum(sugar)'];
            $total_cholesterol = $row['sum(cholesterol)'];
            $total_vitamin_c = $row['sum(vitamin_c)'];
            $total_vitamin_a = $row['sum(vitamin_a)'];
        }
    }
    //mood
    $amazing = 0;
    $very_good = 0;
    $good = 0;
    $usual = 0;
    $bad = 0;
    $very_bad = 0;
    $fuck_dog = 0;
    $sql =<<<EOF
    SELECT mood FROM Mood WHERE userId=$userId;
EOF;
    $ret = $db->query($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    } else {
        while($row = $ret->fetchArray(SQLITE3_ASSOC)){
            $mood_type = $row['mood'];
            if($mood_type == "../../img/Amazing.png"){
                $mood_type = 1;
            }else if($mood_type == "../../img/Pumped_UP.png"){
                $mood_type = 2;
            }else if($mood_type == "../../img/Energized.png"){
                $mood_type = 3;
            }else if($mood_type == "../../img/Meh.png"){
                $mood_type = 4;
            }else if($mood_type == "../../img/Dragging.png"){
                $mood_type = 5;
            }else if($mood_type == "../../img/Exhausted.png"){
                $mood_type = 6;
            }else if($mood_type == "../../img/Totally_Done.png"){
                $mood_type = 7;
            }
            switch($mood_type){
                case 1:$amazing++;break;
                case 2:$very_good++;break;
                case 3:$good++;break;
                case 4:$usual++;break;
                case 5:$bad++;break;
                case 6:$very_bad++;break;
                case 7:$fuck_dog++;break;
            }
        }
    }

    echo
    "
        <div class='col-md-12'>
            <div id='analysis-moves'>
                <div style='margin-left: 10%'>
                    <h3>你总共走了 <strong style='color: white'>$total_steps</strong> 步，平均每天走了 <strong style='color: white'>$avg_steps</strong> 步</h3>
                </div>
            </div>
            <div id='analysis-sleeps'>
                <div style='margin-left: 10%'>
                    <h3>你总共睡了 <strong style='color: white'>$total_sleeps</strong> 小时，平均每天睡了 <strong style='color: white'>$avg_sleep</strong> 小时</h3>
                </div>
            </div>
            <div id='analysis-workouts'>
                <div style='margin-left: 10%'>
                    <h3>你总共跑了 <strong style='color: white'>$total_run</strong> 公里，平均每天跑了 <strong style='color: white'>$avg_run </strong> 公里</h3>
                </div>
            </div>
            <div id='analysis-meals'>
                <div style='margin-left: 10%'>
                    <h4>共摄入 <strong style='color: white'>$total_fat</strong> 克脂肪</h4>
                    <h4>共摄入 <strong style='color: white'>$total_protein</strong> 毫克蛋白质</h4>
                    <h4>共摄入 <strong style='color: white'>$total_calcium</strong> 毫克钙</h4>
                    <h4>共摄入 <strong style='color: white'>$total_carbohydrate</strong> 毫克碳水化合物</h4>
                    <h4>共摄入 <strong style='color: white'>$total_sugar</strong> 毫克糖</h4>
                    <h4>共摄入 <strong style='color: white'>$total_cholesterol</strong> 毫克胆固醇</h4>
                    <h4>共摄入 <strong style='color: white'>$total_vitamin_c</strong> 毫克维他命C</h4>
                    <h4>共摄入 <strong style='color: white'>$total_vitamin_a</strong> 毫克维他命A</h4>

                </div>
            </div>
            <div id='analysis-mood'>
                <div style='margin-left: 10%'>
                    <h3>心情状况为</h3>
                    <h4>“Amazing好” <strong style='color: white'>$amazing</strong> 次</h4>
                    <h4>“非常好” <strong style='color: white'>$very_good</strong> 次</h4>
                    <h4>“好” <strong style='color: white'>$good</strong> 次</h4>
                    <h4>“一般” <strong style='color: white'>$usual</strong> 次</h4>
                    <h4>“坏” <strong style='color: white'>$bad</strong> 次</h4>
                    <h4>“非常坏” <strong style='color: white'>$very_bad</strong> 次</h4>
                    <h4>“槽糕透了” <strong style='color: white'>$fuck_dog</strong> 次</h4>
                </div>
            </div>
        </div>
    ";

}

analysis();