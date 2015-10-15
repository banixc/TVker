<?php
/**
 * Created by PhpStorm.
 * User: Pal
 * Date: 2015/10/6
 * Time: 18:15
 */
require_once("functions.php");


/*
function dbconn() {
    $conn=mysql_connect($BASIC['mysql_host'], $BASIC['mysql_user'], $BASIC['mysql_pass']);
    //$conn=mysql_connect('ali.pal6exe.cn',  'admin', 'admin');
    if (!$conn) {
        die('连接数据库失败: ' . mysql_error());
    }

    mysql_select_db('tvker') or die("无法选择数据库!");

    return $conn;

}*/

dbconn();

$query = "INSERT INTO users(userid, username, userpassword) VALUE('16', 'user1', 'user1')";

$result = mysql_query($query) or die("Error in query: $query. ".mysql_error());

echo "创建用户成功";

?>