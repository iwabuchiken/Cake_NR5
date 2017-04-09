<h1>

	<?php 
	
		echo $a['line']; 
// 		echo h($a['line']); 
		
	?>
	
</h1>

<br>

<table id="open_article">

  <tr>
  
    <td class="td_label_narrow">Line</td>
    
    <td class="open_article_content">
    
    	<?php 
    	
    		$option = array(
						'target'	=> '_blank',
// 						'escape'	=> false,
// 						'?'	=> "article_url=".$a['url']
// 						'article_url'	=> $a['url']
				);
    		
// 	    	echo $this->Html->link($line,
	    	echo $this->Html->link($a['line'],
	    			$a['url'],
					$option
	    								);
    		
    	?>
    	
    </td>
    
  </tr>
  
  <tr>
    <td class="td_label_narrow">
    
    		Content
    		
    </td>
    
    <td id="open_article_content">
<!--     <td class="open_article_content" id="open_article_content"> -->
    
    	<?php 
    	
    		echo isset($a['content']) ? $a['content'] : "NO DATA"; 
//     		echo $a['content']; 
    		
    	?>
    	
    </td>
    
  </tr>
  
  <tr>
    <td class="td_label_narrow">Vendor</td>
    <td class="open_article_content"><?php echo $a['vendor']; ?></td>
  </tr>
  
<!--   <tr> -->
<!--     <td class="td_label_narrow">Time</td> -->
<!--     <td class="open_article_content"> -->
    	<?php //echo $a['news_time']; ?>
<!--     </td> -->
<!--   </tr> -->
  
  <tr>
    <td class="td_label_narrow">Category</td>
    <td class="open_article_content">
    
    	<?php 
    		
    		$cat = Utils::get_Category_From_Id($a['category_id']);
    	
//     		debug($cat);
    		
// 	    	echo $cat['category_id'];
	    	echo $cat['Category']['name']."(".$cat['Category']['id'].")";
// 	    	echo $a['category_id'];
    	?>
    	
    </td>
  </tr>
  
  <tr>
    <td class="td_label_narrow">Genre</td>
    <td class="open_article_content">
    
    	<?php 
    	
	    	$genre = Utils::get_Genre_From_Genre_Id($cat['Genre']['id']);
// 	    	$genre = Utils::get_Genre_From_Genre_Id($cat['genre_id']);
	    	 
	    	//     		debug($cat);
	    	
	    	// 	    	echo $cat['category_id'];
	    	echo $genre['Genre']['name']."(".$genre['Genre']['id'].")";
    	
    	 ?>
    	 
    	
    </td>
  </tr>
  
  
</table>
