<?php include_once 'linkstart.php';
show_head_no_login('注册信息');

echo '<!-- 导航条 -->';

get_bar();

echo '<!-- 导航条结束 -->
<!-- 主体部分 -->';
?>

<div class="container">

<?php
global $username, $password, $email, $studentid;

if (@$_POST['username'] and @$_POST['password'] and @$_POST['email'] and @$_POST['studentid']) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$studentid = $_POST['studentid'];

	if (get_user_by_name($username)) {
		echo '注册失败！用户名已存在！';
	} else if (!add_user($username, $password, $email, $studentid)) {
		echo '注册失败！未知原因！';
	} else {
		echo $username . " 欢迎您的加入！";
	}

} else {
	no_access('register.php');
}

get_foot();
?>
