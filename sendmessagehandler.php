<?php

include_once("linkstart.php");

if (!is_login()) {
    header("location: login.php?action=err&mes=你需要登录才能查看用户信息！");exit;
}

if(!@$_POST['content'])
{
    header("location: messagelist.php?action=err&mes=发送失败！没有任何内容！");exit;
}

if($messageid = add_message($_SESSION['userid'],$_POST['content']))
{
    header("location: messagedetails.php?messageid=".$messageid);exit;
}
else
{
    header("location: messagedetails.php?action=err");exit;
}


?>




