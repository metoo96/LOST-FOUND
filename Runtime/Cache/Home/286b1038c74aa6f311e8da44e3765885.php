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
      
      <div class="page-header">
        <h4><i class="glyphicon glyphicon-edit"></i> 捡到失物模块</4>
      </div>       
                  <font style="color:#666">
                        <div class="form-group">
                        <label>失物者学号:</label>
                        <input class="form-control" type="number" id="lostnumber" placeholder="未知填 0" size="20" />
                        </div>
                        <div class="form-group">
                        <label><span>失物者姓名:</span></label>
                        <input class="form-control" type="text" id="lostname" placeholder="未知填 0" size="30"/>
                        </div>
                        <div class="form-group">
                        <label><span>失物类型: </span></label>
                        <label id="lblSelect">
                        </label>
                        </div>
                        <div class="form-group">
                        <select class="form-control" id="losttype">
                        <option value ="校园卡">校园卡</option>
                        <option value ="学生证">学生证</option>
                        <option value="书包">书包</option>
                        <option value="钱包">钱包</option>
                        <option value="书本">书本</option>
                        <option value="手机">手机</option>
                        <option value="电脑">电脑</option>
                        <option value="其它">其它</option>
                        </select>
                        </label>
                        </div>
                        <div class="form-group">
                        <label><span>失物备注信息:</span></label>
                        <textarea class="form-control" rows="4" id="lostdesc" placeholder="拾到物品的过程、物品的特征、或别的任何有助于找回失物的信息都可以输入......" /></textarea>
                        </div>
                        <div class="form-group">
                        <label><span>拾物者学号:</span></label>
                        <input class="form-control" type="number" id="findnumber" size="30" />
                        </div>
                        <div class="form-group">
                        <label><span>拾物者姓名: </span></label>
                        <input class="form-control" type="text" id="findname" size="30" />
                        </div>
                        <div class="form-group">
                        <label><span>拾物者备注信息:</span></label>
                        <textarea class="form-control" rows="2" id="finddesc" /></textarea>
                        </div>
              <div align="left" style="margin-bottom: 1em;margin-top:20px;">
              <button   class ="form-control btn btn-primary" onclick="findadd()">
                 提交拾物表单
              </button>
             </div>
            </font>
           
               

            <div style="visibility:hidden;display:none">
               <div id="personalfindaddAjax">
               <?php echo U('Home/Personal/findaddAjax');?>
               </div>
               <div id="loginindex">
               <?php echo U('Home/User/temp');?>
               </div>
            </div>

            <script type="text/javascript">


             //点击提交按钮时进行提交
               var findadd = function(){
                  var data = {
                     lname:$('#lostname').val(),
                     lnumber:$('#lostnumber').val(),
                     ltype:$('#losttype').val(),
                     ldesc:$('#lostdesc').val(),
                     fname:$('#findname').val(),
                     fnumber:$('#findnumber').val(),
                     fdesc:$('#finddesc').val()
                  }
                  $.ajax({
                     url:$('#personalfindaddAjax').html(),
                     type:'post',
                     data:data,
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

            </script>
   </body>
</html>