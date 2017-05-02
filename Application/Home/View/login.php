<?php 
require_once '../../../newfile.php';
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>用户登录</title>
		<link rel="stylesheet" type="text/css" href="<?php echo BasePath;?>Public/dist/css/bootstrap.min.css"/>
		<script type="text/javascript"  src="<?php echo BasePath;?>Public/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="<?php echo BasePath;?>Public/dist/js/bootstrap.min.js"></script>
		<script type="text/javascript">
		


		
			function checkin(obj,reg){
				$(obj).parent().removeClass("has-success has-error");
				$(obj).parent().find("span").removeClass("glyphicon-ok glyphicon-remove");
				$(obj).parent().find("label:last").hide();
				if(reg.test(obj.value)){
					$(obj).parent().addClass("has-success");
					$(obj).parent().find("span").addClass("glyphicon-ok").css("color","green");
					return 1;
				}else{					
					$(obj).parent().addClass("has-error");
					$(obj).parent().find("span").addClass("glyphicon-remove").css("color","red");
					$(obj).parent().find("label:last").show();
					return 0;
				}	
			}

		
			
		</script>	
		
	</head>
	<body>
	<form action="<?php echo BasePath;?>index.php/Home/User/login" method='post'>
    	<div class="row" style=";">
    		<div class="col-md-4 " style="background-color: yellow;padding-top: 10px;">
    		
        		<div class="form-group form-inline has-feedback" >
        			<label>账号：</label>
        			<div class="input-group" style="width: 60%;">
        				<span class="input-group-addon">
        					<span class="  glyphicon glyphicon-phone"></span>	 
        				</span>
        				<input class="form-control" type="text" name="username"  style="width: 78%;" placeholder="手机/邮箱/账号" onblur="checkin(this,/^[0-9]{2,12}$/)"
        				data-toggle = "po pover" data-toggle="tooltip" data-placement="right"  />
        			</div>
        		</div>
        		
        			<div class="form-group form-inline   has-feedback">
            			<label>密码：</label>
            		<div class="input-group" style="width: 60%;">
            				<span class="input-group-addon">
            					<span class="  glyphicon glyphicon-lock"></span>	 
            				</span>
            			<input id="in1"   type="password" class="form-control" name="userpass"   name="userpass"  style="width:78%;"  placeholder="密码" onblur="checkin(this,/^[a-zA-Z0-9]{2,12}$/)"
            				data-toggle = "popover" data-toggle="tooltip" data-placement="right"  data-trigger="manual" />
            		</div>
            		
            		</div>
        		
            		
            		<div class="col-md-4 col-md-offset-4">
            			<input   type="submit" name="" id="" value="登陆" />
            		</div>
    		
    		</div>
    	</div>			
	</form>	
		
		
	</body>
</html>