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

    if(!isset($_GET['id_subject'])) 
    {
        die("<H1>invalid id_subject.</H1>");
    }
    $id_subject=(int)$_GET['id_subject'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script src="/scripts/print_bottom.js"> </script>
<link rel="stylesheet" href="/css/haha.css" type="text/css" charset="utf-8"/>
<title>投票页</title>


<script language="javascript">
function chk(theForm)
{
        if (theForm.multi_select.value == "0")
        { 
            return (true); 
        } 
 
        var sum=0;
var x = document.getElementsByName("option[]");
        for(var i=0;i <x.length;i++)
        {
            if(x[i].checked==true)
              sum=sum+1;
        }

	if (sum == 0){
		alert("必须至少选择一个");
		return (false);   
	}

        return (true); 
}

function chk_comment(theForm){
	if (theForm.comment.value.replace(/(^\s*)|(\s*$)/g, "") == ""){
		alert("评论内容不能为空！");
		theForm.comment.focus();   
		return (false);   
	}		
	
        return (true); 
}
</script>

</head>

<body <?php if (isset($_GET['scroll2bottom'])) echo "onload='scroll(0,document.body.scrollHeight)'"; ?> >

<?php print_hdr(); ?>

<?php
    get_mutex();
    if (0!=open_database())
    {
        put_mutex();
        die("<H1>open database failed.</H1>");
    }

    $file_db->exec("update subject set view_cnt=view_cnt+1 where id_subject=".$id_subject);

    $query_str="select * from option as o cross join subject as s cross join user as u where ";
    $query_str=$query_str." o.id_subject=".$id_subject;
    $query_str=$query_str." and o.id_subject=s.id_subject and s.id_user=u.id_user order by o.id_option asc ";
//echo $query_str;
    $result = $file_db->query($query_str);

    $cnt=0;
    foreach($result as $row) 
    {
        $cnt=$cnt+1;
        $subject=$row['subject'];
        $multi_select=$row['multi_select'];
        $author=$row['real_name'];
    }

    if ($cnt==0)
    {
        put_mutex();
        die("<H1>没有查到任何内容。参数输错了？？？</H1>");
    }

  echo "<h1>".$subject."</h1>";
  echo "<h3>(创建者:".$author.")</h3>";
?>

  <form action="vote.php" method="post" onSubmit="return chk(this)">
  <input type="hidden" name="id_subject" <?php  echo  "value='".$id_subject."'"; ?> >
  <input type="hidden" name="multi_select" <?php  echo  "value='".$multi_select."'"; ?> >
      <table cellSpacing=0 cellPadding=0 width="50%"  border=0>

        <tr>
          <th width="50%">选项</th><th>得票数</th>
        </tr> 

<?php
  $result = $file_db->query($query_str);
  foreach($result as $row) 
{
    echo "<tr>";
    echo "<td>";
    if ($row['multi_select']==1)
        echo "<input type='checkbox' name='option[]' value='".$row['id_option']."' >";
    else
        echo "<input type='radio' name='option' value='".$row['id_option']."' checked='true'>";

    echo $row['option_name'];
    echo "</td>";
    echo "<td>";
    echo $row['select_cnt'];
    echo "</td>";
    echo "</tr>";
}			  
?>


  </table>
 <input type="submit" value="投票">
</form>

<br>
已投者:
<?php
    $query_str="select * from vote as v  cross join subject as s cross join user as u  where ";
    $query_str=$query_str." v.id_subject=".$id_subject;
    $query_str=$query_str." and v.id_user=u.id_user group by v.id_user order by v.vote_time asc ";
  $result = $file_db->query($query_str);

$cnt=0;
  foreach($result as $row) 
  {
    $cnt++;
    echo $row['real_name']."&nbsp;";

  }
	  
?>

<h1>评论</h1>
  <form action="comment.php" method="post" onSubmit="return chk_comment(this)">
  <input type="hidden" name="id_subject" <?php  echo  "value='".$id_subject."'"; ?> >
  <input type="hidden" name="multi_select" <?php  echo  "value='".$multi_select."'"; ?> >
<textarea name="comment" id="descript" cols="60" rows="5"></textarea>
<br>
 <input type="submit" value="发表评论">
</form>
<br>

<?php
    $query_str="select * from comment as c  cross join user as u where ";
    $query_str=$query_str." c.id_subject=".$id_subject;
    $query_str=$query_str." and c.id_user=u.id_user  order by c.comment_time asc ";
  $result = $file_db->query($query_str);
put_mutex();
$cnt=0;
  foreach($result as $row) 
  {
    $cnt++;
    echo "<hr><br>".$cnt."楼 &nbsp;&nbsp;".$row['real_name']."&nbsp;&nbsp;&nbsp;&nbsp;".user_time($row['comment_time'])."<br>".$row['comment']."<br>";

  }
	  
?>

<script>
print_bottom();
</script>

</body>
</html>
