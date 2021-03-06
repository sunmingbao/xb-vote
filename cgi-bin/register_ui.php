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
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script src="../scripts/print_bottom.js"> </script>
<link rel="stylesheet" href="../css/haha.css" type="text/css" charset="utf-8"/>
<title>新用户注册</title>

<script language="javascript">

function str_is_number(str){
    var len=str.length;
    var i=0;
    var digits="0123456789";
    for (i=0; i<len; i++) {
        var one_char = str.charAt(i) ;
        if (digits.indexOf(one_char)<0)
            return (false);
    }

    return (true);
}

function stuff_id_ok(theForm){
        var stuff_id = theForm.stuff_id.value;

	if (stuff_id.replace(/(^\s*)|(\s*$)/g, "") == ""){
		alert("工号不能为空！");
		theForm.stuff_id.focus();   
		return (false);
	}

	if (stuff_id.length != 8){
		alert("工号长度必须为8位");
		theForm.stuff_id.focus();   
		return (false);   
	}

	if (!str_is_number(stuff_id)){
		alert("工号必须是数字");
		theForm.stuff_id.focus();   
		return (false);   
	}

        var first_char = stuff_id.charAt(0);
	if (first_char != '0' && first_char != '1'){
		alert("工号必须以0或1开头");
		theForm.stuff_id.focus();   
		return (false);   
	}

        return (true);
}

function chk(theForm){
	if (theForm.user_name.value.replace(/(^\s*)|(\s*$)/g, "") == ""){
		alert("帐号不能为空！");
		theForm.user_name.focus();   
		return (false);   
	}
	
	if (theForm.password.value.replace(/(^\s*)|(\s*$)/g, "") == ""){
		alert("密码不能为空！");
		theForm.password.focus();   
		return (false);   
	}	
	
	if (theForm.password.value != theForm.pass.value){
		alert("两次输入密码不一样！");
		theForm.pass.focus();   
		return (false);   
	}
		 
	if (theForm.real_name.value.replace(/(^\s*)|(\s*$)/g, "") == ""){
		alert("真实姓名不能为空！");   
		theForm.real_name.focus();   
		return (false);   
	}


	if (theForm.real_name.value.replace(/[\u4e00-\u9fa5]/g, "")){
		alert("真实姓名必须为中文！");   
		theForm.real_name.focus();   
		return (false);   
	}


        return stuff_id_ok(theForm); 
}
</script>

</head>

<body>

<?php print_hdr(); ?>
<center><H1>新用户注册</H1></center>

<form id="theForm" name="theForm" method="post" action="register.php" onSubmit="return chk(this)" runat="server" style="margin-bottom:0px;">
  <table width="60%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
    <tr>
      <td colspan="2" bgcolor="#EBEBEB"><center>以下打“<font color="#FF0000">*</font>”为必填项</center></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">用&nbsp;户&nbsp;名:</td>
      <td bgcolor="#FFFFFF"><input name="user_name" type="text"  size="20" maxlength="20" />
      <font color="#FF0000"> *</font>(字母开头，由字母或数字组成)</td>
    </tr>

    <tr>
      <td align="right" bgcolor="#FFFFFF">密&nbsp;&nbsp;&nbsp;码:</td>
      <td bgcolor="#FFFFFF"><input name="password" type="password" size="20" maxlength="20" />
      <font color="#FF0000"> *</font>(由数字或字母组成)</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">确认密码:</td>
      <td bgcolor="#FFFFFF"><input name="pass" type="password" size="20" maxlength="20" />
      <font color="#FF0000"> *</font>(再次输入密码)</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">真实姓名:</td>
      <td bgcolor="#FFFFFF"><input name="real_name" type="text" size="20" />
      <label><font color="#FF0000">*</font></label></td>
    </tr>

    <tr>
      <td align="right" bgcolor="#FFFFFF">工号(中兴员工):</td>
      <td bgcolor="#FFFFFF"><input name="stuff_id" type="text" size="20" value="00000000" />
      </td>
    </tr>

    <tr>
      <td align="right" bgcolor="#FFFFFF">性&nbsp;&nbsp;&nbsp;别:</td>
      <td align="left" bgcolor="#FFFFFF">
        <select style="WIDTH: 50px" name="sex" >   
        <option value="男">男</option>
        <option value="女">女</option>
      </select> 
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">电话:</td>
      <td bgcolor="#FFFFFF"><input name="member_phone" type="text"  size="20"/></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">电子邮箱:</td>
      <td bgcolor="#FFFFFF"><input name="member_email" type="text" size="20"/></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#FFFFFF"><center><input type="reset" name="button" id="font_button" value="重置" />
      <input type="submit" name="submit" id="font_button" value="注册" /></center></td>
    </tr>
  </table>
</form>

<script>
print_bottom();
</script>

</body>
</html>
