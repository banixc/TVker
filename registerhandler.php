<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart - UI Elements</title>

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
    <title>注册</title>
</head>
<body>
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
    echo '注册失败！';

}
else
{
    echo $username."欢迎您的加入！";
}
?>

</BODY>

</HTML>