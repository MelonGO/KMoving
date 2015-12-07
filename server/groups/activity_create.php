<?php

class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('/Users/melon/Sites/test.db');
    }
}

function get_authorId(){
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {
        echo "Opened database successfully</br>";
    }
    $userName = $_COOKIE["username"];
    $sql =<<<EOF
    SELECT * FROM User WHERE name = '$userName';
EOF;

    $ret = $db->query($sql);
    if($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        $authorId = $row['id'];
        $db->close();
        return $authorId;
    }else{
        $db->close();
        return null;
    }
}

function create_activity($title, $target, $content, $authorId){
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {
        echo "Opened database successfully</br>";
    }

    $sql =<<<EOF
            INSERT INTO Activity (title, target, content, authorId)
            VALUES ('$title', '$target', '$content', '$authorId');
EOF;

    $ret = $db->exec($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    } else {
        $db->close();
        header("Location: http://www.kmoving.com/user/groups/activity.php");
    }
    $db->close();
}

$title = $_POST["title"];
$target = $_POST["target"];
$content = $_POST["content"];
$authorId = get_authorId();
create_activity($title, $target, $content, $authorId);