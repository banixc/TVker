<?php include_once 'linkstart.php';
show_head('用户信息');

echo '<!-- 导航条 -->';

get_bar();

echo '<!-- 导航条结束 -->
<!-- 主体部分 -->';

if (@$_GET['id']) {
	$userid = $_GET['id'];
} else {
	echo "已跳转为本人页面";
	$userid = $_SESSION['userid'];
}

$user = get_user_by_id($userid);

//print_r($user);
if (!$user) {
	echo "查无此人！";
} else {
	echo "用户ID：" . $user['userid'] . "<br />";
	echo "用户名：" . $user['username'] . "<br />";
	echo "用户学号：" . $user['studentid'] . "<br />";
	echo "用户邮箱：" . $user['email'] . "<br />";
	echo "用户密码：" . $user['password'] . "<br />";
	echo "用户签名：" . $user['signature'] . "<br />";
	echo "注册时间：" . $user['registertime'] . "<br />";
	echo "用户权限等级：" . $user['level'] . "<br />";
}

?>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="js/ie10-viewport-bug-workaround.js"></script>
</body>
