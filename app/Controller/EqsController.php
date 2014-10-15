<?php

class EqsController extends AppController {
	public $helpers = array('Html', 'Form');

	public function index() {
		$this->set('eqs', $this->Eq->find('all'));
	}
	
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid genre'));
		}
	
		$genre = $this->Eq->findById($id);
		if (!$genre) {
			throw new NotFoundException(__('Invalid genre'));
		}
		$this->set('genre', $genre);
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Eq->create();
			
			$this->request->data['Eq']['created_at'] = Utils::get_CurrentTime();
			$this->request->data['Eq']['updated_at'] = Utils::get_CurrentTime();
			
			if ($this->Eq->save($this->request->data)) {
				$this->Session->setFlash(__('Your eqs has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to add your eqs.'));
		}
	}

	public function delete($id) {
		/******************************
	
		validate
	
		******************************/
		if (!$id) {
			throw new NotFoundException(__('Invalid genre id'));
		}
	
		$genre = $this->Eq->findById($id);
	
		if (!$genre) {
			throw new NotFoundException(__("Can't find the genre. id = %d", $id));
		}
	
		/******************************
	
		delete
	
		******************************/
		if ($this->Eq->delete($id)) {
			// 		if ($this->Eq->save($this->request->data)) {
	
			$this->Session->setFlash(__(
					"Eq deleted => %s",
					$genre['Eq']['name']));
	
			return $this->redirect(
					array(
							'controller' => 'eqs',
							'action' => 'index'
	
					));
	
		} else {
	
			$this->Session->setFlash(
					__("Eq can't be deleted => %s",
							$genre['Eq']['name']));
	
			// 			$page_num = _get_Page_from_Id($id - 1);
	
			return $this->redirect(
					array(
							'controller' => 'eqs',
							'action' => 'view',
							$id
					));
	
		}
	
	}//public function delete($id)

	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid text'));
		}
	
		/****************************************
			* Langs data
		****************************************/
		$this->loadModel('Lang');
			
		$langs = $this->Lang->find('all');
			
		// 			debug($langs);
			
		$select_Langs = array();
			
		foreach ($langs as $lang) {
	
			$lang_Name = $lang['Lang']['name'];
			$lang_Id = $lang['Lang']['id'];
	
			$select_Langs[$lang_Id] = $lang_Name;
	
		}
			
		// 			debug($select_Langs);
			
		$this->set('select_Langs', $select_Langs);
	
		/****************************************
			* Text
		****************************************/
		$text = $this->Text->findById($id);
		if (!$text) {
			throw new NotFoundException(__('Invalid text'));
		}
	
		// 		debug($this->request);
	
		// 		if ($this->request->is(array('text', 'put'))) {
			
		$this->Text->id = $id;
			
		if ($this->Text->save($this->request->data)) {
	
			$this->Session->setFlash(__('Your text has been updated.'));
			return $this->redirect(
					array(
							'action' => 'view',
							$id));
	
		}//if ($this->Text->save($this->request->data))
			
		$this->Session->setFlash(__('Unable to update your text.'));
			
			// 		} else {
	
		// 			$this->Session->setFlash(__(
		// 					"Sorry. \$this->request->is(array('text', 'put')) => Not true"));
	
		// 		}//if ($this->request->is(array('text', 'put')))
	
		if (!$this->request->data) {
			$this->request->data = $text;;
		}
	
	}//public function edit($id = null)
	
}