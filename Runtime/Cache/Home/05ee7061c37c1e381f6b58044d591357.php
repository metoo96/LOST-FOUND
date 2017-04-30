<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<title>
南苑校园失物招领登录界面
</title>
</head>
<body>
<h1>南苑校园失物招领登录界面</h1><hr>
	  <div>
		  <div>
			  <input type="text" placeholder="手机号" id="mobile"/>
				<button onclick="getCode()" id="getBtn">
					 获取验证码
				</button>
				<div id="getdefaultBtn" style="display:none">
					60s后重新获取
				</div>
		  </div>
		  <input type="text" placeholder="验证码" id="code">
		  <div align="left">
				<button  onclick="checkCode()" >
			     提交
				</button>
		  </div>
		  <div>
		  <hr>
		  <!--分享操作的代码-->
		  <!-- JiaThis Button BEGIN -->
		  <div class="jiathis_style_32x32">
				<a class="jiathis_button_qzone"></a>
				<a class="jiathis_button_tsina"></a>
				<a class="jiathis_button_tqq"></a>
				<a class="jiathis_button_weixin"></a>
				<a class="jiathis_button_renren"></a>
				<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
				<a class="jiathis_counter_style"></a>
			</div>
			<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
			<!-- JiaThis Button END -->
		   </div>
		</div>
		<div style="visibility:hidden;display:none">
			<div id="getCodeAjax">
				<?php echo U('Home/Index/getCodeAjax');?>
			</div>
			<div id="checkCodeAjax">
				<?php echo U('Home/Index/checkCodeAjax');?>
			</div>
			<div id="loginindex">
			<?php echo U('Home/User/index');?>
			</div>
		</div>

		<script type="text/javascript" src="/campus/Public/js/jquery-2.2.4.min.js"></script>
		<script type="text/javascript" src="/campus/Public/js/bootstrap.min.js"></script>
		<script type="text/javascript">

		//验证码码点击后需要等待60秒
			var disableBtn = function(){
				var btn = $('#getBtn');
				var defaultBtn = $('#getdefaultBtn');
				btn.hide();
				defaultBtn.show();
				var number = 60;
				defaultBtn.html(number + "s后重新获取");
				var intervalFun = function(){
					if(number == 0){
						btn.show();
						defaultBtn.hide();
						clearInterval(interval);
					}else {
						number -- ;
						defaultBtn.html(number + "s后重新获取");
					}
				}
				var interval = setInterval(function(){
					intervalFun();
				},1000);
			}

            //获取验证码
			var getCode = function(){
				var data = {
					mobile:$('#mobile').val()
				}
				$.ajax({
					url:$('#getCodeAjax').html(),
					type:'post',
					data:data,
					success:function(res){
						if(res.success){
							disableBtn();//获取成功
						}else {
							alert(res.errmsg);
						}
					},
					error:function(){
						alter('网络错误');
					}
					
				})
			}

            //点击提交按钮时进行验证
			var checkCode = function(){
				var data = {
					mobile:$('#mobile').val(),
					code:$('#code').val()
				}
				$.ajax({
					url:$('#checkCodeAjax').html(),
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
		</script>
	</body>
</html>