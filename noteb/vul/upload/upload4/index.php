﻿<?php 
session_start();
if (empty($_SESSION["NotebUser"])) {
  header("Location:../../../login.php");
}
 ?>
<?php 
include_once('../header.php');
 ?>
<?php 
if (!empty($_FILES)) {
	if (file_exists("../upload_cache/" . $_FILES["file"]["name"]))
	{
	    echo "<script>alert('".$_FILES["file"]["name"] . " 文件已经存在。 "."')</script>";
	}
	else
	{
		$name = strrev($_FILES['file']['name']); //获取上传文件名的倒序
		$array = explode('.',$name);  //获取.后面的名字
		$file_name = $array[0]; //将后缀名赋值给file_name
		$New_File_Name = str_ireplace("php","",$file_name); //替换后缀名的php，不区分大小写（单独获取后缀名是怕对文件名也替换）
		$rand_name = explode('.',$_FILES['file']['name']);//获取源文件的文件名，不需要后缀名
		$rand_name = $array[1]; //由于之前将后缀名传入数组，这次应该获取第二个（从0开始）
		$name = $rand_name.".".strrev($New_File_Name);
        // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
        $file_name=strtolower($_FILES["file"]["name"]);
	    move_uploaded_file($_FILES["file"]["tmp_name"], "../upload_cache/" . $name);
	    echo "<script>alert('"."文件存储在: " . "../upload_cache/" .$name."')</script>";
	}
}
 ?>
<div class="layui-upload">
<form enctype="multipart/form-data" method="post" >
  <button type="button" class="layui-btn layui-btn-normal" id="test8" onclick="document.getElementById('upload_test').click()">选择文件</button>
  <input class="layui-upload-file" type="file" accept="" name="file" id="upload_test">
  <button type="submit" class="layui-btn" id="test9">开始上传</button>

</form>
</div>

		<div id="content">
<?php 
if (isset($_GET['showcode'])) {
	include_once "code.php";
}
 ?>
		</div>
	</div>
</div>
<div id="footer">
	<p>Copyright © C1O2A3 All Rights Reserved
<a href="../../../index.php" target="_blank">图片上传 image upload</a> 
	</p>
</div>
</div>
</body>
<script src="../../../src/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="../../../src/prism.js"></script>
<script type="text/javascript" src="../../../src/prism-line-numbers.min.js"></script>
<script type="text/javascript" src="../../../src/prism-php.min.js"></script>
<script src="../../../src/layui.js"></script>
<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
  
});
function ok() {
    //弹出层提示
	layui.use('layer', function(){
	var layer = layui.layer;
	layer.alert('删除了什么？',{title:'tips',anim:6,icon:3,time:10000,closeBtn:1,btn: ['我知道了'],btnAlign:'c'});
	}); 
}
function clean_upload_file(){
	$.ajax({  
		type: 'get',  
		url: "../del.php",	
	}).success(function(data) {
		    //弹出层提示
			layui.use('layer', function(){
			var layer = layui.layer;
			layer.msg(data,{anim:1,icon:1,time:10000,closeBtn:1,btn: ['我知道了'],btnAlign:'c'});
			}); 
	}).error(function() {
		    //弹出层提示
			layui.use('layer', function(){
			var layer = layui.layer;
			layer.msg('删除失败',{anim:1,icon:2,time:10000,closeBtn:1,btn: ['我知道了'],btnAlign:'c'});
			}); 
	}); 
}
</script>


</html>