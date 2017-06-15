<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title>
个人失物新建报失
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" type="text/css" href="/ACM/official/lost_found/Public/css/select.css">
<link rel="stylesheet" type="text/css" href="/ACM/official/lost_found/Public/css/LostAdd.css">
</head>
<body style="margin:10px auto;">
<h1>个人失物新建报失</h1>
  <div style="width:100%;height:5px">
       <div style="float:left;width:50%;height:5px;background-color:#FFFF00">
       </div>
       <div style="float:right;width:50%;height:5px;background-color:#22DD48">
       </div>
   </div>
  <table style="margin:10px auto;"> 
      <tr>
      <td>
      <label ><span id="firstTitle">类型：</span></label>
      <label id="lblSelect">
      <select id="selectStyle">
      <option value ="校园卡">校园卡</option>
      <option value ="学生证">学生证</option>
      <option value="书包">书包</option>
      <option value="钱包">钱包</option>
      <option value="书本">书本</option>
      <option value="手机">手机</option>
      <option value="电脑">电脑</option>
      </select>
      </label>
      </td>
      </tr>
      <tr>
      <td>
      <label><span >学号：</span></label>

      <input type="text"  id="number" size="30"/>
      </td>
      </tr>
      <tr>
      <td>
      <label><span>姓名：</span></label>
      <input type="text"  id="name" size="30" />
      </td>
      </tr>
      <tr>
      <td>
      <label><span>备注信息：</span></label>
      <textarea  id="desc" placeholder="失物外形、时间、地点..." /></textarea>
      </td>
      </tr>
         <td>
         <br>
         <button onclick="personallostadd()">提交</button>
         </td>
      </tr>
 </table>
  <div style="width:100%;height:5px">
       <div style="float:right;width:50%;height:5px;background-color:#FFFF00">
       </div>
       <div style="float:left;width:50%;height:5px;background-color:#22DD48">
       </div>
   </div>
<div style="visibility:hidden;display:none">
         <div id="personallostaddAjax">
         <?php echo U('Home/Personal/lostaddAjax');?>
         </div>
</div>
<button onclick="back()" >返回</button>
<button onclick="fullMsg()" >个人信息</button>
<button onclick="lostlist()" >我的报失</button>
<button onclick="lostadd()" >新建报失</button>
<div style="visibility:hidden;display:none">
<div id="personalindex">
<?php echo U('Home/Personal/index');?>
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
      <script type="text/javascript" src="/ACM/official/lost_found/Public/js/jquery-2.2.4.min.js"></script>
      <script type="text/javascript" src="/ACM/official/lost_found/Public/js/bootstrap.min.js"></script>
      <script type="text/javascript">


            //点击提交按钮时进行提交
         var personallostadd = function(){
            var data = {
               type:$('#selectStyle').val(),
               name:$('#name').val(),
               number:$('#number').val(),
               desc:$('#desc').val()
            }
            $.ajax({
               url:$('#personallostaddAjax').html(),
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
         window.location.href = $('#personalindex').html();
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