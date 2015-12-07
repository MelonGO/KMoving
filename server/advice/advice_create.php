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
    SELECT * FROM User WHERE name = '$userName' and doctor='on';
EOF;

    $ret = $db->query($sql);
    if($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        $authorId = $row['id'];
        $db->close();
        return $authorId;
    }
    $db->close();
}

function advice_create($title,$content,$toUserId,$authorId){
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {
        echo "Opened database successfully</br>";
    }

    $sql =<<<EOF
            INSERT INTO Advice (title, content, toUserId, authorId)
            VALUES ('$title', '$content', '$toUserId', '$authorId');
EOF;

    $ret = $db->exec($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    } else {
        $db->close();
        header("Location: http://www.kmoving.com/user/advice_create.php?msg=success");
    }
    $db->close();
}


$title = $_POST["title"];
$content = $_POST["content"];
$toUserId = $_POST["toUserId"];
$authorId = get_authorId();
if($authorId!=null){
    advice_create($title,$content,$toUserId,$authorId);
}else{
    header("Location: http://www.kmoving.com/user/advice_create.php?msg=NotDoc");
}

