<?php
error_reporting(E_ALL);
date_default_timezone_set('Asia/ShangHai');
include '../../PHPExcel_1.8.0_doc/Classes/PHPExcel/IOFactory.php';

$inputfile = $_POST['inputfile'];
$addres = "/Users/melon/Desktop/".$inputfile;
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('/Users/melon/Sites/test.db');
    }
}
$address = "/Users/melon/Desktop/advice.xls";
function import_advice($address){

    $reader = PHPExcel_IOFactory::createReader('Excel5');
    $PHPExcel = $reader->load($address); // 载入excel文件
    $sheet = $PHPExcel->getSheet(0); // 读取第一個工作表
    $highestRow = $sheet->getHighestRow(); // 取得总行数
    $highestColumm = $sheet->getHighestColumn(); // 取得总列数

    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {}

    $title = "";
    $content = "";
    $toUserId = 0;
    $authorId= 0;
    for ($row = 1; $row <= $highestRow; $row++){//行数是以第1行开始
        for ($column = 'A'; $column <= $highestColumm; $column++) {//列数是以A列开始
            if($row!=1){
                switch($column){
                    case 'A':
                        $title = $sheet->getCell($column.$row)->getValue();
                        break;
                    case 'B':
                        $content = $sheet->getCell($column.$row)->getValue();
                        break;
                    case 'C':
                        $toUserId = $sheet->getCell($column.$row)->getValue();
                        break;
                    case 'D':
                        $authorId = $sheet->getCell($column.$row)->getValue();
                        break;
                }
            }
        }
        if($row!=1){
            $sql =<<<EOF
            INSERT INTO Advice (title, content, toUserId, authorId)
            VALUES ('$title', '$content', '$toUserId', '$authorId');
EOF;
            $ret = $db->exec($sql);
            if(!$ret){
                echo $db->lastErrorMsg();
            } else {}
        }
    }

    $db->close();
    header("Location: http://www.kmoving.com/user/advice.php");
}
import_advice($address);