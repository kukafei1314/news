<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻管理系统</title>
<link href="<?php echo base_url('static/style/style.css'); ?>" type="text/css" rel="stylesheet" />
</head>

<body>

<div class="title">
    新闻管理系统
</div>
<div>
	<div style="position:absolute; right:21%; top:70px; color:#FFF"><a href="/home_g/logout">注销</a></div>
    <div class="sousuo">
    	<form action="<?php echo base_url('/home_g/search_new') ?>" method="post">
          <span style="font-size:11px; color:#000">新闻检索</span>
            <input style="height:22px" name="sousuo" type="text" id="sousuo" value="请输入关键字" size="22" />
            <div class="ss"><input type="image" border="0" name="imageField" src="<?php echo base_url('static/image/ss.gif');?>"></div>
        </form>	
    </div>
</div>
<div class="bg">
	<div><a class="herf" href='<?php echo base_url("/home_g/add_news"); ?> '><span style="color:#C00; font-size:12px"><?php echo"添加新闻"; ?></span></a></div>
	<?php
    header("Content-Type: text/html; charset: utf-8"); 

    foreach ($news->result() as $row){
        $cc = substr("$row->content",0,256);
        $time = substr("$row->time",0,19);
		$id = $row->id;
		$author = $row->author;
		$topic = $row->topic;
    ?>
        <a class="herf" href='<?php echo base_url("/home_g/news_detail?id= $id");?>'><?php echo $topic."</br>"; ?></a>
    <?php 
        echo"$cc</br>";
        echo"$author &nbsp&nbsp&nbsp";
        echo"$time";
    ?>
        <div style="text-align:right">
            <a class="herf" href='<?php echo base_url("/home_g/edit_news?id= $id"); ?> '><span style="color:#C00; font-size:12px"><?php echo"编辑"; ?></span></a>&nbsp;&nbsp;
            <a class="herf" href='<?php echo base_url("/home_g/delete?id= $id"); ?> '><span style="color:#C00; font-size:12px"><?php echo"删除"; ?></span></a></br>
         </div>
    <?php
    }
    ?>  
    <center>
        <div class = "page">
            <p class = "middle"><?php echo "$key"; ?></p>
        </div>
    </center>
</div>
</body>
</html>

