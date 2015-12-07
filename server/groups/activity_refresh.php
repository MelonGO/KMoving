<?php
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('/Users/melon/Sites/test.db');
    }
}

function is_Author($refresh_ID){
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {
    }

    $userName = $_COOKIE["username"];
    $sql =<<<EOF
      SELECT * from Activity,User where User.id=Activity.authorId and User.name='$userName' and Activity.id=$refresh_ID;
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

function activity_refresh($id,$title,$target,$content){
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {
    }
    $sql =<<<EOF
      UPDATE Activity SET title='$title',target='$target',content='$content' where id=$id;
EOF;

    $ret = $db->exec($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    }
    $db->close();
}

$id = $_POST["id-refresh"];
$title = $_POST["title-refresh"];
$target = $_POST["target-refresh"];
$content = $_POST["content-refresh"];
if(is_Author($id)){
    activity_refresh($id,$title,$target,$content);
    header("Location: http://www.kmoving.com/user/groups/activity.php?msg=refreshSuccess");
}else{
    header("Location: http://www.kmoving.com/user/groups/activity.php?msg=noAuthority");
}