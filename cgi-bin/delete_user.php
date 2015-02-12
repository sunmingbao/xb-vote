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

    user_restrict('root');

    $id_user  =  $_GET['id_user'];
    $ret  =  $_GET['ret'];

    get_mutex();
    if (0!=open_database())
    {
        put_mutex();
        die("<H1>open database failed.</H1>");
    }


        $file_db->exec("delete from user where id_user=".$id_user."");

    $result = $file_db->query("select * from subject where id_user=".$id_user);

    $cnt=0;
    if (!is_bool($result))
    foreach($result as $row) 
    {
        $id_subject = $row['id_subject'];
        $file_db->exec("delete from subject where id_subject=".$id_subject);
        $file_db->exec("delete from option where id_subject=".$id_subject);
        $file_db->exec("delete from vote where id_subject=".$id_subject);
        $file_db->exec("delete from comment where id_subject=".$id_subject);
    }


    $result = $file_db->query("select * from vote where id_user=".$id_user." group by id_subject");

    $cnt=0;
    if (!is_bool($result))
    foreach($result as $row) 
    {
        $id_subject = $row['id_subject'];
//echo "subject<br>";
        $file_db->exec("update subject set  vote_cnt=vote_cnt-1 where id_subject=".$id_subject);
    }

    $result = $file_db->query("select * from comment where id_user=".$id_user);

    $cnt=0;
    if (!is_bool($result))
    foreach($result as $row) 
    {
//echo "comment<br>";
        $id_subject = $row['id_subject'];
        $file_db->exec("update subject set  comment_cnt=comment_cnt-1 where id_subject=".$id_subject);
    }

    $result = $file_db->query("select * from vote where id_user=".$id_user);

    $cnt=0;
    if (!is_bool($result))
    foreach($result as $row) 
    {
        $id_option = $row['id_option'];
//echo "option<br>";
        $file_db->exec("update option set  select_cnt=select_cnt-1 where id_option=".$id_option);
    }



        $file_db->exec("delete from vote where id_user=".$id_user);
        $file_db->exec("delete from comment where id_user=".$id_user);
    put_mutex();

    header("Location:".$ret);

?>
