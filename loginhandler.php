<?php

include_once 'linkstart.php';

show_head_no_login();
get_bar();
?>
<div class="container">

<?php

global $username;
global $password;

if (@$_POST['username'] and @$_POST['password']) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (!empty($username) and !empty($password)) {

		$user = get_user_by_name($username);
		if (!$user) {
			echo '登录失败 用户不存在！';
		} else if ($user['password'] == hash_password($password)) {
			echo '登录成功 欢迎回来：' . $user['username'];

			$_SESSION['userid'] = $user['userid'];
		} else {
			echo '登录失败 密码错误!';
		}

	}

} else {
	no_access();
}
?>

    </div>
