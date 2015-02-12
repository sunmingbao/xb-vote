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
    login_restrict();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script src="/scripts/print_bottom.js"> </script>
<link rel="stylesheet" href="/css/haha.css" type="text/css" charset="utf-8"/>

<title>创建新投票 - 小兵投票</title>

<script language="javascript">
function chk(theForm){
	if (theForm.subject.value.replace(/(^\s*)|(\s*$)/g, "") == ""){
		alert("标题不能为空！");
		theForm.user_name.focus();   
		return (false);   
	}
	
	if (theForm.option1.value.replace(/(^\s*)|(\s*$)/g, "") == ""){
		alert("选项1不能为空！");
		theForm.user_name.focus();   
		return (false);   
	}

	if (theForm.option2.value.replace(/(^\s*)|(\s*$)/g, "") == ""){
		alert("选项2不能为空！");
		theForm.user_name.focus();   
		return (false);   
	}

        return (true); 
}
</script>
</head>

<body>

    <?php  print_hdr(); ?>

<br>
<h2 align="center">创建新投票</h2>
<form id="theForm" name="theForm" method="post" action="new_vote.php" onSubmit="return chk(this)" runat="server" style="margin-bottom:0px;">
  <table width="60%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
    <tr>
      <td colspan="2" bgcolor="#EBEBEB"><center>打“<font color="#FF0000">*</font>”的为必填项</center></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">标题:</td>
      <td bgcolor="#FFFFFF"><input name="subject" type="text" id="subject" size="30" maxlength="30" />
      <font color="#FF0000"> *</font></td>
    </tr>

    <tr>
      <td align="right" bgcolor="#FFFFFF">允许多选:</td>
      <td bgcolor="#FFFFFF">
             <input  type="radio" name="multi_select" value ="1"   />是 &nbsp;&nbsp;&nbsp;&nbsp;
             <input  type="radio" name="multi_select" value ="0" checked="checked" />否
      </td>
    </tr>

    <tr>
      <td align="right" bgcolor="#FFFFFF">选项1:</td>
      <td bgcolor="#FFFFFF"><input name="option1" type="text" id="option1" size="30" maxlength="30" />
      <font color="#FF0000"> *</font></td>
    </tr>

    <tr>
      <td align="right" bgcolor="#FFFFFF">选项2:</td>
      <td bgcolor="#FFFFFF"><input name="option2" type="text" id="option2" size="30" maxlength="30" />
      <font color="#FF0000"> *</font></td>
    </tr>

    <tr>
      <td align="right" bgcolor="#FFFFFF">选项3:</td>
      <td bgcolor="#FFFFFF"><input name="option3" type="text" id="option3" size="30" maxlength="30" />
      </td>
    </tr>

    <tr>
      <td align="right" bgcolor="#FFFFFF">选项4:</td>
      <td bgcolor="#FFFFFF"><input name="option4" type="text" id="option4" size="30" maxlength="30" />
      </td>
    </tr>

    <tr>
      <td align="right" bgcolor="#FFFFFF">选项5:</td>
      <td bgcolor="#FFFFFF"><input name="option5" type="text" id="option5" size="30" maxlength="30" />
      </td>
    </tr>

    <tr>
      <td align="right" bgcolor="#FFFFFF">选项6:</td>
      <td bgcolor="#FFFFFF"><input name="option6" type="text" id="option6" size="30" maxlength="30" />
      </td>
    </tr>

    <tr>
      <td align="right" bgcolor="#FFFFFF">选项7:</td>
      <td bgcolor="#FFFFFF"><input name="option7" type="text" id="option7" size="30" maxlength="30" />
      </td>
    </tr>

    <tr>
      <td align="right" bgcolor="#FFFFFF">选项8:</td>
      <td bgcolor="#FFFFFF"><input name="option8" type="text" id="option8" size="30" maxlength="30" />
      </td>
    </tr>

    <tr>
      <td align="right" bgcolor="#FFFFFF">选项9:</td>
      <td bgcolor="#FFFFFF"><input name="option9" type="text" id="option9" size="30" maxlength="30" />
      </td>
    </tr>

    <tr>
      <td align="right" bgcolor="#FFFFFF">选项10:</td>
      <td bgcolor="#FFFFFF"><input name="option10" type="text" id="option10" size="30" maxlength="30" />
      </td>
    </tr>

    <tr>
      <td colspan="2" bgcolor="#FFFFFF"><center><input type="reset" name="button" id="button" value="重置" />
      <input type="submit" name="submit" id="submit" value="提交" /></center></td>
    </tr>
  </table>
</form>

<script>
print_bottom();
</script>


</body>
</html>
