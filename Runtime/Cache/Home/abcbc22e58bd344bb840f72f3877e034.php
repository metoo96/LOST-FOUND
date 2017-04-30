<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title>
个人失物新建报失
</title>
</head>
<body style="margin:10px auto;">
<h1>个人失物报失详情</h1>
<hr>
  <table style="margin:10px auto;"> 
      <tr style="display:none">
      <td>
       <input type="text" id="id" value="<?php echo ($row['lost_id']); ?>">
      </td>
      </tr>
      <tr>
      <td>
      <label><span>失物人的学号：</span></label>
      <input type="text" name="lost_number" value="<?php echo ($row['lost_number']); ?>" id="number" disabled="true"size="30"/>
      </td>
      </tr>
      <tr>
      <td>
      <label><span>失物人的姓名: </span></label>
      <input type="text" name="lost_name" value="<?php echo ($row['lost_name']); ?>" disabled="true" size="30" />
      </td>
      </tr>
      <tr>
      <td>
      <label><span>如需修改备注信息,请修改备注信息后点击修改按钮</span></label>
      </td>
      </tr>
      <tr>
      <td>
      <label><span>失物人的备注信息:</span></label>
      <textarea name="lost_desc" id="lostdesc"/><?php echo ($row['lost_desc']); ?> </textarea>
      </td>
      </tr>
      <tr>
         <td>
         <button onclick="changeDesc()">修改</button>
         </td>
      </tr>
      <tr>
      <td>
      <h1 style="color:red"><?php echo ($result); ?></h1>
      </td>
      </tr>
 </table>
   <div style="visibility:hidden;display:none">
         <div id="getLostDescAjax">
            <?php echo U('Home/Personal/lostdetailAjax');?>
         </div>
  </div>
<button onclick="back()" >返回</button>
<button onclick="fullMsg()" >个人信息</button>
<button onclick="lostlist()" >我的报失</button>
<button onclick="lostadd()" >新建报失</button>
<div style="visibility:hidden;display:none">
<div id="personallist">
<?php echo U('Home/Personal/lostlist');?>
</div>
<div id="fullMsg">
<?php echo U('Home/User/fullMsg');?>
</div>
<div id="personallostlist">
<?php echo U('Home/Personal/lostlist');?>
</div>
<div id="personallostadd">
<?php echo U('Home/Personal/lostadd');?>
</div>
</div>
      <script type="text/javascript" src="/campus/Public/js/jquery-2.2.4.min.js"></script>
      <script type="text/javascript" src="/campus/Public/js/bootstrap.min.js"></script>
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




      var back = function(){
         window.location.href = $('#personallist').html();
      }
      var fullMsg = function(){
         window.location.href = $('#fullMsg').html();
      }
      var lostlist = function(){
         window.location.href = $('#personallostlist').html();
      }
      var lostadd = function(){
         window.location.href = $('#personallostadd').html();
      }
         </script>
</body>
</html>