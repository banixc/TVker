<?php
/**
 * Created by PhpStorm.
 * User: Pal
 * Date: 2015/11/12
 * Time: 16:12
 */

include_once('linkstart.php');
if (!is_login()) {
    header("location: login.php?action=err&mes=你需要登录才能查看用户信息！");
    exit;
}

show_head('热门');

show_bar(1);
//show_send_message();


show_message_list(get_message_praise_hot_list());

show_foot();?>
