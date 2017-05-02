<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Insert title here</title>
	</head>
	<body>
		模块
		
		<?php echo ($bbb); ?>
		<?php echo ($ccc[1]); ?>
	
		<p><?php echo ($ee); ?></p>
		<p><?php echo date('Y/m/d',$ee);?></p><!--  时间日期-->
		<?php if(is_array($ff)): $i = 0; $__LIST__ = array_slice($ff,1,2,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?><!-- 循环。。。offset从索引几开始  length到索引几结束  -->
		 <?php if($mod == 0): echo ($c); ?><br/><?php endif; endforeach; endif; else: echo "" ;endif; ?>
		
	</body>
</html>