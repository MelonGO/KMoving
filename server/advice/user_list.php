<?php
$page = $_GET['page'];

class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('/Users/melon/Sites/test.db');
    }
}

function get_user_list($num){
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {
    }

    $sql =<<<EOF
    SELECT * FROM User ORDER BY id LIMIT $num,5;
EOF;

    $arrayList[] = array();
    $ret = $db->query($sql);
    $index = 0;
    while($row = $ret->fetchArray(SQLITE3_ASSOC)){
        $id = $row['id'];
        $name = $row['name'];
        $gender = $row['gender'];
        $height = $row['height'];
        $weight = $row['weight'];
        $birth = $row['birth'];
        $country = $row['country'];
        $city = $row['city'];
        $arrayList[$index] = [$id, $name, $gender, $height, $weight, $birth, $country, $city];
        $index++;
    }
    $db->close();
    return $arrayList;
}

function get_user_len(){
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {
    }

    $sql =<<<EOF
    SELECT count(*) AS length FROM User;
EOF;

    $ret = $db->query($sql);
    if($row = $ret->fetchArray(SQLITE3_ASSOC)){
        $db->close();
        return $row['length'];
    }
    $db->close();
    return null;
}

function show_user_list($data_list,$page=1){
    $len = count($data_list);

    echo "
        <table class=\"table table-striped user-list\">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>用户名</th>
                    <th>性别</th>
                </tr>
            </thead>
            <tbody>";
    for($index = 0;$index < $len;$index++){
        $id = $data_list[$index][0];
        $name = $data_list[$index][1];
        $gender = $data_list[$index][2];
        $height = $data_list[$index][3];
        $weight = $data_list[$index][4];
        $birth = $data_list[$index][5];
        $country = $data_list[$index][6];
        $city = $data_list[$index][7];
        echo "
            <tr>
                <td>
                    $id
                </td>
                <td>
                    $name
                    <button type='button' class='btn btn-info pull-right' title='用户资料'
                        data-container='body' data-toggle='popover' data-placement='left''
                        data-content='身高: $height 体重: $weight 生日: $birth 国家: $country 城市: $city'>资料</button>
                </td>
                <td>
                    $gender<button class='btn btn-toolbar fa fa-plus-circle center-block pull-right'
                                   data-toggle='modal' data-target='#advice' onclick='get_toUserId($id)'></button>
                </td>
            </tr> ";
    }
    echo "
            </tbody>
        </table>";

    $total_len = get_user_len();
    echo "
    <div class=\"row\">
        <nav style=\"text-align: center\">
            <ul class=\"pagination\">";
    for($index = 1;$index < $total_len/5 + 1;$index++){
        echo "
            <li><a href=\"?page=$index\">$index</a></li>";
    }
    echo "
            </ul>
        </nav>
    </div>";
}

if($page == null){
    $data_list = get_user_list(0);
    show_user_list($data_list);
}else{
    $num = ($page - 1) * 5;
    $data_list = get_user_list($num);
    show_user_list($data_list);
}