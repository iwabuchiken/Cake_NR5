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
				
// 				'conditions'	=> array(
				
// 						'Genre.id >='	=> 10
// 				)
// 				,
				
				'order'		=> array(
// 				'sort'		=> array(
				
						'Geschichte.id'	=> "desc"
// 						'Geschichte.id'	=> "asc"
				)
						
		);
		
		debug($options);
		
		/*******************************
			geschichtes
		*******************************/
		$geschichtes = $this->Geschichte->find('all', $options);
		
// 		debug($geschichtes[0]);
		
		$this->set("geschichtes", $geschichtes);
		
	}//index()

	
}//class GeschichtesController extends AppController

