<?php
/**
 * Created by PhpStorm.
 * User: Pal
 * Date: 2015/10/16
 * Time: 5:16
 */

include_once('functions.php');

$userid=$_GET['id'];

dbconn();
$user=getuser($userid);
if(!$user)
    echo "查无此人！";
else{
    //$user=getuser('$userid');
echo "用户ID：".$user['userid']."<br />";
echo "用户名：".$user['username']."<br />";
echo "用户学号：".$user["studentid"]."<br />";
echo "用户邮箱：".$user["email"]."<br />";
}