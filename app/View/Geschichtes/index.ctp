<h1>
	
	Geschichtes 
	
</h1>

(<a href="#bottom">Bottom</a><a name="top"></a>)

&nbsp;&nbsp;&nbsp;
(geschichte stats)

<?php 

	//test
	mb_language("Japanese");
	
	echo "Entries = "."<font color='blue'>".count($geschichtes)."</>";
	
	echo "<font color='black'>";
	
	$label = sprintf('%.2f %%', count($geschichtes) / count($geschichtes_all) * 100);
	
	echo " (".$label.")";
// 	echo " (".round(count($geschichtes) / count($geschichtes_all), 2).")";
	
	echo " / ";
	
	echo "Total = "
			."</>"
			."<font color='blue'>".count($geschichtes_all)."</>";

?>

<?php 

	echo "<br>"; echo "<br>";
	
	
// 	echo $this->element('articles/index/_header'); 

?>	

        	<?php 

				$opt_input = array(
				
						'onmouseover' => 'this.select()',
						'rows' => '1',
// 						'cols'	=> '1'
						//REF http://stackoverflow.com/questions/973637/how-do-i-set-the-width-of-a-text-box-in-cakephp-using-the-style-option
						'style'	=> 'width: 200px',
						'label'	=> '',
						'name'	=> 'filter_text'
// 						'div'	=> false,
			
				);
				
				if (isset($query_Filter) && $query_Filter != null) {
// 				if ($filter_text != null) {
// 				if ($filter_lang != null) {
					
					$opt_input['value'] = $query_Filter;
					
// 					$opt_input['type'] = "text";
					
				}
				
				$opt_input['type'] = "text";
				
				$opt_input['div'] = false;
				
				$opt_create = array(
						
						'div'	=> false,
						//REF http://wiltonsoftware.com/posts/view/customizing-your-form-labels-in-cakephp-1-2
						'label'	=> false,
						'url'	=> array(
										'controller'	=> 'geschichtes',
// 										'controller'	=> 'texts',
										'action'	=> 'index'),
						'type'	=> 'get'
						
					
				);
					
				$opt_End = array(
						
						'div'	=> false,
						'label'	=> false,
// 						'size'	=> 10,
// 						'style'	=> '',
// 						'font'	=> '',
// 						'style'	=> 'font-size: 3px',
// 						'class'	=> 'form-button',
					
				);
					
				echo $this->Form->create(null, $opt_create);
// 				echo $this->Form->create('', $opt_create);
// 				echo $this->Form->create('Filter');
				
				echo $this->Form->input('filter', $opt_input);
				
// 				echo $this->Form->end('Go', $opt_End);
				//REF http://cakephp.1045679.n5.nabble.com/removing-lt-div-gt-in-Form-gt-end-closing-in-cakephp-1-3-td5714867.html
// 				echo $this->Form->end(array('div' => false, 'text' => 'send'));	//=> n/w
// 				echo $this->Form->end('', array('div' => false, 'text' => 'send'));	//=> n/w
				echo $this->Form->end(
								'Filter("__@" to clear)');
// 							'Filter', 
// 							array('div' => false, 'text' => 'send'));
					
			?>


<table>
  <tr>
    <th>Id</th>
    <th>Line</th>
    <th>Vendor</th>
    <th>Genre</th>
    <th>Category</th>
  </tr>
  
<?php 

	foreach ($geschichtes as $g) {
		
?>
	<tr>
		<td>
			<?php 
			
				echo $g['Geschichte']['id'];
			
			?>
		</td>
	

		<td>
			<?php 

				$option = array(
						
						"target"	=> "_blank"
						
				);
			
				//ref http://d.hatena.ne.jp/SumiTomohiko/20061227/1167233803 "linkメソッドをみると"
				echo $this->Html->link(
						$g['Geschichte']['line'],
							$g['Geschichte']['url']
							, $option
// 							$url = $g['Geschichte']['line']
					);
						
// 				echo $g['Geschichte']['line'];
			
			?>
		</td>

		<td>
			<?php 
			
				echo $g['Geschichte']['vendor'];
			
			?>
		</td>
	
		<td>
			<?php
			
				$genre = Utils::get_Genre_From_Genre_Id($g['Geschichte']['genre_id']);
			
				echo $genre['Genre']['name']."(".$genre['Genre']['id'].")";
			
			?>
		</td>
	
		<td>
			<?php
			
				$cat_id = $g['Geschichte']['category_id'];
			
				if ($cat_id == "-1") {
				
					$cat_label = "others";
					
				} else {//if ($g[])
					
					$cat = Utils::get_Category_From_Id(intval($cat_id));
					
					$cat_label = $cat['Category']['name']."(".$cat['Category']['id'].")";
					
				}//if ($g[])
			
				echo $cat_label;
			
			?>
		</td>
	
	</tr>

<?php 		

	}//foreach ($geschichtes as $g)
	
?>
  <tr>
<!--     <td>Row 1: Col 1</td> -->
<!--     <td>Row 1: Col 2</td> -->
  </tr>
</table>



<?php 

	echo "<br>"; echo "<br>";
	
?>	

(<a href="#top">Top</a><a name="bottom"></a>)

<?php 

// 	$count = 1;

// 	foreach ($articles as $a) {
	
// // 		echo $article['line']." / ".$article['url'];
		
// // 		echo "<br>"; echo "<br>";
		
// 		echo "<a href=\"".$a['url']."\" target=_blank".">"
// 				."$count) "
// 				.$a['line']
// 				."</a>";
// // 		echo "<a href=\"".$a['url']."\"".">".$a['line']."</a>";
		
// 		echo "<br>"; echo "<br>";
		
// 		// increment
// 		$count ++;
		
// 	}//foreach ($articles as $article)
	
	



?>