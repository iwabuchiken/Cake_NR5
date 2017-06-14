<?php

class GeschichtesController extends AppController {
// class ArticlesController extends AppController {
	public $helpers = array('Html', 'Form', 'Mytest');
// 	public $helpers = array('Html', 'Form');

	public function 
	index() {

		/*******************************
			options
		*******************************/
		$options = 				array(
				
				'order'		=> array(
				
						'Geschichte.id'	=> "desc"
						
				)
						
		);

		# filter
		@$query_Filter = $this->request->query['filter_text'];
// 		@$query_Filter = $this->request->query[$filter_text];
		
// 		debug($this->request->query);
		
// 		debug("query_Filter => '".$query_Filter."'");
		
		if ($query_Filter != null && $query_Filter != "__@") {
			
			$options['conditions'] = 
// 						array('Geschichte.content LIKE'	=> "%$query_Filter%");
						array(
								'OR'	=> array(
										
										array('Geschichte.content LIKE'	=> "%$query_Filter%"),
										array('Geschichte.line LIKE'	=> "%$query_Filter%"),
										
// 										array('Geschichte.content LIKE'	=> "%韓国%"),
										
// 										'Geschichte.content LIKE'	=> "%$query_Filter%",
// 										'Geschichte.content LIKE'	=> "%韓国%"
								)
						);
// 			$options['conditions'] = array('Geschichte.content LIKE'	=> '%韓国%');
			
			$this->set("query_Filter", $query_Filter);
			
		}
		
// 		debug($options);
		
		/*******************************
			geschichtes
		*******************************/
		$geschichtes = $this->Geschichte->find('all', $options);
		
		$geschichtes_all = $this->Geschichte->find('all');
		
// 		debug($geschichtes[0]);
		
		$this->set("geschichtes", $geschichtes);
		$this->set("geschichtes_all", $geschichtes_all);
		
	}//index()

	
}//class GeschichtesController extends AppController

