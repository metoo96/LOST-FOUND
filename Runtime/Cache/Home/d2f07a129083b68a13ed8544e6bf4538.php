<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
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
		    body{
		    width:100%;
		    }
		</style>
	</head>
	<body>
           <div style="margin-bottom:100px">
		<div class="page-header">
		  <h4><i class="glyphicon glyphicon-asterisk"></i> 个人失物模块</h4>
		</div>

            <span class="badge"><?php echo ($count); ?>条记录</span> 
		    <div align="right" style="margin-bottom: 1em">
			<a href="<?php echo U('Home/Personal/lostadd');?>" class ="btn btn-primary">
		     <i class="glyphicon glyphicon-plus"></i> 新建个人报失
		    </a>
		    </div>

    
			 <table class="table table-striped">
			    <tbody>
					   <?php if(is_array($list)): foreach($list as $key=>$l): ?><tr>
			                      <td> 
			                       <a  href="<?php echo U('Home/Personal/lostDetail',array('lost_id'=>$l['lost_id']));?>" style="text-decoration:none"> 
			                      <img src="/lost_found/Public/<?php echo ($l['thumb_img']); ?>" alt="失物招领" width="50" height="50" style="border:3px solid gray;border-radius:2px;">  <!--失物的缩略图-->
			                      </a>
			                      </td>
			                      <td>
			                        <a  href="<?php echo U('Home/Personal/lostDetail',array('lost_id'=>$l['lost_id']));?>" style="text-decoration:none"> 
			                      <font style="color:#666">
			                        <i class="glyphicon glyphicon-list-alt"></i>失物人的学号:<?php echo ($l['lost_number']); ?>
			                      失物人的姓名:<?php echo ($l['lost_name']); ?>a
			                      失物类型:<?php echo ($l['lost_type']); ?>
			                       <i class="glyphicon glyphicon-time"></i>失物时间:<?php echo date('Y-m-d',$l['time']); ?>
			                       </font>
			                       </a>
			                       </td>
			                      <td> 
			                           <a  href="<?php echo U('Home/Personal/lostDetail',array('lost_id'=>$l['lost_id']));?>" style="text-decoration:none;"><i class="glyphicon glyphicon-chevron-right" style="font-size:28px;"></i>
							           </a>
			                      </td>
			                    </tr>
						       </a><?php endforeach; endif; ?>	
			       </tbody>
			      </table>

		
		
		 <h3><?php echo ($page); ?></h3>
		  <form method="post" action="<?php echo U('Home/Personal/index');?>">
          <label id="lblSelect">
          <select class="form-control" name="p" selected="p" id="selectStyle">
          <?php for($i=1;$i<=($count/10+1);$i++){?>
          <option><?php echo $i; ?></a></option>
          <?php } ?>
          </select>
          </label>
          <input class="btn btn-default" type="submit" value="跳转">
          </form>
       </div>

        <div style="visibility:hidden;display:none">
		<div id="pendingAllEdit">
		<?php echo U('Admin/Admin/pendingOrderAllEditAjax');?>
		</div>
		<div id="pendingAllDel">
		<?php echo U('Admin/Admin/pendingOrderAllDelAjax');?>
		</div>
		<div id="adminindex">
		<?php echo U('Admin/Admin/index');?>
		</div>
		</div>
		<script type="text/javascript">
	
		   //关闭操作
		   var Alldel= function(){
		      var r=confirm("确定全部关闭？");
             if (r==true)
             {
            $.ajax({
               url:$('#pendingAllDel').html(),
               //请求成功
               success:function(res){
                  if(res.success){
                      alert(res.msg);
                      window.location.href = $('#adminindex').html();
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
		 
		
        var Alledit=function ()
        {
        var r=confirm("确定全部通过？");
        if (r==true)
        {
               $.ajax({
               url:$('#pendingAllEdit').html(),
               //请求成功
               success:function(res){
                  if(res.success){
                      alert(res.msg);
                      window.location.href = $('#adminindex').html();
                  }else {
                     alert(res.errmsg);
                  }
               },
               //请求失败
               error:function(){
                  alert('网络错误');
               }
            })
        }
      else
        {
       
        }
        }
     </script>		

	</body>
</html>