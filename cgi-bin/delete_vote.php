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
