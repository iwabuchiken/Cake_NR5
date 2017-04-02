<?php

/*
 * access: http://localhost/Eclipse_Luna/Cake_NR5/genre_names
 */
class GenreNamesController extends AppController {
// class ArticlesController extends AppController {
	public $helpers = array('Html', 'Form', 'Mytest');
// 	public $helpers = array('Html', 'Form');

	public $column_names = ["id", "genre_id", "media_name", "genre_name"];
	
	public function 
	index() {

		/*******************************
		 sort names
		 *******************************/
		$select_SortNames_GenreNames_1 = ["id", "genre_id", "media_name", "genre_name"];
		$select_SortNames_GenreNames_2 = ["id", "genre_id", "media_name", "genre_name"];
		
		// set
		$this->set('select_SortNames_GenreNames_1', $select_SortNames_GenreNames_1);
		$this->set('select_SortNames_GenreNames_2', $select_SortNames_GenreNames_2);
		
// 		/*******************************
// 			get: params --> sort name
// 		*******************************/
// 		$sort_name = $this->index__get_sort_name();
// // 		aa
		
		/*******************************
		 set: options
		 *******************************/
		$option = $this->index__get_sort_name();
		
// 		debug($option);
		
		//
		$genre_names = $this->GenreName->find('all', $option);
// 		$genre_names = $this->GenreName->find('all');
		
		$this->set('genre_names', $genre_names);
		
// 		debug($genre_names[0]);
// 		debug($genre_names[0]['Genre']);
// 		debug($genre_names['GenreName']['Genre']);	//=> "Notice (8): Undefined index: GenreName"
		
		
// 		//debug
// 		debug($genre_names);
		
	}//index()

	function index__get_sort_name() {
	
		/*******************************
		 get: params --> sort name
		 *******************************/
		$sort_genrenames = @$this->request->query['sort_genrenames'];
	
		$sort_genrenames_1 = @$this->request->query['sort_genrenames_1'];
		$sort_genrenames_2 = @$this->request->query['sort_genrenames_2'];
// 		$sort_name_1 = @$this->request->query['sort_1'];
// 		$sort_name_2 = @$this->request->query['sort_2'];
	
		/*******************************
		 build: sort conditions
		 set: page variables
			*******************************/
		// 		$column_names = ["id", "name", "genre_id"];
		// 		$column_names = ["id", "name", "genre"];
	
		// validate
		if ($sort_genrenames == NULL || $sort_genrenames == "") {
			// 		if ($sort_name == NULL) {
	
			debug("sort --> NULL or blank");
			// 			debug("sort --> NULL; set to default of 'id'");
	
			if (isset($sort_genrenames_1) && isset($sort_genrenames_2)) {
	
				$order_ary = array(
	
						//ref global var http://stackoverflow.com/questions/12638962/global-variable-in-controller-cakephp-2
						"GenreName.".$this->column_names[$sort_genrenames_1] => 'asc'
						, "GenreName.".$this->column_names[$sort_genrenames_2] => 'asc'
						// 						"Category.$sort_name_1" => 'asc'
				// 						, "Category.$sort_name_2" => 'asc'
						// 								, "Category.id" => 'asc'
	
				);
	
				// set page variables
				$this->set("sort_genrenames_1", $sort_genrenames_1);
				$this->set("sort_genrenames_2", $sort_genrenames_2);
	
				// 				debug("\$this->column_names[\$sort_name_1]  => ".$this->column_names[$sort_name_1] );
	
				// 				debug($order_ary);
	
					
			} else {
					
				debug("sort --> not set; set to default of 'id'");
	
				$order_ary = array(
	
						"GenreName.id" => 'asc'
						// 						, "Category.$sort_2" => 'asc'
						// 								, "Category.id" => 'asc'
	
				);
	
				// set page variables
				$this->set("sort_genrenames", "id");
	
	
			}//if (isset($sort_name_1) && isset($sort_name_2))
				
			//ref in_array() http://php.net/manual/ja/function.in-array.php
		} else if (!in_array($sort_genrenames, $this->column_names)) {
			// 		} else if (!in_array($sort_name, $column_names)) {
	
			debug("sort --> unknown name: $sort_genrenames; set to default of 'id'");
	
			// 			$sort_name = "id";
			$order_ary = array(
						
					"GenreName.id" => 'asc'
					// 						, "Category.$sort_2" => 'asc'
					// 								, "Category.id" => 'asc'
						
			);
	
			// set page variables
			$this->set("sort_genrenames", "id");
	
		} else if (in_array($sort_genrenames, $this->column_names)) {
				
// 			debug("sort name given --> $sort_genrenames");
				
			$order_ary = array(
	
					"GenreName.$sort_genrenames" => 'asc'
					// 						, "Category.$sort_2" => 'asc'
					// 								, "Category.id" => 'asc'
	
			);
				
			// set page variables
			$this->set("sort_genrenames", $sort_genrenames);
	
		} else {//if ($sort_name == NULL)
				
			debug("sort --> unknown value: $sort_genrenames; set to default of 'id'");
				
				// 			$sort_name = "id";
			$order_ary = array(
						
					"GenreName.id" => 'asc'
					// 						, "Category.$sort_2" => 'asc'
					// 								, "Category.id" => 'asc'
						
			);
	
			// set page variables
			$this->set("sort_genrenames", "id");
	
		}//if ($sort_name == NULL)
	
		/*******************************
		 set: page var: list of sort names
			*******************************/
		$this->set("column_names", $this->column_names);
	
	
		/*******************************
		 build: condition
			*******************************/
		$condition = array(
				//REF http://book.cakephp.org/2.0/ja/models/retrieving-your-data.html "$params はいろいろな種類のfindへのパラメータを渡すために使われます"
				'order'	=> $order_ary
				// 				'order'	=> array(
	
						// 						"Category.$sort_name" => 'asc'
						// 						, "Category.name" => 'asc'
						// 						// 								, "Category.id" => 'asc'
	
						// 				)
				// 				'order'	=> array('Category.id' => 'asc')
					
		);
	
		// return
		return $condition;
		// 		return $sort_name;
	
	}//function index__get_sort_name()
	
	public function add() {
		if ($this->request->is('post')) {
			$this->GenreName->create();
				
			$this->request->data['GenreName']['created_at'] = Utils::get_CurrentTime();
			$this->request->data['GenreName']['updated_at'] = Utils::get_CurrentTime();
				
			if ($this->GenreName->save($this->request->data)) {
				$this->Session->setFlash(__('Your GenreNames has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to add your GenreNames.'));
		}
	}
	
	
}//class GenreNamesController extends AppController
