<?php
/* 
 * ±¾Èí¼şÎªÃâ·Ñ¡¢¿ªÔ´Èí¼ş¡£
 * ±¾Èí¼şµÄ°æÈ¨(°üÀ¨Ô´Âë¼°¶ş½øÖÆ·¢²¼°æ±¾)¹éÒ»ÇĞ¹«ÖÚËùÓĞ¡£
 * Äú¿ÉÒÔ×ÔÓÉÊ¹ÓÃ¡¢´«²¥±¾Èí¼ş¡£
 * ÄúÒ²¿ÉÒÔÒÔÈÎºÎĞÎÊ½¡¢ÈÎºÎÄ¿µÄÊ¹ÓÃ±¾Èí¼ş(°üÀ¨Ô´Âë¼°¶ş½øÖÆ·¢²¼°æ±¾)£¬¶ø²»ÊÜÈÎºÎ°æÈ¨ÏŞÖÆ¡£
 * =====================
 * ×÷Õß: ËïÃ÷±£
 * ÓÊÏä: sunmingbao@126.com
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
<title>×¢²á½á¹û</title>



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

    echo "<H1>ä¿®æ”¹æˆåŠŸ&nbsp;&nbsp;<a href='/'>è¿”å›é¦–é¡µï¼Ÿ</a></H1>";

?>

<script>
print_bottom();
</script>

</body>
</html>