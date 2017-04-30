<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
<title>
<title>
</title>
</head>
<body>
<div style="margin:0px;text-align:center;background:#F4DBB5">
     <div style="margin:0px;width:100%;height:50px"><h1>已上线失物订单列表</h1></div>
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
			失物人学号
				</td>
				<td>
			失物人姓名
				</td>
				<td>
			失物人备注
				</td>
		   </tr>
			<?php if(is_array($list)): foreach($list as $key=>$l): ?><tr>
				<td>
				<?php echo ($l['lost_number']); ?>
				</td>
				<td>
				<?php echo ($l['lost_name']); ?>
				</td>
				<td>
				<?php echo ($l['lost_desc']); ?>
				</td>
				<td>
				<a href="<?php echo U('Admin/Admin/onlineOrderDetail',array('lost_id'=>$l['lost_id']));?>" style="text-decoration:none;">详情
				</a>
				</td>
			</tr><?php endforeach; endif; ?>
		</table>
		</div>
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