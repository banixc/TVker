<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>控制台</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <form class="form-horizontal" action="sendmessage.php" method="post">
        <input type=t ext name="content">
        <button type="submit" class="btn btn-sm btn-default">发送信息</button>
    </form>
    <div class="container">
        <div class="row">
            <div></div>
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <!--    <div class="panel-heading">Horizontal Form</div>-->
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
      </div>



</html>
