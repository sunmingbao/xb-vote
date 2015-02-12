<?php
/* 
 * 本软件为免费、开源软件。
 * 本软件的版权(包括源码及二进制发布版本)归一切公众所有。
 * 您可以自由使用、传播本软件。
 * 您也可以以任何形式、任何目的使用本软件(包括源码及二进制发布版本)，而不受任何版权限制。
 * =====================
 * 作者: 孙明保
 * 邮箱: sunmingbao@126.com
 */

    require 'common.php';
    require 'mutex.php';
    require 'database.php';
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script src="../scripts/print_bottom.js"> </script>
<link rel="stylesheet" href="/css/haha.css" type="text/css" charset="utf-8"/>
<title>注册结果</title>



</head>


<body>

<?php print_hdr(); ?>

<?php

    $user_name=$_POST['user_name'];
    $password_hash=md5($_POST['password']);
    $real_name=$_POST['real_name'];
    $stuff_id=$_POST['stuff_id'];
    $sex=$_POST['sex'];
    $tel_no=$_POST['member_phone'];
    $email=$_POST['member_email'];
    
    get_mutex();
    if (0!=open_database())
    {
        put_mutex();
        die("<H1>open database failed.</H1>");
    }

    $result = $file_db->query("select * from user where user_name='".$user_name."'");

//var_dump($result);
    $cnt=0;
    if (!is_bool($result))
    foreach($result as $row) 
    {
        $cnt=$cnt+1;
    }

    if ($cnt>0)
    {
        put_mutex();
        die("<H1>用户名已存在</H1>");
    }

    try
    {
        $file_db->exec("insert into user values(NULL, '".$user_name."', '".$password_hash."',".time().", '".$real_name."', '".$stuff_id."', '".$sex."', '".$tel_no."', '".$email."')");
    }
    catch (PDOException $e) 
    {
        put_mutex();
        die("<H1>insert user failed.</H1>");
    }
    put_mutex();
    

    echo "<H1>注册成功&nbsp;&nbsp;<a href='/cgi-bin/login_ui.php'>马上登陆？</a></H1>";

?>

<script>
print_bottom();
</script>

</body>
</html>