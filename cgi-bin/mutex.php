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


    $fp=NULL;
    function get_mutex() 
    {
        global $fp;

        $fp = fopen("../databases/flock.txt","w");
        //var_dump($fp);

        if ($fp==NULL)
        {
            die("<H1>Unable to open file!</H1>");
	}

        if (!flock($fp, LOCK_EX))
        {
            die("<H1>get_mutex failed.</H1>");
        }
    }
    
    function put_mutex()
    {
        global $fp;

        flock($fp, LOCK_UN);
        fclose($fp);
    }

?>
