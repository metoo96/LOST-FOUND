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
	</head>
	<body>
		<div style="margin-top:5px;">
    <span class="badge" style="color:white;background-color:red;">最新的五条失物信息New</span></a>
    <table class="table table-striped">
    <tbody>
		  <?php if(is_array($list)): foreach($list as $key=>$l): ?><tr>
                      <td>
                       <a  href="<?php echo U('Home/AllLost/lostDetail',array('lost_id'=>$l['lost_id']));?>" style="text-decoration:none;">
                       <img src="/lost_found/Public/<?php echo ($l['thumb_img']); ?>" alt="失物招领" width="50" height="50" style="border:3px solid gray;border-radius:2px;">  <!--失物的缩略图-->
                       </a>
                      </td>
                      <td>
                      <a  href="<?php echo U('Home/AllLost/lostDetail',array('lost_id'=>$l['lost_id']));?>" style="text-decoration:none;">
                      <font style="color:#666">
                      <span class="badge" style="color:white;background-color:red;">New</span></a>
                      失物人的学号:<?php echo ($l['lost_number']); ?>
                      失物人的姓名:<?php echo ($l['lost_name']); ?>
                      失物类型:<?php echo ($l['lost_type']); ?>
                      <i class="glyphicon glyphicon-time"></i>失物时间:<?php echo date('Y-m-d',$l['time']); ?>
                       </font>
                       </a>
                       </td>
                      <td> 
                          <a  href="<?php echo U('Home/AllLost/lostDetail',array('lost_id'=>$l['lost_id']));?>" style="text-decoration:none;"><i class="glyphicon glyphicon-chevron-right" style="font-size:28px;"></i>
                          </a>
                      </td>
                    </tr><?php endforeach; endif; ?>	
       </tbody>
      </table>
     </div>

            <div style="visibility:hidden;display:none">
               <div id="searchLostByType">
               <?php echo U('Home/AllLost/searchLostByType');?>
               </div>
            </div>
            <script type="text/javascript">


            
                    //点击提交按钮时进行提交
                     var search = function(){
                        var data = {
                           type:$('#tyle').val()
                        }
                        $.ajax({
                           url:$('#searchLostByType').html(),
                           type:'post',
                           data:data,
                           //请求成功
                           success:function(){
                             alert("成功");
                           },
                           //请求失败
                           error:function(){
                              alert('网络错误');
                           }
                        })
                     }
                

            </script>
	</body>
</html>