<?php
/**
 * Created by PhpStorm.
 * User: Pal
 * Date: 2015/10/5
 * Time: 23:42
 */

include_once ('config/allconfig.php');
include_once ('function.php');

$conn=mysql_connect($BASIC['mysql_host'], $BASIC['mysql_user'], $BASIC['mysql_pass']);

if (!$conn) {
    die('连接数据库失败: ' . mysql_error());
}
echo "mysql 连接成功！";



mysql_close($conn);
?>