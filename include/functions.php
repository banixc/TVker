<?php
/**
 * Created by PhpStorm.
 * User: Pal
 * Date: 2015/10/6
 * Time: 18:17
 */

function dbconn() {
    $conn=mysql_connect($BASIC['mysql_host'], $BASIC['mysql_user'], $BASIC['mysql_pass']);

    if (!$conn) {
        die('连接数据库失败: ' . mysql_error());
    }

}



function dbclose() {
    $conn=mysql_connect($BASIC['mysql_host'], $BASIC['mysql_user'], $BASIC['mysql_pass']);

    if (!$conn) {
        die('连接数据库失败: ' . mysql_error());
    }

}