<?php
/**
 * Created by PhpStorm.
 * User: Pal
 * Date: 2015/10/6
 * Time: 18:17
 */


global $mysql_host,$mysql_user,$mysql_pass,$mysql_db;

$mysql_host = "jp.pal6exe.cn";
$mysql_user = "admin";
$mysql_pass = "admin";
$mysql_db = "tvker";

/*
$mysql_host = "localhost";
$mysql_user = "root";
$mysql_pass = "";
$mysql_db = "tvker";

*/
/**
 * @return mysqli
 */
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


function hashpassword($password) {

    $query = "SELECT passwordsalt.key FROM passwordsalt";
    $result = mysql_query($query);

    if(!$result) {
        return false;
    }

    else {

        $row = mysql_fetch_row($result);
        $key=$row[0];
    }

    return crypt($password,$key);

}


/**
 * @return int
 */
//用于返回最后一个ID号


function adduser($username,$password,$email,$studentid) {


    $query = "SELECT status.value FROM status WHERE status.key = 'usernumber'";
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);

    $userid = $row[0]+1;

    $password = hashpassword($password);

    $query = "INSERT INTO user(userid, username, userpassword, email, studentid) VALUE($userid, '$username', '$password','$email',$studentid)";

    if($result = mysql_query($query)) {

        $query =  "UPDATE status SET status.value = status.value+1 WHERE status.key = 'usernumber'";

        mysql_query($query);
        return true;

    }
    else
         die("Error in query: $query. ".mysql_error());

}

/**
 * @return array|bool
 */





function getuser($userid) {


    $query = "SELECT * FROM user WHERE userid = '$userid'";
    $result = mysql_query($query);



    if(!$result) {
        return false;
    }
    else {

        $row = mysql_fetch_array($result);

       /* foreach($row as $key=>$value)
            echo $key."=>".$value;
*/
        $user=array(
            'userid' => $row['userid'],
            'username' => $row['username'],
            'email' => $row['email'],
            'studentid' => $row[ 'studentid']
        );
        return $user;

    }
}

function login($username,$password)

{
    $query = "SELECT * FROM user WHERE user.username = '$username'";
    $result = mysql_query($query);



    if(!$result) {
        return false;
    }
    else {

        $row = mysql_fetch_row($result);

        //echo $row[2];

        if($row[2] == hashpassword($password))
        {
            return true;
        }
        else {
            return false;
        }

    }



    }







/*
function dbclose() {
    $conn=mysql_connect($BASIC['mysql_host'], $BASIC['mysql_user'], $BASIC['mysql_pass']);

    if (!$conn) {
        die('连接数据库失败: ' . mysql_error());
    }

}
*/
