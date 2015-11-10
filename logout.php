<?php session_start();
include_once('functions.php');
if(!is_login())
{
  echo '毫无权限 请登录';
}
else
{
header("Content-Type: text/html; charset=UTF-8");
logout();
echo '恭喜您 登出成功';
}
?>
