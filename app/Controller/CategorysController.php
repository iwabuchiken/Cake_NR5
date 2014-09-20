<?php

class CategorysController extends AppController {
// class CategoriesController extends AppController {
	
	public $helpers = array('Html', 'Form');

	public function index() {
		$this->set('categories', $this->Category->find('all'));
	}
	
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid genre'));
		}
	
		$category = $this->Category->findById($id);
		if (!$category) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->set('category', $category);
		
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Category->create();
			
			$this->request->data['Category']['created_at'] = Utils::get_CurrentTime();
			$this->request->data['Category']['updated_at'] = Utils::get_CurrentTime();
			
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('Your categories has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to add your categories.'));
		} else {//if ($this->request->is('post'))
			
			$this->loadModel('Genre');
				
			$genres = $this->Genre->find('all');
				
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
	
}