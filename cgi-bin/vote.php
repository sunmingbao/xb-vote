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

$vote_time=time();

    $id_subject=(int)$_POST['id_subject'];
    $multi_select=(int)$_POST['multi_select'];
    $id_user=$_SESSION['id_user'];

    get_mutex();
    if (0!=open_database())
    {
        put_mutex();
        die("<H1>open database failed.</H1>");
    }

    $result = $file_db->query("select * from vote where id_subject=".$id_subject." and id_user='".$id_user."'");

//var_dump($result);
    if (!result_empty($result))
    {
        put_mutex();
        die("<H1>you have already voted</H1>");
    }

if ($multi_select==1)
{
    $option_array = $_POST['option'];

    foreach($option_array as $key => $value) 
    {

      $sql_str = "insert into vote values(NULL, ".$id_user.",".$id_subject.",".$value.", ".$vote_time.", NULL)";
      try
      {
        $file_db->exec($sql_str);
      }
      catch (PDOException $e) 
      {
          put_mutex();
          die("<H1>insert subject failed.</H1>");
      }
      $file_db->exec("update option set select_cnt=select_cnt+1 where id_option=".$value);
    }
}
else
{
      $id_option =$_POST['option'];
      $sql_str = "insert into vote values(NULL, ".$id_user.",".$id_subject.",".$id_option.", ".$vote_time.", NULL)";
      try
      {
        $file_db->exec($sql_str);
      }
      catch (PDOException $e) 
      {
          put_mutex();
          die("<H1>insert subject failed.</H1>");
      }
    $file_db->exec("update option set select_cnt=select_cnt+1 where id_option=".$id_option);
}

      $file_db->exec("update subject set last_update_time=".$vote_time.", vote_cnt=vote_cnt+1 where id_subject=".$id_subject);
put_mutex();
header("Location:vote_ui.php?id_subject=".$id_subject);
?>
