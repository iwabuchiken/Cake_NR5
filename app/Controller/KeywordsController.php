<?php

class KeywordsController extends AppController {
	public $helpers = array('Html', 'Form', 'Keyword');
// 	public $helpers = array('Html', 'Form');

	public $components = array('Paginator');
	
	public function index() {
		
		//REF http://www.codeofaninja.com/2013/07/pagination-in-cakephp.html
		$this->paginate = array(
				'limit' => 4,
				'order' => array(
						'id' => 'asc'
				)
		);
		
		$this->set('keywords', $this->Keyword->find('all'));
		
// 		$this->set('genre', $this->_get_Genre($keyword['Category']['id']));
	}
	
	public function 
	view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid keyword'));
		}
	
		$keyword = $this->Keyword->findById($id);
		if (!$keyword) {
			throw new NotFoundException(__('Invalid keyword'));
		}
		
// 		debug($keyword);
		
		$this->set('keyword', $keyword);
		
		$genre = $this->_get_Genre($keyword['Category']['id']);
		
// 		debug($genre);
		
		$this->set('genre', $this->_get_Genre($keyword['Category']['id']));
		
	}//view

	public function 
	_get_Genre
	($category_id) {
		
		/**********************************
		* category
		**********************************/
		$this->loadModel('Category');
		
		$option = array(
					'conditions' => array('Category.id' => $category_id));
		
		$category = $this->Category->find('first', $option);
// 		$categories = $this->Category->find('all', $option);
		
		/**********************************
		* genre
		**********************************/
		$this->loadModel('Genre');
		
		$option = array(
					'conditions' => array(
									'Genre.id' => $category['Genre']['id']));
// 									'Genre.id' => $categories[0]['Genre']['id']));
		
		$genre = $this->Genre->find('first', $option);
		
		/**********************************
		* return
		**********************************/
		return $genre;
// 		return $genres[0];
		
	}//_get_Genre
	
	public function 
	add() {
		if ($this->request->is('post')) {
			$this->Keyword->create();
			
			$this->request->data['Keyword']['created_at'] = Utils::get_CurrentTime();
			$this->request->data['Keyword']['updated_at'] = Utils::get_CurrentTime();
			
			if ($this->Keyword->save($this->request->data)) {
				$this->Session->setFlash(__('Your keywords has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to add your keywords.'));
		} else {
			
			$select_Genres = $this->_get_Selector_Genre();
			
			$this->set('select_Genres', $select_Genres);
			
			$select_Categories = $this->_get_Selector_Category();
			
			$this->set('select_Categories', $select_Categories);
			
			
		}
		
	}//add

	public function 
	_get_Selector_Category() {

		$this->loadModel('Category');
		
		$genres = $this->Category->find('all');
		
		$select_Categories = array();
		
		foreach ($genres as $genre) {
				
			$genre_Name = $genre['Category']['name'];
			$genre_Id = $genre['Category']['id'];
				
			$select_Categories[$genre_Id] = $genre_Name;
				
		}
		
		return $select_Categories;
		
	}//_get_Selector_Category
	
	public function 
	_get_Selector_Genre() {

		$this->loadModel('Genre');
		
		$genres = $this->Genre->find('all');
		
		$select_Genres = array();
		
		foreach ($genres as $genre) {
				
			$genre_Name = $genre['Genre']['name'];
			$genre_Id = $genre['Genre']['id'];
				
			$select_Genres[$genre_Id] = $genre_Name;
				
		}
		
		return $select_Genres;
		
	}//_get_Selector_Genre
	
	public function delete($id) {
		/******************************
	
		validate
	
		******************************/
		if (!$id) {
			throw new NotFoundException(__('Invalid keyword id'));
		}
	
		$keyword = $this->Keyword->findById($id);
	
		if (!$keyword) {
			throw new NotFoundException(__("Can't find the keyword. id = %d", $id));
		}
	
		/******************************
	
		delete
	
		******************************/
		if ($this->Keyword->delete($id)) {
			// 		if ($this->Keyword->save($this->request->data)) {
	
			$this->Session->setFlash(__(
					"Keyword deleted => %s",
					$keyword['Keyword']['name']));
	
			return $this->redirect(
					array(
							'controller' => 'keywords',
							'action' => 'index'
	
					));
	
		} else {
	
			$this->Session->setFlash(
					__("Keyword can't be deleted => %s",
							$keyword['Keyword']['name']));
	
			// 			$page_num = _get_Page_from_Id($id - 1);
	
			return $this->redirect(
					array(
							'controller' => 'keywords',
							'action' => 'view',
							$id
					));
	
		}
	
	}//public function delete($id)

	public function
	save_Data_Keywords_from_CSV() {
		/**********************************
		* list: categories
		**********************************/
		$this->loadModel('Category');
		
		$categories = $this->Category->find('all');
		
		/**********************************
			* read csv
		**********************************/
		$fname = join(DS, array($this->path_Data, "Keyword_backup.csv"));
		
		// 		$data = $this->csv_to_array($fname, ',');
		$data = Utils::csv_to_array($fname, ',');
	
		/**********************************
			* build list
		**********************************/
		$kw_pairs = $this->_save_Data_Keywords_from_CSV__KWPairs($data);
// 		$cat_pairs = array();
	
// 		for ($i = 3; $i < count($data); $i++) {
				
// 			// 			if ($i < 10) {
	
// 			// 				Utils::write_Log(
// 			// 					Utils::get_dPath_Log(),
// 			// 					//REF http://www.phpbook.jp/func/string/index7.html
// 			// 					sprintf("data[%d] => %s, %s, %s",
// 			// 							$i, $data[$i][0], $data[$i][1], $data[$i][2]),
// 			// 					__FILE__, __LINE__);
	
// 			// 			}
				
// 			$pair = array();
				
// 			array_push($pair, $data[$i][0]);
// 			array_push($pair, $data[$i][1]);
// 			array_push($pair, $data[$i][2]);
// 			array_push($pair, $data[$i][3]);
				
// 			array_push($cat_pairs, $pair);
				
// 		}
	
// 		// 		debug($cat_pairs[0]);
// 		Utils::write_Log(
// 		Utils::get_dPath_Log(),
// 		"\$cat_pairs => ".((string)count($cat_pairs)),
// 		__FILE__, __LINE__);
	
		/**********************************
			* save data
		**********************************/
		$counter = 0;
	
		foreach ($kw_pairs as $kw_pair) {
	
			$this->Keyword->create();

			$cat_id = $this->_save_Data_Keywords_from_CSV__Get_CatID_From_OrigID(
								$kw_pair[3], $categories);
			
			// valiate
			if ($cat_id == false) {
				
				continue;
				
			}
			
			// build param
			$param = array('Keyword' =>
						
					array(
							
							'name'			=> $kw_pair[1],
							'category_id'	=> $cat_id,
							'created_at'	=> Utils::get_CurrentTime(),
							'updated_at'	=> Utils::get_CurrentTime()
							
					)
						
			);
			
			// 			Utils::write_Log(
			// 					Utils::get_dPath_Log(),
			// 					"param => built",
			// 					__FILE__, __LINE__);
				
			if ($this->Keyword->save($param)) {
	
				$counter += 1;
	
			}
				
// 						//test
// 						if ($counter > 20) {
	
// 							break;
	
// 						}
				
		}//foreach ($cat_pairs as $cat_pair)
	
		Utils::write_Log(
		Utils::get_dPath_Log(),
		"counter => ".((string)$counter),
		__FILE__, __LINE__);
	
	
		$this->Session->setFlash(__('Save keywords from csv => executed'));
	
		return $this->redirect(
				array(
						'controller' => 'keywords',
						'action' => 'index'
	
				));
	
	}//_read_CSV_Categories

	public function
	_save_Data_Keywords_from_CSV__Get_CatID_From_OrigID($orig_id, $categories) {
		
		foreach ($categories as $cat) {
		
			if ($cat['Category']['original_id'] == $orig_id) {
				
				return $cat['Category']['id'];
				
			};
		
		}
		
		return false;
		
	}//_save_Data_Keywords_from_CSV__Get_CatID_From_OrigID
	
	public function
	_save_Data_Keywords_from_CSV__KWPairs($data) {

		$kw_pairs = array();
		
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
			array_push($pair, $data[$i][1]);
			array_push($pair, $data[$i][2]);
			array_push($pair, $data[$i][3]);
		
			array_push($kw_pairs, $pair);
		
		}
		
		// 		debug($kw_pairs[0]);
		Utils::write_Log(
		Utils::get_dPath_Log(),
		"\$kw_pairs => ".((string)count($kw_pairs)),
		__FILE__, __LINE__);
		
		return $kw_pairs;
		
	}//_save_Data_Keywords_from_CSV__CatPairs

	public function
	delete_all() {
	
		//REF http://book.cakephp.org/2.0/ja/core-libraries/helpers/html.html
		if ($this->Keyword->deleteAll(array('Keyword.id >=' => 1))) {
			// 		if ($this->Category->deleteAll(array('id >=' => 1))) {
				
			$this->Session->setFlash(__('Keywords all deleted'));
			return $this->redirect(array('action' => 'index'));
				
		} else {
	
			$this->Session->setFlash(__('Keywords not deleted'));
			return $this->redirect(array('action' => 'index'));
	
		}
	
	}//delete_all
	
}