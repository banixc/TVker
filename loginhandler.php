<?php include_once('linkstart.php');

global $username;
global $password;

if (@$_POST['username'] and @$_POST['password']) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) and !empty($password)) {
        $user = get_user_by_name($username);
        if (!$user) {
           // echo '<HTML><HEAD><META HTTP-EQUIV="refresh" CONTENT="3;url=login.php"></HEAD><BODY>';
            header("location: login.php?action=err&mes=登录失败!用户不存在!请重试!");
            exit;
        } else if ($user['password'] == hash_password($password)) {
            $_SESSION['userid'] = $user['userid'];
            header("location: userdetails.php?action=succ&mes=登录成功!欢迎回来：".show_user_by_id($user['userid']));
            exit;

        } else {
            header("location: login.php?action=err&mes=登录失败!密码错误!请重试!");
            exit;

        }
    }
    else {
        no_access();
    }

} else {
    no_access();
}

?>



