<?php

$last = $_POST['last'];
$amount = $_POST['amount'];

class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('/Users/melon/Sites/test.db');
    }
}

function get_authorName($db, $authorId){
    $sql =<<<EOF
    SELECT * FROM User WHERE id = $authorId;
EOF;

    $ret = $db->query($sql);
    if($row = $ret->fetchArray(SQLITE3_ASSOC)){
        $authorName = $row['name'];
        return $authorName;
    }
    return null;
}

function get_userId($db, $userName){
    $sql =<<<EOF
    SELECT * FROM User WHERE name = '$userName';
EOF;

    $ret = $db->query($sql);
    if($row = $ret->fetchArray(SQLITE3_ASSOC)){
        $userId = $row['id'];
        return $userId;
    }
    return null;
}

function show_activity($last,$amount){
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {
    }

    $userName = $_COOKIE['username'];
    $userId = get_userId($db,$userName);
    $sql =<<<EOF
    SELECT * FROM Advice WHERE toUserId=$userId ORDER BY id DESC LIMIT '$last','$amount';
EOF;

    $ret = $db->query($sql);
    while($row = $ret->fetchArray(SQLITE3_ASSOC)){
        $authorId = $row['authorId'];
        $authorName = get_authorName($db, $authorId);
        if($authorName!=null){
            $sayList[] = array(
                'title'=>"标题：".$row['title'],
                'content'=>"建议内容： ".$row['content'],
                'authorName'=>"提出者： ".$authorName
            );
        }

    }
    echo json_encode($sayList);
    $db->close();
}

show_activity($last,$amount);