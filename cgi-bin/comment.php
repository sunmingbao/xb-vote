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

$comment_time=time();

    $id_subject=(int)$_POST['id_subject'];
    $multi_select=(int)$_POST['multi_select'];
    $comment=$_POST['comment'];
    $id_user=$_SESSION['id_user'];
    $client_ip=$_SERVER["REMOTE_ADDR"];


    get_mutex();
    if (0!=open_database())
    {
        put_mutex();
        die("<H1>open database failed.</H1>");
    }





      $sql_str = "insert into comment values(NULL, ".$id_user.",".$id_subject.",'".$comment."', ".$comment_time.", '".$client_ip."')";
      try
      {
        $file_db->exec($sql_str);
      }
      catch (PDOException $e) 
      {
          put_mutex();
          die("<H1>insert comment failed.</H1>");
      }


      $file_db->exec("update subject set last_update_time=".$comment_time.", comment_cnt=comment_cnt+1 where id_subject=".$id_subject);
put_mutex();
header("Location:vote_ui.php?id_subject=".$id_subject."&scroll2bottom=1");
?>

