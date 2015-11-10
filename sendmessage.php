<?php

include_once("functions.php");

db_conn();

if(!is_login())
{
	no_access('sendmessage','登录');
}

if(!@$_POST['content'])
{
	no_access('sendmessage','勿输入空白状态');

}

if($messageid = add_message($_SESSION['userid'],$_POST['content']))
{
	echo '恭喜您！发送成功！';
	$message = get_message($messageid);
	foreach($message as $key=>$value)
	echo $key."=>".$value."<br />";

}


/*  foreach($a as $key=>$value)
      echo $key."=>".$value."<br />";
*/



?>




