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

    require './common.php';
    require './mutex.php';
    require './database.php';

    login_restrict();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script src="../scripts/print_bottom.js"> </script>
<link rel="stylesheet" href="../css/haha.css" type="text/css" charset="utf-8"/>
<title>投票列表</title>



</head>

<body>
<?php print_hdr(); ?>

<br>

<center><a href="/cgi-bin/new_vote_ui.php"><font id="big_red_font">创建投票</font></a></center>
<br>
<br>

<TABLE cellSpacing=0 cellPadding=0 width="90%" align=center border=1>

  <TBODY>

    <TR> 
      <TH width="10%">序号</TH>
      <TH width="30%">标题</TH>
      <TH width="10%">投票数</TH>
      <TH width="10%">查看数</TH>
      <TH width="10%">评论数</TH>
      <TH width="20%">最后更新</TH>
    </TR>
<?php

    get_mutex();
    if (0!=open_database())
    {
        put_mutex();
        die("<H1>open database failed.</H1>");
    }

    $result = $file_db->query("select * from subject order by create_time desc");

    $cnt=0;
    if (!is_bool($result))
    foreach($result as $row) 
    {
        $cnt=$cnt+1;
        $id_subject=(int)$row['id_subject'];
        echo "<TR>";
        echo "<TD>".$cnt."</TD>";
        echo "<TD><a href='vote_ui.php?id_subject=".$id_subject."'>".$row['subject']."</a></TD>";
        echo "<TD>".$row['vote_cnt']."</TD>";
        echo "<TD>".$row['view_cnt']."</TD>";
        echo "<TD>".$row['comment_cnt']."</TD>";
        echo "<TD>".user_time($row['last_update_time'])."</TD>";


        echo "</TR>";
    }
    put_mutex();
?>
  </TBODY>
</TABLE>

<?php
    if ($cnt==0)
    {
        echo "<H1>暂无任何投票</H1>";
    }
?>

<script>
print_bottom();
</script>

</body>
</html>
