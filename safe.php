<?php 
include('./config/config_global.php');
?>
<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <title>Discuz！防CC工具</title>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css">
    </head>
    <body>
        <form  method = "post" action="#">
			<div class="form">
			    <h1>Discuz！防CC工具</h1>
				<br />
				目前的防护等级:<?php if($_config['security']['attackevasive'] == '0'){ echo '关闭'; }elseif($_config['security']['attackevasive'] == '1|2'){ echo '低级';}elseif($_config['security']['attackevasive'] == '1|2|4'){echo '中级';}elseif($_config['security']['attackevasive'] == '1|2|4|8'){echo '高级';}?>
				<br/><br/>
				<label><input type="radio" name="type" value="0" <?php if($_config['security']['attackevasive'] == '0'){ echo 'checked="true"'; }?>/>关闭</label>
				<br />
				<label><input type="radio" name="type" value="1|2" <?php if($_config['security']['attackevasive'] == '1|2'){ echo 'checked="true"'; }?>/>低级（限制cookie刷新、代理访问）</label>
				<br />
				<label><input type="radio" name="type" value="1|2|4" <?php if($_config['security']['attackevasive'] == '1|2|4'){ echo 'checked="true"'; }?>/>中级（限制cookie刷新、代理访问，二次加载网页）</label>
				<br />
				<label><input type="radio" name="type" value="1|2|4|8" <?php if($_config['security']['attackevasive'] == '1|2|4|8'){ echo 'checked="true"'; }?>/>高级（限制cookie刷新、代理访问，二次加载网页，验证）</label>
				<br />
				<br />
				<button class="btn btn-default" type="submit">设置</button>
			</div>
		</form>
    </body>
</html>
<?php

if($_POST){
	$_config['security']['attackevasive'] = $_POST['type'];
	
	$string = "<?php\n \$_config = ".var_export($_config,TRUE).";\n?>";
	
	if(file_put_contents('./config/config_global.php', $string)){
		echo "<script>alert('设置成功！');window.location.href='safe.php';</script>";
	}else{
		echo "<script>alert('设置失败，请查看文件是否可写');</script>";
	}
}

?>