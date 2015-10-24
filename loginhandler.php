<?php
/**
 * Created by PhpStorm.
 * User: Pal
 * Date: 2015/10/24
 * Time: 9:42
 */

include_once('functions.php');

$username = $_POST['username'];
$password = $_POST['password'];


dbconn();


if(login($username,$password))
{
    echo "登录成功!" .$username. " 欢迎回来！";
}
else
{
    echo "登录失败，请检查您的用户名/密码。";
}