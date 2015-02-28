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
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script src="/scripts/print_bottom.js"> </script>
<link rel="stylesheet" href="/css/haha.css" type="text/css" charset="utf-8"/>
<title>用户信息维护</title>

<script language="javascript">
function chk(theForm)
{
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

    return (true); 
}
</script>

</head>

<body>
<?php print_hdr(); ?>

<br>

<form id="theForm" name="theForm" method="post" action="modify_pass.php" onSubmit="return chk(this)" runat="server" style="margin-bottom:0px;">
  <table width="50%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
    <tr>
      <td colspan="2" bgcolor="#EBEBEB"><center>密码修改</center></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">新密码:</td>
      <td bgcolor="#FFFFFF"><input name="password" type="password" size="20" maxlength="20" />
      <font color="#FF0000"> *</font>(由数字或字母组成)</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">确认密码:</td>
      <td bgcolor="#FFFFFF"><input name="pass" type="password" size="20" maxlength="20" />
      <font color="#FF0000"> *</font>(再次输入密码)</td>
    </tr>

    <tr>
      <td colspan="2" align="center" bgcolor="#FFFFFF"><center>
      <input type="submit" name="submit" id="font_button" value="确定" /></center></td>
    </tr>
  </table>
</form>
<br><br><br>
<form id="theForm" name="theForm" method="post" action="modify_user.php" runat="server" style="margin-bottom:0px;">
  <table width="50%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
    <tr>
      <td colspan="2" bgcolor="#EBEBEB"><center>用户信息修改</center></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">真实姓名:</td>
      <td bgcolor='#FFFFFF'><input name='real_name' type='text'  size='20' value='<?php echo $_SESSION['real_name']; ?>' /></td>
      
    </tr>

    <tr>
      <td align="right" bgcolor="#FFFFFF">工号(中兴员工):</td>
      <td bgcolor="#FFFFFF"><input name="stuff_id" type="text" size="20" value="<?php echo $_SESSION['stuff_id']; ?>" />
      </td>
    </tr>

    <tr>
      <td align="right" bgcolor="#FFFFFF">性&nbsp;&nbsp;&nbsp;别:</td>
      <td align="left" bgcolor="#FFFFFF">
        <select style="WIDTH: 50px" name="sex" >   
        <option value="男" <?php if ($_SESSION['sex']=='男') echo  "selected='selected'"; ?> >男</option>
        <option value="女" <?php if ($_SESSION['sex']=='女') echo  "selected='selected'"; ?> >女</option>
      </select> 
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">电话:</td>
      <td bgcolor="#FFFFFF"><input name="member_phone" type="text" size="20" value='<?php echo $_SESSION['tel_no']; ?>' /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">电子邮箱:</td>
      <td bgcolor="#FFFFFF"><input name="member_email" type="text" size="20" value='<?php echo $_SESSION['email']; ?>' /></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#FFFFFF"><center>
      <input type="submit" name="submit" id="font_button" value="确定" /></center></td>
    </tr>
  </table>
</form>
<script>
print_bottom_user();
</script>

</body>
</html>
