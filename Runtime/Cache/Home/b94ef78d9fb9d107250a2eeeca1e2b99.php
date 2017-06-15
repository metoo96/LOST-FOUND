<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="/ACM/official/lost_found/Public/css/Basic.css">
<link rel="stylesheet" type="text/css" href="/ACM/official/lost_found/Public/css/select.css">
<link rel="stylesheet" type="text/css" href="/ACM/official/lost_found/Public/css/tableStyle.css">
<title>失物招领列表</title>
</head>
<body>
<h1>
个人失物失物列表
</h1>
  <div style="width:100%;height:5px">
       <div style="float:left;width:50%;height:5px;background-color:#FFFF00">
       </div>
       <div style="float:right;width:50%;height:5px;background-color:#22DD48">
       </div>
   </div>
<table class="imagetable">
<?php if(is_array($list)): foreach($list as $key=>$list): ?><tr>
<td>
失物学号：<?php echo ($list['lost_number']); ?>;
失物姓名: <?php echo ($list['lost_name']); ?>;
失物类型: <?php echo ($list['lost_type']); ?>;
失物时间: <?php echo date("Y-m-d",$list['time']);?>;
<a href="<?php echo U('Home/personal/lostdetail',array('lost_id'=>$list['lost_id']));?>" style="text-decoration:none;">详情</a>
</td>
</tr><?php endforeach; endif; ?>
<tr>
<td>
<form  method="post" action="<?php echo U('Home/Personal/lostlist');?>">
<label id="lblSelect">
<select name="p" id="selectStyle">
<?php for($i=1;$i<=($count/5+1);$i++){?>
<option>
<?php echo $i; ?>
</option>
<?php }?>
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
  <script type="text/javascript" src="/ACM/official/lost_found/Public/js/jquery-2.2.4.min.js"></script>
		<script type="text/javascript" src="/ACM/official/lost_found/Public/js/bootstrap.min.js"></script>
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