<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
<title>
</title>
</head>
<body>
<div style="margin:0px;text-align:center;background:#F4DBB5">
     <div style="margin:0px;width:100%;height:50px"><h1>所有失物订单详情</h1></div>
</div>
<div>
		<div style="width:20%;height:650px;float:left;background:#BBBBBB">
		<button onclick="pendingorder()" >待审核失物订单</button>
		<button onclick="onlineorder()" >上线失物订单</button>
		<button onclick="allorder()" >所有失物订单</button>
		<button onclick="pfindadd()" >注销</button>
		</div>
		<div style="width:80%;height:650px;float:right;background:#8EE9E9">
		<table style="width:100%;background:#E6E6E6">
		<tr>
		    <td>
		     编号:
			</td>
			<td>
			<?php echo ($row['lost_id']); ?>
			</td>
		</tr>
		<tr>
			<td>
			失物人学号:
			</td>
			<td>
			<?php echo ($row['lost_number']); ?>
			</td>
		</tr>
		<tr>
			<td>
			失物人姓名:
			</td>
			<td>
			<?php echo ($row['lost_name']); ?>
			</td>
		</tr>
		<tr>
			<td>
			失物人备注：
			</td>
			<td>
			<?php echo ($row['lost_desc']); ?>
			</td>
		</tr>
		<tr>
			<td>
			失物类型:
			</td>
			<td>
			<?php echo ($row['lost_type']); ?>
			</td>
		</tr>
		<td>
			失物人备注:
			</td>
			<td>
			<?php echo ($row['lost_mobile']); ?>
			</td>
		</tr>
		</table>
		</div>
</div>
<div style="visibility:hidden;display:none">
<div id="pendingorder">
<?php echo U('Admin/Admin/pendingOrder');?>
</div>
<div id="onlineorder">
<?php echo U('Admin/Admin/onlineOrder');?>
</div>
<div id="allorder">
<?php echo U('Admin/Admin/allOrder');?>
</div>
<div id="personalfindadd">
<?php echo U('Home/Personal/findadd');?>
</div>
<div id="allorderdetail">
<?php echo U('Admin/Admin/allOrderDetail');?>
</div>
</div>
	    <script type="text/javascript" src="/campus/Public/js/jquery-2.2.4.min.js"></script>
		<script type="text/javascript" src="/campus/Public/js/bootstrap.min.js"></script>
		<script type="text/javascript">
		var pendingorder = function(){
			window.location.href = $('#pendingorder').html();
		}
		var onlineorder = function(){
			window.location.href = $('#onlineorder').html();
		}
		var allorder = function(){
			window.location.href = $('#allorder').html();
		}
		var pfindadd = function(){
			window.location.href = $('#personalfindadd').html();
		}  
		</script>		
</body>
</html>