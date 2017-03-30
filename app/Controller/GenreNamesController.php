<?php

/*
 * access: http://localhost/Eclipse_Luna/Cake_NR5/genre_names
 */
class GenreNamesController extends AppController {
// class ArticlesController extends AppController {
	public $helpers = array('Html', 'Form', 'Mytest');
// 	public $helpers = array('Html', 'Form');

	public function 
	index() {

		//
		$genre_names = $this->GenreName->find('all');
		
		$this->set('genre_names', $genre_names);
		
// 		//debug
// 		debug($genre_names);
		
	}//index()

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
