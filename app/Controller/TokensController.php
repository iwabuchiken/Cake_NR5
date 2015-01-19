<?php

class TokensController extends AppController {
	public $helpers = array('Html', 'Form');

	public $components = array('Paginator');
	
	public function 
	index() {

		/**********************************
		* query
		**********************************/
// 		debug($this->request->query);
		
		/**********************************
		 * paginate
		**********************************/
		$page_limit = 10;
		
		$opt_order = $this->_index__Orders();
// 		$opt_order = array(
// 						'Token.id' => 'asc',
// 						'Token.hin' => 'asc',
// 						'Token.hin_1' => 'asc'
		
// 		);
		
		$opt_conditions = $this->_index__Options();
// 		$opt_conditions = '';

// 		debug("\$opt_conditions is...");
// 		debug($opt_conditions);
		
		
		
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
		* filter: hins_1
		**********************************/
		$hins_1_Array = $this->_get_Hins_1_Array();

// 		debug($hins_Array);
		
		$this->set("hins_1_Array", $hins_1_Array);
		
		/**********************************
		* filter: history_id
		**********************************/
		$history_id_Array = $this->_get_History_Id_Array();

// 		debug($hins_Array);
// 		debug("\$opt_conditions is...");
// 		debug($opt_conditions);
		
		$this->set("history_id_Array", $history_id_Array);
		
		/**********************************
		 * labels: options, sorts
		**********************************/
		$this->_index_SetLabels(
					$opt_conditions,
					$hins_Array, $hins_1_Array,
					$history_id_Array
		);
		
	}//index

	public function
	_index_SetLabels
	($opt_conditions, $hins_Array, $hins_1_Array,
		$history_id_Array) {

// 		debug($opt_conditions);
		
		/**********************************
		 * hin
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
		
		/**********************************
		 * hin_1
		**********************************/
		// 		debug($opt_conditions);
		
		@$chosen_hin_1 = $hins_1_Array[$opt_conditions['Token.hin_1']];
		// 		@$chosen_Lang = $opt_conditions['Text.lang_id'];
		
// 		debug($chosen_hin_1);
		
		if ($chosen_hin_1 == null) {
		
			$chosen_hin_1 = "No chonsen hin_1";
		
			$this->set("chosen_hin_1", null);
		
			// 			$this->set("chosen_lang_id", null);
		
		} else {
		
			$this->set("chosen_hin_1", $chosen_hin_1);
		
// 			debug("chosen_hin_1 => set");
			
			// 			$this->set("chosen_lang_id", $opt_conditions['Text.lang_id']);
		
		}
		
		/**********************************
		 * history_id_Array
		**********************************/
		// 		debug($opt_conditions);
		
		@$chosen_history_id = $history_id_Array[$opt_conditions['Token.history_id']];
		// 		@$chosen_Lang = $opt_conditions['Text.lang_id'];
		
//		debug($chosen_history_id);
		
		if ($chosen_history_id == null) {
		
			$chosen_history_id = "No chonsen history_id";
		
			$this->set("chosen_history_id", null);
		
			// 			$this->set("chosen_lang_id", null);
		
		} else {
		
			$this->set("chosen_history_id", $chosen_history_id);
		
//			debug("chosen_history_id => set");
			
			// 			$this->set("chosen_lang_id", $opt_conditions['Text.lang_id']);
		
		}
		
	}//_index_SetLabels($opt_conditions)
	
	public function
	_index__Options() {
	
		/**********************************
		 * param: filter: hin
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
		* hin_1
		**********************************/
		$opt_conditions = $this->_index__Options__Hin_1($opt_conditions);
		
		/**********************************
		* history_id
		**********************************/
		$opt_conditions = $this->_index__Options__Hist_Id($opt_conditions);
		
		/**********************************
			* return
		**********************************/
		return $opt_conditions;
	
	}//_index__Options
	
	public function
	_index__Orders() {
	
		/**********************************
		 * param: sort
		**********************************/
		// 		debug($this->request->data);
		// 		debug($this->request->query);
		$opt_order = array();
	
		$sort = "sort";
	
		@$query_Sort = $this->request->query[$sort];
	
		if ($query_Sort == null) {
	
			@$session_Sort = $this->Session->read($sort);
	
			//			debug("session_Sort is ...");
			//			debug($this->Session->read($sort));
	
			if ($session_Sort != null) {
	
				$opt_order["Token.$session_Sort"] = "asc";
	
				/**********************************
				 * set: var
				**********************************/
				$this->set("sort", $session_Sort);
	
			} else {
	
				/**********************************
				 * set: var
				**********************************/
				$this->set("sort", null);
	
			}
	
		} else {
	
			// 			$opt_order['History.line LIKE'] = "%$query_Sort%";
				
			$opt_order["Token.$query_Sort"] = "asc";
				
			$session_Sort = $this->Session->write($sort, $query_Sort);
	
			//			debug("session_Sort => written: ".$query_Sort);
	
			/**********************************
			 * set: var
			**********************************/
			$this->set("sort", $query_Sort);
				
		}
	
		return $opt_order;
	
	}//_index__Orders
	
