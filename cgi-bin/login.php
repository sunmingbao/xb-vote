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

    ob_start();
    session_start();

    $user_name=$_POST['user_name'];
    $password_hash=md5($_POST['password']);
    echo $_POST['$password_hash']."<br>";
    get_mutex();
    if (0!=open_database())
    {
        put_mutex();
        die("<H1>open database failed.</H1>");
    }

    $result = $file_db->query("select * from user where user_name='".$user_name."' and passwd_hash='".$password_hash."'");

//var_dump($result);
    $cnt=0;
    if (!is_bool($result))
    foreach($result as $row) 
    {
        $cnt++;
        $id_user = (int)$row['id_user'];
        break;
    }
    put_mutex();
    if ($cnt>0)
    {
        session_regenerate_id();
        $_SESSION['user_time_zone'] = $_POST['user_time_zone'];
        $_SESSION['id_user']  =  $id_user;
	$_SESSION['user_name'] =  $user_name;
        $_SESSION['real_name'] =  $row['real_name'];
        $_SESSION['stuff_id']  =  $row['stuff_id'];
        $_SESSION['sex']       =  $row['sex'];
        $_SESSION['tel_no']    =  $row['tel_no'];
        $_SESSION['email']     =  $row['email'];

        if($user_name=="root")
        {
            $_SESSION['user_type'] = "root";
            $_SESSION['user_home_pure'] = "/root_home.php";
        }
        else
        {
            $_SESSION['user_type'] = "normal";
            $_SESSION['user_home_pure'] = "/cgi-bin/vote_list.php";
        }

        $_SESSION['user_home'] = "Location:".$_SESSION['user_home_pure'];
	session_write_close();
	header($_SESSION['user_home']);
    }
    else
    {
        header($login_url);
    }

?>
