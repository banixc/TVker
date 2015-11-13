<?php include_once('linkstart.php');
if (!is_login()) {
    header("location: login.php?action=err&mes=你需要登录才能进行操作！");exit;
}


if (!@$_GET['active']) {
    header("location: messagelist.php?action=err&mes=没有这个操作");exit;

}

if (!@$_GET['messageid']) {
    header("location: messagelist.php?action=err&mes=没有这条状态");exit;
}


switch ($_GET['active'])
{
    case 'praise';
        $err=praise_message($_GET['messageid'],$_SESSION['userid']);
        if($err==-1)
        {
            header("location: messagelist.php?action=info&mes=已取消点赞！");exit;
        }
        else if(!$err)
        {
            header("location: messagedetails.php?action=succ&mes=点赞成功！&messageid=".$_GET['messageid']);exit;
        }
        else
        {
            header("location: messagelist.php?action=err&mes=$err");exit;
        }
        break;

    case 'comment';
        if(!@$_GET['content'])
        {
            header("location: messagelist.php?action=err&mes=请输入评论内容！");exit;
        }

        else
        {
            if(!$err = comment_message($_GET['messageid'],$_SESSION['userid'],$_GET['content']))
            {
                header("location: messagedetails.php?action=succ&mes=评论成功&messageid=".$_GET['messageid']);exit;
            }
            else
            {
                header("location: messagedetails.php?action=err&mes=$err&messageid=".$_GET['messageid']);exit;
            }
        }

        break;

}

?>

