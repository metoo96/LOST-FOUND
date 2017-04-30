<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title>
个人信息
</title>
</head>
<body style="margin:10px auto;">
<h1>个人信息</h1>
<hr>
<form  action="<?php echo U('Home/personal/lostadd');?>" method="post">
  <table style="margin:10px auto;"> 
      <tr>
      <td>
      <label><span>学号：</span></label>
      <input type="text" name="lost_number" size="30"/>
      </td>
      </tr>
      <tr>
      <td>
      <label><span>姓名: </span></label>
      <input type="text" name="lost_name" size="30" />
      </td>
      </tr>
      <tr>
      <td>
      <label><span>手机号: </span></label>
      <input type="text" name="lost_name" size="30" />
      </td>
      </tr> 
      <tr>
      <td><span>如需更换号码请点击验证码按钮</span></td>
      <td><input type="button" value="获取验证码"></td>
      </tr>
      <tr>  
         <td>
         <input type="submit" value="提交">
         </td>
      </tr>
 </table>
  </form>
</body>
</html>