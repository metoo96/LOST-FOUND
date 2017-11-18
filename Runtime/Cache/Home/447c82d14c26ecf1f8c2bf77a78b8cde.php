<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>南苑校园失物招领</title>
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
		  <h4><span class="glyphicon glyphicon-list-alt"></span> 所有失物详情模块</h4>
		</div>
		              <li class="list-group-item listItems">
		                 <img src="/lost_found/Public/<?php echo ($row['thumb_img']); ?>" alt="失物招领" id='img' class="min"  style="border:3px solid gray;border-radius:2px;text-align:center;">  <!--失物的缩略图-->
		                    <p  class="text-warning">(点击图片可放大)</p>
		                 </li>
		        
					  	<font style="color:#666">

					  	    
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

		   				 <script type="text/javascript">
							$('#img').click(function(){
							            $(this).toggleClass('min');
							            $(this).toggleClass('max');
							            });
							</script>
     </body>

</html>