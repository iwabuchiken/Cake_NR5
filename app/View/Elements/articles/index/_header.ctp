<?php 

// 	set_Options();

// 	echo "Genre";

	$opt_create = array(
					'div' => false,
					//REF http://book.cakephp.org/2.0/en/core-libraries/helpers/form.html#options-for-create 
					'type' => 'get');

	$opt_input = array(
					'type' => 'select',
					'options' => $select_Genres,
					'label' => false,
					'name' => "genre_id",
					'div' => false
// 					'inputDefaults' => array(
// 											'label' => false,
// 											'div' => false
// 									)
			);

	$opt_end = array(
			'div' => false
	
	);
	
	echo $this->Form->create('Genre', $opt_create);	
// 	echo $this->Form->create('Genre');	
	echo $this->Form->input(
			'', $opt_input
			// 						'Lang id',
// 			array(
// 					'type' => 'select',
// 					'options' => $select_Genres,
// 					'label' => false,
// 					'name' => "genre_id"
// // 					'inputDefaults' => array(
// // 											'label' => false,
// // 											'div' => false
// // 									)
// 			)
	
	
	);
	
	//REF http://stackoverflow.com/questions/6360767/form-end-without-a-div-in-cakephp answered Jun 15 '11 at 17:06
// 	$opt_end = array(
// 				'div' => false
		
// 	);
// 	$options = array(
// 				'inputDefaults' => array(
// 									'label' => 'Go',
// 									'value' => 'Go',
// 									'div' => false
// 								));

	echo $this->Form->submit("Go", $opt_end);
// 	echo $this->Form->end("Go", $opt_end);
// 	echo $this->Form->end($options);
// 	echo $this->Form->end('Go');

 ?>
 
 <?php 
 
//  	public function set_Options() {

// 		$opt_create = array(
// 		'div' => false,
// 		'type' => 'get');

// 		$opt_input = array(
// 				'type' => 'select',
// 				'options' => $select_Genres,
// 				'label' => false,
// 				'name' => "genre_id"
// 				// 					'inputDefaults' => array(
// 						// 											'label' => false,
// 						// 											'div' => false
// 						// 									)
// 		);
		
// 		$opt_end = array(
// 				'div' => false
		
// 		);

// 	}
 
 ?>