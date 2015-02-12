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
