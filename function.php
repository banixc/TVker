<?php
/**
 * Created by PhpStorm.
 * User: Pal
 * Date: 2015/10/5
 * Time: 23:04
 */
/*
function dbconn($autoclean = false)
{
    global $lang_functions;
    global $mysql_host, $mysql_user, $mysql_pass, $mysql_db;
    global $useCronTriggerCleanUp;

    if (!mysql_connect($mysql_host, $mysql_user, $mysql_pass))
    {
        switch (mysql_errno())
        {
            case 1040:
            case 2002:
                die("<html><head><meta http-equiv=refresh content=\"10 $_SERVER[REQUEST_URI]\"><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"></head><body><table border=0 width=100% height=100%><tr><td><h3 align=center>".$lang_functions['std_server_load_very_high']."</h3></td></tr></table></body></html>");
            default:
                die("[" . mysql_errno() . "] dbconn: mysql_connect: " . mysql_error());
        }
    }
    mysql_query("SET NAMES UTF8");
    mysql_query("SET collation_connection = 'utf8_general_ci'");
    mysql_query("SET sql_mode=''");
    mysql_select_db($mysql_db) or die('dbconn: mysql_select_db: ' + mysql_error());

    userlogin();

    if (!$useCronTriggerCleanUp && $autoclean) {
        register_shutdown_function("autoclean");
    }
}
*/