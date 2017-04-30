<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	    <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
<title>
南苑校园失物招领系统后台
</title>
</head>
<body>
<div>
<div style="float:left; width:20%;height:650px;background:#BBBBBB">
<button onclick="pendingorder()" >待审核失物订单</button>
<button onclick="onlineorder()" >上线失物订单</button>
<button onclick="allorder()" >所有失物订单</button>
<button onclick="pfindadd()" >注销</button>
</div>
<div style="float:right; width:80%;height:650px;background:#B0BEF9">
<div style="text-align:center">
<h1 style="margin-top:200px;">南苑校园失物招领系统后台</h1>
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