<?php
/**
 * Created by PhpStorm.
 * User: Pal
 * Date: 2015/10/6
 * Time: 18:17
 */


global $mysql_host,$mysql_user,$mysql_pass,$mysql_db;

$mysql_host = "localhost";
$mysql_user = "root";
$mysql_pass = "";
$mysql_db = "tvker";




function get_row_count($table, $suffix = "")
{
    $r = mysql_query("SELECT COUNT(*) FROM `$table` $suffix");
    $a = mysql_fetch_row($r) or die(mysql_error());
    return $a[0];
}

function get_row_sum($table, $field, $suffix = "")
{
    $r = mysql_query("SELECT SUM(`$field`) FROM `$table` $suffix");
    $a = mysql_fetch_row($r) or die(mysql_error());
    return $a[0];
}

function get_single_value($table, $field, $suffix = ""){
    $r = mysql_query("SELECT `$field` FROM `$table` $suffix LIMIT 1");
    $a = mysql_fetch_row($r) or die(mysql_error());
    if ($a) {
        return $a[0];
    } else {
        return false;
    }
}

function get_single_array($table, $field, $suffix = "")
{
    $r = mysql_query("SELECT * FROM $table $suffix");
    $a = mysql_fetch_array($r) or die(mysql_error());

    print_r($a);
    if ($a)
    {

        $i = 0;
    foreach($a as $key=>$value)
            {
                echo $key."=>".$value;

            }


    return $a;
    }
    else
    {
    return false;
    }
}

function getNowTime()
{
    $timezone_identifier = "PRC";  
    $time=date("Y-m-d h:i:s");
    return $time;
}



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

//加密密码
function hashpassword($password) {
    return crypt($password,get_single_value('status','string','WHERE `key` = "passwordsalt"'));
}

//增加一个用户
function adduser($username,$password,$email,$studentid) {

    $userid = get_single_value('status','int','WHERE `key` = "usernumber"')+1; //得到用户的数量并+1生成新用户的ID

    $password = hashpassword($password); //加密密码

    $query = "INSERT INTO user(userid, username, password, email, studentid) VALUE('$userid', '$username', '$password','$email','$studentid')";

    if($result = mysql_query($query)) {
        mysql_query("UPDATE status SET status.int = status.int+1 WHERE status.key = 'usernumber'");
        return true;
    }
    else
         die("Error in query: $query. ".mysql_error());

}



        /*foreach($row as $key=>$value)
            echo $key."=>".$value;*/

/*
function getuser($userid) {

    $result = mysql_query("SELECT * FROM user WHERE userid = '$userid'");

    if(!$result) {
        return false;
    }
    else {

        $row = mysql_fetch_array($result);


        $user=array(
            'userid' => $row['userid'],
            'username' => $row['username'],
            'email' => $row['email'],
            'studentid' => $row[ 'studentid']
        );

        return $user;
    }
}*/


function getuser($userid)
{
   // if (get_single_value('user','username','WHERE `userid` = "$userid"'))

    $row = get_single_array('user', '' ,'WHERE userid = "$userid"');

    foreach($row as $key=>$value)
            echo $key."=>".$value;

        return $row ;
       // else
        //    return false;
}

function login($username,$password)
{

    if(hashpassword($password) == get_single_value('user','password','WHERE user.username = "$username"'))
        return true;
    else
        return false;
}


function sendmessage($content)
{

}


function showTop()
{
    echo "<nav class=\"navbar navbar-inverse navbar-fixed-top\"><div class=\"container\"><div id=\"navbar\" class=\"navbar-collapse collapse\"><ul class=\"nav navbar-nav\"><li class=\"active\"><a href=\"#\">index</a></li><li><a href=\"#about\">About</a></li><li><a href=\"#contact\">Contact</a></li><li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Dropdown <span class=\"caret\"></span></a><ul class=\"dropdown-menu\"><li><a href=\"#\">Action</a></li><li><a href=\"#\">Another action</a></li><li><a href=\"#\">Something else here</a></li><li role=\"separator\" class=\"divider\"></li><li class=\"dropdown-header\">Nav header</li><li><a href=\"#\">Separated link</a></li></ul></li></ul></div></div></nav>"
;
}

function showHead()
{
    echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">
    <link rel=\"icon\" href=\"favicon.ico\">

    <title>Theme Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">
    <!-- Bootstrap theme -->
    <link href=\"css/bootstrap-theme.min.css\" rel=\"stylesheet\">

    <!-- Custom styles for this template -->
    <link href=\"theme.css\" rel=\"stylesheet\">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src=\"assets/js/ie8-responsive-file-warning.js\"></script><![endif]-->
    <script src=\"assets/js/ie-emulation-modes-warning.js\"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src=\"https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js\"></script>
    <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
    <![endif]-->
</head>";
}


/*
function dbclose() {
    $conn=mysql_connect($BASIC['mysql_host'], $BASIC['mysql_user'], $BASIC['mysql_pass']);

    if (!$conn) {
        die('连接数据库失败: ' . mysql_error());
    }

}
*/
