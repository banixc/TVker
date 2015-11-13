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
$mysql_pass = "root";
$mysql_db = "tvker";

function get_row_count($table, $suffix = "")
{
    //echo "SELECT COUNT(*) FROM $table $suffix";
    $r = mysql_query("SELECT COUNT(*) FROM $table $suffix");

    $a = mysql_fetch_row($r) or die(mysql_error());

    return $a[0];
}

function get_row_sum($table, $field, $suffix = "")
{
    $r = mysql_query("SELECT SUM($field) FROM $table $suffix");
    $a = mysql_fetch_row($r) or die(mysql_error());
    return $a[0];
}

function get_single_value($table, $field, $suffix = "")
{
    //echo "SELECT $field FROM $table $suffix LIMIT 1";
    $r = mysql_query("SELECT $field FROM $table $suffix LIMIT 1");

    $a = mysql_fetch_row($r) or die(mysql_error());
    if ($a) {
        return $a[0];
    } else {
        return false;
    }
}

function mysql_fetch_all($r)
{
    while ($row = mysql_fetch_array($r)) {
        $return[] = $row;
    }
    return $return;
}

function get_now_time()
{
    $timezone_identifier = "PRC";
    $time = date("Y-m-d h:i:s");
    return $time;
}

function db_conn()
{
    $host = $GLOBALS['mysql_host'];
    $user = $GLOBALS['mysql_user'];
    $pass = $GLOBALS['mysql_pass'];
    $db = $GLOBALS['mysql_db'];

    $conn = mysql_connect($host, $user, $pass);

    if (!$conn) {
        die('连接数据库失败: ' . mysql_error());
    }

    mysql_select_db($db) or die("无法选择数据库!");


    mysql_query("set character set 'utf8'");//读库
    mysql_query("set names 'utf8'");//写库

    return $conn;

}

function get_user_number()
{
    return get_single_value('status', 'value', 'WHERE name = "usernumber"');
}

//加密密码
function hash_password($password)
{
    return crypt($password, get_single_value('status', 'string', 'WHERE name = "passwordsalt"'));
}

//增加一个用户
function add_user($username, $password, $email, $studentid)
{

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

function get_user_by_id($userid)
{
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
            'qq' => $a['qq'],
            'phone' => $a['phone'],
            'level' => get_single_value("level", "levelname", "WHERE levelid = " . $a['level']),
        );
        //print_r($user);

        return $user;
    } else {
        return false;
    }

}

function get_user_by_name($username)
{

    if (get_row_count('user', "WHERE username = '$username'") == 0) {

        return false;
    } else {

        return get_user_by_id(get_single_value('user', 'userid', "WHERE username = '$username'"));
    }

}

function logout()
{
    unset($_SESSION['userid']);
}

function no_access($message = '未知区域', $tips = '通过合法方式访问')
{
    echo '操作错误，您在' . $message . '没有足够的权限！请' . $tips . '!';
}

function is_login()
{
    if (isset($_SESSION['userid'])) {
        return true;
    } else {
        return false;
    }
}


//message function


