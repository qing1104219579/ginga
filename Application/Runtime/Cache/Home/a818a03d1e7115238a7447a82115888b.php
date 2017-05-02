<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>用户列表2</title>
				<link type="text/css" rel="stylesheet" href="http://localhost:8080/tp/Public/dist/css/bootstrap.min.css">
		<link type="text/css" rel="stylesheet" href="http://localhost:8080/tp/Public/easyui/themes/default/easyui.css">
		<link type="text/css" rel="stylesheet" href="http://localhost:8080/tp/Public/easyui/themes/icon.css">
		<script type="text/javascript" src="http://localhost:8080/tp/Public/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="http://localhost:8080/tp/Public/easyui/jquery.easyui.min.js"></script>
		<script type="text/javascript" src="http://localhost:8080/tp/Public/easyui/locale/easyui-lang-zh_CN.js"></script>
			<script type="text/javascript" src="http://localhost:8080/tp/Public/dist/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			function trunPage(pageNo,pageSize,type){
				if(type == -1){			//向上翻页
					pageNo = (pageNo -1);
					if(pageNo<1){
						alert("已经是第一页")
						return;
					}
				}else if (type == 0){   //向后翻页
					pageNo = (pageNo+1);
					
				}else{     				//点击跳转翻页
					pageNo = type;
				}
				location.href = "http://localhost:8080/tp/index.php/Home/User/nameList/pageNo/"+pageNo+"/pageSize/2";
			}
			function openWin(type){
				if(type ==0){     //0代表修改
					var rows = $("input[name='checkbox']:checked");
					if(rows.length > 1){
						alert("你选多了！");
						return;
					}
					if(rows.length == 0 ){
						alert("你该选一个啊！！");
						return;
					}
					var bid = rows.eq(0).val();
					$.post("http://localhost:8080/tp/index.php/Home/User/updatebranch",{
						"bid" : bid
					},function(data){
						
					},"json");
				
				}else{
				}
				$("#myModal").modal("toggle");
			}
		</script>
	</head>
	<body>
		<div>
			<button type="button" class="btn btn-info btn-md" onclick="openWin(1);"><span class="glyphicon glyphicon-plus"></span>新增</button>
			<button type="button" class="btn btn-info btn-md" onclick="openWin(0);"><span class="glyphicon glyphicon-pencil"></span>修改</button>
			<button type="button" class="btn btn-info btn-md"><span class="glyphicon glyphicon-remove"></span>删除</button>
			<button type="button" class="btn btn-info btn-md"><span class="glyphicon glyphicon-th-list"></span>导出表格</button>
		</div>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">部门</h4>
					</div>
					<div class="modal-body">
						<form id="ff" action="http://localhost:8080/tp/Home/User/listbranch" method="post">
							<table  id="td"  style="width: 300px;height: 200px;">
								<tr>
									<td>编号:</td>
									<td><input type="text" name="bid" id="bid" value=""/></td>
								</tr>
								<tr >
									<td>名称:</td>
									<td><input type="text" name="bname" id="bname" value=""/></td>
								</tr>
								<tr>
									<td colspan="2">
										<input class="btn btn-primary" style="width: 54px;height: 30px;" onclick="SMUUser()" type="button" value="确定"/>
										<input type="button" class="btn btn-info" style="width: 54px;height: 30px;" type="reset" value="取消" onclick="OFF();" />
									</td>
								</tr>
							</table>
						</form>
					</div>
   				</div>
			</div>
		</div> 
	
	
		<table style="width:80%;" class="table table-striped table-bordered table-condensed">
			<tr>
				<td><input type="checkbox" name=""/></td>
				<td>编号</td>
				<td>名称</td>
				
			</tr>
			<?php if(is_array($dataq["rows"])): $i = 0; $__LIST__ = $dataq["rows"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
					<td><input type="checkbox" name="checkbox" value="<?php echo ($data["bid"]); ?>"/></td>
					<td> <?php echo ($data["bid"]); ?></td>
					<td> <?php echo ($data["bname"]); ?></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			
		</table>
		<div class="container">
			<nav aria-label="Page navigation">
				<ul class="pagination">
					<li><a href="#">总共<b style="color:red;"> <?php echo ($dataq["total"]); ?></b>条数据</a></li>
					<li>
				    	<a href="javascript:trunPage(<?php echo ($dataq["pageNo"]); ?>,2,-1);" aria-label="Previous">
				        	<span aria-hidden="true">&laquo;</span>
				      	</a>
				    </li>
				    <li><a href="javascript:trunPage(1,2,1);">1</a></li>
				    <li><a href="javascript:trunPage(2,2,2);">2</a></li>
				    <li><a href="javascript:trunPage(3,2,3);">3</a></li>
				 	<li>
				      	<a href="javascript:trunPage(<?php echo ($dataq["pageNo"]); ?>,2,0);" aria-label="Next">
				        	<span aria-hidden="true">&raquo;</span>
				        </a>
					</li>
					<li><a href="#">第<b style="color:red;"><?php echo ($dataq["pageNo"]); ?></b>页数据</a></li>
				</ul>
			</nav>
		</div>
	</body>
</html>