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

    $id_subject  =  $_GET['id_subject'];
    $ret  =  $_GET['ret'];

    get_mutex();
    if (0!=open_database())
    {
        put_mutex();
        die("<H1>open database failed.</H1>");
    }


        $file_db->exec("delete from subject where id_subject=".$id_subject."");
        $file_db->exec("delete from option where id_subject=".$id_subject."");
        $file_db->exec("delete from voter_list where id_subject=".$id_subject."");
        $file_db->exec("delete from vote where id_subject=".$id_subject."");
        $file_db->exec("delete from comment where id_subject=".$id_subject."");


    put_mutex();
    header("Location:".$ret);

?>
