<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="/lost_found/Public/css/Basic.css">
<link rel="stylesheet" type="text/css" href="/lost_found/Public/css/select.css">
<link rel="stylesheet" type="text/css" href="/lost_found/Public/css/tableStyle.css">

<title>失物招领列表</title>
</head>
<body>
<h1>
南苑校园所有失物列表
</h1>
 <div style="width:100%;height:5px">
       <div style="float:left;width:50%;height:5px;background-color:#FFFF00">
       </div>
       <div style="float:right;width:50%;height:5px;background-color:#22DD48">
       </div>
 </div>
</body>
<table class="imagetable">
<?php if(is_array($list)): foreach($list as $key=>$list): ?><tr>
<td>
<!--学号：<?php echo ($list['lost_number']); ?>;-->
姓名：<?php echo ($list['lost_name']); ?>;
失物类型：<?php echo ($list['lost_type']); ?>;
手机：<?php echo ($list['lost_mobile']); ?>;
提交时间：<?php echo date("Y-m-d",$list['time']);?>
<a href="<?php echo U('Home/AllLost/lostdetail',array('lost_id'=>$list['lost_id']));?>" style="text-decoration:none;">详情</a>
</td>
</tr>
<tr>
<td><?php endforeach; endif; ?>
<form method="post" action="<?php echo U('Home/AllLost/lostlist');?>">
<label id="lblSelect">
<select name="p" selected="p" id="selectStyle">
<?php for($i=1;$i<=($count/5+1);$i++){?>
<option><?php echo $i; ?></a></option>
<?php } ?>
</select>
</label>
<input type="submit" value="跳转">
</form>
</td>

</tr>
<tr>
<td>
<h3>
<?php echo ($page); ?>
</h3>
</td>
</tr>
</table>
 <div style="width:100%;height:5px">
       <div style="float:right;width:50%;height:5px;background-color:#FFFF00">
       </div>
       <div style="float:left;width:50%;height:5px;background-color:#22DD48">
       </div>
 </div>
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
	    <script type="text/javascript" src="/lost_found/Public/js/jquery-2.2.4.min.js"></script>
		<script type="text/javascript" src="/lost_found/Public/js/bootstrap.min.js"></script>
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