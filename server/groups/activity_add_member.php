<?php
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('/Users/melon/Sites/test.db');
    }
}

function get_userId(){
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {}
    $userName = $_COOKIE["username"];
    $sql =<<<EOF
    SELECT * FROM User WHERE name = '$userName';
EOF;

    $ret = $db->query($sql);
    if($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        $userId = $row['id'];
        $db->close();
        return $userId;
    }
    $db->close();
}

function add_member($activityId){
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {}

    $userId = get_userId();
    $sql =<<<EOF
    SELECT * FROM ActivityMember WHERE userId=$userId and activityId=$activityId;
EOF;

    $ret = $db->query($sql);
    if($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        $db->close();
        header("Location: http://www.kmoving.com/user/groups/activity.php?msg=memberExist");
    }else{
        $data = $_COOKIE['date'];
        $sql =<<<EOF
            INSERT INTO ActivityMember (userId, activityId, createAt)
            VALUES ('$userId', '$activityId', '$data');
EOF;

        $ret = $db->exec($sql);
        if(!$ret){
            echo $db->lastErrorMsg();
        } else {
            $db->close();
            header("Location: http://www.kmoving.com/user/groups/activity.php");
        }
    }
}

$activityId = $_POST['activityId'];
add_member($activityId);