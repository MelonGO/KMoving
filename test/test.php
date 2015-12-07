<?php
error_reporting(E_ALL);

date_default_timezone_set('Asia/ShangHai');

require_once '../PHPExcel_1.8.0_doc/Classes/PHPExcel/IOFactory.php';

if (!file_exists("/Users/melon/Desktop/advice1.xls")) {
    exit("not found advice.xls\n");
}

$reader = PHPExcel_IOFactory::createReader('Excel5'); //设置以Excel5格式(Excel97-2003工作簿)
$PHPExcel = $reader->load("../data/advice.xls"); // 载入excel文件
$sheet = $PHPExcel->getSheet(0); // 读取第一個工作表
$highestRow = $sheet->getHighestRow(); // 取得总行数
$highestColumm = $sheet->getHighestColumn(); // 取得总列数

/** 循环读取每个单元格的数据 */
for ($row = 1; $row <= $highestRow; $row++){//行数是以第1行开始
    for ($column = 'A'; $column <= $highestColumm; $column++) {//列数是以A列开始
        $dataset[] = $sheet->getCell($column.$row)->getValue();
        echo $column.$row.":".$sheet->getCell($column.$row)->getValue()."<br />";
    }
}