<?php include_once ('linkstart.php'); if(is_login()) {header("location: userdetails.php?action=info&mes=您已登录，要注册请先登出!");exit;}?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Home</title>
    <!-- Custom Theme files -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/login.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- Custom Theme files -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
    <!--Google Fonts-->
    <link href='http://fonts.useso.com/css?family=Roboto:500,900italic,900,400italic,100,700italic,300,700,500italic,100italic,300italic,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.useso.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <!--Google Fonts-->
</head>
<body>
<div class="login">
    <h2>Tvker</h2>
    <div class="login-top">
        <h1>Register</h1>

        <?php show_alert(); ?>


        <form action="registerhandler.php" method="post">
            <input type="text" value="用户名" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '用户名';}" name = "username">
            <input type="password" value="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'password';}" name = "password">
            <input type="password" value="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'password';}" name = "confpassword">
            <input type="text" value="邮箱" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '邮箱';}" name = "email">
            <input type="text" value="学号" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '学号';}" name = "studentid">
            <div class="forgot">
                <input type="submit" value="注册" >
            </div>
        </form>
    </div>
    <div class="login-bottom">
        <h3>已经注册请&nbsp;<a href="login.php">登录</a>&nbsp</h3>
    </div>
</div>
<div class="copyright">
    <p>Copyright &copy; 2015.<a href="index.php">Tvker</a> All rights reserved.</p>
</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="js/ie10-viewport-bug-workaround.js"></script></body>

</body>
</html>
