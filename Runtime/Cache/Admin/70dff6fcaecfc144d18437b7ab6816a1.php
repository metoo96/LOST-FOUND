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
     <div style="margin:0px;width:100%;height:50px"><h1>待审核失物订单详情</h1></div>
</div>
<div>
		<div style="width:20%;height:650px;float:left;background:#BBBBBB">
		<button onclick="pendingorder()" >待审核失物订单</button>
		<button onclick="onlineorder()" >上线失物订单</button>
		<button onclick="allorder()" >所有失物订单</button>
		<button onclick="logout()" >退出</button>
		</div>
		<div style="width:80%;height:650px;float:right;background:#8EE9E9">
		<table style="width:100%;background:#E6E6E6">
		 <tr style="display:none">
		       <td>
		       <input type="text" id="id" value="<?php echo ($row['lost_id']); ?>">
		      </td>
        </tr>
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
		<hr>
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
		<hr>
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
		<hr>
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
		<hr>
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
		<tr>
		<td>
		<hr>
		</td>
		</tr>
		<tr>
		<td>
			失物人手机:
			</td>
			<td>
			<?php echo ($row['lost_mobile']); ?>
			</td>
		</tr>
	    <tr>
		<td>
		<hr>
		</td>
		</tr>
		<tr>
			<td>
			提交时间:
			</td>
			<td>
			<?php echo date('Y-m-d',$row['time']); ?>
			</td>
		</tr>
		</table>
		<table>
		<tr>
		<td>
		<div style="margin-left:400px">
		<button onclick="edit()">
		通   过
		</button>
		</div>
		</td>
		<td>
		<div style="margin-left:150px;">
		<button onclick="del()">
		关   闭
		</button>
		</div>
		</td>
		</tr>
		</table>
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
<div id="logoutAjax">
<?php echo U('Admin/login/logoutAjax');?>
</div>
<div id="allorderdetail">
<?php echo U('Admin/Admin/allOrderDetail');?>
</div>
<div id="pendingorderdel">
<?php echo U('Admin/Admin/pendingOrderDelAjax');?>
</div>
<div id="pendingorderedit">
<?php echo U('Admin/Admin/pendingOrderEditAjax');?>
</div>
</div>
	    <script type="text/javascript" src="/lost_found/Public/js/jquery-2.2.4.min.js"></script>
		<script type="text/javascript" src="/lost_found/Public/js/bootstrap.min.js"></script>
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
		



		   //关闭操作
		   var del= function(){
		  var r=confirm("确定关闭？");
		  if (r==true)
		   {
            var data = {
               id:$('#id').val()
            }
            $.ajax({
               url:$('#pendingorderdel').html(),
               type:'post',
               data:data,
               //请求成功
               success:function(res){
                  if(res.success){
                      alert(res.msg);
                  }else {
                     alert(res.errmsg);
                  }
               },
               //请求失败
               error:function(){
                  alert('网络错误');
               }
            })
         }else{
		
		 }
		 }

           //通过操作
		   var edit= function(){
	      var r=confirm("确定通过？");
		  if (r==true)
		   {
            var data = {
               id:$('#id').val()
            }
            $.ajax({
               url:$('#pendingorderedit').html(),
               type:'post',
               data:data,
               //请求成功
               success:function(res){
                  if(res.success){
                      alert(res.msg);
                  }else {
                     alert(res.errmsg);
                  }
               },
               //请求失败
               error:function(){
                  alert('网络错误');
               }
            })
         }else{
		
		 }
		 }

	    var logout = function(){
		var r=confirm("确定退出该系统？");
		if(r==true){
			window.location.href = $('#logoutAjax').html();
		}else{
		
		}
	   }
		</script>		
</body>
</html>