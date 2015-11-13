<?php include_once('linkstart.php');
if (!is_login()) {
    header("location: login.php?action=err&mes=你需要登录才能查看用户信息！");
    exit;
}
show_head('用户信息');

echo '<!-- 导航条 -->';

show_bar();

echo '<!-- 导航条结束 -->
<!-- 主体部分 -->';

if (@$_GET['userid']) {
    $userid = $_GET['userid'];
} else {
    $userid = $_SESSION['userid'];
}

global $user;
$user = get_user_by_id($userid);

//print_r($user);
?>
<div class="container">
    <?php if (!$user) {
        header("location: userdetails.php?action=err&mes=用户不存在！");
    }

    show_alert();


    ?>


    <table class="table">
        <tbody>
        <tr>
            <td>用户ID</td>
            <td><?php echo $user['userid']; ?></td>
        </tr>
        <tr>
            <td>用户名</td>
            <td><?php echo $user['username']; ?></td>
        </tr>
        <tr>
            <td>权限</td>
            <td><?php echo $user['level']; ?></td>
        </tr>
        <tr>
            <td>用户学号</td>
            <td><?php echo $user['studentid']; ?></td>
        </tr>
        <tr>
            <td>用户邮箱</td>
            <td><?php echo $user['email']; ?></td>
        </tr>
        <tr>
            <td>注册时间</td>
            <td><?php echo $user['registertime']; ?></td>
        </tr>
        <tr>
            <td>QQ</td>
            <td><?php echo $user['qq']; ?></td>
        </tr>
        <tr>
            <td>手机</td>
            <td><?php echo $user['phone']; ?></td>
        </tr>
        <tr>
            <td>签名</td>
            <td><?php echo $user['signature']; ?></td>
        </tr>
        </tbody>
    </table>

    <?php if($user['userid'] == $_SESSION['userid'])

    echo '
    <!-- Button trigger modal -->
    <div class="pull-right">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            修改信息
        </button>
    </div>';

    ?>



    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <div class="modal-title" id="myModalLabel">修改信息</div>
                </div>
                <form class="form-horizontal" method="post" action="edituserhandler.php">

                    <div class="modal-body">


                        <div class="form-group">
                            <label class="col-sm-2 control-label">用户名</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?php echo $user['username']; ?>"
                                       name="username">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">学号</label>

                            <div class="col-sm-10">
                                <input type="tel" class="form-control" value="<?php echo $user['studentid']; ?>"
                                       name="studentid">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">邮箱</label>

                            <div class="col-sm-10">
                                <input type="email" class="form-control" value="<?php echo $user['email']; ?>"
                                       name="email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">QQ</label>

                            <div class="col-sm-10">
                                <input type="tel" class="form-control" value="<?php echo $user['qq']; ?>" name="qq">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">手机</label>

                            <div class="col-sm-10">
                                <input type="tel" class="form-control" value="<?php echo $user['phone']; ?>"
                                       name="phone">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">签名</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?php echo $user['signature']; ?>"
                                       name="signature">
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="js/ie10-viewport-bug-workaround.js"></script>
</body>
