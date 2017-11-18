<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>lost_found</title>
		<link rel="stylesheet" type="text/css" href="/lost_found/Public/css/bootstrap.min.css">
		<script type="text/javascript" src="/lost_found/Public/js/jquery-2.2.4.min.js"></script>
		<script type="text/javascript" src="/lost_found/Public/js/bootstrap.min.js"></script>

		<style>
		.max{width:100%;height:200px;}
		.min{width:100px;height:100px;align:center;}
		</style>
	</head>
<body>
		
		<div class="page-header">
		  <h1>上线失物订单详情</h1>
		</div>

		        <ul class="list-group">
				  	<div class="row">
					  <div class="col-xs-7 col-sm-7 col-md-7">
					  	<font style="color:#666">
					  	<div style="visibility:none;display:none">
                            <input type="text" id="id" value="<?php echo ($row['lost_id']); ?>">
					  	</div>
					  	   <li class="list-group-item listItems">
                           <img src="/lost_found/Public/<?php echo ($row['thumb_img']); ?>" alt="失物招领" id='img' class="min"  style="border:3px solid gray;border-radius:2px;text-align:center;">
                           </li> 
					  	    <li class="list-group-item listItems">
						    失物编号：<?php echo ($row['lost_id']); ?>
						    </li>
						    <li class="list-group-item listItems">
							失物人的学号：<?php echo ($row['lost_number']); ?>
							</li>
							<li class="list-group-item listItems">
							失物人的姓名：<?php echo ($row['lost_name']); ?>
							</li>
							<li class="list-group-item listItems">
							提交时间：<?php echo date('Y-m-d',$row['time']); ?>
							</li>
							  <li class="list-group-item listItems">
							失物描述：<?php echo ($row['lost_desc']); ?>
							</li>
							  <li class="list-group-item listItems">
							失物类型:<?php echo ($row['lost_type']); ?>
							</li>
							<li class="list-group-item listItems">
							失物人手机：<?php echo ($row['lost_mobile']); ?>
							</li>
							<li class="list-group-item listItems">
							失物是否找到：<?php if($row['mark']==1){ echo "是"; }else{ echo "否"; } ?>
						    </li>
		   				 </font>
					  	<div style="width: 90%;margin-left: 5%">
						   
					  	</div>  
					  </div>
					</div>
		       </ul>
		        <div align="left" style="margin-bottom: 1em">
			    <a class="btn btn-danger" onclick="del()">
			    关闭订单
			    </a>
			    </div>
                
                <div style="visibility:hidden;display:none">
		        <div id="onlineorderdel">
				<?php echo U('Admin/Admin/onlineOrderDelAjax');?>
				</div>
				<div id="onlineorder">
				<?php echo U('Admin/Admin/onlineOrder');?>
				</div>
				</div>
				<script type="text/javascript">
 
			       var del= function(){
			       var r=confirm("确定关闭？");
			       if (r==true){

			            var data = {
			               id:$('#id').val()
			            }
			            $.ajax({
			               url:$('#onlineorderdel').html(),
			               type:'post',
			               data:data,
			               //请求成功
			               success:function(res){
			                  if(res.success){
			                      alert(res.msg);
			                      window.location.href = $('#onlineorder').html();
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


 
				$('#img').click(function(){
				            $(this).toggleClass('min');
				            $(this).toggleClass('max');
				            });
 
				</script>

</body>
</html>