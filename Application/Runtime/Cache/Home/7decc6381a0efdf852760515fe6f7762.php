<?php if (!defined('THINK_PATH')) exit();?>
<html>
	<head>   
		<meta charset="UTF-8">
		<title>欢迎界面</title>
		<link rel="stylesheet" type="text/css" href="../../../Public/easyui/themes/default/easyui.css"/>
		<link rel="stylesheet" type="text/css" href="../../../Public/easyui/themes/icon.css"/>
		<script type="text/javascript"  src="../../../Public/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="../../../Public/easyui/jquery.easyui.min.js"></script>
		<script type="text/javascript">
			function addTabs(title,url){
				$('#tt').tabs('add',{
					title: title,
					selected: true,
					closable:true,
					content:'<iframe src="'+url+'" width="100%" height="100%" frameborder="0"></iframe>'
					//...
				});
								
			}
		</script>
	</head>
	<body class="easyui-layout">  
        <div data-options="region:'north',split:false" style="height:50px;"></div>  
         
        <div data-options="region:'west',title:'菜单列表',split:false" style="width:200px;">
      		<ul  class="easyui-tree">   
				<?php if(is_array($_SESSION['menus'])): $i = 0; $__LIST__ = $_SESSION['menus'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m1): $mod = ($i % 2 );++$i; if($m1["level"] == 0): ?><li>
							<span><?php echo ($m1["mname"]); ?></span>
							<ul>
								<?php $mid = $m1["mid"]; ?>
								<?php if(is_array($_SESSION['menus'])): $i = 0; $__LIST__ = $_SESSION['menus'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m2): $mod = ($i % 2 );++$i; if($m2["level"] == 1 AND $m2["parentid"] == $mid): ?><li><a href = "javascript:addTabs('<?php echo ($m2["mname"]); ?>','<?php echo ($m2["url"]); ?>');"><?php echo ($m2["mname"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			</ul>
    	</div>   
    	
        <div data-options="region:'center'" style="background:#eee;">
			<div id="tt" class="easyui-tabs" data-options="fit:true">
				<div title="Tabl" style="padding:20px">
					<span>欢迎你</span>
				</div>
			</div>
        </div> 
    </body>  


</html>