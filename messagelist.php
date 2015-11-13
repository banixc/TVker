<?php
/**
 * Created by PhpStorm.
 * User: Pal
 * Date: 2015/11/13
 * Time: 19:04
 */
include_once('linkstart.php');

if (is_login()) {
    show_head('所有状态');
}
else {
    show_head('最新状态（登录后查看所有内容）');
}




show_bar(2);


echo '<div class="container">';

show_alert();

echo ' </div>';





//show_send_message();
if (is_login()) {
    show_message_list(get_message_list());
}
else {
    show_message_list(get_message_list(10));
}



show_foot(); ?>