function add_message($userid, $content)
{
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

function edit_user($userid, $username, $studentid, $email, $signature, $qq, $phone)
{
    if ($user = get_user_by_id($userid)) {
        if ($username != $user['username'])
            if (get_row_count("user", "WHERE username = '$username'"))
                return "用户名相同，请更换用户名！";
        $query = "UPDATE user SET username = '$username',studentid = '$studentid', email = '$email', signature = '$signature', qq = '$qq', phone = '$phone'  WHERE userid = '$userid'";

        if ($result = mysql_query($query)) {
            return false;
        } else {
            return 'Error in query: $query. ' . mysql_error();
        }

    } else {
        return "没有这个用户!";
    }

}

function get_message_by_id($messageid)

{
    $r = mysql_query("SELECT * FROM message WHERE messageid = $messageid LIMIT 1");


    $a = mysql_fetch_array($r) or die(mysql_error());

    if ($a) {
        $message = array(
            'messageid' => $a['messageid'],
            'userid' => $a['userid'],
            'sendtime' => $a['sendtime'],
            'content' => $a['content'],
            'praisenumber' => get_message_praise_number($messageid),
            'commentnumber' => get_message_comment_number($messageid),
            'praiselist' => get_message_praise_list($messageid),
            'commentlist' => get_message_comment_list($messageid),
        );

        return $message;
    } else {
        return false;
    }
}

function get_message_praise_number($messageid)
{
    return get_row_count("praise", "WHERE messageid = $messageid");

}

function get_message_praise_list($messageid)
{
    $praise_number = get_message_praise_number($messageid);
    if ($praise_number == 0) return false;
    else {
        $r = mysql_query("SELECT * FROM praise WHERE messageid = $messageid ");
        return mysql_fetch_all($r);
    }
}

function get_message_praise_hot_list($number = 10)
{
    $r = mysql_query("SELECT messageid FROM praise GROUP BY (messageid) ORDER BY COUNT(*) DESC LIMIT $number");

    while ($row = mysql_fetch_array($r)) {
        $return[] = get_message_by_id($row[0]);
    }
    return $return;
}

function get_message_list($number = 0)
{
    if ($number == 0) {
        $r = mysql_query("SELECT messageid FROM message ORDER BY messageid DESC");
    } else {
        $r = mysql_query("SELECT messageid FROM message ORDER BY messageid DESC LIMIT $number");

    }

    while ($row = mysql_fetch_array($r)) {
        $return[] = get_message_by_id($row[0]);
    }
    return $return;

}


function get_message_comment_hot_list($number = 10)
{
    $r = mysql_query("SELECT messageid FROM comment GROUP BY (messageid) ORDER BY COUNT(*) DESC LIMIT $number");

    while ($row = mysql_fetch_array($r)) {
        $return[] = get_message_by_id($row[0]);
    }
    return $return;
}

function get_message_user_praise($userid)
{
    return get_row_count("prasie", "WHERE userid = $userid");
}


function praise_message($messageid, $userid)
{
    if (get_user_by_id($userid) and get_message_by_id($messageid)) {
        if (get_row_count("praise", "WHERE messageid = $messageid AND userid = $userid")) {
            $a = "DELETE FROM praise WHERE messageid = $messageid AND userid = $userid";
            $r = mysql_query($a) or die(mysql_error());
            return -1;
        } else {
            $a = "INSERT INTO praise(messageid, userid) VALUE('$messageid', '$userid')";
            $r = mysql_query($a) or die(mysql_error());
            return 0;
        }
    } else {
        return '用户名或状态不存在！';
    }

}

function get_message_number()
{
    return get_single_value("status", "value", "WHERE name = 'messagenumber'");
}

function get_message_comment_number($messageid)
{

    return get_row_count("comment", "WHERE messageid = $messageid");

}

function get_message_comment_list($messageid)
{
    $praise_number = get_message_comment_number($messageid);
    if ($praise_number == 0) return false;
    else {
        $r = mysql_query("SELECT * FROM comment WHERE messageid = $messageid ");
        return mysql_fetch_all($r);
    }

}


function get_message_user_commnet($userid)
{
    return get_row_count("comment", "WHERE userid = $userid");
}


function comment_message($messageid, $userid, $content)
{
    if (get_user_by_id($userid) and get_message_by_id($messageid)) {

        if (get_row_count("comment", "WHERE messageid = $messageid AND userid = $userid")) {
            return '您已评论过该状态！无法再次评论';
        } else {
            $a = "INSERT INTO comment(messageid, userid, content) VALUE('$messageid', '$userid' , '$content')";
            $r = mysql_query($a) or die(mysql_error());
            return false;
        }
    } else {
        return '用户名或状态不存在！';
    }

}


function show_head($name = "")
{
    echo '<!DOCTYPE html><html lang=zh-cmn-Hans><head>';
    echo '<meta charset="UTF-8" >' . //新 Bootstrap 核心 CSS 文件
        '<link rel="stylesheet"href="css/bootstrap.min.css">' . //可选的Bootstrap主题文件（一般不用引入）

        //<link rel="stylesheet"href="css/bootstrap-theme.css">
        '<link rel="stylesheet"href="css/custom.css"><title>' . $name . '</title></head><body>';


}


function show_bar($active = 0)
{
    echo '<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="container">
<div class="navbar-header">
<a class="navbar-brand"href="index.php">Tvker</a>
</div>
<div id="navbar"class="navbar-collapse collapse">
<ul class="nav navbar-nav">
<li ';
    if ($active == 2) {
        echo 'class = "active"';
    }
    echo '><a href="messagelist.php">状态</a></li>
<li ';
    if ($active == 1) {
        echo 'class = "active"';
    }
    echo '><a href="hotmessage.php"
>热门</a></li>
<li><a href="#" data-toggle="collapse" data-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample" >发送状态</a></li>

</ul>





<ul class="nav navbar-nav navbar-right">';
    if (get_user_by_id(@$_SESSION['userid'])) {
        echo '<li class="dropdown"><a href="#"class="dropdown-toggle"data-toggle="dropdown"role="button"aria-haspopup="true"aria-expanded="false">' . get_user_by_id($_SESSION['userid'])['username'] . '<span class="caret"></span></a><ul class="dropdown-menu"><li><a href="userdetails.php">我的主页</a></li><li role="separator"class="divider"></li><li><a href="logout.php">登出</a></li></ul></li>';
    } else {
        echo '<li><a href="login.php">登录</a></li>
<li><a href="register.php">注册</a></li>';
    }

    echo '</li></ul></div>
<!--/.nav-collapse -->
</div>
</nav>
<div class="container">
<div class="collapse" id="collapseExample" aria-expanded="true">
  <div class="well">
    <form action="sendmessagehandler.php" method="post">
    <div class="row">
    <div class="col-md-11"><input type="text" placeholder="请输入状态" class="form-control" name="content"></div>

     <div class="col-md-1"><button type="submit" class="btn btn-sm btn-default">发送状态</button></div>


  </div></form>
</div></div>
</div>
';
}

function show_user_by_id($userid)
{
    $user = get_user_by_id($userid);
    return '<a href=userdetails.php?userid=' . $user['userid'] . '>' . $user['username'] . '</a>';

}

function show_foot()
{
    echo '

 <footer class="footer">
      <p><a href="index.php">Tvker</a> 一个轻量级的校园社交网站</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>        <!-- Bootstrap core JavaScript
================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="js/ie10-viewport-bug-workaround.js"></script></body>';

}

function show_message_list($messagelist)
{
    foreach ($messagelist as $k => $val) {
        show_message($val);
    }

}

function show_message_by_id($messageid)
{
    return '<a href=messagedetails.php?messageid=' . $messageid . '>#' . $messageid . '</a>';
}


function show_message($message)
{
    echo '

    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">' . show_user_by_id($message['userid']) . '&nbsp;&nbsp;' . show_message_by_id($message['messageid']) . '

                    <div class="pull-right">
                        <span class="label label-success">' . date("Y-m-d H:i", strtotime($message['sendtime'])) . '</span>

                    </div>
                </h3>
            </div>

            <div class="panel-body">
                <div class="row">

                    <div class="jumbotron">' . $message['content'] . '</div>
                    <h3>
                        <div class="col-md-10">
                            <button class="btn btn-success" type="button">
                                <a href="messagehandle.php?active=praise&messageid=' . $message['messageid'] . '">点赞<span class="badge">' . $message['praisenumber'] . '</span></a>
                            </button>
                            ';
    show_message_praise_user($message);
    echo '
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-primary" type="button" data-toggle="collapse"
                                    data-target="#allcomment' . $message['messageid'] . '" aria-expanded="false" aria-controls="allcomment' . $message['messageid'].'"';
                                    if($message['commentnumber'] ==0) echo ' disabled="disabled';
    echo'">
    评论<span class="badge">' . $message['commentnumber'] . '</span>
                            </button>
                        </div>

                        <div class="col-md-1">
                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#comment' . $message['messageid'] . '"
                                    aria-expanded="false" aria-controls="comment' . $message['messageid'] . '">
    我要评</span>
                            </button>
                        </div>
                    </h3>

                </div>
            </div>

            <div class="collapse" id="allcomment' . $message['messageid'] . '">';

    show_message_comment_list($message);

    echo '    </div>

        </div>


        <div class="collapse" id="comment' . $message['messageid'] . '">
            <div class="well">
                <form action="messagehandle.php" method="get">
                    <div class="row">
                        <div class="col-md-11"><input type="text" placeholder="请评论" class="form-control"
                                                      name="content"/></div>
                                                      <input type="hidden" value = "comment" name = "active" />
                                                      <input type="hidden" value = "' . $message['messageid'] . '" name = "messageid" />


                        <div class="col-md-1">
                            <button type="submit" class="btn btn-sm btn-default">发送评论</button>
                        </div>
                </form>
            </div>
        </div>
    </div>


</div>
';

}

function show_message_comment_list($message)
{
    if ($message['commentnumber'] == 0)
        return;
    foreach ($message['commentlist'] as $k => $val) {

        echo '                <div class="well">
                    <div class="row">
                        <div class="col-md-1"><span class="label label-info">' . show_user_by_id($val['userid']) . '</span></div>
                        <div class="col-md-11">' . $val['content'] . '
                            <div class="pull-right"> <span class="label label-success">' . date("Y-m-d H:i", strtotime($val['commenttime'])) . '</span></div>
                        </div>
                    </div>
                </div>';
    }
}

function show_message_praise_user($message)
{
    if ($message['praisenumber'] == 0)
        return;
    foreach ($message['praiselist'] as $k => $val) {


        echo '                    <span class="label label-info">' . show_user_by_id($val['userid']) . '</span>
                  ';
    }
}


function show_send_message()
{
    echo '<div class="container">';
    echo '<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  我要发送
</button>';
    echo '               <div class="collapse" id="collapseExample">
  <div class="well">
    <form action="sendmessagehandler.php" method="post">
    <div class="row">
    <div class="col-md-9 col-md-offset-1"><input type="text" placeholder="请输入状态" class="form-control" name="content" /></div>

     <div class="col-md-1"><button type="submit" class="btn btn-sm btn-default">发送状态</button></div>

</form>
  </div>
</div></div>';

}

function show_alert()
{
    if ($action = @$_GET['action']) {
        switch ($action) {
            case 'err';

                echo '
        <div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>错误！</strong>';

                if ($mes = @$_GET['mes']) {
                    echo $mes;

                } else {
                    echo "权限不足！";
                }

                echo '</div>';
                break;

            case 'succ';
                echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>恭喜您！</strong>';

                if ($mes = @$_GET['mes']) {
                    echo $mes;
                } else {
                    echo "操作成功！";
                }

                echo '</div>';
                break;
            case 'info';
                echo '<div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>不需要！</strong>';

                if ($mes = @$_GET['mes']) {
                    echo $mes;
                } else {
                    echo "您没必要执行该项！";
                }

                echo '</div>';
                break;


        }
    }
}
