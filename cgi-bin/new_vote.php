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

//var_dump($_POST);
$option_num = 0;
$create_time=time();

    $subject=$_POST['subject'];
    $multi_select=(int)$_POST['multi_select'];
    $anyone_can_vote=(int)$_POST['anyone_can_vote'];
    $voter_list= explode(',',preg_replace('/\s+/', '', $_POST['voter_list']));
    $voter_num=count($voter_list);
//var_dump($voter_list);
    $author=$_SESSION['user_name'];
 $id_user=$_SESSION['id_user'];

//echo "<br>";
foreach($_POST as $key => $value) 
{
    if (substr($key, 0, 3)=="opt")
    {
        if ($value == "")
            break;

        //echo "$key: $value<br>";
        $option_num++;
    }
}

//echo $option_num."<br>".user_time(time());

    get_mutex();
    if (0!=open_database())
    {
        put_mutex();
        die("<H1>open database failed.</H1>");
    }

    $result = $file_db->query("select * from subject where subject='".$subject."'");

//var_dump($result);
    if (!result_empty($result))
    {
        put_mutex();
        die("<H1>投票已存在</H1>");
    }

    try
    {
        $file_db->exec("insert into subject values(NULL, ".$id_user.", '".$subject."',".$multi_select.", ".$option_num.", ".$anyone_can_vote.", ".$create_time.",0,0,0,".$create_time.")");
    }
    catch (PDOException $e) 
    {
        put_mutex();
        die("<H1>insert subject failed.</H1>");
    }

    $result = $file_db->query("select * from subject where subject='".$subject."'");
    foreach($result as $row) 
    {
        $id_subject=(int)$row['id_subject'];
    }

    foreach($_POST as $key => $value) 
    {
        if (substr($key, 0, 3)=="opt")
        {
            if ($value == "")
                break;

            $file_db->exec("insert into option values(NULL, ".$id_subject.",'".$value."', 0)");
        }
    }

    for($x=0;$x<$voter_num;$x++) {
      if ($voter_list[$x] != "")
          $file_db->exec("insert into voter_list values(".$id_subject.",'".$voter_list[$x]."')");
    }

    put_mutex();
    

   header("Location:vote_list.php");

?>
