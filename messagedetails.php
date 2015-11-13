<?php include_once('linkstart.php');
if (!is_login()) {
    header("location: login.php?action=err&mes=你需要登录才能查看用户信息！");
    exit;
}
show_head('状态信息');

echo '<!-- 导航条 -->';

show_bar();

echo '<!-- 导航条结束 -->
<!-- 主体部分 -->';


//print_r($user);
?>
    <?php

    echo '<div class="container">';

    show_alert();

    echo '</div>';


    global $message;

    if(!@$_GET['messageid'])
    {
        header("location: messagelist.php?action=err&mes=信息不存在！");
        exit;
    }

    $message = get_message_by_id($_GET['messageid']);

    show_message($message);



    ?>





<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="js/ie10-viewport-bug-workaround.js"></script>
</body>
