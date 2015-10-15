<?php
/**
 * Created by PhpStorm.
 * User: Pal
 * Date: 2015/10/6
 * Time: 18:17
 */


global $mysql_host,$mysql_user,$mysql_pass,$mysql_db;

$mysql_host = "ali.pal6exe.cn";
$mysql_user = "admin";
$mysql_pass = "admin";
$mysql_db = "tvker";

global $mytext;
$mytext = "呵呵";

function dbconn() {
    $host=$GLOBALS['mysql_host'];
    $user=$GLOBALS['mysql_user'];
    $pass=$GLOBALS['mysql_pass'];
    $db=$GLOBALS['mysql_db'];

    $conn=mysql_connect($host, $user, $pass);

    if (!$conn) {
        die('连接数据库失败: ' . mysql_error());
    }

    mysql_select_db($db) or die("无法选择数据库!");

    return $conn;

}

/**
 * @return int
 */
//用于返回最后一个ID号
function getnextuserid()
{

    $query = "SELECT * FROM users ORDER BY userid DESC";

    $result = mysql_query($query);

    $rownum = mysql_num_rows($result);
    //echo $rownum;


  /*  for($i=0;$i<$rownum;$i++)
    {
        $row=mysql_fetch_assoc($result);
        echo "ID:".$row['userid']."<br />";
    }*/

    $row = mysql_fetch_assoc($result);


    return $row['userid'];


}

function adduser($username,$password,$email,$studentid) {

    $userid = getnextuserid()+1;

    $query = "INSERT INTO users(userid, username, userpassword, email, studentid) VALUE($userid, '$username', $password,'$email',$studentid)";

    if($result = mysql_query($query)) {
        return true;
    }
    else
         die("Error in query: $query. ".mysql_error());

}


/*
function dbclose() {
    $conn=mysql_connect($BASIC['mysql_host'], $BASIC['mysql_user'], $BASIC['mysql_pass']);

    if (!$conn) {
        die('连接数据库失败: ' . mysql_error());
    }

}
*/
