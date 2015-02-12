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

    login_restrict();
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
    $password_hash=md5($_POST['password']);
    //echo $_POST['password'];
    get_mutex();
    if (0!=open_database())
    {
        put_mutex();
        die("<H1>open database failed.</H1>");
    }

    try
    {
        //echo "<br>exec<br>".$_SESSION['user_name'];
        $file_db->exec("update user set passwd_hash='".$password_hash."' where user_name='".$_SESSION['user_name']."'");
    }
    catch (PDOException $e) 
    {
        put_mutex();
        die("<H1>update user failed.</H1>");
    }

    put_mutex();
    //header($_SESSION['user_home']);

    echo "<H1>淇敼鎴愬姛&nbsp;&nbsp;<a href='/'>杩斿洖棣栭〉锛�</a></H1>";

?>

<script>
print_bottom();
</script>

</body>
</html>