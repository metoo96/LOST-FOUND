<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title>失物招领列表</title>
</head>
<body>
<h1>
个人失物失物列表
</h1>
<hr>
<table style="width:800px ;border:1px solid gray; border-radius:5px;">
<?php if(is_array($list)): foreach($list as $key=>$list): ?><tr>
<td>
<a href="<?php echo U('Home/personal/lostdetail',array('lost_id'=>$list['lost_id']));?>" style="text-decoration:none;"><?php echo ($list['lost_name']); ?></a>
</td>
</tr><?php endforeach; endif; ?>
</table>
<form  method="post" action="<?php echo U('Home/AllLost/lostlist');?>">
<select name="p">
<?php for($i=1;$i<=($count/5+1);$i++){?>
<option>
<?php echo $i; ?>
</option>
<?php }?>
</select>
<input type="submit" value="跳转">
</form>
<p>
<?php echo ($page); ?>
</p>
<button onclick="back()" >返回</button>
<button onclick="fullMsg()" >个人信息</button>
<button onclick="lostlist()" >我的报失</button>
<button onclick="lostadd()" >新建报失</button>
<div style="visibility:hidden;display:none">
<div id="personalindex">
<?php echo U('Home/Personal/index');?>
</div>
<div id="fullMsg">
<?php echo U('Home/User/fullMsg');?>
</div>
<div id="personallostlist">
<?php echo U('Home/Personal/lostlist');?>
</div>
<div id="personallostadd">
<?php echo U('Home/Personal/lostadd');?>
</div>
</div>
  <script type="text/javascript" src="/campus/Public/js/jquery-2.2.4.min.js"></script>
		<script type="text/javascript" src="/campus/Public/js/bootstrap.min.js"></script>
		<script type="text/javascript">
		var back = function(){
			window.location.href = $('#personalindex').html();
		}
		var fullMsg = function(){
			window.location.href = $('#fullMsg').html();
		}
		var lostlist = function(){
			window.location.href = $('#personallostlist').html();
		}
		var lostadd = function(){
			window.location.href = $('#personallostadd').html();
		}

</script>
</body>
</html>