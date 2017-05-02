<?php 
require_once '../../../newfile.php';
session_start();?>
<html>
	<head>   
		<meta charset="UTF-8">
		<title>------3------</title>
		<link rel="stylesheet" type="text/css" href="<?php echo BasePath;?>Public/easyui/themes/default/easyui.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo BasePath?>Public/easyui/themes/icon.css"/>
		<script type="text/javascript"  src="<?php echo BasePath?>Public/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="<?php echo BasePath?>Public/easyui/jquery.easyui.min.js"></script>
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
				<?php 
					foreach($_SESSION["menus"] as $m){
					   if($m["level"] == 0){
					        echo "<li>";
						    echo     "<span>{$m['mname']}</span>";
						    echo     "<ul>";
					        foreach($_SESSION["menus"] as $m3){
						        if($m3['level'] == 1 && $m3['parentid'] == $m['mid']){
						            echo "<li><a href='javascript:addTabs(\"{$m3['mname']}\",\"{$m3['url']}\");'>{$m3['mname']}</a></li>";
						        }
						    }
						    echo    "</ul>";
					        echo "</li>";
					    }
					}
				?>
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