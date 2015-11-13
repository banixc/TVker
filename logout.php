<?php include_once('linkstart.php');
if (!is_login()) {
    header("location: login.php?action=err&mes=必须先登录！");
    exit;
} else {
    header("Content-Type: text/html; charset=UTF-8");
    logout();
    header("location: login.php?action=succ&mes=登出成功！");
    exit;
}
?>