	public function
	_index__Options__Hin_1($opt_conditions) {
	
		/**********************************
		 * param: filter: hin
		**********************************/
		$filter_hins_1 = CONS::$str_Filter_Hins_1;
// 		$filter_hins = "filter_hins_1";
	
// 		$opt_conditions = array();
	
		@$query_Filter_Hins_1 = $this->request->query[$filter_hins_1];

// 		debug("query_Filter_Hins_1 is...");
// 		debug($query_Filter_Hins_1);
		
		if ($query_Filter_Hins_1 == CONS::$str_Filter_Hins_1_all) {
// 		if ($query_Filter_Hins == "-1") {
	
			$this->Session->write($filter_hins_1, null);
	
			$this->set("filter_hins_1", '');
	
		} else if ($query_Filter_Hins_1 == null) {
	
			@$session_Filter = $this->Session->read($filter_hins_1);
	
			if ($session_Filter != null) {
	
				$opt_conditions['Token.hin_1'] = $session_Filter;
	
				/**********************************
				 * set: var
				**********************************/
				$this->set("filter_hins_1", $session_Filter);
	
			} else {
	
				/**********************************
				 * set: var
				**********************************/
				$this->set("filter_hins_1", null);
	
			}
	
		} else {
	
			// 			$opt_conditions['History.line LIKE'] = "%$query_Filter_Hins%";
	
			//REF http://book.cakephp.org/2.0/en/models/retrieving-your-data.html
			$opt_conditions['Token.hin_1'] = $query_Filter_Hins_1;
	
			$session_Filter = $this->Session->write($filter_hins_1, $query_Filter_Hins_1);
	
			//			debug("session_Filter => written");
	
			/**********************************
			 * set: var
			**********************************/
			$this->set("filter_hins_1", $query_Filter_Hins_1);
	
		}
	
		/**********************************
			* return
		**********************************/
// 		debug("\$opt_conditions is...");
// 		debug($opt_conditions);
		
		return $opt_conditions;
	
	}//_index__Options__Hin_1
	
	public function
	_index__Options__Hist_Id($opt_conditions) {
	
		/**********************************
		 * param: filter: hin
		**********************************/
		$filter_hist_id = CONS::$str_Filter_Hist_Id;
// 		$filter_hins = "filter_hist_id";
	
// 		$opt_conditions = array();
	
		@$query_Filter_Hist_Id = $this->request->query[$filter_hist_id];

		
// 		debug("query_Filter_Hist_Id is...");
// 		debug($query_Filter_Hist_Id);
		
		if ($query_Filter_Hist_Id == CONS::$str_Filter_Hist_Id_all) {
// 		if ($query_Filter_Hins == "-1") {
	
			$this->Session->write($filter_hist_id, null);
	
			$this->set("filter_hist_id", '');
	
		} else if ($query_Filter_Hist_Id == null) {
	
			@$session_Filter = $this->Session->read($filter_hist_id);
	
			if ($session_Filter != null) {
	
				$opt_conditions['Token.history_id'] = $session_Filter;
	
				/**********************************
				 * set: var
				**********************************/
				$this->set("filter_hist_id", $session_Filter);
	
			} else {
	
				/**********************************
				 * set: var
				**********************************/
				$this->set("filter_hist_id", null);
	
			}
	
		} else {
	
			// 			$opt_conditions['History.line LIKE'] = "%$query_Filter_Hins%";
	
			//REF http://book.cakephp.org/2.0/en/models/retrieving-your-data.html
			$opt_conditions['Token.history_id'] = $query_Filter_Hist_Id;
	
			$session_Filter = $this->Session->write($filter_hist_id, $query_Filter_Hist_Id);
	
			//			debug("session_Filter => written");
	
			/**********************************
			 * set: var
			**********************************/
			$this->set("filter_hist_id", $query_Filter_Hist_Id);
	
		}
	
		/**********************************
			* return
		**********************************/
// 		debug("\$opt_conditions is...");
// 		debug($opt_conditions);
		
		return $opt_conditions;
	
	}//_index__Options__Hin_1
	
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
		
//		debug("create_hins");
		
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
		
//		debug($select_Hins);
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
	
	public function
	_get_Hins_1_Array() {

		/**********************************
		 * get: hins
		**********************************/
		$tokens = $this->Token->find('all');
		
		$hins_1 = array();
		
		for ($i = 0; $i < count($tokens); $i++) {
				
			array_push($hins_1, $tokens[$i]['Token']['hin_1']);
				
		}
		
		$hins_1 = array_unique($hins_1);
		
		/**********************************
		 * build: string
		**********************************/
		$hins_1_string = implode($hins_1, "/");
		
		$select_Hins_1 = array();
		
		$hins_1 = array_values($hins_1);
		
		for ($i = 0; $i < count($hins_1); $i++) {
				
			$select_Hins_1[$hins_1[$i]] = $hins_1[$i];
// 			$select_Hins_1[$i] = $hins_1[$i];
				
		}

		$select_Hins_1[CONS::$str_Filter_Hins_1_all] = CONS::$str_Filter_Hins_1_all;
// 		debug($select_Hins_1);
		
		return $select_Hins_1;
		
	}//_get_Hins_1_Array
	
	public function
	_get_History_Id_Array() {

		/**********************************
		 * get: hins
		**********************************/
		$tokens = $this->Token->find('all');
		
		$history_id = array();
		
		for ($i = 0; $i < count($tokens); $i++) {
				
			array_push($history_id, $tokens[$i]['Token']['history_id']);
				
		}
		
		$history_id = array_unique($history_id);
		
		/**********************************
		 * build: string
		**********************************/
		$history_id_string = implode($history_id, "/");
		
		$select_History_Id = array();
		
		$history_id = array_values($history_id);
		
		for ($i = 0; $i < count($history_id); $i++) {
				
			$select_History_Id[$history_id[$i]] = $history_id[$i];
// 			$select_History_Id[$i] = $hins_1[$i];
				
		}

		$select_History_Id[CONS::$str_Filter_Hist_Id_all] = CONS::$str_Filter_Hist_Id_all;
// 		$select_History_Id[CONS::$str_Filter_Hins_1_all] = CONS::$str_Filter_Hins_1_all;
// 		debug($select_History_Id);
		
		return $select_History_Id;
		
	}//_get_Hins_1_Array
	
}