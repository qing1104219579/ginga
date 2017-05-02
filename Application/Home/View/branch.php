<?php 
require_once '../../../newfile.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>部门列表</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="<?php echo BasePath?>Public/easyui/themes/default/easyui.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo BasePath?>Public/easyui/themes/icon.css"/>
		<script type="text/javascript"  src="<?php echo BasePath?>Public/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="<?php echo BasePath?>Public/easyui/jquery.easyui.min.js"></script>
		<script type="text/javascript" src="<?php echo BasePath;?>Public/easyui/locale/easyui-lang-zh_CN.js"></script>
		<style type="text/css">
            #td input{width: 200px;height: 30px;}
        </style>
		<script type="text/javascript">
		$(function(){
			$("#win").window('close');
			$("#winaa").window('close');
			$('#dg').datagrid({    
			    url:'<?php echo BasePath;?>index.php/Home/User/branch/pageNo/1/pageSize/10',
			    striped:true,
			    pagination:true,
			    rownumbers:true,
			    frozenColumns:[[
					{field:'hfdhs',checkbox:true}
			    ]],
			    columns:[[    
			        {field:'bid',title:'部门编号',width:100,align:'center'},    
			        {field:'bname',title:'部门名称',width:200,align:'center',formatter:function(value){
						return "<b style='color:red;'>"+value+"</b>";
				    }}
			          
			    ]],
			    toolbar: [{
				    text   : '添加',
					iconCls: 'icon-ok',
					handler: function(){
						$("#uid").val("-1");
						$("#win").window('open');
					}
				},'-',{
					text   : '删除',
					iconCls: 'icon-delete',
					handler: function(){
					var rows = $("#dg").datagrid("getSelections");
					if(rows.length <=0){
						alert("亲‘请先选择一行或多行进行删除");	
						return;
					}
						$("#winaa").window('open');
					}
					
				},'-',{
					text   : '修改',
					iconCls: 'icon-edit',
					handler: function(){
						var rows = $("#dg").datagrid("getSelections");
						if(rows.length > 1){
							alert("你选多了！");
							return;
						}
						if(rows.length == 0 ){
							alert("你该选一个啊！！");
							return;
						}
						var row = rows[0];
						$("#uid").val(row[0]);
						$("#name").val(row[1]);
						$("#win").window('open');
					}
				}]
			});
			
			var pager = $("#dg").datagrid("getPager");
			pager.pagination({
				onSelectPage:function(pageNumber, pageSize){
					$("#dg").datagrid('loading');
					$.post("<?php echo BasePath?>index.php?c=Menu&a=branch&pageNo="+pageNumber+"&pageSize="+pageSize,
					function(data){
							$("#dg").datagrid("loadData",{
							rows:data.rows,
							total:data.total
						});
						$("#dg").datagrid('loaded');
					},"json");
				}
			});
		});
		
		//修改部门.增加
		function SMUUser(){
			$.post("<?php echo BasePath?>index.php?m=Home&c=User&a=updatebranch",{
				"uid" : $("#uid").val(),
				"bname" : $("#bname").val(),
				
			},function(data){
				$("#dg").datagrid("loading");
				$("#dg").datagrid("loadData",{
					rows:data.rows,
					total:data.total
				});
				$("#dg").datagrid("loaded");
				
			},"json");
			$("#win").window('close');
		}



		//删除部门
		function deletea(){
			var rows = $("#dg").datagrid("getSelections");
			var upda = new Array();
			for(var i=0;i<rows.length;i++){			
				upda[i]=rows[i][0];
			}
			$("#winaa").window('close');
			$.post("<?php echo BasePath?>index.php?c=Menu&a=deletebranch&pageNo=1&pageSize=10",{
				"uid" :upda
			},function(data){
				$("#dg").datagrid("loadData",{
					rows:data.rows,
					total:data.total
				});
			},"json");

		}
		
		function OFF(){
			$("#winaa").window('close');
		}
		</script>
	</head>
	<body>
			<table id="dg"></table>
        		<div id="win" class="easyui-window" title="User" style="width:400px;height:300px;text-align:center;"   
                 	data-options="iconCls:'icon-save',modal:true">   
    			 <form >
    			 	<input type="hidden" name="uid" id="uid" value=""/>
    			 	
    			 	<table  id="td"  style="width: 300px;height: 200px;">
    			 		
			 		<tr>
			 			<td>姓名:</td>
			 			<td> <input type="text" name="bname" id="bname" value=""/></td>
			 		</tr>
			 		<tr>
			 			<td colspan="2">
   				 			<input class="btn btn-primary" style="width: 54px;height: 30px;" onclick="SMUUser()" type="button" value="确定"/>
   				 			<input class="btn btn-info" style="width: 54px;height: 30px;" type="reset" value="取消" onclick="OFF();"/>
			 			</td>
			 		</tr>
			 </table>
			 	</form>
		</div>  
		<div id="winaa" class="easyui-window" title="删除" style="width:250px;height:150px;text-align:center;"   
        data-options="iconCls:'icon-save',modal:true"> 
        	<p style="color: red;font-size:20px;">确定要删除吗？</p>
        	<input type="button"  id="updat" class="btn btn-primary"  value="确定"onclick="deletea();"/>
        	<input type="button" class="btn btn-info"  value="取消" onclick="OFF();" />
		</div>
	</body>
</html>