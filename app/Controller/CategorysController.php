<?php

class CategorysController 
				extends AppController {
// class CategoriesController extends AppController {
	
	public $helpers = array('Html', 'Form');
	
	public $column_names = ["id", "name", "genre_id"];
// 	public $column_names = ["id", "name", "genre_id"];

	public function index() {

		/*******************************
			sort names
		*******************************/
		$select_SortNames_1 = ["id", "name", "genre_id"];
		$select_SortNames_2 = ["id", "name", "genre_id"];

		// set
		$this->set('select_SortNames_1', $select_SortNames_1);
		$this->set('select_SortNames_2', $select_SortNames_2);
		
// 		/*******************************
// 			get: params --> sort name
// 		*******************************/
// 		$sort_name = $this->index__get_sort_name();
		

		/*******************************
			set: options
		*******************************/
		$option = $this->index__get_sort_name();
		
// 		$option = array(
// 				//REF http://book.cakephp.org/2.0/ja/models/retrieving-your-data.html "$params はいろいろな種類のfindへのパラメータを渡すために使われます"
// 				'order'	=> array(
						
// 								"Category.$sort_name" => 'asc'
// 								, "Category.name" => 'asc'
// // 								, "Category.id" => 'asc'
						
// 							)
// // 				'order'	=> array('Category.id' => 'asc')
			
// 		);
		
		
		$this->set('categories', $this->Category->find('all', $option));
// 		$this->set('categories', $this->Category->find('all'));

// 		//test
// 		Utils::write_Log(
// 				Utils::get_dPath_Log(),
// 				//REF http://www.phpbook.jp/func/string/index7.html
// 				"ROOT = ".ROOT,
// 				__FILE__, __LINE__);
		
	}
	
	function index__get_sort_name() {

		/*******************************
		 get: params --> sort name
		 *******************************/
		$sort_name = @$this->request->query['sort'];
		
		$sort_name_1 = @$this->request->query['sort_1'];
		$sort_name_2 = @$this->request->query['sort_2'];

		/*******************************
			build: sort conditions
			set: page variables
		*******************************/
// 		$column_names = ["id", "name", "genre_id"];
		// 		$column_names = ["id", "name", "genre"];
		
		// validate
		if ($sort_name == NULL || $sort_name == "") {
// 		if ($sort_name == NULL) {
		
			debug("sort --> NULL or blank");
// 			debug("sort --> NULL; set to default of 'id'");
				
			if (isset($sort_name_1) && isset($sort_name_2)) {

				$order_ary = array(
		
						//ref global var http://stackoverflow.com/questions/12638962/global-variable-in-controller-cakephp-2
						"Category.".$this->column_names[$sort_name_1] => 'asc'
						, "Category.".$this->column_names[$sort_name_2] => 'asc'
// 						"Category.$sort_name_1" => 'asc'
// 						, "Category.$sort_name_2" => 'asc'
						// 								, "Category.id" => 'asc'
		
				);
				
				// set page variables
				$this->set("sort_name_1", $sort_name_1);
				$this->set("sort_name_2", $sort_name_2);
				
// 				debug("\$this->column_names[\$sort_name_1]  => ".$this->column_names[$sort_name_1] );
				
// 				debug($order_ary);
				
			
			} else {
			
				debug("sort --> not set; set to default of 'id'");
				
				$order_ary = array(
				
						"Category.id" => 'asc'
// 						, "Category.$sort_2" => 'asc'
						// 								, "Category.id" => 'asc'
				
				);
				
				// set page variables
				$this->set("sort", "id");
				
				
			}//if (isset($sort_name_1) && isset($sort_name_2))
			
			//ref in_array() http://php.net/manual/ja/function.in-array.php
		} else if (!in_array($sort_name, $this->column_names)) {
// 		} else if (!in_array($sort_name, $column_names)) {

			debug("sort --> unknown name: $sort_name; set to default of 'id'");
				
// 			$sort_name = "id";
			$order_ary = array(
			
					"Category.id" => 'asc'
					// 						, "Category.$sort_2" => 'asc'
					// 								, "Category.id" => 'asc'
			
			);
				
			// set page variables
			$this->set("sort", "id");
				
		} else if (in_array($sort_name, $this->column_names)) {
			
			debug("sort name given --> $sort_name");
			
			$order_ary = array(
						
					"Category.$sort_name" => 'asc'
					// 						, "Category.$sort_2" => 'asc'
					// 								, "Category.id" => 'asc'
						
			);
			
			// set page variables
			$this->set("sort", $sort_name);
				
		} else {//if ($sort_name == NULL)
			
			debug("sort --> unknown value: $sort_name; set to default of 'id'");
			
// 			$sort_name = "id";
			$order_ary = array(
			
					"Category.id" => 'asc'
					// 						, "Category.$sort_2" => 'asc'
					// 								, "Category.id" => 'asc'
			
			);

			// set page variables
			$this->set("sort", "id");
				
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
	
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid genre'));
		}
	
		$category = $this->Category->findById($id);
		if (!$category) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->set('category', $category);

		//test 2017/03/31 15:22:58
		debug($_SERVER['HTTP_REFERER']);
		
		
// 		debug($category);
		
		/**********************************
		* read csv
		**********************************/
// 		$this->_read_CSV_Categories();
		
	}

	public function add() {
		if ($this->request->is('post')) {
			
			$this->Category->create();
			
			$this->request->data['Category']['created_at'] = Utils::get_CurrentTime();
			$this->request->data['Category']['updated_at'] = Utils::get_CurrentTime();
			
			if ($this->Category->save($this->request->data)) {
			
				$cat = $this->request->data;
// 				$cat = $this->request->data['Category'];
				
				$genre = Utils::get_Genre_From_Genre_Id($cat['Category']['genre_id']);
// 				$genre = Utils::get_Genre_From_Genre_Id($cat['Genre']['id']);
				
				$msg = "Category saved: name => ".$cat['Category']['name']
// 				$msg = "Category saved: name => ".$cat['name']
				." / "
						."Genre id => ".$cat['Category']['genre_id']
						." ('"
								.$genre['Genre']['name']
								."')"
				;
				
				Utils::write_Log(
						Utils::get_dPath_Log(),
						$msg,
						__FILE__, __LINE__);
				
				$this->Session->setFlash(__('Your categories has been saved.'));
				return $this->redirect(array('action' => 'index'));
				
			}
			
			$this->Session->setFlash(__('Unable to add your categories.'));
			
		} else {//if ($this->request->is('post'))
			
			$this->loadModel('Genre');
				
			$option = array('order' => array('Genre.name' => 'asc'));
			
			$genres = $this->Genre->find('all', $option);
				
			$select_Genres = array();
				
			foreach ($genres as $genre) {
			
				$genre_Name = $genre['Genre']['name'];
				$genre_Id = $genre['Genre']['id'];
			
				$select_Genres[$genre_Id] = $genre_Name;
			
			}
			
			$this->set('select_Genres', $select_Genres);
				
		}//if ($this->request->is('post'))
			
	}

	public function delete($id) {
		/******************************
	
		validate
	
		******************************/
		if (!$id) {
			throw new NotFoundException(__('Invalid genre id'));
		}
	
		$genre = $this->Category->findById($id);
	
		if (!$genre) {
			throw new NotFoundException(__("Can't find the genre. id = %d", $id));
		}
	
		/******************************
	
		delete
	
		******************************/
		if ($this->Category->delete($id)) {
			// 		if ($this->Category->save($this->request->data)) {
	
			$this->Session->setFlash(__(
					"Category deleted => %s",
					$genre['Category']['name']));
	
			return $this->redirect(
					array(
							'controller' => 'categorys',
							'action' => 'index'
	
					));
	
		} else {
	
			$this->Session->setFlash(
					__("Category can't be deleted => %s",
							$genre['Category']['name']));
	
			// 			$page_num = _get_Page_from_Id($id - 1);
	
			return $this->redirect(
					array(
							'controller' => 'categorys',
							'action' => 'view',
							$id
					));
	
		}
	
	}//public function delete($id)

	public function 
	delete_all() {
	
		//REF http://book.cakephp.org/2.0/ja/core-libraries/helpers/html.html
		if ($this->Category->deleteAll(array('Category.id >=' => 1))) {
// 		if ($this->Category->deleteAll(array('id >=' => 1))) {
			
			$this->Session->setFlash(__('Categories all deleted'));
			return $this->redirect(array('action' => 'index'));
			
		} else {
	
			$this->Session->setFlash(__('Categories not deleted'));
			return $this->redirect(array('action' => 'index'));
	
		}
	
	}//delete_all
	
	public function
	_read_CSV_Categories() {
		
		$fname = join(DS, array($this->path_Data, "Category_backup.csv"));

		/**********************************
		* read csv
		**********************************/
// 		$data = $this->csv_to_array($fname, ',');
		$data = Utils::csv_to_array($fname, ',');

		/**********************************
		* build list
		**********************************/
		$cat_pairs = array();
		
		for ($i = 3; $i < count($data); $i++) {
			
			$pair = array();
			
			array_push($pair, $data[$i][0]);
			array_push($pair, $data[$i][1]);
			array_push($pair, $data[$i][2]);
			
			array_push($cat_pairs, $pair);
			
		}
		
		/**********************************
		* save data
		**********************************/
		$this->Category->create();

// 		$this->Category->name = $cat_pairs[1][1];
		
// 		$this->Category->genre_id = 4;

		$param = array('Category' => 
				
							array(
// 								'name' => mb_convert_encoding($cat_pairs[7][1], "UTF-8"),
								'name' => $cat_pairs[7][1],
								'genre_id' => 4
							)
		
		);

// 		$param = array(
// 						'name' => $cat_pairs[1][1],
// 						'genre_id' => 4
// 				);
		
// 		$this->Category->set($param);
// 		$this->Category->save();
		
		$this->Category->save($param);
// 		$this->Category->save();
		
// 		debug($this->Category);
		
// 		debug(count($data));
		debug(count($cat_pairs));
	
// 		debug($cat_pairs[0]);
		
	}//_read_CSV_Categories

	public function
	save_Data_Categories_from_CSV() {

		$fname = join(DS, array($this->path_Data, "Category_backup.csv"));

		/**********************************
		* read csv
		**********************************/
// 		$data = $this->csv_to_array($fname, ',');
		$data = Utils::csv_to_array($fname, ',');

		/**********************************
		* build list
		**********************************/
		$cat_pairs = array();
		
		for ($i = 3; $i < count($data); $i++) {
			
// 			if ($i < 10) {
				
// 				Utils::write_Log(
// 					Utils::get_dPath_Log(),
// 					//REF http://www.phpbook.jp/func/string/index7.html
// 					sprintf("data[%d] => %s, %s, %s", 
// 							$i, $data[$i][0], $data[$i][1], $data[$i][2]),
// 					__FILE__, __LINE__);
				
// 			}
			
			$pair = array();
			
			array_push($pair, $data[$i][0]);
			
// 			array_push($pair, mb_convert_encoding($data[$i][1], "UTF-8", "EUCJP"));
// 			array_push($pair, mb_convert_encoding($data[$i][1], "UTF-8", "SJIS"));
// 			array_push($pair, mb_convert_encoding($data[$i][1], "UTF-8"));
			array_push($pair, $data[$i][1]);

			array_push($pair, $data[$i][2]);
			
			array_push($cat_pairs, $pair);
			
		}
		
// 		debug($cat_pairs[0]);
		Utils::write_Log(
					Utils::get_dPath_Log(),
					"\$cat_pairs => ".((string)count($cat_pairs)),
					__FILE__, __LINE__);
		
		/**********************************
		* save data
		**********************************/
		$counter = 0;
		
		foreach ($cat_pairs as $cat_pair) {
		
// 			Utils::write_Log(
// 					Utils::get_dPath_Log(),
// 					"foreach",
// 					__FILE__, __LINE__);
			
// 			Utils::write_Log(
// 					Utils::get_dPath_Log(),
// 					"\$cat_pair => ".$cat_pair[1],
// 					__FILE__, __LINE__);
			if (env('SERVER_NAME') == 'localhost') {	//REF api http://php.net/manual/ja/reserved.variables.server.php
// 			if (env('SERVER_NAME') !== 'localhost') {	//REF api http://php.net/manual/ja/reserved.variables.server.php
			
				if ($cat_pair[2] == 3) {
					
					$cat_pair[2] = 4;
					
				} else if ($cat_pair[2] == 1) {
					
					$cat_pair[2] = 2;
					
				} else if ($cat_pair[2] == 2) {
					
					$cat_pair[2] = 3;
					
				} else {
					
					continue;
					
				}
				
			} else {
				
				if ($cat_pair[2] == 3) {
					
					$cat_pair[2] = 3;
					
				} else if ($cat_pair[2] == 1) {
					
					$cat_pair[2] = 1;
					
				} else if ($cat_pair[2] == 2) {
					
					$cat_pair[2] = 2;
					
				} else {
					
					continue;
					
				}
				
			}
				
			$this->Category->create();
			
			// 		$this->Category->name = $cat_pairs[1][1];
			
			// 		$this->Category->genre_id = 4;
			
			$param = array('Category' =>
			
					array(
							'name' => $cat_pair[1],
							'genre_id' => $cat_pair[2],
							'original_id'	=> $cat_pair[0]
// 							'name' => $cat_pair[0],
// 							'genre_id' => $cat_pair[1]
					)
			
			);
			
// 			Utils::write_Log(
// 					Utils::get_dPath_Log(),
// 					"param => built",
// 					__FILE__, __LINE__);
			
			if ($this->Category->save($param)) {
				
				$counter += 1;
				
			}
			
// 			//test
// 			if ($counter > 20) {
				
// 				break;
				
// 			}
			
		}//foreach ($cat_pairs as $cat_pair)
		
		Utils::write_Log(
					Utils::get_dPath_Log(),
					"counter => ".((string)$counter),
					__FILE__, __LINE__);
		
		
		$this->Session->setFlash(__('Save categories from csv => executed'));
		
		return $this->redirect(
				array(
						'controller' => 'categorys',
						'action' => 'index'
		
				));
		
	}//_read_CSV_Categories

	//REF http://php.net/manual/ja/function.str-getcsv.php
	public function 
	csv_to_array
	($filename='', $delimiter=',') {
		
		//test
		setlocale(LC_ALL, 'ja_JP.UTF-8');
// 		setlocale(LC_ALL, 'ja_JP.EUCJP');
		
		//test
		Utils::write_Log(
				Utils::get_dPath_Log(),
				//REF http://www.phpbook.jp/func/string/index7.html
				"mb_internal_encoding => ".mb_internal_encoding(),
				__FILE__, __LINE__);
		
		
		if(!file_exists($filename) || !is_readable($filename))
			return FALSE;
	
// 		$header = NULL;
		$data = array();
		
		if (($handle = fopen($filename, 'r')) !== FALSE) {
			
			while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
				
// 				if(!$header)
// 					$header = $row;
// 				else
// 					$data[] = array_combine($header, $row);
				array_push($data, $row);
				
			}
			
			fclose($handle);
			
		}
		
		return $data;
		
	}//csv_to_array
	
}//CategorysController