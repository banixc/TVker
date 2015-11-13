<?php include_once 'linkstart.php';

global $username, $password, $email, $studentid;

if (@$_POST['username'] and @$_POST['password'] and @$_POST['confpassword'] and @$_POST['email'] and @$_POST['studentid']) {

	if(@$_POST['password'] != @$_POST['confpassword'])
	{
		header("location: register.php?action=err&mes=注册失败!两次密码输入不一致！");exit;

	}

	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$studentid = $_POST['studentid'];

	if (get_user_by_name($username)) {
		header("location: register.php?action=err&mes=注册失败！用户名已存在！");exit;
	} else if (!add_user($username, $password, $email, $studentid)) {
		header("location: register.php?action=err&mes=注册失败！请检查其他信息！");exit;

	} else {
		$_SESSION['userid'] = get_user_by_name($username)['userid'];
		header("location: userdetails.php?action=succ&mes=注册成功！欢迎加入".show_user_by_id($_SESSION['userid']));exit;
	}

} else {
	no_access('register.php');
}

