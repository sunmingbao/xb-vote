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

    require './cgi-bin/common.php'; 
    user_name_restrict('root');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script src="/scripts/print_bottom.js"> </script>
<link rel="stylesheet" href="/css/haha.css" type="text/css" charset="utf-8"/>

<title>管理员主页</title>

</head>

<body>

    <?php print_hdr(); ?>

<br>
<br>
<TABLE cellSpacing=0 cellPadding=0 width="90%" align=center border=0>

<TBODY>

    <TR> 
      <TD><h1><a href="/cgi-bin/delete_vote_ui.php" target="_blank">删除投票</a></h1></TD>
    </TR>

    <TR> 
      <TD><h1><a href="/cgi-bin/delete_user_ui.php" target="_blank">删除用户</a></h1></TD>
    </TR>
</TBODY>
</TABLE>



<script>
print_bottom();
</script>

</body>
</html>
