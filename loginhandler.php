<?php
/**
 * Created by PhpStorm.
 * User: Pal
 * Date: 2015/10/24
 * Time: 9:42
 */

include_once('functions.php');

$username = $_POST['username'];
$password = $_POST['password'];


dbconn();


if(login($username,$password))
{
    echo "��¼�ɹ�!" .$username. " ��ӭ������";
}
else
{
    echo "��¼ʧ�ܣ����������û���/���롣";
}