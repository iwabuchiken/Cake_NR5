<?php

class KeywordsController extends AppController {
	public $helpers = array('Html', 'Form', 'Keyword');
// 	public $helpers = array('Html', 'Form');

	public function index() {
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
	
}