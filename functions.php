<?php
/**
 * Created by PhpStorm.
 * User: Pal
 * Date: 2015/10/6
 * Time: 18:17
 */

global $mysql_host, $mysql_user, $mysql_pass, $mysql_db;

$mysql_host = "localhost";
$mysql_user = "root";
$mysql_pass = "";
$mysql_db = "tvker";

function get_row_count($table, $suffix = "") {
	//echo "SELECT COUNT(*) FROM $table $suffix";
	$r = mysql_query("SELECT COUNT(*) FROM $table $suffix");

	$a = mysql_fetch_row($r) or die(mysql_error());

	return $a[0];
}

function get_row_sum($table, $field, $suffix = "") {
	$r = mysql_query("SELECT SUM($field) FROM $table $suffix");
	$a = mysql_fetch_row($r) or die(mysql_error());
	return $a[0];
}

function get_single_value($table, $field, $suffix = "") {
	//echo "SELECT $field FROM $table $suffix LIMIT 1";
	$r = mysql_query("SELECT $field FROM $table $suffix LIMIT 1");

	$a = mysql_fetch_row($r) or die(mysql_error());
	if ($a) {
		return $a[0];
	} else {
		return false;
	}
}

function get_now_time() {
	$timezone_identifier = "PRC";
	$time = date("Y-m-d h:i:s");
	return $time;
}

function db_conn() {
	$host = $GLOBALS['mysql_host'];
	$user = $GLOBALS['mysql_user'];
	$pass = $GLOBALS['mysql_pass'];
	$db = $GLOBALS['mysql_db'];

	$conn = mysql_connect($host, $user, $pass);

	if (!$conn) {
		die('连接数据库失败: ' . mysql_error());
	}

	mysql_select_db($db) or die("无法选择数据库!");

	return $conn;

}

function get_user_number() {
	return get_single_value('status', 'value', 'WHERE name = "usernumber"');
}

//加密密码
function hash_password($password) {
	return crypt($password, get_single_value('status', 'string', 'WHERE name = "passwordsalt"'));
}

//增加一个用户
function add_user($username, $password, $email, $studentid) {

	$userid = get_user_number() + 1; //得到用户的数量并+1生成新用户的ID

	$password = hash_password($password); //加密密码

	$query = "INSERT INTO user(userid, username, password, email, studentid) VALUE('$userid', '$username', '$password','$email','$studentid')";

	if ($result = mysql_query($query)) {
		mysql_query("UPDATE status SET status.value = status.value+1 WHERE status.name = 'usernumber'");
		return true;
	} else {
		die("Error in query: $query. " . mysql_error());
	}

}

function get_user_by_id($userid) {
	if (!is_numeric($userid)) {
		return false;
	}

	if (get_row_count('user', "WHERE userid = $userid") == 0) {

		return false;
	}
	//echo "SELECT * FROM user WHERE userid = $userid LIMIT 1";

	$r = mysql_query("SELECT * FROM user WHERE userid = $userid LIMIT 1");

	$a = mysql_fetch_array($r) or die(mysql_error());

	/*  foreach($a as $key=>$value)
	echo $key."=>".$value."<br />";
	 */
	if ($a) {

		$user = array(
			'userid' => $a['userid'],
			'username' => $a['username'],
			'password' => $a['password'],
			'email' => $a['email'],
			'studentid' => $a['studentid'],
			'signature' => $a['signature'],
			'registertime' => $a['registertime'],
			'level' => $a['level'],
		);
		//print_r($user);

		return $user;
	} else {
		return false;
	}

}

function get_user_by_name($username) {

	if (get_row_count('user', "WHERE username = '$username'") == 0) {

		return false;
	} else {

		return get_user_by_id(get_single_value('user', 'userid', "WHERE username = '$username'"));
	}

}

function logout() {
	unset($_SESSION['userid']);
}

function no_access($message = '未知区域', $tips = '通过合法方式访问') {
	echo '操作错误，您在' . $message . '没有足够的权限！请' . $tips . '!';
}
function is_login() {
	if (isset($_SESSION['userid'])) {
		return true;
	} else {
		return false;
	}
}

function add_message($userid, $content) {
	if (get_user_by_id($userid)) {
		$messageid = get_single_value('status', 'value', 'WHERE name = "messagenumber"') + 1;
		$query = "INSERT INTO message(messageid, userid, content) VALUE('$messageid', '$userid', '$content')";

		if ($result = mysql_query($query)) {
			mysql_query("UPDATE status SET status.value = status.value+1 WHERE status.name = 'messagenumber'");
			return $messageid;
		} else {
			die("Error in query: $query. " . mysql_error());
		}

	} else {
		return false;
	}

}

function get_message($messageid) {
	$r = mysql_query("SELECT * FROM message WHERE messageid = $messageid LIMIT 1");

	$a = mysql_fetch_array($r) or die(mysql_error());

	if ($a) {
		$message = array(
			'messageid' => $a['messageid'],
			'userid' => $a['userid'],
			'sendtime' => $a['sendtime'],
			'content' => $a['content'],
		);

		return $message;
	} else {
		return false;
	}
}

function show_head($name = "") {
	echo '<!DOCTYPE html><html lang=zh-cmn-Hans><head>';
	if (!is_login()) {
		echo '<meta charset="UTF-8"  http-equiv="refresh" content="3;url=login.php">';
	} else {
		echo '<meta charset="UTF-8" >' . //新 Bootstrap 核心 CSS 文件
		'<link rel="stylesheet"href="css/bootstrap.min.css">' . //可选的Bootstrap主题文件（一般不用引入）
		'<link rel="stylesheet"href="css/bootstrap-theme.min.css">
        <link rel="stylesheet"href="css/custom.css"><title>' . $name . '</title></head><body>';
	}

}
function show_head_no_login($name = "") {
	echo '<!DOCTYPE html><html lang=zh-cmn-Hans><head><meta charset="UTF-8" >' . //新 Bootstrap 核心 CSS 文件
	'<link rel="stylesheet"href="css/bootstrap.min.css">' . //可选的Bootstrap主题文件（一般不用引入）
	'<link rel="stylesheet"href="css/bootstrap-theme.min.css">
        <link rel="stylesheet"href="css/custom.css"><title>' . $name . '</title></head><body>';
}

function get_bar() {
	echo '<nav class="navbar navbar-default navbar-fixed-top">
<div class="container">
<div class="navbar-header">
<a class="navbar-brand"href="index.html">Tvker</a>
</div>
<div id="navbar"class="navbar-collapse collapse">
<ul class="nav navbar-nav">
<li><a href="#">状态</a></li>
<li><a href="#about">热门</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">';
	if (get_user_by_id(@$_SESSION['userid'])) {
		echo '<li class="dropdown"><a href="#"class="dropdown-toggle"data-toggle="dropdown"role="button"aria-haspopup="true"aria-expanded="false">' . get_user_by_id($_SESSION['userid'])['username'] . '<span class="caret"></span></a><ul class="dropdown-menu"><li><a href="#">设置</a></li><li><a href="#">关于</a></li><li role="separator"class="divider"></li><li><a href="logout.php">登出</a></li></ul></li>';
	} else {
		echo '<li><a href="login.php">登录</a></li>
<li><a href="register.php">注册</a></li>';
	}

	echo '</li></ul></div>
<!--/.nav-collapse -->
</div>
</nav>';
}

function get_foot() {
	echo '        <!-- Bootstrap core JavaScript
================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="js/ie10-viewport-bug-workaround.js"></script>';

}

?>


