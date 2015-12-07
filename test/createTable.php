<?php

class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('/Users/melon/Sites/test.db');
    }
}
$db = new MyDB();
if(!$db){
    echo $db->lastErrorMsg();
} else {
    echo "Opened database successfully</br>";
}

$sql =<<<EOF
      CREATE TABLE Meals
      (userId        INTEGER,
      title          varchar(255),
      calories       REAL,
      fat            REAL,
      protein        REAL,
      calcium        REAL,
      carbohydrate   REAL,
      sugar          REAL,
      cholesterol    REAL,
      vitamin_c      REAL,
      vitamin_a      REAL,
      createAt       DATETIME);
EOF;

$ret = $db->exec($sql);
if(!$ret){
    echo $db->lastErrorMsg();
} else {
    echo "Table created successfully\n";
}
$db->close();