<?php

$item = $_GET["item"];
$info = $_GET["info"];

function moves_date_change($info){
    if($info=="previous"){
        $date_old = strtotime($_COOKIE["date"]);
        $date_new = date("Y-m-d",$date_old - 86400);
        setcookie("date",$date_new);
        echo $_COOKIE["date"];
        header("Location: http://www.kmoving.com/user/info/moves_show.php");
    }else{
        $date_old = strtotime($_COOKIE["date"]);
        $date_new = date("Y-m-d",$date_old + 86400);
        setcookie("date",$date_new);
        header("Location: http://www.kmoving.com/user/info/moves_show.php");
    }
}

function sleeps_date_change($info){
    if($info=="previous"){
        $date_old = strtotime($_COOKIE["date"]);
        $date_new = date("Y-m-d",$date_old - 86400);
        setcookie("date",$date_new);
        echo $_COOKIE["date"];
        header("Location: http://www.kmoving.com/user/info/sleeps_show.php");
    }else{
        $date_old = strtotime($_COOKIE["date"]);
        $date_new = date("Y-m-d",$date_old + 86400);
        setcookie("date",$date_new);
        header("Location: http://www.kmoving.com/user/info/sleeps_show.php");
    }
}

function workouts_date_change($info){
    if($info=="previous"){
        $date_old = strtotime($_COOKIE["date"]);
        $date_new = date("Y-m-d",$date_old - 86400);
        setcookie("date",$date_new);
        echo $_COOKIE["date"];
        header("Location: http://www.kmoving.com/user/info/workouts_show.php");
    }else{
        $date_old = strtotime($_COOKIE["date"]);
        $date_new = date("Y-m-d",$date_old + 86400);
        setcookie("date",$date_new);
        header("Location: http://www.kmoving.com/user/info/workouts_show.php");
    }
}

function meals_date_change($info){
    if($info=="previous"){
        $date_old = strtotime($_COOKIE["date"]);
        $date_new = date("Y-m-d",$date_old - 86400);
        setcookie("date",$date_new);
        echo $_COOKIE["date"];
        header("Location: http://www.kmoving.com/user/info/meals_show.php");
    }else{
        $date_old = strtotime($_COOKIE["date"]);
        $date_new = date("Y-m-d",$date_old + 86400);
        setcookie("date",$date_new);
        header("Location: http://www.kmoving.com/user/info/meals_show.php");
    }
}

function mood_date_change($info){
    if($info=="previous"){
        $date_old = strtotime($_COOKIE["date"]);
        $date_new = date("Y-m-d",$date_old - 86400);
        setcookie("date",$date_new);
        echo $_COOKIE["date"];
        header("Location: http://www.kmoving.com/user/info/mood_show.php");
    }else{
        $date_old = strtotime($_COOKIE["date"]);
        $date_new = date("Y-m-d",$date_old + 86400);
        setcookie("date",$date_new);
        header("Location: http://www.kmoving.com/user/info/mood_show.php");
    }
}

switch($item){
    case "moves":
        moves_date_change($info);
        break;
    case "sleeps":
        sleeps_date_change($info);
        break;
    case "workouts":
        workouts_date_change($info);
        break;
    case "mood":
        mood_date_change($info);
        break;
    case "meals":
        meals_date_change($info);
        break;
}