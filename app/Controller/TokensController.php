<?php

class TokensController extends AppController {
	public $helpers = array('Html', 'Form');

	public function index() {
		$this->set('tokens', $this->Token->find('all'));
	}
	
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid token'));
		}
	
		$token = $this->Token->findById($id);
		if (!$token) {
			throw new NotFoundException(__('Invalid token'));
		}
		$this->set('token', $token);
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Token->create();
			
			$this->request->data['Token']['created_at'] = Utils::get_CurrentTime();
			$this->request->data['Token']['updated_at'] = Utils::get_CurrentTime();
			
			if ($this->Token->save($this->request->data)) {
				$this->Session->setFlash(__('Your tokens has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to add your tokens.'));
		}
	}

	public function delete($id) {
		/******************************
	
		validate
	
		******************************/
		if (!$id) {
			throw new NotFoundException(__('Invalid token id'));
		}
	
		$token = $this->Token->findById($id);
	
		if (!$token) {
			throw new NotFoundException(__("Can't find the token. id = %d", $id));
		}
	
		/******************************
	
		delete
	
		******************************/
		if ($this->Token->delete($id)) {
			// 		if ($this->Token->save($this->request->data)) {
	
			$this->Session->setFlash(__(
					"Token deleted => %s",
					$token['Token']['name']));
	
			return $this->redirect(
					array(
							'controller' => 'tokens',
							'action' => 'index'
	
					));
	
		} else {
	
			$this->Session->setFlash(
					__("Token can't be deleted => %s",
							$token['Token']['name']));
	
			// 			$page_num = _get_Page_from_Id($id - 1);
	
			return $this->redirect(
					array(
							'controller' => 'tokens',
							'action' => 'view',
							$id
					));
	
		}
	
	}//public function delete($id)
	
}