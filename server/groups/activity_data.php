<?php

$page = $_GET['page'];

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

function get_userName($db, $userId){
    $sql =<<<EOF
    SELECT * FROM User WHERE id = $userId;
EOF;

    $ret = $db->query($sql);
    if($row = $ret->fetchArray(SQLITE3_ASSOC)){
        $userName = $row['name'];
        return $userName;
    }
    return null;
}

function get_members($db,$activityId){
    $members = "";
    $sql =<<<EOF
    SELECT * FROM ActivityMember WHERE activityId=$activityId;
EOF;

    $ret = $db->query($sql);
    while($row = $ret->fetchArray(SQLITE3_ASSOC)){
        $userId = $row['userId'];
        $tmp = get_userName($db, $userId);
        $members = $members."<p class='fa fa-user'>".$tmp."</p> ";
    }
    return $members;
}

function get_activity_data($num){
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {
    }

    $sql =<<<EOF
    SELECT * FROM Activity ORDER BY id LIMIT $num,3;
EOF;

    $arrayList[] = array();
    $ret = $db->query($sql);
    $index = 0;
    while($row = $ret->fetchArray(SQLITE3_ASSOC)){
        $authorId = $row['authorId'];
        $authorName = get_authorName($db, $authorId);
        $title = $row['title'];
        $target= $row['target'];
        $content= $row['content'];
        $id= $row['id'];
        $menbers = get_members($db,$id);
        $arrayList[$index] = [$title, $target, $content, $authorName, $id, $menbers];
        $index++;
    }
    $db->close();
    return $arrayList;
}

function get_total_len(){
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {
    }

    $sql =<<<EOF
    SELECT count(*) AS length FROM Activity;
EOF;

    $ret = $db->query($sql);
    if($row = $ret->fetchArray(SQLITE3_ASSOC)){
        $db->close();
        return $row['length'];
    }
    $db->close();
    return null;
}

function show_activity_data($data_list,$page=1){
    $len = count($data_list);

    for($index = 0;$index < $len;$index++){
        $title = $data_list[$index][0];
        $target = $data_list[$index][1];
        $content = $data_list[$index][2];
        $authorName = $data_list[$index][3];
        $activityId = $data_list[$index][4];
        $members = $data_list[$index][5];
        echo "<div class=\"row center-block\">
                <div class=\"list-group\">
                    <div class=\"list-group-item active\">
                        <h4 class=\"list-group-item-heading\">
                            标题: $title (ID: $activityId)
                            <button id='$activityId' onclick='click_delete($activityId)' class=\"btn btn-default btn-sm fa fa-trash pull-right\"></button>
                        </h4>
                    </div>
                    <div class=\"list-group-item\">
                        <p class=\"list-group-item-text\">
                            目标: $target
                        </p>
                        <div class=\"target\"></div>
                    </div>
                    <div class=\"list-group-item\">
                        <p class=\"list-group-item-text\">
                            活动说明: $content
                        </p>
                        <div class=\"content\"></div>
                    </div>
                    <div class=\"list-group-item\">
                        <p class=\"list-group-item-text\">
                            创建者: $authorName
                        </p>
                        <div class=\"authorName\"></div>
                    </div>
                    <div class=\"list-group-item\">
                        <p class=\"list-group-item-text\">
                            成员: $members
                            <button class=\"btn btn-default btn-sm fa fa-user-plus fa-2x pull-right\"
                                      onclick='get_activityId($activityId)' data-toggle=\"modal\" data-target=\"#add-member\"></button>
                        </p>
                    </div>
                    <HR>
                </div>
            </div>";
    }

    $total_len = get_total_len();
    echo "
    <div class=\"row\">
        <nav style=\"text-align: center\">
            <ul class=\"pagination\">";
    for($index = 1;$index < $total_len/3 + 1;$index++){
        echo "
            <li><a href=\"?page=$index\">$index</a></li>";
    }
    echo "
            </ul>
        </nav>
    </div>";
}

if($page == null){
    $data_list = get_activity_data(0);
    show_activity_data($data_list);
}else{
    $num = ($page - 1) * 3;
    $data_list = get_activity_data($num);
    show_activity_data($data_list,$page);
}



