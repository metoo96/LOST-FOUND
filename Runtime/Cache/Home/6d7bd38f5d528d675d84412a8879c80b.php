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
            <div style="margin-bottom:100px">
		<div class="page-header">
		  <h4><i class="glyphicon glyphicon-th-list"></i> 所有失物模块</h4>
      <form action="<?php echo U('Home/AllLost/searchLostByType');?>" method="post">
		  <div class="input-group col-md-3" style="margin-top:0px positon:relative"> 
              <select class="form-control" name="type" id="tyle">
                        <option value ="校园卡">校园卡</option>
                        <option value ="学生证">学生证</option>
                        <option value="书包">书包</option>
                        <option value="钱包">钱包</option>
                        <option value="书本">书本</option>
                        <option value="手机">手机</option>
                        <option value="电脑">电脑</option>
                        <option value="其它">其它</option>
                        </select>
               <span class="input-group-btn">  
               <input type="submit" value="查找" class="btn btn-info btn-search" >
               </span>  
        </div>
        </form>  
		</div>
   <span class="badge"><?php echo ($count); ?>条记录</span> 
	 <table class="table table-striped">
    <tbody>
      <?php if(is_array($list)): foreach($list as $key=>$l): ?><tr>
                      <td> 
                        <a  href="<?php echo U('Home/AllLost/lostDetail',array('lost_id'=>$l['lost_id']));?>"  style="text-decoration:none">   
                      <img src="/lost_found/Public/<?php echo ($l['thumb_img']); ?>" alt="失物招领" width="50" height="50" style="border:3px solid gray;border-radius:2px;">  <!--失物的缩略图-->
                       </a>
                      </td>
                      <td>
                       <a  href="<?php echo U('Home/AllLost/lostDetail',array('lost_id'=>$l['lost_id']));?>" style="text-decoration:none">   
                      <font style="color:#666">
                       <i class="glyphicon glyphicon-list-alt"></i>失物人的学号:<?php echo ($l['lost_number']); ?>
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
 
					  	
		  <form method="post" action="<?php echo U('Home/AllLost/searchLostByType');?>">
          <label id="lblSelect">
          <div  style="visibility:hidden;display:none">
          <input name="type" value="<?php echo ($type); ?>"/>
          </div>
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