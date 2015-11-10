<?php include_once 'linkstart.php';
show_head_no_login("注册");
get_bar();
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form-horizontal" action="registerhandler.php" method="post">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">用户名</label>
                                <div class="col-lg-10">
                                    <input type="text" placeholder="请输入您的用户名" class="form-control" name="username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">密码</label>
                                <div class="col-lg-10">
                                    <input type="password" placeholder="请输入您的密码" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">确认密码</label>
                                <div class="col-lg-10">
                                    <input type="password" placeholder="请确认您的密码" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">邮箱</label>
                                <div class="col-lg-10">
                                    <input type="email" placeholder="请输入您的邮箱" class="form-control" name="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">学号</label>
                                <div class="col-lg-10">
                                    <input type="text" placeholder="请输入您的学号" class="form-control" name="studentid">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button type="submit" class="btn btn-sm btn-default">注册</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


<?php get_foot();?>
