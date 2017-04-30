<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title>
Document
</title>
</head>
<body>
<form action="<?php echo U('Home/User/login');?>" method="post" >
     <input type="text" value="" name="mobile" size="30" /><br>
     <input type="text" value="" name="code" size="10" />
     <input type="button" value="获取验证码" /><br>
     <input type="submit" value="提交" />
</form>
</body>
</html>