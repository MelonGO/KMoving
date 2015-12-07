<?php
$delete_ID =  $_GET['delete_id'];
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('/Users/melon/Sites/test.db');
    }
}

function is_Author($delete_ID){
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {
    }

    $userName = $_COOKIE["username"];
    $sql =<<<EOF
      SELECT * from Activity,User where User.id=Activity.authorId and User.name='$userName' and Activity.id=$delete_ID;
EOF;

    $ret = $db->query($sql);
    if($row = $ret->fetchArray(SQLITE3_ASSOC)){
        $db->close();
        return true;
    }else{
        $db->close();
        return false;
    }
}

function activity_delete($delete_ID){
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {
    }
    $sql =<<<EOF
      DELETE from Activity where id = $delete_ID;
EOF;
    $ret = $db->exec($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    }else{
        $sql =<<<EOF
        DELETE from ActivityMember where activityId = $delete_ID;
EOF;
        $ret = $db->exec($sql);
        if(!$ret){
            echo $db->lastErrorMsg();
        }else{
            $db->close();
            header("Location: http://www.kmoving.com/user/groups/activity.php");
        }
    }
}

if(is_Author($delete_ID)){
    activity_delete($delete_ID);
}else{
    header("Location: http://www.kmoving.com/user/groups/activity.php?msg=noAuthority");
}
