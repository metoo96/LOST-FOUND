<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title>失物招领列表</title>
</head>
<body>
<h1>
南苑校园所有失物列表
</h1>
<hr>
</body>
<table style="width:800px ;border:1px solid gray; border-radius:5px;">
<?php if(is_array($list)): foreach($list as $key=>$list): ?><tr>
<td>
<a href="<?php echo U('Home/AllLost/lostdetail',array('lost_id'=>$list['lost_id']));?>" style="text-decoration:none;"><?php echo ($list['lost_name']); ?></a>
</td>
</tr>
<tr>
<td><?php endforeach; endif; ?>
<form method="post" action="<?php echo U('Home/AllLost/lostlist');?>">
<select name="p" selected="p">
<?php for($i=1;$i<=($count/5+1);$i++){?>
<option><?php echo $i; ?></a></option>
<?php } ?>
</select>
<input type="submit" value="跳转">
</form>
</td>
<td>
<p>
<?php echo ($page); ?>
</p>
</td>
</tr>
</table>
<button onclick="fullMsg()" >个人信息</button>
<button onclick="alllost()" >所有失物</button>
<button onclick="pindex()" >个人失物</button>
<button onclick="pfindadd()" >捡到失物</button>
</div>
<div style="visibility:hidden;display:none">
<div id="fullMsg">
<?php echo U('Home/User/fullMsg');?>
</div>
<div id="alllost">
<?php echo U('Home/AllLost/lostlist');?>
</div>
<div id="personalindex">
<?php echo U('Home/Personal/index');?>
</div>
<div id="personalfindadd">
<?php echo U('Home/Personal/findadd');?>
</div>
</div>
	    <script type="text/javascript" src="/campus/Public/js/jquery-2.2.4.min.js"></script>
		<script type="text/javascript" src="/campus/Public/js/bootstrap.min.js"></script>
		<script type="text/javascript">
		var fullMsg = function(){
			window.location.href = $('#fullMsg').html();
		}
		var alllost = function(){
			window.location.href = $('#alllost').html();
		}
		var pindex = function(){
			window.location.href = $('#personalindex').html();
		}
		var pfindadd = function(){
			window.location.href = $('#personalfindadd').html();
		}

</script>
</body>
</html>