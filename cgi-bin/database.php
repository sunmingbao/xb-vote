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

    $file_db=NULL;
    function open_database() 
    {
        global $file_db;
        try 
        {
              $file_db = new PDO('sqlite:../databases/database.db');
              //var_dump($fp);
              
              if (is_null($file_db))
              {
                  return 1;
              }
              
              if (!is_object($file_db))
              {
                  return 1;
              }
	}
        catch (PDOException $e) 
        {
            return 1;
        }

        return 0;

    }
?>
