<?php
/* 
 * �����Ϊ��ѡ���Դ�����
 * ������İ�Ȩ(����Դ�뼰�����Ʒ����汾)��һ�й������С�
 * ����������ʹ�á������������
 * ��Ҳ�������κ���ʽ���κ�Ŀ��ʹ�ñ����(����Դ�뼰�����Ʒ����汾)���������κΰ�Ȩ���ơ�
 * =====================
 * ����: ������
 * ����: sunmingbao@126.com
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
<title>ע����</title>



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

    echo "<H1>修改成功&nbsp;&nbsp;<a href='/'>返回首页？</a></H1>";

?>

<script>
print_bottom();
</script>

</body>
</html>