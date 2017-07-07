<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php //echo $this->Html->charset(); ?>
	
	<!-- ref http://onlineconsultant.jp/pukiwiki/?Cake%20PHP%20%E6%96%87%E5%AD%97%E5%8C%96%E3%81%91%E3%82%92%E7%9B%B4%E3%81%99 -->
	<?php //echo $html->charset("utf-8"); ?>
	<?php echo $this->Html->charset("utf-8"); ?>
	
	<title>
		<?php echo CONS::$proj_Name ?>:
		<?php //echo CONS::$proj_Name ?>:
		<?php //echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	
	<meta name="viewport"
           content="width=device-width,
			user-scalable=yes,
			initial-scale=0.30,
			minimum-scale=0.01,
                    maximum-scale=3.0" />
	
	
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('main');
		echo $this->Html->css('jquery-ui.structure');
		echo $this->Html->css('jquery-ui.theme');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

		
		echo $this->Html->script('swfobject');
		
		echo $this->Html->script('http://code.jquery.com/jquery-1.10.2.min.js');
		echo $this->Html->script('jquery-ui.js');
		
		echo $this->Html->script('main');
		echo $this->Html->script('nlp');

		// d3
		echo $this->Html->script('http://d3js.org/d3.v3.min.js');
		
		// sprintf
		//REF http://www.diveintojavascript.com/projects/javascript-sprintf
		//REF C:\WORKS\WS\Eclipse_Luna\Cake_NR5\sprintf.js\demo\angular.html
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-rc.3/angular.min.js');
		echo $this->Html->script('angular-sprintf');
		echo $this->Html->script('sprintf');

		
		echo $this->Html->script('test_NVP');
		
		
	?>
	
<!-- 	http://d3js.org/ -->
<!-- 	<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script> -->
	
	<?php 
	
// 		echo $this->Html->script('test_NVP');
	
	?>
</head>
<body>
<!-- 	<div id="container"> -->
	<div>
<!-- 		<div id="header"> -->
			<h1><?php //echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1>
<!-- 		</div> -->
		<div id="content">
<!-- 		<div> -->

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
			
		</div>
			
	</div>

	
		<?php echo $this->element('layouts/links'); ?>
	
	<div>	
			<?php echo $this->element('layouts/links_2'); ?>
		
	</div>
	
	<?php 
// 		echo $this->element('sql_dump'); 
	?>
	
</body>
</html>
