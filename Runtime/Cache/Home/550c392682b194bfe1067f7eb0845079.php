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
        <h4><i class="glyphicon glyphicon-bookmark"></i>个人失物详情模块</h4>
      </div>
                   
               <li class="list-group-item listItems">
                       <img src="/lost_found/Public/<?php echo ($row['thumb_img']); ?>" alt="失物招领" id='img' class="min"  style="border:3px solid gray;border-radius:2px;text-align:center;">  <!--失物的缩略图-->
                          <p  class="text-warning">(点击图片可放大)</p>
               </li>
                  <font style="color:#666">
                     <div style="display:none">
                     <td>
                     <input type="text" id="id" value="<?php echo ($row['lost_id']); ?>">
                     </td>
                     </div>
                      <li class="list-group-item listItems">
                     失物人的学号: <?php echo ($row['lost_number']); ?>
                     <div style="display:none;visibility:hidden;">
                     <input disabled="true" class="form-control" type="text" id="number" value="<?php echo ($row['lost_number']); ?>">
                     </div>
                     </li>
                     <li class="list-group-item listItems">
                     失物人的姓名：<?php echo ($row['lost_name']); ?>
                     </li>
                     <li class="list-group-item listItems">
                     提交时间：<?php echo date('Y-m-d',$row['time']); ?>
                     </li>
                     <li class="list-group-item listItems">
                     失物类型:<?php echo ($row['lost_type']); ?>
                     </li>
                     <li class="list-group-item listItems">
                     失物是否找到：<?php if($row['mark']==1){ echo "是"; }else{ echo "否"; } ?>
                       </li>
                        <tr>
                        <td>
                        <label><span class="Msg">如有需要,可修改备注信息</span></label>
                        </td>
                        </tr>

                        <tr>
                        <td>
                        <label class="text-warning"><span>备注信息:</span></label>
                        <textarea class="form-control" name="lost_desc" id="lostdesc"/><?php echo ($row['lost_desc']); ?>
                        </textarea>
                        </td>
                        </tr>
               </font>

               <tr>
               <td>
               <label class="text-warning"><span>  </span></label>
               <button class="form-control btn-warning" onclick="changeDesc()">修改</button>
               </td>
               </tr>


               <div style="visibility:hidden;display:none">
                  <div id="getLostDescAjax">
                  <?php echo U('Home/Personal/lostdetailAjax');?>
                  </div>
                  <div id="loginindex">
                  <?php echo U('Home/Personal/index');?>
                  </div>
              </div>
              <script type="text/javascript">           

                     //点击提交按钮时进行验证
                  var changeDesc = function(){
                     var data = {
                        desc:$('#lostdesc').val(),
                        number:$('#number').val(),
                        id:$('#id').val()
                     }
                     $.ajax({
                        url:$('#getLostDescAjax').html(),
                        type:'post',
                        data:data,
                        //请求成功
                        success:function(res){
                           if(res.success){
                               alert(res.msg);
                               window.location.href = $('#loginindex').html();
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



      
                     $('#img').click(function(){
                                 $(this).toggleClass('min');
                                 $(this).toggleClass('max');
                                 });

                  </script>
     </body>
</html>