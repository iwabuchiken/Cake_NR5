<?php

class EqsController extends AppController {
	public $helpers = array('Html', 'Form');

	public function index() {
		$this->set('eqs', $this->Eq->find('all'));
		
		$eqs = $this->_index__Get_EqInfo();
		
	}

	public function
	_index__Get_EqInfo() {
		
		$url = "http://typhoon.yahoo.co.jp/weather/jp/earthquake/list/";
		
		//REF http://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/
		$html = file_get_html($url);
		
		$trs = $html->find('table tr');
		
		$eqs = $this->_index__Conv_Html_to_Eqs($trs);
		
// 		$table = $html->find('table');
		
// 		if ($table != null) {
			
// 			debug(count($table));	//=> 1

// 			$trs = $html->find('table tr');
			
// 			debug(count($trs));	//=> 101
			
// 			debug(get_class($trs[0]));	//=> simple_html_dom_node
			
// 			$trs_0_children = $trs[0]->children();
			
// 			debug(count($trs_0_children));	//=> 5
			
// 			//td
// 			$td_1 = $trs_0_children[0];	// [node, node,...]

// 			debug(get_class($td_1));	//=> simple_html_dom_node
			
// 			debug($td_1->plaintext);	//=> '  発生時刻     '
			
// // 			$trs_children = $trs->children();	//=> Call to a member function children() on a non-object
			
// // 			$tds_1 = $trs[0]->children();
			
// // 			debug(get_class($tds_1[0]));	//=> simple_html_dom_node
			
// // 			$td_1 = $trs->first_child();	//=> Call to a member function first_child() on a non-object	
			
// // 			$td_1 = $trs[0]['td:first'];	//=> Cannot use object of type simple_html_dom_node as array
			
// // 			debug(array_keys($trs[0]));
// // 			debug($trs[0]);
// // 			$td = $trs->children(1);	//=> Call to a member function children() on a non-object
// // 			debug(array_keys($table));
// // 			debug(array_keys($table[0]));
// // 			debug($table[0]);
			
// // 			$trs = $table->tr;
			
// // 			debug(count($trs));
			
// 		} else {
			
// 			debug("\$table => null");
			
// 		}
		
// 		debug(get_class($table));
// 		debug($table);	//=> Allowed memory size of 134217728 bytes exhausted
		
	}//_index__Get_EqInfo
	
	public function 
	_index__Conv_Html_to_Eqs($trs) {
		
		$eqs = array();
		
		$tr_1 = $trs[1];
		
		$tds_1 = $tr_1->children();
		
		$eq = $this->Eq->create();
		
		$eq['time_eq'] = $tds_1[0]->plaintext;
		$eq['time_pub'] = $tds_1[1]->plaintext;
		$eq['epi'] = $tds_1[2]->plaintext;
		
		debug($eq);
		
// 		$td_1 = $tds_1[0];
		
// 		$time_eq = $td_1->plaintext;
		
// 		debug($time_eq);	//=> '2014年10月15日 7時52分ごろ'
// 		debug(count($tds_1));	//=> 5
		
	}//_index__Conv_Html_to_Eqs
	
	public function 
	view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid eq'));
		}
	
		$eq = $this->Eq->findById($id);
		if (!$eq) {
			throw new NotFoundException(__('Invalid eq'));
		}
		$this->set('eq', $eq);
	}

	public function 
	add() {
		if ($this->request->is('post')) {
			$this->Eq->create();
			
			$this->request->data['Eq']['created_at'] = Utils::get_CurrentTime();
			$this->request->data['Eq']['updated_at'] = Utils::get_CurrentTime();
			
			if ($this->Eq->save($this->request->data)) {
				$this->Session->setFlash(__('Your eqs has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('Unable to add your eqs.'));
			
		} else {
			
			$option = array('class' => 'flash_ok');
			
			//REF flash bg http://hijiriworld.com/web/cakephp-setflash/
			$this->Session->setFlash(__('Add Eq'), 'default', $option);
// 			$this->Session->setFlash(__('Add Eq'));
			
		}
		
	}//add

	public function delete($id) {
		/******************************
	
		validate
	
		******************************/
		if (!$id) {
			throw new NotFoundException(__('Invalid eq id'));
		}
	
		$eq = $this->Eq->findById($id);
	
		if (!$eq) {
			throw new NotFoundException(__("Can't find the eq. id = %d", $id));
		}
	
		/******************************
	
		delete
	
		******************************/
		if ($this->Eq->delete($id)) {
			// 		if ($this->Eq->save($this->request->data)) {
	
			$this->Session->setFlash(__(
					"Eq deleted => %s",
					$eq['Eq']['epi']));
	
			return $this->redirect(
					array(
							'controller' => 'eqs',
							'action' => 'index'
	
					));
	
		} else {
	
			$this->Session->setFlash(
					__("Eq can't be deleted => %s",
							$eq['Eq']['epi']));
	
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

	public function
	delete_all() {
	
		//REF http://book.cakephp.org/2.0/ja/core-libraries/helpers/html.html
		if ($this->Eq->deleteAll(array('Eq.id >=' => 1))) {
			// 		if ($this->Category->deleteAll(array('id >=' => 1))) {
	
			$this->Session->setFlash(__('Eqs all deleted'));
			return $this->redirect(array('action' => 'index'));
	
		} else {
	
			$this->Session->setFlash(__('Eqs not deleted'));
			return $this->redirect(array('action' => 'index'));
	
		}
	
	}//delete_all
	
}