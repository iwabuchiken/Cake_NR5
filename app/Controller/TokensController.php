<?php

class TokensController extends AppController {
	public $helpers = array('Html', 'Form');

	public $components = array('Paginator');
	
	public function index() {

		/**********************************
		* query
		**********************************/
// 		debug($this->request->query);
		
		/**********************************
		 * paginate
		**********************************/
		$page_limit = 10;
		
		$opt_order = array(
						'Token.id' => 'asc',
// 						'Token.hin' => 'asc',
// 						'Token.hin_1' => 'asc'
		
		);
		
		$opt_conditions = $this->_index__Options();
// 		$opt_conditions = '';
		
		$this->paginate = array(
				// 					'conditions' => array('Image.file_name LIKE' => "%$filter_TableName%"),
		// 				'conditions' => array('Image.memos LIKE' => "%$filter_TableName%"),
				'limit' => $page_limit,
				'order' => $opt_order,
				'conditions'	=> $opt_conditions
				// 				'order' => array(
						// 						'id' => 'asc'
						// 				)
		);
		
		$this->set('tokens', $this->paginate('Token'));
		
		$num_of_tokens = count($this->Token->find('all'));
		$this->set('num_of_tokens', $num_of_tokens);
		
		$this->set('num_of_pages', (int) ceil($num_of_tokens / $page_limit));

		/**********************************
		* filter: hins
		**********************************/
		$hins_Array = $this->_get_HinsArray();

// 		debug($hins_Array);
		
		$this->set("hins_Array", $hins_Array);
		
		/**********************************
		 * labels: options, sorts
		**********************************/
		@$chosen_hin = $hins_Array[$opt_conditions['Token.hin']];
		// 		@$chosen_Lang = $opt_conditions['Text.lang_id'];
		
		if ($chosen_hin == null) {
				
			$chosen_hin = "No chonsen hin";
				
			$this->set("chosen_hin", null);
				
// 			$this->set("chosen_lang_id", null);
				
		} else {
		
			$this->set("chosen_hin", $chosen_hin);
				
// 			$this->set("chosen_lang_id", $opt_conditions['Text.lang_id']);
		
		}
		
	}

	public function
	_index__Options() {
	
		/**********************************
		 * param: filter: lang_id
		**********************************/
		$filter_hins = CONS::$str_Filter_Hins;
// 		$filter_hins = "filter_hins";
	
		$opt_conditions = array();
	
		@$query_Filter_Hins = $this->request->query[$filter_hins];
	
		if ($query_Filter_Hins == CONS::$str_Filter_Hins_all) {
// 		if ($query_Filter_Hins == "-1") {
	
			$this->Session->write($filter_hins, null);
	
			$this->set("filter_hins", '');
	
		} else if ($query_Filter_Hins == null) {
	
			@$session_Filter = $this->Session->read($filter_hins);
	
			if ($session_Filter != null) {
	
				$opt_conditions['Token.hin'] = $session_Filter;
	
				/**********************************
				 * set: var
				**********************************/
				$this->set("filter_hins", $session_Filter);
	
			} else {
	
				/**********************************
				 * set: var
				**********************************/
				$this->set("filter_hins", null);
	
			}
	
		} else {
	
			// 			$opt_conditions['History.line LIKE'] = "%$query_Filter_Hins%";
	
			//REF http://book.cakephp.org/2.0/en/models/retrieving-your-data.html
			$opt_conditions['Token.hin'] = $query_Filter_Hins;
	
			$session_Filter = $this->Session->write($filter_hins, $query_Filter_Hins);
	
			//			debug("session_Filter => written");
	
			/**********************************
			 * set: var
			**********************************/
			$this->set("filter_hins", $query_Filter_Hins);
	
		}
	
		/**********************************
			* return
		**********************************/
		return $opt_conditions;
	
	}//_index__Options
	
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

	public function delete_all() {
	
		//REF http://book.cakephp.org/2.0/ja/core-libraries/helpers/html.html
		if ($this->Token->deleteAll(array('Token.id >=' => 1))) {
// 		if ($this->Token->deleteAll(array('id >=' => 1))) {
			
			$this->Session->setFlash(__('Tokens =>  all deleted'));
			return $this->redirect(array('action' => 'index'));
			
		} else {
	
			$this->Session->setFlash(__('Tokens =>  not deleted'));
			return $this->redirect(array('action' => 'index'));
	
		}
	
	}

	public function test_1() {
		
		$option = array(
			
				'conditions' => array('Token.hin_1'	=> '格助詞')
// 				'conditions' => array('Token.hin_1'	=> '固有名詞')
// 				'Token.history_id'	=> '82'
// 				'Token.hin_1'	=> '固有名詞'
				
		);
		
		$tokens = $this->Token->find('all', $option);		
		
// 		debug("tokens...");
// 		debug(count($tokens));
// 		debug($tokens[0]);
// 		debug($tokens);
		
		/**********************************
		* build: text
		**********************************/
		$text = "";
		
		for ($i = 0; $i < count($tokens); $i++) {
			
			$text .= "/".$tokens[$i]['Token']['form'];
// 			$text .= $tokens[$i]['Token']['form'];
// 			$text .= $tokens[$i]['Token']['hin'];
			
		}
		
		/**********************************
		* set
		**********************************/
		$this->set("text", $text);
		
	}

	public function create_hins() {
		
		debug("create_hins");
		
		/**********************************
		* get: hins
		**********************************/
		$tokens = $this->Token->find('all');
		
		$hins = array();
		
		for ($i = 0; $i < count($tokens); $i++) {
			
			array_push($hins, $tokens[$i]['Token']['hin']);
			
		}

		$hins = array_unique($hins);
		
		/**********************************
		* build: string
		**********************************/
		$hins_string = implode($hins, "/");
		
		$select_Hins = array();
		
		$hins = array_values($hins);
		
		for ($i = 0; $i < count($hins); $i++) {
			
			$select_Hins[$hins[$i]] = $hins[$i];
// 			$select_Hins[$i] = $hins[$i];
			
		}
		
		debug($select_Hins);
// 		debug($hins);
		
		//REF http://stackoverflow.com/questions/5943149/rebase-array-keys-after-unsetting-elements answered May 9 '11 at 22:18 
// 		debug(array_values($hins));
		
		$this->set("hins_string", $hins_string);
		
		
// 		return $this->redirect(array('action' => 'test_1'));
		
	}
	
	public function
	_get_HinsArray() {

		/**********************************
		 * get: hins
		**********************************/
		$tokens = $this->Token->find('all');
		
		$hins = array();
		
		for ($i = 0; $i < count($tokens); $i++) {
				
			array_push($hins, $tokens[$i]['Token']['hin']);
				
		}
		
		$hins = array_unique($hins);
		
		/**********************************
		 * build: string
		**********************************/
		$hins_string = implode($hins, "/");
		
		$select_Hins = array();
		
		$hins = array_values($hins);
		
		for ($i = 0; $i < count($hins); $i++) {
				
			$select_Hins[$hins[$i]] = $hins[$i];
// 			$select_Hins[$i] = $hins[$i];
				
		}

		$select_Hins[CONS::$str_Filter_Hins_all] = CONS::$str_Filter_Hins_all;
// 		debug($select_Hins);
		
		return $select_Hins;
		
	}//_get_HinsArray
	
}