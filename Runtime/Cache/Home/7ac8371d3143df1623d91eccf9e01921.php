<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>南苑校园失物招领</title>
		<link rel="stylesheet" type="text/css" href="/lost_found/Public/css/bootstrap.min.css">
		<!--页面下部的导航效果--start-->
		<link rel="stylesheet" type="text/css" href="/lost_found/Public/css/all1.css">
		<link rel="stylesheet" type="text/css" href="/lost_found/Public/css/base1.css">
		<!--页面下部的导航效果--end-->
		<link rel="Shortcut Icon" href="/lost_found/Public/res/favicon.icon">
		<script type="text/javascript" src="/lost_found/Public/js/jquery-2.2.4.min.js"></script>
		<script type="text/javascript" src="/lost_found/Public/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/lost_found/Public/js/router.js" ></script>
		<style>
		   .header 
		   {
				margin-left: 0;
				margin-right: 0;
				height:50px;
				line-height: 50px;
				background-color: #4A515B;
				color:#fff;
			}
			#main-nav {
			   width:100%;
	     
	        }
 
            #main-nav.nav-tabs.nav-stacked > li > a {
                padding: 10px 8px;
                font-weight: 600;
                color: #4A515B;
                background: #E9E9E9;
                background: -moz-linear-gradient(top, #FAFAFA 0%, #E9E9E9 100%);
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#FAFAFA), color-stop(100%,#E9E9E9));
                background: -webkit-linear-gradient(top, #FAFAFA 0%,#E9E9E9 100%);
                background: -o-linear-gradient(top, #FAFAFA 0%,#E9E9E9 100%);
                background: -ms-linear-gradient(top, #FAFAFA 0%,#E9E9E9 100%);
                background: linear-gradient(top, #FAFAFA 0%,#E9E9E9 100%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FAFAFA', endColorstr='#E9E9E9');
                -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr='#FAFAFA', endColorstr='#E9E9E9')";
                border: 1px solid #D5D5D5;
                border-radius: 4px;
            }
 
            #main-nav.nav-tabs.nav-stacked > li > a > span {
                color: #4A515B;
            }

            #main-nav.nav-tabs.nav-stacked > li.active > a, #main-nav.nav-tabs.nav-stacked > li > a:hover {
                color: #FFF;
                background: #3C4049;
                background: -moz-linear-gradient(top, #4A515B 0%, #3C4049 100%);
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#4A515B), color-stop(100%,#3C4049));
                background: -webkit-linear-gradient(top, #4A515B 0%,#3C4049 100%);
                background: -o-linear-gradient(top, #4A515B 0%,#3C4049 100%);
                background: -ms-linear-gradient(top, #4A515B 0%,#3C4049 100%);
                background: linear-gradient(top, #4A515B 0%,#3C4049 100%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#4A515B', endColorstr='#3C4049');
                -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr='#4A515B', endColorstr='#3C4049')";
                border-color: #2B2E33;
            }

            #main-nav.nav-tabs.nav-stacked > li.active > a, #main-nav.nav-tabs.nav-stacked > li > a:hover > span {
                color: #FFF;
            }
 
            #main-nav.nav-tabs.nav-stacked > li {
                margin-bottom: 4px;
            }
 
	        /*定义二级菜单样式*/
	        .secondmenu a {
	            font-size: 10px;
	            color: #4A515B;
	            text-align: center;
	        }
	 
	        .navbar-static-top {
	            background-color: #212121;
	            margin-bottom: 5px;
	        }
	 
	        .navbar-brand {
	            display: inline-block;
	            vertical-align: middle;
	            padding-left: 50px;
	            color: #fff;
	        }


	        @font-face {
			  font-family: 'Glyphicons Halflings';
			  src: url('../fonts/glyphicons-halflings-regular.eot');
			}

			.glyphicon {
			  position: relative;
			  top: 1px;
			  display: inline-block;
			  font-family: 'Glyphicons Halflings';
			  -webkit-font-smoothing: antialiased;
			  font-style: normal;
			  font-weight: normal;
			  line-height: 1;
			  -moz-osx-font-smoothing: grayscale;
			}

             /*返回顶部*/
            .scroll{
					width:50px;
					height:50px;
					background:#41CEF1;
					color:#fff;
					line-height:20px;
					text-align:center;
					position:fixed;
					right:30px;
					bottom:40px;
					cursor:pointer;
					font-size:20px;
					font-family: 'Glyphicons Halflings';
					border:2px solid #41CEF1;
					border-radius:6px;
					opacity:0.5;
	               }
	           
            
		</style>
	</head>
	<body>
     <div  class="header">
       <div style="width:20%;float:left;margin-top:0px;" > 
	         <div style="margin-left:20%;">
				       <a href="javascript:void(0);" onclick="router.action('../AllLost/newIndexData')">
                   	   <i class="glyphicon glyphicon-home btn  btn-default  btn-sm">
	                           <p>首页</p></i>
	              </a>
		      </div>
	   </div>
	   <div style="width:60%;float:left;">
	             <div style="margin-left:20%;">
	             <h4>校园失物招领</h4>
	             </div>
	   </div>
	    <div style="width:20%;float:right;margin-top:0px;" > 
	         <div style="margin-left:20%;">
           <a onclick="logout()" >
                <i class="glyphicon glyphicon-off btn  btn-warning  btn-sm "> <p>退出</p>
	               </i>
	          </a>
	         </div>
	   </div>
		</div>
		
		  <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="5000" style="height:120px;">
                      <!-- 轮播（Carousel）指标 -->
                      <ol class="carousel-indicators">
                          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                          <li data-target="#myCarousel" data-slide-to="1"></li>
                          <li data-target="#myCarousel" data-slide-to="2"></li>
                          <li data-target="#myCarousel" data-slide-to="3"></li>
                          <li data-target="#myCarousel" data-slide-to="4"></li>
                      </ol>   
                      <!-- 轮播（Carousel）项目 -->
                      <div class="carousel-inner">
                          <div class="item active">
                              <img src="/lost_found/Public/img/1.jpg"  alt="First slide">
                          </div>
                          <div class="item">
                              <img src="/lost_found/Public/img/2.jpg"  alt="Second slide">
                          </div>
                          <div class="item">
                              <img src="/lost_found/Public/img/3.jpg"  alt="Third slide">
                          </div>
                           <div class="item">
                              <img src="/lost_found/Public/img/4.jpg"  alt="Four slide">
                          </div>
                           <div class="item">
                              <img src="/lost_found/Public/img/5.jpg"  alt="Five slide">
                          </div>
                      </div>
                      <!-- 轮播（Carousel）导航 -->
                      <a class="carousel-control left" href="#myCarousel" 
                          data-slide="prev" >&lsaquo;
                      </a>
                      <a class="carousel-control right" href="#myCarousel" 
                          data-slide="next">&rsaquo;
                      </a>
       </div>
		
	    <div style="width:100%" >
	        <!--<div style="width:100%" >
	            <div style="width:100%">
	                <ul id="main-nav" class="nav nav-tabs nav-stacked" style="width:100%">
	                    <li class="nav-list" name="system">
	                        <a href="#systemSetting" class="nav-header collapsed" data-toggle="collapse">
	                           
	                               <i class="glyphicon glyphicon-cog"></i>  系统功能</h5
	                               <span class="pull-right glyphicon glyphicon-chevron-down"></span>
	                        </a>
	                        <ul id="systemSetting" class="nav nav-list collapse secondmenu" style="height: 0px;">
	                            <li>
	                            <a href="javascript:void(0);" onclick="router.action('../User/fullMsg')"><i class="glyphicon glyphicon-user"></i> 个 人 信 息</a></li>
	                            <li>
	                            <a href="javascript:void(0);" onclick="router.action('../AllLost/lostlist')">
	                            <i class="glyphicon glyphicon-th-list"></i> 所 有 失 物
	                            </a>
	                            </li>
	                            <li>
	                            <a href="javascript:void(0);" onclick="router.action('../Personal/index')"><i class="glyphicon glyphicon-asterisk"></i> 个 人 失 物
	                            </a>
	                            </li>
	                            <li>
	                            <a href="javascript:void(0);" onclick="router.action('../Personal/findadd')">
	                            <i class="glyphicon glyphicon-edit"></i> 捡 到 失 物</a></li>
	                            <li class="nav-list" name="SchoolmateServer">
	                            <a onclick="logout()" >
	                            <i class="glyphicon glyphicon-fire"></i>
	                             退 出 系 统
	                            </a>
	                            </li>
	                        </ul>
	                    </li>
	                </ul>
	            </div>
	        </div>
	    </div>-->
	   <div style="width:100%" >
                         
                   
	                <iframe id="mainPage" src="/lost_found/Home/AllLost/newIndexData" frameBorder="0" width="100%" scrolling="yes" height="900">          
	                </iframe>
	     
	   </div>
	     <footer class="page-footer fixed-footer" id="footer" style="text-decoration:none;">
			<ul>
				<li >
				       <a href="javascript:void(0);" onclick="router.action('../AllLost/lostlist')">
	                  <span class="glyphicon glyphicon-th-list btn  btn-default  btn-xs">
	                           <h5>所有失物</h5> </span> 
	              </a>
				</li>
				<li>
				    <a href="javascript:void(0);" onclick="router.action('../Personal/index')">
				                <span class="glyphicon glyphicon-pencil btn  btn-default  btn-xs">
				          
				               <h5>个人失物</h5>     </span> 
					     </a>
				</li>
				<li>
				         <a href="javascript:void(0);" onclick="router.action('../Personal/findadd')">
	                            <span class="glyphicon glyphicon-edit btn  btn-default  btn-xs">
	                            <h5>捡到失物</h5> </span>
	                            </a>
	                <a onclick="logout()" >
				</li>
				<li>
					<a href="javascript:void(0);" onclick="router.action('../User/fullMsg')">
						<span class="glyphicon glyphicon-user  btn  btn-default  btn-xs" >
						             <h5 >个人信息</h5></span>
					</a>
				</li>
			</ul>
		</footer>
		
		
	    <!--<div class="scroll" id="scroll" style="display:none;">
		 返回顶部
	     </div>-->

        <div style="visibility:hidden;display:none">
		    <div id="logoutAjax">
        <?php echo U('Home/User/logout');?>
        </div>
        </div>
		<script type="text/javascript">
		var logout = function(){
		var r=confirm("确定退出该系统？");
		if(r==true){
			window.location.href = $('#logoutAjax').html();
		}else{
		
		}
	    }
        
        //返回顶部
			$(function(){
				showScroll();
				function showScroll(){
					$(window).scroll( function() { 
						var scrollValue=$(window).scrollTop();
						scrollValue > 100 ? $('div[class=scroll]').fadeIn():$('div[class=scroll]').fadeOut();
					} );	
					$('#scroll').click(function(){
						$("html,body").animate({scrollTop:0},200);	
					});	
				}
			})

			</script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	</body>
</html>