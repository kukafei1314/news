<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo base_url('static/style/style.css'); ?>" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="div_bg">
<center>
<form class="login" id="form1" name="form1" method="post" action="<?php echo base_url('/home_g/ulogin');?>">
  <p>用户名：<input name="username" type="text" id="username" size="25" />
  </p>
  <p>密&nbsp;&nbsp;码：<input name="pwd" type="password" id="pwd" size="25" />
  </p>
  <p>
    &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="sub" id="sub" value="提交" />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="location='/home_g/reg'" name="register" id="register" value="注册" />
  </p>
</form>
</center>
</div>
</body>
</html>