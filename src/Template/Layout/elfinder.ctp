<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->Html->charset(); ?>
		
		<?php echo $this->Html->script($staticFiles['js']['jquery']);?>
		
		<?php echo $this->Html->css($staticFiles['css']['jquery_ui']);?>
		<?php echo $this->Html->script($staticFiles['js']['jquery_ui']);?>
		
		<?php 
		  if ($staticFiles['css']['jquery_ui_theme']) {
		      echo $this->Html->css($staticFiles['css']['jquery_ui_theme']);
		  }
		?>
		
		<?php echo $this->Html->css('CakephpTinymceElfinder./elfinder/css/elfinder.min.css');?>
		<?php echo $this->Html->css('CakephpTinymceElfinder./elfinder/css/theme.css');?>

		<?php echo $this->Html->script('CakephpTinymceElfinder./elfinder/js/elfinder.min.js');?>
	</head>
	<body>
		<?php echo $this->fetch('content');?>
	</body>
</html>
