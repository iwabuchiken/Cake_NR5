<?php 

	$opt_create = array(
					'div' => false,
// 					'id' => "Genre2",
					//REF http://book.cakephp.org/2.0/en/core-libraries/helpers/form.html#options-for-create 
					'type' => 'get');

	$opt_input = array(
					'type'		=> 'select',
					'options'	=> $select_SortNames_1,
					//REF http://satussy.blogspot.jp/2011/07/cakephp-select.html "見つけた方法は"
					'selected'	=> isset($sort_name_1) ? $sort_name_1 : 0,
// 					'selected'	=> 0,
// 					'selected'	=> $genre_id,
			
					'label'		=> false,
					'name'		=> "sort_1",
			
// 					'id' => "Genre2",	//=> no change
			
					'div'		=> false,
			
					'class'		=> 'select_genre'
			);

	$opt_input_2 = array(
					'type'		=> 'select',
					'options'	=> $select_SortNames_2,
					//REF http://satussy.blogspot.jp/2011/07/cakephp-select.html "見つけた方法は"
					'selected'	=> isset($sort_name_2) ? $sort_name_2 : 0,
// 					'selected'	=> 0,
// 					'selected'	=> $genre_id,
			
					'label'		=> false,
					'name'		=> "sort_2",
			
// 					'id' => "Genre2",	//=> no change
			
					'div'		=> false,
			
					'class'		=> 'select_genre'
			);

	$opt_end = array(
			'div' => false,
			
			'class'	=> 'submit_go'
	
	);
	
// 	echo $this->Form->create('Genre2', $opt_create);	
	echo $this->Form->create('Category', $opt_create);	
	
	echo $this->Form->input(
// 						'Genre2', $opt_input
						'', $opt_input
	
					);
	
	echo "&nbsp;";
	echo "&nbsp;";
	
	echo $this->Form->input(
// 						'Genre2', $opt_input
						'', $opt_input_2
	
					);
	
	//REF http://stackoverflow.com/questions/6360767/form-end-without-a-div-in-cakephp answered Jun 15 '11 at 17:06
	echo $this->Form->submit("Sort", $opt_end);

	/*******************************
		sort name
	*******************************/
// 	echo "sort";
	
	echo "&nbsp;";
	echo "&nbsp;";
	
	echo (isset($sort) ? "<font color='blue'>(sort => $sort)</font>" : "");
	
	echo (isset($sort_name_1) && isset($sort_name_2)
			
			? "<font color='blue'>"
				."("
				."sort_1 = ".$column_names[$sort_name_1]
				." / "
				."sort_2 = ".$column_names[$sort_name_2]
				.")"
			."</font>" 
			
			: ""
	);
	
// 	if (isset($sort_name)) {
	
// 		echo "sort => $sort_name";
		
// 	}//if (isset($sort_name))
	
 ?>
 
