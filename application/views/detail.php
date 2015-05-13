<?php
foreach($new->result() as $row){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo"$row->topic" ?></title>
<link href="<?php echo base_url('/static/style/style.css') ?>" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="div_detail">
	<?php
		$time = substr("$row->time",0,19);
		echo"</br>"; 
	?>
	<h3 class="header">
		<?php
            echo"$row->topic</br>"; 
        ?>
    </h3>
	<?php
    	echo"$row->content</br></br>";
	?>
		<div style="text-align:right">
        	<?php
				echo"$row->author&nbsp&nbsp&nbsp";
				echo"$time</br>";
			?>
        </div>
</div>
</body>
</html>
<?php
}
?>