<HTML>
<HEAD></HEAD>

<BODY>

<?php
/**
 * Created by PhpStorm.
 * User: Pal
 * Date: 2015/10/16
 * Time: 3:48
 */

include_once('functions.php');

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$studentid = $_POST['studentid'];


dbconn();

if(!adduser($username,$password,$email,$studentid))
{
    echo '创建用户失败，请重试';

}
else
{
    echo $username."恭喜您成为我们的第*位会员";
}
?>

</BODY>

</HTML>