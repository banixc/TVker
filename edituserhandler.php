<?php
/**
 * Created by PhpStorm.
 * User: Pal
 * Date: 2015/11/13
 * Time: 16:11
 */


include_once("linkstart.php");

if (!is_login()) {
    header("location: login.php");
    exit;
}

if (@$_POST['username'] and @$_POST['studentid'] and @$_POST['email']) {
    $username = $_POST['username'];
    $studentid = $_POST['studentid'];
    $email = $_POST['email'];
    $qq = @$_POST['qq'];
    $phone = @$_POST['phone'];
    $signature = @$_POST['signature'];


    if($user = get_user_by_id($_SESSION['userid']))
    {
        if(!$err= edit_user($user['userid'],$username,$studentid,$email,$signature,$qq,$phone))
        {
            header("location: userdetails.php?action=succ");
        }
        else
        {
            header("location: userdetails.php?action=err&mes=".$err);
        }
    }
    else
    {
        no_access('修改信息页面');
    }


} else {
    header("location: userdetails.php?action=err&mes=用户名、学生证号或邮箱均不能为空！");
}

?>

