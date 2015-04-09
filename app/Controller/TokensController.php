<?php

class TokensController extends AppController {
	public $helpers = array('Html', 'Form');

	public $components = array('Paginator');
	
	public function 
	index() {

		/**********************************
		 * paginate
		**********************************/
		$page_limit = 10;
		
		$opt_order = $this->_index__Orders();
		
		$opt_conditions = $this->_index__Options();

		//test
		//REF http://stackoverflow.com/questions/20234155/how-to-count-total-number-of-rows-of-table-in-cakephp
		$tmp_tokens = $this->Token->find('count', array('conditions' => $opt_conditions));
// 		$tmp_tokens = $this->Token->find('count');
		
		debug($tmp_tokens);
		
// 		$opt_conditions = array('Token.id > ?' => array($tmp_tokens - 100));
		
		$opt_conditions = array('Token.id > ?' => array(10000));
		
		//debug
// 		$opt_conditions['Token.hin_1'] = "形容動詞語幹";
// 		$opt_conditions['Token.id'] = "< 600";

		//test
// 		$opt_conditions['Token.id'] = "> 9000";
// 		$opt_conditions['Token.id BETWEEN ? AND ?'] = "> 9000";

		//REF http://alvinalexander.com/php/cakephp-find-between-select-query-syntax
// 		$opt_conditions = array('Token.id > ?' => array(10000));
// 		$opt_conditions = array('Token.id BETWEEN ? AND ?' => array(9000, 9100));
		
		
		debug($opt_conditions);
		
// 		//test
// 		$tmp_tokens = $this->Token->find('count');
		
// 		debug("count => ".count($tmp_tokens));
		
// 		debug($tmp_tokens);
		
		$opt_group = $this->_index__Group();
		
		if ($opt_group != null && count($opt_group) > 0) {
			
			$this->paginate = array(
					'limit' => $page_limit,
					'order' => $opt_order,
					'conditions'	=> $opt_conditions,
					'group'			=> $opt_group
					
			);
				
		} else {
			
			$this->paginate = array(
					'limit' => $page_limit,
					'order' => $opt_order,
					'conditions'	=> $opt_conditions,
			
			);
				
		}

		/*******************************
			tokens
		*******************************/
		$tokens = $this->paginate('Token');
		
// 		debug($tokens[0]);
// 		debug($tokens[7]);
// 		debug(count($tokens));
		
		$this->set('tokens', $tokens);
		
		$num_of_tokens = count($this->Token->find('all'));
		$this->set('num_of_tokens', $num_of_tokens);
		
		$this->set('num_of_pages', (int) ceil($num_of_tokens / $page_limit));

		/*******************************
			current tokens
		*******************************/
// 		$this->paginate = array(
// 				'limit' => $num_of_tokens,
// 				'order' => $opt_order,
// 				'conditions'	=> $opt_conditions,
					
// 		);
		
// 		$tokens_Current = $this->paginate('Token');
		$tokens_Current = $this->Token->find('all',
						array(
								'conditions'	=> $opt_conditions,
		));
		
		$this->set('num_of_tokens_Current', count($tokens_Current));
// 		$this->set('num_of_tokens_Current', count($tokens));

// 		/*******************************
// 			resume: tokens
// 		*******************************/
// 		if ($opt_group != null && count($opt_group) > 0) {
				
// 			$this->paginate = array(
// 					'limit' => $page_limit,
// 					'order' => $opt_order,
// 					'conditions'	=> $opt_conditions,
// 					'group'			=> $opt_group
						
// 			);
		
// 		} else {
				
// 			$this->paginate = array(
// 					'limit' => $page_limit,
// 					'order' => $opt_order,
// 					'conditions'	=> $opt_conditions,
						
// 			);
		
// 		}
		
// 		$tokens = $this->paginate('Token');
		
		/**********************************
		* filter: hins
		**********************************/
		$hins_Array = $this->_get_HinsArray();

		$this->set("hins_Array", $hins_Array);
		
		/**********************************
		* filter: hins_1
		**********************************/
		$hins_1_Array = $this->_get_Hins_1_Array();

		$this->set("hins_1_Array", $hins_1_Array);
		
		/**********************************
		* filter: hins_2
		**********************************/
		$hins_2_Array = $this->_get_Hins_2_Array();

		$this->set("hins_2_Array", $hins_2_Array);
		
		/**********************************
		* filter: hins_3
		**********************************/
		$hins_3_Array = $this->_get_Hins_3_Array();

		$this->set("hins_3_Array", $hins_3_Array);
		
		/**********************************
		* filter: history_id
		**********************************/
		$history_id_Array = $this->_get_History_Id_Array();

		asort($history_id_Array);
		
		$this->set("history_id_Array", $history_id_Array);
		
// 		debug($history_id_Array);
		
		/*******************************
			get array: categories
		*******************************/
		$category_id_Array = $this->_get_Category_Id_Array();
		
		asort($category_id_Array);
		
		$this->set("category_id_Array", $category_id_Array);
		
// 		debug($category_id_Array);
		
		/**********************************
		 * labels: options, sorts
		**********************************/
		$this->_index_SetLabels(
					$opt_conditions,
					$hins_Array, $hins_1_Array,
					$history_id_Array, $category_id_Array
		);
		
	}//index

	public function 
	index_2() {

		/**********************************
		 * paginate
		**********************************/
		$page_limit = 10;
		
		$opt_order = $this->_index__Orders();
		
		$opt_conditions = $this->_index__Options();

		debug($opt_conditions);
		
		$opt_group = $this->_index__Group();
		
		if ($opt_group != null && count($opt_group) > 0) {
			
			$this->paginate = array(
					'limit' => $page_limit,
					'order' => $opt_order,
					'conditions'	=> $opt_conditions,
					'group'			=> $opt_group
					
			);
				
		} else {
			
			$this->paginate = array(
					'limit' => $page_limit,
					'order' => $opt_order,
					'conditions'	=> $opt_conditions,
			
			);
				
		}

		/*******************************
			tokens
		*******************************/
		$tokens = $this->paginate('Token');
		
		$this->set('tokens', $tokens);
		
		$num_of_tokens = count($this->Token->find('all'));
		$this->set('num_of_tokens', $num_of_tokens);
		
		$this->set('num_of_pages', (int) ceil($num_of_tokens / $page_limit));

		/*******************************
			current tokens
		*******************************/
// 		$this->paginate = array(
// 				'limit' => $num_of_tokens,
// 				'order' => $opt_order,
// 				'conditions'	=> $opt_conditions,
					
// 		);
		
// 		$tokens_Current = $this->paginate('Token');
		$tokens_Current = $this->Token->find('all',
						array(
								'conditions'	=> $opt_conditions,
		));
		
		$this->set('num_of_tokens_Current', count($tokens_Current));
// 		$this->set('num_of_tokens_Current', count($tokens));

// 		/*******************************
// 			resume: tokens
// 		*******************************/
// 		if ($opt_group != null && count($opt_group) > 0) {
				
// 			$this->paginate = array(
// 					'limit' => $page_limit,
// 					'order' => $opt_order,
// 					'conditions'	=> $opt_conditions,
// 					'group'			=> $opt_group
						
// 			);
		
// 		} else {
				
// 			$this->paginate = array(
// 					'limit' => $page_limit,
// 					'order' => $opt_order,
// 					'conditions'	=> $opt_conditions,
						
// 			);
		
// 		}
		
// 		$tokens = $this->paginate('Token');
		
		/**********************************
		* filter: hins
		**********************************/
		$hins_Array = $this->_get_HinsArray();

		$this->set("hins_Array", $hins_Array);
		
		/**********************************
		* filter: hins_1
		**********************************/
		$hins_1_Array = $this->_get_Hins_1_Array();

		$this->set("hins_1_Array", $hins_1_Array);
		
		/**********************************
		* filter: history_id
		**********************************/
		$history_id_Array = $this->_get_History_Id_Array();

		asort($history_id_Array);
		
		$this->set("history_id_Array", $history_id_Array);
		
// 		debug($history_id_Array);
		
		/*******************************
			get array: categories
		*******************************/
		$category_id_Array = $this->_get_Category_Id_Array();
		
		asort($category_id_Array);
		
		$this->set("category_id_Array", $category_id_Array);
		
// 		debug($category_id_Array);
		
		/**********************************
		 * labels: options, sorts
		**********************************/
		$this->_index_SetLabels(
					$opt_conditions,
					$hins_Array, $hins_1_Array,
					$history_id_Array, $category_id_Array
		);
		
	}//index

	public function
	_index__SkimmTokens($tokens) {
		
		$tokens_new = array();
		
		for ($i = 0; $i < count($tokens); $i++) {
			
			$res = Utils::isIn_Array_Tokens($tokens_new, $tokens[$i], "form");
			
			if ($res == false) {
				
				array_push($tokens_new, $tokens[$i]);
				
			}
			
		}
		
		debug("\$tokens_new ...");
		debug(count($tokens_new));
		
		return $tokens_new;
		
	}//_index__SkimmTokens($tokens)
	
	public function
	_index_SetLabels
	($opt_conditions, $hins_Array, $hins_1_Array,
		$history_id_Array, $category_id_Array) {

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
		
		/**********************************
		 * category_id_Array
		**********************************/
		// 		debug($opt_conditions);
		
		@$chosen_category_id = $opt_conditions['History.category_id'];
// 		@$chosen_category_id = $category_id_Array[$opt_conditions['History.category_id']];
// 		@$chosen_category_id = $category_id_Array[$opt_conditions['Token.category_id']];
		// 		@$chosen_Lang = $opt_conditions['Text.lang_id'];
		
//		debug($chosen_history_id);
		
		if ($chosen_category_id == null) {
		
			$chosen_category_id = "No chonsen category_id";
		
			$this->set("chosen_category_id", null);
		
			// 			$this->set("chosen_lang_id", null);
		
		} else {
		
			$this->set("chosen_category_id", 
							$category_id_Array[$opt_conditions['History.category_id']]);
// 			$this->set("chosen_category_id", $chosen_category_id);
		
//			debug("chosen_history_id => set");
			
			// 			$this->set("chosen_lang_id", $opt_conditions['Text.lang_id']);
		
		}
		
// 		debug("\$chosen_category_id");
// 		debug($chosen_category_id);
		
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
	
// 				$opt_conditions['Token.hin'] = "DISTINCT ".$session_Filter;
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
// 			$opt_conditions['Token.hin'] = "DISTINCT ".$query_Filter_Hins;
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
		* hin_2
		**********************************/
		$opt_conditions = $this->_index__Options__Hin_2($opt_conditions);
		
		/**********************************
		* history_id
		**********************************/
		$opt_conditions = $this->_index__Options__Hist_Id($opt_conditions);
		
		/**********************************
		* cat_id
		**********************************/
		$opt_conditions = $this->_index__Options__Cat_Id($opt_conditions);

		/**********************************
		* option: distinct
		**********************************/
// 		$opt_conditions['fields'] = 'DISTINCT Token.hin';
		
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
	_index__Group() {
	
		/**********************************
		 * param: group
		**********************************/
		// 		debug($this->request->data);
		// 		debug($this->request->query);
		$opt_group = array();
	
		$group = "group";
	
		@$query_Group = $this->request->query[$group];
	
		if ($query_Group == null) {
	
			@$session_Sort = $this->Session->read($group);
	
			//			debug("session_Sort is ...");
			//			debug($this->Session->read($group));
	
			if ($session_Sort != null) {
	
// 				$opt_group["Token.$session_Sort"] = "asc";
				array_push($opt_group, $query_Group);
	
				/**********************************
				 * set: var
				**********************************/
				$this->set("group", $session_Sort);
	
			} else {
	
				/**********************************
				 * set: var
				**********************************/
				$this->set("group", null);
	
			}
	
		} else if ($query_Group == -1) {
			
			$this->set("group", "no grouping");
			
			$this->Session->write($group, null);
			
		} else {
	
			// 			$opt_group['History.line LIKE'] = "%$query_Sort%";
				
// 			$opt_group["Token.$query_Sort"] = "asc";
			array_push($opt_group, $query_Group);
				
			$session_Sort = $this->Session->write($group, $query_Group);
	
			//			debug("session_Sort => written: ".$query_Sort);
	
			/**********************************
			 * set: var
			**********************************/
			$this->set("group", $query_Group);
				
		}
	
		return $opt_group;
	
	}//_index__Group
	
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
	_index__Options__Hin_2($opt_conditions) {
	
		/**********************************
		 * param: filter: hin
		**********************************/
		$filter_hins_2 = CONS::$str_Filter_Hins_2;
// 		$filter_hins = "filter_hins_1";
	
// 		$opt_conditions = array();
	
		@$query_Filter_Hins_2 = $this->request->query[$filter_hins_2];

// 		debug("query_Filter_Hins_1 is...");
// 		debug($query_Filter_Hins_1);
		
		if ($query_Filter_Hins_2 == CONS::$str_Filter_Hins_2_all) {
// 		if ($query_Filter_Hins == "-1") {
	
			$this->Session->write($filter_hins_2, null);
	
			$this->set("filter_hins_2", '');
	
		} else if ($query_Filter_Hins_2 == null) {
	
			@$session_Filter = $this->Session->read($filter_hins_2);
	
			if ($session_Filter != null) {
	
				$opt_conditions['Token.hin_2'] = $session_Filter;
	
				/**********************************
				 * set: var
				**********************************/
				$this->set("filter_hins_2", $session_Filter);
	
			} else {
	
				/**********************************
				 * set: var
				**********************************/
				$this->set("filter_hins_2", null);
	
			}
	
		} else {
	
			// 			$opt_conditions['History.line LIKE'] = "%$query_Filter_Hins%";
	
			//REF http://book.cakephp.org/2.0/en/models/retrieving-your-data.html
			$opt_conditions['Token.hin_2'] = $query_Filter_Hins_2;
	
			$session_Filter = $this->Session->write($filter_hins_2, $query_Filter_Hins_2);
	
			//			debug("session_Filter => written");
	
			/**********************************
			 * set: var
			**********************************/
			$this->set("filter_hins_2", $query_Filter_Hins_2);
	
		}
	
		/**********************************
			* return
		**********************************/
// 		debug("\$opt_conditions is...");
// 		debug($opt_conditions);
		
		return $opt_conditions;
	
	}//_index__Options__Hin_2
	
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
	
	public function
	_index__Options__Cat_Id($opt_conditions) {
	
		/**********************************
		 * param: filter: hin
		**********************************/
		$filter_cat_id = CONS::$str_Filter_Cat_Id;
	
		@$query_Value = $this->request->query[$filter_cat_id];
		
// 		debug("\$query_Value");
// 		debug($query_Value);
		
		if ($query_Value == CONS::$str_Filter_Cat_Id_all_Val) {
// 		if ($query_Value == CONS::$str_Filter_Cat_Id_all) {
	
			$this->Session->write($filter_cat_id, null);
	
			$this->set("filter_cat_id", '');
	
		} else if ($query_Value == null) {
	
			@$session_Filter = $this->Session->read($filter_cat_id);
	
			if ($session_Filter != null) {
	
				$opt_conditions['History.category_id'] = $session_Filter;
	
				/**********************************
				 * set: var
				**********************************/
				$this->set("filter_cat_id", $session_Filter);
	
			} else {
	
				/**********************************
				 * set: var
				**********************************/
				$this->set("filter_cat_id", null);
	
			}
	
		} else {
	
			// 			$opt_conditions['History.line LIKE'] = "%$query_Filter_Hins%";
	
			//REF http://book.cakephp.org/2.0/en/models/retrieving-your-data.html
			$opt_conditions['History.category_id'] = $query_Value;
	
			$session_Filter = $this->Session->write($filter_cat_id, $query_Value);
	
			//			debug("session_Filter => written");
	
			/**********************************
			 * set: var
			**********************************/
			$this->set("filter_cat_id", $query_Value);
	
		}
	
		/**********************************
			* return
		**********************************/
		return $opt_conditions;
	
	}//_index__Options__Cat_Id
	
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
	hin_changed() {
		
		@$query_Hin_Name = $this->request->query['hin_name'];
		
// 		//log
// 		Utils::write_Log(
// 						Utils::get_dPath_Log(),
// 						"hin_name => ".$query_Hin_Name,
// 						__FILE__, __LINE__);
		
		
// 		debug("\$query_Hin_Name");
// 		debug($query_Hin_Name);

		/*******************************
			validate:
		*******************************/
		if ($query_Hin_Name == null) {
			
			debug("no hin name given");
			
			return;
			
		}

// 		//log
// 		Utils::write_Log(
// 						Utils::get_dPath_Log(),
// 						"\$query_Hin_Name => not null",
// 						__FILE__, __LINE__);
		
		/*******************************
			get: tokens
		*******************************/
		$option = array(
					'conditions' => 
							array('Token.hin' => $query_Hin_Name),
					'group'	=> 'Token.hin_1'
		);
		
		$tokens = $this->Token->find('all', $option);
		
		/*******************************
			validate
		*******************************/
		if (count($tokens) < 1) {
			
// 			debug("no hin_1s for the hin: ".$query_Hin_Name);

			$tokens = $this->Token->find('all', array('group'	=> 'Token.hin_1'));
			
// 			//log
// 			Utils::write_Log(
// 					Utils::get_dPath_Log(),
// 					"count(\$tokens) => < 1",
// 					__FILE__, __LINE__);
						
// 			return;
			
		}
		
// 			//log
// 			Utils::write_Log(
// 					Utils::get_dPath_Log(),
// 					"count(\$tokens) => >= 1",
// 					__FILE__, __LINE__);
		
// 		debug(count($tokens));
		
// 		debug($tokens[0]);
		
		/*******************************
			build: hin_1s
		*******************************/
		$hin_1s = array();

		for ($i = 0; $i < count($tokens); $i++) {
			
			$hin_1 = $tokens[$i]['Token']['hin_1'];
			
			if ($hin_1 != null) {
				
				array_push($hin_1s, $hin_1);
				
			}
			
		}

// 		//log
// 		Utils::write_Log(
// 						Utils::get_dPath_Log(),
// 						"hin_1s => done",
// 						__FILE__, __LINE__);
		
		/*******************************
			array
		*******************************/
		$select_Hins_1 = array();
		
		for ($i = 0; $i < count($hin_1s); $i++) {
		
			$select_Hins_1[$hin_1s[$i]] = $hin_1s[$i];
			// 			$select_Hins_1[$i] = $hins_1[$i];
		
		}
		
		$select_Hins_1[CONS::$str_Filter_Hins_1_all] = CONS::$str_Filter_Hins_1_all;
		// 		debug($select_Hins_1);
		
// 		debug(implode("/", $hin_1s)."(".count($hin_1s).")");

// 		//log
// 		Utils::write_Log(
// 						Utils::get_dPath_Log(),
// 						"\$select_Hins_1 => built",
// 						__FILE__, __LINE__);
		
		/*******************************
			layout, vars
		*******************************/
		$this->set("text", implode("/", $hin_1s)."(".count($hin_1s).")");
		
		$this->set("hins_1_Array", $select_Hins_1);
		
		$this->layout = 'plain';

// 		//log
// 		Utils::write_Log(
// 						Utils::get_dPath_Log(),
// 						"layout => set",
// 						__FILE__, __LINE__);
		
	}//hin_Changed
	
	public function
	hin_1_changed() {
		
		@$query_Hin_Name = $this->request->query['hin_1_name'];
		
// 		//log
// 		Utils::write_Log(
// 						Utils::get_dPath_Log(),
// 						"hin_1_name => ".$query_Hin_Name,
// 						__FILE__, __LINE__);
		
		
// 		debug("\$query_Hin_Name");
// 		debug($query_Hin_Name);

		/*******************************
			validate:
		*******************************/
		if ($query_Hin_Name == null) {
			
			debug("no hin_1 name given");
			
			return;
			
		}

// 		//log
// 		Utils::write_Log(
// 						Utils::get_dPath_Log(),
// 						"\$query_Hin_Name => not null",
// 						__FILE__, __LINE__);
		
		/*******************************
			get: tokens
		*******************************/
		$option = array(
					'conditions' => 
							array('Token.hin_1' => $query_Hin_Name),
					'group'	=> 'Token.hin_2'
		);
		
		$tokens = $this->Token->find('all', $option);
		
		/*******************************
			validate
		*******************************/
		if (count($tokens) < 1) {

			$tokens = $this->Token->find('all', array('group'	=> 'Token.hin_2'));
				
// 			debug("no hin_2s for the hin: ".$query_Hin_Name);

// 			//log
// 			Utils::write_Log(
// 					Utils::get_dPath_Log(),
// 					"count(\$tokens) => < 1",
// 					__FILE__, __LINE__);
						
// 			return;
			
		}
		
// 			//log
// 			Utils::write_Log(
// 					Utils::get_dPath_Log(),
// 					"count(\$tokens) => >= 1",
// 					__FILE__, __LINE__);
		
// 		debug(count($tokens));
		
// 		debug($tokens[0]);
		
		/*******************************
			build: hin_2s
		*******************************/
		$hin_2s = array();

		for ($i = 0; $i < count($tokens); $i++) {
			
			$hin_2 = $tokens[$i]['Token']['hin_2'];
			
			if ($hin_2 != null) {
				
				array_push($hin_2s, $hin_2);
				
			}
			
		}

// 		//log
// 		Utils::write_Log(
// 						Utils::get_dPath_Log(),
// 						"hin_1s => done",
// 						__FILE__, __LINE__);
		
		/*******************************
			array
		*******************************/
		$select_Hins_2 = array();
		
		for ($i = 0; $i < count($hin_2s); $i++) {
		
			$select_Hins_2[$hin_2s[$i]] = $hin_2s[$i];
			// 			$select_Hins_2[$i] = $hins_1[$i];
		
		}
		
		$select_Hins_2[CONS::$str_Filter_Hins_2_all] = CONS::$str_Filter_Hins_2_all;
		// 		debug($select_Hins_1);
		
// 		debug(implode("/", $hin_1s)."(".count($hin_1s).")");

// 		//log
// 		Utils::write_Log(
// 						Utils::get_dPath_Log(),
// 						"\$select_Hins_1 => built",
// 						__FILE__, __LINE__);
		
		/*******************************
			layout, vars
		*******************************/
		$this->set("text", implode("/", $hin_2s)."(".count($hin_2s).")");
		
		$this->set("hins_2_Array", $select_Hins_2);
		
		$this->layout = 'plain';

// 		//log
// 		Utils::write_Log(
// 						Utils::get_dPath_Log(),
// 						"layout => set",
// 						__FILE__, __LINE__);
		
	}//hin_1_changed()
	
	
	
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
	_get_Hins_2_Array() {

		/**********************************
		 * get: hins
		**********************************/
		$tokens = $this->Token->find('all');
		
		$hins_2 = array();
		
		for ($i = 0; $i < count($tokens); $i++) {
				
			array_push($hins_2, $tokens[$i]['Token']['hin_2']);
				
		}
		
		$hins_2 = array_unique($hins_2);
		
		/**********************************
		 * build: string
		**********************************/
		$hins_2_string = implode($hins_2, "/");
		
		$select_Hins_2 = array();
		
		$hins_2 = array_values($hins_2);
		
		for ($i = 0; $i < count($hins_2); $i++) {
				
			$select_Hins_2[$hins_2[$i]] = $hins_2[$i];
// 			$select_Hins_1[$i] = $hins_1[$i];
				
		}

		$select_Hins_2[CONS::$str_Filter_Hins_2_all] = CONS::$str_Filter_Hins_2_all;
// 		debug($select_Hins_1);
		
		return $select_Hins_2;
		
	}//_get_Hins_2_Array
	
	public function
	_get_Hins_3_Array() {

		/**********************************
		 * get: hins
		**********************************/
		$tokens = $this->Token->find('all');
		
		$hins_3 = array();
		
		for ($i = 0; $i < count($tokens); $i++) {
				
			array_push($hins_3, $tokens[$i]['Token']['hin_3']);
				
		}
		
		$hins_3 = array_unique($hins_3);
		
		/**********************************
		 * build: string
		**********************************/
		$hins_3_string = implode($hins_3, "/");
		
		$select_Hins_3 = array();
		
		$hins_3 = array_values($hins_3);
		
		for ($i = 0; $i < count($hins_3); $i++) {
				
			$select_Hins_3[$hins_3[$i]] = $hins_3[$i];
// 			$select_Hins_1[$i] = $hins_1[$i];
				
		}

		$select_Hins_3[CONS::$str_Filter_Hins_3_all] = CONS::$str_Filter_Hins_3_all;
// 		debug($select_Hins_1);
		
		return $select_Hins_3;
		
	}//_get_Hins_3_Array
	
	
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

	public function
	_get_Category_Id_Array() {

		/**********************************
		 * get: hins
		**********************************/
		$tokens = $this->Token->find('all');
		
		$category_id = array();
		
		for ($i = 0; $i < count($tokens); $i++) {
				
			array_push($category_id, $tokens[$i]['History']['category_id']);
// 			array_push($category_id, $tokens[$i]['Token']['category_id']);
				
		}
		
		$category_id = array_unique($category_id);
		
		$category_id = array_values($category_id);
		
		/**********************************
		 * build: string
		**********************************/
		// Load model
		$this->loadModel('Category');
		$this->loadModel('Genre');
		
		$category_Id_Array = array();
		
		$option['conditions'] = array();
		
// 		$cat = $this->Category->find('first', $option);

// 		debug($category_id);
		
// 		for ($i = 0; $i < 2; $i++) {
		for ($i = 0; $i < count($category_id); $i++) {

			/*******************************
				validate: id value
			*******************************/
			if ($category_id[$i] < 1) {
				
				continue;
				
			}
			
			//debug($category_id[$i]);	
			
			$option['conditions']['Category.id'] = $category_id[$i];

// // 			$option['conditions'] = array('Category.id' => $category_id[$i]);
			
// // 			$option = array('conditions' => array("Category.id" => $category_id[$i]));
			
			$cat = $this->Category->find('first', $option);
			
			$category_Id_Array[$category_id[$i]] = 
						$cat['Category']['name']."(".$cat['Genre']['name'].")";
			
// 			$category_Id_Array[$cat['Category']['name']."(".$cat['Genre']['name'].")"] = 
// 					$category_id[$i];
			
		}
		
		/*******************************
			no filter
		*******************************/
		$category_Id_Array[-1] =
				CONS::$str_Filter_Cat_Id_all;
		
		//debug("array --> built");
		
		return $category_Id_Array;
// 		return $select_Category_Id;
		
	}//_get_Category_Id_Array

	public function 
	D_7() {
	
		$option = array(
					
				'conditions' => array('Token.history_id'	=> '82')
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
				
			$text .= $tokens[$i]['Token']['form'];
// 			$text .= "/".$tokens[$i]['Token']['form'];
			// 			$text .= $tokens[$i]['Token']['form'];
			// 			$text .= $tokens[$i]['Token']['hin'];
				
		}
	
		$text = mb_ereg_replace("。", "。<br>", $text);
// 		$text = preg_replace("。", "。<br>", $text);
		
		/**********************************
			* set
		**********************************/
		$this->set("text", $text);

		/**********************************
		* 「は」
		**********************************/
		$option = array(
					
				'conditions' => array(
								'Token.form'	=> 'は',
								'Token.hin'		=> '助詞',
								'Token.history_id'	=> '82'
				)
				// 				'conditions' => array('Token.hin_1'	=> '固有名詞')
		// 				'Token.history_id'	=> '82'
		// 				'Token.hin_1'	=> '固有名詞'
	
		);
		
		$text_Ha_ary = array();
		
// 		$tokens_Ha = $this->Token->find('all', $option);
		for ($i = 0; $i < count($tokens); $i++) {
			
			$token_Combo = array();
			
			if ($tokens[$i]['Token']['form'] == 'は'
					&& $tokens[$i]['Token']['hin'] == '助詞'
					&& $tokens[$i]['Token']['history_id'] == '82'
// 					&& $tokens[$i]['Token']['insentence_id'] == $i
				) {
				
				array_push($token_Combo, $tokens[$i]);
				array_push($token_Combo, $i);
				
				array_push($text_Ha_ary, $token_Combo);
// 				array_push($text_Ha_ary, $tokens[$i]);
				
			}
		}
		
		$text_Ha = "";
		
		for ($i = 0; $i < count($text_Ha_ary); $i++) {
		
			$word_Ha = $this->_D_7__GetWord_Ha($tokens, $text_Ha_ary[$i]);
			
			if ($word_Ha == null) {
				
				debug("\$word_Ha => null");
				
				continue;
				
			}
			
			$text_Ha .= "/".$word_Ha;
// 			$text_Ha .= "/"
// 						.$tokens[$text_Ha_ary[$i][1] - 1]['Token']['form']
// 						."("
// 						.$tokens[$text_Ha_ary[$i][1] - 1]['Token']['hin']
// 						.")"
// 						.$text_Ha_ary[$i][0]['Token']['form']
// 						."(".$text_Ha_ary[$i][0]['Token']['id'].")"
// 						."(".$text_Ha_ary[$i][1].")"
// 						;
// 			$text_Ha .= "/".$text_Ha_ary[$i]['Token']['form']
// 						."(".$text_Ha_ary[$i]['Token']['id'].")";
			// 			$text .= "/".$tokens[$i]['Token']['form'];
			// 			$text .= $tokens[$i]['Token']['form'];
			// 			$text .= $tokens[$i]['Token']['hin'];
		
		}
		
// 		$text_Ha = preg_replace("。", "。<br>", $text_Ha);
// 		$text_Ha = mb_replace("。", "。<br>", $text_Ha);
// 		$text_Ha = mb_ereg_replace("。", "。<br>", $text_Ha);
		
		$this->set("text_Ha", $text_Ha);
		
		$word_Ha = $this->_D_7__GetWord_Ha($tokens, $text_Ha_ary[0]);
		
		/**********************************
		* redirect
		**********************************/
// 		$this->redirect("/tokens/tests/D_7");
		$this->render("/Tokens/tests/D_7");
		
	}//D_7

	public function 
	_D_7__GetWord_Ha($tokens, $combo) {

		$insentence_Id = $combo[1];
		
		$word_Final = $combo[0]['Token']['form'];

// 		debug("\initial \$word_Final is...");
// 		debug($word_Final);
		
		$token_Index_Offset = -1;
		
		$target_Index = $insentence_Id + $token_Index_Offset;
		
		while ($target_Index >= 0) {
			
			$token_Prev = $tokens[$target_Index];
			
			if ($token_Prev['Token']['hin'] != '名詞') {
				
				break;
				
			}
			
// 			debug($token_Prev['Token']['form']);
			
			$word_Final = $token_Prev['Token']['form'].$word_Final;
			
// 			debug($word_Final);
			
			$target_Index --;
			
		}
		
		return ($word_Final == $combo[0]['Token']['form']) ? null : $word_Final;
// 		return ($token_Index_Offset == -1) ? null : $word_Final;
// 		if ($insentence_Id > 0) {
			
// 			$token_Prev = $tokens[$insentence_Id - 1];
			
// 			debug($token_Prev['Token']['form']);
			
// 			$word_Final = $token_Prev['Token']['form'].$word_Final;
			
// 			debug($word_Final);
			
// 		}
		
	}

	public function
	D_7_V_1_1() {

		/**********************************
		* history
		**********************************/
// 		$this->loadModel('History');
		
// 		$history = $this->History->find(
// 								'first', 
// 								array('order' => array('History.id' => 'asc'))
// 								);
		
// 		$text = $history['History']['content'];
		
		$option = array(
					
				'conditions' => array('Token.history_id'	=> '82')
				// 				'conditions' => array('Token.hin_1'	=> '固有名詞')
				// 				'Token.history_id'	=> '82'
				// 				'Token.hin_1'	=> '固有名詞'
	
		);

		$tokens = $this->Token->find('all', $option);

// 		debug(count($tokens));
		
		/**********************************
		 * build: text
		**********************************/
		$text = "";
		
		for ($i = 0; $i < count($tokens); $i++) {
		
			$text .= $tokens[$i]['Token']['form'];
			// 			$text .= "/".$tokens[$i]['Token']['form'];
			// 			$text .= $tokens[$i]['Token']['form'];
			// 			$text .= $tokens[$i]['Token']['hin'];
		
		}
		
// 		debug("\$text is...");
// 		debug($text);
		
		/**********************************
		* get: sentences
		**********************************/
		$token_Sentences = array();
		$token_Sen = array();
		
		for ($i = 0; $i < count($tokens); $i++) {
			
			if ($tokens[$i]['Token']['form'] == "。") {
// 			if ($tokens[$i] == "。") {
				
// 				debug("pushing a sentence...");
				
				array_push($token_Sen, $tokens[$i]);
				
				array_push($token_Sentences, $token_Sen);
				
				unset($token_Sen); $token_Sen = array();
				
			} else {
				
				array_push($token_Sen, $tokens[$i]);
				
			}
			
			
		}
	
// 		debug("\$token_Sentences ...");
// 		debug(count($token_Sentences));

// 		debug($token_Sentences[0]);
// 		debug($token_Sentences[0]['Token']);
		
		/**********************************
		* get: one sentence
		**********************************/
		$sen = "";
		
		for ($i = 0; $i < count($token_Sentences[0]); $i++) {

			$sen .= $token_Sentences[0][$i]['Token']['form'];
			
		}
		
		$this->set("sen", $sen);

		/**********************************
		* bunsetsu	=> bs
		**********************************/
		$id = 0;
		
		$bs_Subject = Utils::get_BS_Subject($token_Sentences[0], $id);
// 		$bs_Subject = Utils::get_BS_Subject($token_Sentences[0], &$id);
		
		$bs_Verb = Utils::get_BS_Verb($token_Sentences[0], $id);
		
		debug("\$bs_Subject is...");
		debug($bs_Subject);
		
		debug("id is...");
		debug($id);
		
		debug("\$bs_Verb is...");
		debug($bs_Verb);
		
		/**********************************
			* redirect
		**********************************/
		// 		$this->redirect("/tokens/tests/D_7");
		$this->render("/Tokens/tests/D_7_V_1_1");
	
	}//D_7
	
	public function
	D_7_V_2_0__Nouns() {

		/*******************************
			get: query
		*******************************/
		@$history_Id = $this->request->query['history_id'];
		
		debug($history_Id);
		
		/**********************************
		 * history
		**********************************/
		$this->loadModel('History');

		$option = array(
					
				'conditions' => array('History.id'	=> $history_Id)
	
		);
		
		$history = $this->History->find('first', $option);
		
		if ($history == null) {
			
			$this->Session->setFlash(__("No such history: id = ".$history_Id));;

			$this->render("/Tokens/tests/D_7_V_2_0__Nouns");
			
			return;
			
		}
		
// 		$this->Session->setFlash(__('Your tokens has been saved.'));
		
		/*******************************
			find: tokens
		*******************************/
		$option = array(
					
				'conditions' => array('Token.history_id'	=> $history_Id)
// 				'conditions' => array('Token.history_id'	=> '82')
	
		);

		$tokens = $this->Token->find('all', $option);

		if ($tokens == null) {
				
			$this->Session->setFlash(__("\$tokens null for the history id ".$history_Id));;
		
			$this->render("/Tokens/tests/D_7_V_2_0__Nouns");

			return;
			
		}
		
		if (count($tokens) < 1) {
				
			$this->Session->setFlash(__("No tokens with the history id ".$history_Id));;
		
			$this->render("/Tokens/tests/D_7_V_2_0__Nouns");

			return;
			
		}
		
		/**********************************
		 * build: text
		**********************************/
		$text = "";
		
		$ary_N = array();
		
		for ($i = 0; $i < count($tokens); $i++) {
		
			if ($tokens[$i]['Token']['hin'] == '名詞') {
				
				$text .= $tokens[$i]['Token']['form'];
				
			} else {
				
				if ($text != "") {
				
					array_push($ary_N, $text);
					
					$text = "";
				
				}
				
			}
			
		}//for ($i = 0; $i < count($tokens); $i++)
		
// 		debug($ary_N);

// 		debug(implode("/", $ary_N));
		
		debug("original => ".count($ary_N));
		debug("unique => ".count(array_unique($ary_N)));
		
		$this->set("text", (implode("/", array_unique($ary_N))));
// 		$this->set("text", array_unique(implode("/", $ary_N)));
// 		$this->set("text", implode("/", $ary_N));
		
		/**********************************
			* redirect
		**********************************/
		$this->render("/Tokens/tests/D_7_V_2_0__Nouns");
	
	}//D_7

	/*******************************
		e.g.<br>
		"係助詞"	=> "NB"
	*******************************/
	public function
	conv_Particle_2_SubParticle($hin_1) {
		
		$hin = "P";
		
		/*******************************
			judge
		*******************************/
		if ($hin_1 == CONS::$hin1_Names[0]) {
		
			// 格助詞
			$hin .= CONS::$map_Hin1_Symbols[CONS::$hin1_Names[0]];
		
		} else if ($hin_1 == CONS::$hin1_Names[6]) {
			
			// 連体化
			$hin .= CONS::$map_Hin1_Symbols[CONS::$hin1_Names[6]];
			
		} else if ($hin_1 == CONS::$hin1_Names[3]) {
			
			// 係助詞
			$hin .= CONS::$map_Hin1_Symbols[CONS::$hin1_Names[3]];
			
		} else {		
		
			// その他
			$hin .= CONS::$map_Hin1_Symbols[CONS::$hin1_Names[8]];
		
		}
		
		return $hin;
		
	}//conv_Particle_2_SubParticle
	
	/*******************************
		e.g.<br>
		"固有名詞"	=> "NB"
	*******************************/
	public function
	conv_Noun_2_SubNoun($hin_1) {
		
		$hin = "N";
		
		/*******************************
			judge
		*******************************/
		if ($hin_1 == CONS::$hin1_Noun_Names[0]) {
		
			
			$hin .= CONS::$map_Hin1_Noun_Symbols[CONS::$hin1_Noun_Names[0]];
		
		} else if ($hin_1 == CONS::$hin1_Noun_Names[1]) {
			
			
			$hin .= CONS::$map_Hin1_Noun_Symbols[CONS::$hin1_Noun_Names[1]];
			
		} else if ($hin_1 == CONS::$hin1_Noun_Names[2]) {
			
			
			$hin .= CONS::$map_Hin1_Noun_Symbols[CONS::$hin1_Noun_Names[2]];
			
		} else if ($hin_1 == CONS::$hin1_Noun_Names[3]) {
			
			
			$hin .= CONS::$map_Hin1_Noun_Symbols[CONS::$hin1_Noun_Names[3]];
			
		} else if ($hin_1 == CONS::$hin1_Noun_Names[4]) {
			
			
			$hin .= CONS::$map_Hin1_Noun_Symbols[CONS::$hin1_Noun_Names[4]];
			
		} else if ($hin_1 == CONS::$hin1_Noun_Names[5]) {
			
			
			$hin .= CONS::$map_Hin1_Noun_Symbols[CONS::$hin1_Noun_Names[5]];
			
		} else if ($hin_1 == CONS::$hin1_Noun_Names[6]) {
			
			
			$hin .= CONS::$map_Hin1_Noun_Symbols[CONS::$hin1_Noun_Names[6]];
			
		} else if ($hin_1 == CONS::$hin1_Noun_Names[7]) {
			
			
			$hin .= CONS::$map_Hin1_Noun_Symbols[CONS::$hin1_Noun_Names[7]];
			
		} else if ($hin_1 == CONS::$hin1_Noun_Names[8]) {
			
			
			$hin .= CONS::$map_Hin1_Noun_Symbols[CONS::$hin1_Noun_Names[8]];
			
		} else if ($hin_1 == CONS::$hin1_Noun_Names[9]) {
			
			
			$hin .= CONS::$map_Hin1_Noun_Symbols[CONS::$hin1_Noun_Names[9]];
			
		} else {		
		
			
			$hin .= CONS::$map_Hin1_Noun_Symbols[
								CONS::$hin1_Noun_Names[count(CONS::$hin1_Noun_Names) - 1]];
// 			$hin .= CONS::$map_Hin1_Noun_Symbols[count(CONS::$hin1_Noun_Names) - 1];
// 			$hin .= CONS::$map_Hin1_Noun_Symbols[CONS::$hin1_Noun_Names[6]];
		
		}
		
		return $hin;
		
	}//conv_Noun_2_SubNoun
	
	
	public function
	test_NVP() {

		/*******************************
			get: history id
		*******************************/
		@$hist_id = $this->request->query['hist_id'];

		if ($hist_id == null) {
		
			$hist_id = 63;
		
		} else {
		
// 			$hist_id;
		
		}

		/*******************************
			validate: history exists
		*******************************/
		$res = Utils::exists_History($hist_id);
		
		if ($res == false) {
			
			$this->set("message", "No history for id $hist_id");
			
			$this->render("/Tokens/tests/test_NVP");
			
			return;
			
		}
		
		/*******************************
			get: tokens
		*******************************/
		
		$option = array('conditions' => array('Token.history_id' => $hist_id));
		
		$tokens = $this->Token->find('all', $option);
		
// 		debug(count($tokens));

		/*******************************
			build: NL sentence
		*******************************/
		$this->set("hist_id", $hist_id);
		
		if ($tokens == null || count($tokens) < 1) {
		
			$this->set("sen_NL", "NO TOKENS");
		
		} else {
		
			$ary_Forms = array();
			$ary_Syms = array();
			
			$max = 50;
			
			$count = 1;
			
			for ($i = 0; $i < count($tokens); $i++) {
				
				/*******************************
					hin, sym
				*******************************/
				$hin = $tokens[$i]['Token']['hin'];
				$sym = CONS::$map_HinSymbols[$hin];

				/*******************************
				 modify: particles => subparticles
				*******************************/
				if ($hin == "助詞") {
					
					$sym = $this->conv_Particle_2_SubParticle($tokens[$i]['Token']['hin_1']);
					
				}
				
				array_push($ary_Forms, $tokens[$i]['Token']['form']);
				array_push($ary_Syms, $sym);
// 				array_push($ary_Syms, CONS::$map_HinSymbols[$tokens[$i]['Token']['hin']]);
				
				if ($i > $max) {
					
					break;
					
				}
				
				// delimiter
				if ($i % 5 == 0) {
					
					array_push($ary_Forms, "/($count)");
					array_push($ary_Syms, "/($count)");
					
					$count ++;
					
				}
				
			}
			
			$sen_NL = implode(" ", $ary_Forms);
// 			$sen_Syms = implode("", $ary_Syms);
			$sen_Syms = implode(" ", $ary_Syms);
			
			$this->set("sen_NL", $sen_NL);
			$this->set("sen_Syms", $sen_Syms);
			
	// 		debug($sen_NL);
		
		}

		/*******************************
			stat: hin_1 names => "助詞"
		*******************************/
		$option2 = array('conditions' => 
							array('Token.hin' => "助詞"));
		
		$tokens2 = $this->Token->find('all', $option2); 
		
		$total = count($tokens2);
		
		debug("tokens with 助詞");
		debug($total);
// 		debug(count($tokens2));
		
// 		debug($tokens2[0]);

		/*******************************
			number of each kind of particles
		*******************************/
		$count = 0;
		
		$cnt_NoMatch = 0;
		
		$particles = array();
		
		for ($i = 0; $i < count(CONS::$hin1_Names); $i++) {
			
			$particles[CONS::$hin1_Names[$i]] = 0;
			
		}
		
		for ($i = 0; $i < count($tokens2); $i++) {

			$match = false;
			
			for ($j = 0; $j < count(CONS::$hin1_Names); $j++) {

				$hin_1 = $tokens2[$i]['Token']['hin_1'];
					
				if ($hin_1 == CONS::$hin1_Names[$j]) {
				
					$particles[CONS::$hin1_Names[$j]] += 1;
// 					$count ++;
					
					$match = true;
				
					break;
					
				}
				
			}//for ($j = 0; $j < count(CONS::$hin1_Names); $j++)

			// no match
			if ($match == false) {
				
				$cnt_NoMatch ++;
				
			}
			
// 			$hin_1 = $tokens2[$i]['Token']['hin_1'];
// // 			$hin_1 = $tokens2[0]['Token']['hin_1'];
// // 			$hin_1 = $tokens2['Token']['hin_1'];
			
// 			if ($hin_1 == "格助詞") {
				
// 				$count ++;
				
// 			}
			
		}
		
// 		debug("格助詞");
// 		debug($count);

// 		debug($particles);
		
		$message = "";
		
		asort($particles);
		
		$keys = array_keys($particles);
		
		for ($i = 0; $i < count($particles); $i++) {
			
			$message .= $keys[$i]." => "
					.$particles[$keys[$i]]
					."("
					.(($particles[$keys[$i]]) / $total * 100)
					.")"
					."<br>";
			
		}

		$message .= "no match"." => "
				.$cnt_NoMatch
				."("
						.(($cnt_NoMatch) / $total * 100)
						.")"
								."<br>";

		/*******************************
			names of hins, particles
		*******************************/
		$tmp = "";
		$keys_HinSymbols = array_keys(CONS::$map_HinSymbols);
		
		for ($i = 0; $i < count(CONS::$map_HinSymbols); $i++) {
			
			$tmp .= $keys_HinSymbols[$i]." => "
					.CONS::$map_HinSymbols[$keys_HinSymbols[$i]]."/";
			
		}
		
		$message .= $tmp."<br>";
		
		$tmp = "";
		$keys_Hin1_Symbols = array_keys(CONS::$map_Hin1_Symbols);
		
		for ($i = 0; $i < count(CONS::$map_Hin1_Symbols); $i++) {
			
			$tmp .= $keys_Hin1_Symbols[$i]." => "
					.CONS::$map_Hin1_Symbols[$keys_Hin1_Symbols[$i]]."/";
			
		}
		
		$message .= $tmp."<br>";
		
		
		
		$this->set("message", $message);
		
		/**********************************
		 * view
		**********************************/
		$this->render("/Tokens/tests/test_NVP");
		
	}//test_NVP
	
	public function
	test_NVP_Nouns() {

// 		debug(count(CONS::$hin1_Noun_Names));
// 		debug(CONS::$map_Hin1_Noun_Symbols[count(CONS::$hin1_Noun_Names) - 1]);
		
		/*******************************
			get: history id
		*******************************/
		@$hist_id = $this->request->query['hist_id'];

		if ($hist_id == null) {
		
			$hist_id = 63;
		
		} else {
		
// 			$hist_id;
		
		}//if ($hist_id == null)

		/*******************************
			validate: history exists
		*******************************/
		$res = Utils::exists_History($hist_id);
		
		if ($res == false) {
			
			$this->set("message", "No history for id $hist_id");
			
			$this->render("/Tokens/tests/test_NVP");
			
			return;
			
		}//if ($res == false)
		
		/*******************************
			get: tokens
		*******************************/
		
		$option = array('conditions' => array('Token.history_id' => $hist_id));
		
		$tokens = $this->Token->find('all', $option);
		
		debug(count($tokens));

		/*******************************
			build: NL sentence
		*******************************/
		$this->set("hist_id", $hist_id);
		
		if ($tokens == null || count($tokens) < 1) {
		
			$this->set("sen_NL", "NO TOKENS");
		
		} else {
		
			$ary_Forms = array();
			$ary_Syms = array();
			
			$max = 50;
			
			$count = 1;
			
			for ($i = 0; $i < count($tokens); $i++) {
				
				/*******************************
					hin, sym
				*******************************/
				$hin = $tokens[$i]['Token']['hin'];
				$sym = CONS::$map_HinSymbols[$hin];

				/*******************************
				 modify: particles => subparticles
				*******************************/
				if ($hin == "助詞") {
					
					$sym = $this->conv_Particle_2_SubParticle($tokens[$i]['Token']['hin_1']);
					
				} else if ($hin == "名詞") {
					
					$sym = $this->conv_Noun_2_SubNoun($tokens[$i]['Token']['hin_1']);
					
				}//if ($hin == "助詞")
				
				array_push($ary_Forms, $tokens[$i]['Token']['form']);
				array_push($ary_Syms, $sym);
// 				array_push($ary_Syms, CONS::$map_HinSymbols[$tokens[$i]['Token']['hin']]);
				
				if ($i > $max) {
					
					break;
					
				}
				
				// delimiter
				if ($i % 5 == 0) {
					
					array_push($ary_Forms, "/($count)");
					array_push($ary_Syms, "/($count)");
					
					$count ++;
					
				}
				
			}//for ($i = 0; $i < count($tokens); $i++)
			
			$sen_NL = implode(" ", $ary_Forms);
// 			$sen_Syms = implode("", $ary_Syms);
			$sen_Syms = implode(" ", $ary_Syms);
			
			$this->set("sen_NL", $sen_NL);
			$this->set("sen_Syms", $sen_Syms);
			
	// 		debug($sen_NL);
		
		}//if ($tokens == null || count($tokens) < 1)

		/*******************************
			stat: hin_1 names => "助詞"
		*******************************/
		$option2 = array('conditions' => 
							array('Token.hin' => CONS::$hin_Names[2]));	// 名詞
// 							array('Token.hin' => "助詞"));
		
		$tokens2 = $this->Token->find('all', $option2); 
		
		$total = count($tokens2);
		
		debug("tokens with ".CONS::$hin_Names[2]);
		debug($total);
// 		debug(count($tokens2));
		
// 		debug($tokens2[0]);

		/*******************************
			number of each kind of particles
		*******************************/
		$count = 0;
		
		$cnt_NoMatch = 0;
		
		$particles = array();
		
		for ($i = 0; $i < count(CONS::$hin1_Noun_Names); $i++) {
			
			$particles[CONS::$hin1_Noun_Names[$i]] = 0;
			
		}
		
		for ($i = 0; $i < count($tokens2); $i++) {

			$match = false;
			
			for ($j = 0; $j < count(CONS::$hin1_Noun_Names); $j++) {

				$hin_1 = $tokens2[$i]['Token']['hin_1'];
					
				if ($hin_1 == CONS::$hin1_Noun_Names[$j]) {
				
					$particles[CONS::$hin1_Noun_Names[$j]] += 1;
// 					$count ++;
					
					$match = true;
				
					break;
					
				}
				
			}//for ($j = 0; $j < count(CONS::$hin1_Noun_Names); $j++)

			// no match
			if ($match == false) {
				
				$cnt_NoMatch ++;
				
			}
			
		}
		
		debug($particles);
		
		/*******************************
			build: message
		*******************************/
		$message = "";
		
		asort($particles);
		
		$keys = array_keys($particles);
		
		for ($i = 0; $i < count($particles); $i++) {
			
			$message .= $keys[$i]." => "
					.$particles[$keys[$i]]
					."("
					.(($particles[$keys[$i]]) / $total * 100)
					.")"
					."<br>";
			
		}

		$message .= "no match"." => "
				.$cnt_NoMatch
				."("
						.(($cnt_NoMatch) / $total * 100)
						.")"
								."<br>";

		/*******************************
			names of hins, particles
		*******************************/
		/*******************************
			hin names
		*******************************/
		$tmp = "";
		$keys_HinSymbols = array_keys(CONS::$map_HinSymbols);
		
		for ($i = 0; $i < count(CONS::$map_HinSymbols); $i++) {
			
			$tmp .= $keys_HinSymbols[$i]." => "
					.CONS::$map_HinSymbols[$keys_HinSymbols[$i]]."/";
			
		}//for ($i = 0; $i < count(CONS::$map_HinSymbols); $i++)
		
		$message .= $tmp."<br>";

		/*******************************
			subnouns
		*******************************/
		$tmp = "";
		$keys_Hin1_Noun_Symbols = array_keys(CONS::$map_Hin1_Noun_Symbols);
		
		for ($i = 0; $i < count(CONS::$map_Hin1_Noun_Symbols); $i++) {
			
			$tmp .= $keys_Hin1_Noun_Symbols[$i]." => "
					.CONS::$map_Hin1_Noun_Symbols[$keys_Hin1_Noun_Symbols[$i]]."/";
			
		}
		
		$message .= $tmp."<br>";
		
		
		
		$this->set("message", $message);
		
		/**********************************
		 * view
		**********************************/
		$this->render("/Tokens/tests/test_NVP");
		
	}//test_NVP

	
	public function
	test_NVP_nouns_list() {
		
		/*******************************
			get: history ids	=> 3 ids
		*******************************/
		$this->loadModel('History');
		
		$option_Histories = array("History.category_id" => '8');
		
		$histories = $this->History->find('all', $option_Histories);
// 		$histories = $this->History->find('all');
		
		$max = 3;
		
		$history_Ids = array("127", "128", "129");
// 		$history_Ids = array();
		
		//debug
		$tmp_option = array('conditions' => 
				
							array("AND"	=> array(

							//REF OR http://book.cakephp.org/1.3/en/The-Manual/Developing-with-CakePHP/Models.html "could just as easily find posts that match either condition:"
							// history id => integer, not string (i.e. no double-quotation)
							//REF first hint here => http://stackoverflow.com/questions/8485950/cakephp-or-condition answered Dec 13 '11 at 14:52
							//REF also here => http://stackoverflow.com/questions/8485950/cakephp-or-condition answered Dec 13 '11 at 8:12
												array("OR" => array(
															"Token.history_id" => array(127, 128))
												),
												
												array('Token.hin' => "名詞")
									
							)//array("AND"	=> array
				
// 				//REF
// // 				array( "OR" => array (
// // 						"Post.title" => array("First post", "Second post", "Third post"),
// // 						"Post.created >" => date('Y-m-d', strtotime("-2 weeks"))
// // 				)
// // 				)
// 								array("OR" => array(
// 												"Token.history_id" => array(127, 128))	//=> w
// // 												"Token.history_id" => array("127, 128"))
// 								),
// // 								'Token.hin' => "名詞",
// // 								array('IN' => array("Token.history_id" => array("127, 128")))	//=> n/w

// // 										//=> SQL Query: SELECT "Token"."id", "Token"."created_at", "Token"."updated_at", "Token"."form", "Token"."hin", "Token"."hin_1", "Token"."hin_2", "Token"."hin_3", "Token"."katsu_kei", "Token"."katsu_kata", "Token"."genkei", "Token"."yomi", "Token"."hatsu", "Token"."history_id", "Token"."user_id", "History"."id", "History"."created_at", "History"."updated_at", "History"."line", "History"."url", "History"."vendor", "History"."news_time", "History"."genre_id", "History"."category_id", "History"."subcat_id", "History"."content", "History"."user_id" FROM "main"."tokens" AS "Token" LEFT JOIN "main"."histories" AS "History" ON ("Token"."history_id" = "History"."id") WHERE IN = (Array)

// // 								array('IN' => array("Token.history_id" => "127, 128"))	//=> n/w
// // 								array("Token.history_id" => "127, 128")	//=> n/w
// // 								array("Token.history_id" => "127")
// // 								array('OR' => 
// // // 										array("Token.history_id" => "127"),
// // 										array("Token.history_id" => "128"),
// // // 										array("Token.history_id" => "129"),
// // 											)
			)
			
		);//array('conditions'
		
		$history_1 = $this->Token->find('all', 
								
								$tmp_option
// 								array('conditions' => array('OR' => 
// // 										array("Token.history_id" => "127"),
// 										array("Token.history_id" => "128"),
// // 										array("Token.history_id" => "129"),
// 											))
						);
// 								array('conditions' => array("Token.history_id" => "127")));
		
		debug("count(\$history_1)");
		debug(count($history_1));
		
// 		//debug
// 		debug($histories[0]);
		
// 		for ($i = 0; $i < $max; $i++) {
			
// 			$h = $histories[$i];
			
// 			$id = $h['History']['id'];
			
// 			array_push($history_Ids, $id);
			
// 		}
		
		/*******************************
		 get: history id
		*******************************/
		@$hist_id = $this->request->query['hist_id'];
		
		if ($hist_id == null) {
		
			$hist_id = 126;
// 			$hist_id = 63;
		
		} else {
		
			// 			$hist_id;
		
		}//if ($hist_id == null)
		
		/*******************************
		 validate: history exists
		*******************************/
		$res = Utils::exists_History($hist_id);
		
		if ($res == false) {
				
			$this->set("message", "No history for id $hist_id");
				
			$this->render("/Tokens/tests/test_NVP");
				
			return;
				
		}//if ($res == false)
		
		/*******************************
		 get: tokens
		*******************************/

		debug($history_Ids);

// 		//REF http://stackoverflow.com/questions/6836990/how-to-get-complete-current-url-for-cakephp answered Jul 29 '11 at 15:18
// 		debug(Router::url( $this->here, true ));

// 		debug(gethostname());
// // 		debug(gethostbyname());
// 		debug($_SERVER['SERVER_NAME']);
		
		//REF http://php.net/manual/en/reserved.variables.server.php
		@$server_name = $_SERVER['SERVER_NAME'];
		
		$history_Ids = array(127, 128, 129);
		
		if ($server_name != null && $server_name != "localhost") {
			
			$history_Ids = array(1421, 1471, 1514);
			
		}
		
		$option = array('conditions' => 
				
				array("AND"	=> array(
								
							array("OR" => array(
									"Token.history_id" => $history_Ids)
// 									"Token.history_id" => array(127, 128, 129))
// 									"Token.history_id" => array(127, 128))
							),
			
							array('Token.hin' => "名詞")
								
					)//array("AND"	=> array

				)//array(
					
		);//array('conditions'
		
// 		$option = array('conditions' => 
// 							array(
// 									'AND' => array(
// 												'OR' => array(
// 														array('Token.history_id' => "127"),
// 														array('Token.history_id' => "128"),
// 														array('Token.history_id' => "129"),
// 												),
// 												'Token.hin' => "名詞",
// 									),
// // 									'Token.hin' => "名詞",
									
// // 									'OR' => array(
											
// // 											array('Token.history_id' => "127"),
// // 											array('Token.history_id' => "128"),
// // 											array('Token.history_id' => "129"),
// // // 											'Token.history_id' => "128",
// // // 											'Token.history_id' => "129",
						
// // 									),
// // // 									'Token.history_id' => $history_Ids,		//=> seems working
// // // 									'Token.history_id' => $hist_id,
// // 									'Token.hin' => "名詞",
// 							)
// 		);
		
		$tokens = $this->Token->find('all', $option);
		
		debug(count($tokens));		
		
		/*******************************
			biuld: nouns
		*******************************/
		$nouns = array();
		
		for ($i = 0; $i < count($tokens); $i++) {
			
			array_push($nouns, $tokens[$i]['Token']['form']);
			
		}
		
// 		debug(count($nouns));
		
		/*******************************
			unique
		*******************************/
		$nouns = array_unique($nouns);
		
		debug(count($nouns));
		
// 		debug(array_slice($nouns, 0, 10));
		
// // 		debug($nouns[4]);
// 		debug($nouns[5]);
// // 		debug($nouns[6]);
		
		//REF http://stackoverflow.com/questions/7536961/reset-php-array-index answered Sep 24 '11 at 4:10
		$nouns = array_values($nouns);
		
// 		debug(array_slice($nouns, 0, 10));
// 		debug($nouns[5]);
		
		/*******************************
			setup: nouns with histogram data
		*******************************/
		$histo = array();
		
		for ($i = 0; $i < count($nouns); $i++) {
			
// 			debug($nouns[$i]."($i)");
			
			$histo[$nouns[$i]] = 0;
			
		}
		
// 		debug(array_slice($histo, 0, 10));
		
// 		debug("\$histo => ".count($histo));
		
		/*******************************
			build: histogram data
		*******************************/
		for ($i = 0; $i < count($tokens); $i++) {

			$t = $tokens[$i];

			$form = $t['Token']['form'];
			
			$histo[$form] ++;
				
		}
		

// 		debug(array_slice($histo, 0, 10));
		
// 		debug("\$histo => ".count($histo));
		
		/*******************************
			sort
		*******************************/
		asort($histo);
		
		$histo = array_reverse($histo);

// 		debug(array_slice($histo, 0, 20));
// // 		debug(array_slice($histo, 0, 10));
		
// 		debug("\$histo => ".count($histo));
		
		/*******************************
			set: values
		*******************************/
		$this->set("total", count($tokens));
// 		$this->set("total", count($histo));
		
		$this->set("histo", $histo);

		//test
		$tmp = array(
				
				'aaa'	=> 2,
				'bbb'	=> 3,
				'aaa'	=> 6,
				'ccc'	=> 32,
			
		);
		
		$d = array('aaa'	=> 9871);
		
		array_push($tmp, $d);
		
// 		debug($tmp);

// 		//test
// 		$tmp2 = array_unique($tokens);
		
// 		debug(count($tmp2));

		$tmp = array();
		
		$tokens_New = array();
		
// 		debug($tokens[10]);
		
		for ($i = 0; $i < count($tokens); $i++) {
			
			$t = $tokens[$i];

			if (in_array($t['Token']['form'], $tmp)) {
				
				continue;
				
			} else {
				
				array_push($tokens_New, $t);
				
				array_push($tmp, $t['Token']['form']);
				
			}
			
		}

		debug("\$tokens_New => ".count($tokens_New));
		
// 		//debug
// 		$text = "";
		
// 		for ($i = 0; $i < count($tokens); $i++) {

// 			$text .= $tokens[$i]['Token']['form'];
			
// 			if ($i % 10 == 0) {
				
// 				$text .= "\n";
// // 				$text .= "<br>";
				
// 			}
			
// 		}
		
// 		debug($text);

// 		//debug
// 		$option = array('conditions' =>
// 				array(
// 						'Token.history_id' => $hist_id,
// // 						'Token.hin' => "名詞",
// 				)
// 		);
		
// 		$tokens = $this->Token->find('all', $option);
		
// 		$text = "";
		
// 		for ($i = 0; $i < count($tokens); $i++) {
		
// 			$text .= $tokens[$i]['Token']['form'];
				
// 			if ($i % 10 == 0) {
		
// 				$text .= "\n";
// 				// 				$text .= "<br>";
		
// 			}
				
// 		}

// 		debug($text);
		
		/**********************************
		 * view
		**********************************/
		$this->render("/Tokens/tests/test_NVP_nouns_list");		
		
	}//test_NVP_nouns_list
	
	public function
	test_NVP_nouns_list_V2() {
		
		/*******************************
			get: category id
		*******************************/
		$cat_Name = "医療・介護";
		
		$cat = Utils::get_Category_From_Name($cat_Name);
		
// 		debug($cat);
		
		/*******************************
		 get: tokens
		*******************************/
		$option = array('conditions' => 
				
// 							array("OR" => array(
							array("AND" => 
									array("Token.category_id" => $cat['Category']['id']),
// 									array("Token.category_id" => 8),
									array('Token.hin' => "名詞")
							),
			
// 							array('Token.hin' => "名詞")

		);//array('conditions'
		
		$tokens = $this->Token->find('all', $option);
		
		debug(count($tokens));		
		
		/*******************************
			biuld: nouns
		*******************************/
		$nouns = array();
		
		for ($i = 0; $i < count($tokens); $i++) {
			
			array_push($nouns, $tokens[$i]['Token']['form']);
			
		}
		
// 		debug(count($nouns));
		
		/*******************************
			unique
		*******************************/
		$nouns = array_unique($nouns);
		
		debug("\$nouns(unique) => ".count($nouns));
		
		//REF http://stackoverflow.com/questions/7536961/reset-php-array-index answered Sep 24 '11 at 4:10
		$nouns = array_values($nouns);
		
		/*******************************
			setup: nouns with histogram data
		*******************************/
		$histo = array();
		
		for ($i = 0; $i < count($nouns); $i++) {
			
			$histo[$nouns[$i]] = 0;
			
		}
		
		debug("\$histo => ".count($histo));
		
		/*******************************
			build: histogram data
		*******************************/
		for ($i = 0; $i < count($tokens); $i++) {

			$t = $tokens[$i];

			$form = $t['Token']['form'];
			
			$histo[$form] ++;
				
		}
		
		/*******************************
			sort
		*******************************/
		asort($histo);
		
		$histo = array_reverse($histo);

		/*******************************
			set: values
		*******************************/
		$this->set("total", count($tokens));
		
		$this->set("histo", $histo);
		
		/**********************************
		 * view
		**********************************/
		$this->render("/Tokens/tests/test_NVP_nouns_list");		
		
	}//test_NVP_nouns_list_V2
	
	public function
	test_NVP_nouns_list_V3() {
		
		/*******************************
			get: category id
		*******************************/
		$cat_Name = "医療・介護";
		
		$cat = Utils::get_Category_From_Name($cat_Name);
		
// 		debug($cat);
		
		/*******************************
		 get: tokens
		*******************************/
		$option = array('conditions' => 
				
// 							array("OR" => array(
							array("AND" => 
									array("Token.category_id" => $cat['Category']['id']),
// 									array("Token.category_id" => 8),
// 									array('Token.hin' => "名詞")
							),
			
// 							array('Token.hin' => "名詞")

		);//array('conditions'
		
		$tokens = $this->Token->find('all', $option);
		
		debug(count($tokens));		
		
		/*******************************
			build: list
		*******************************/
		$s = "";
		
		$nouns = array();
		
		for ($i = 0; $i < count($tokens); $i++) {
			
			$t = $tokens[$i];
			
			if ($t['Token']['hin'] == "名詞") {
				
				$s .= $t['Token']['form'];
				
				continue;
				
			} else {
				
				if ($s == "") {
				
					continue;
				
				} else {
				
					array_push($nouns, $s);
					
					$s = "";
					
					continue;
				
				}
				
			}//if ($t['Tokens']['hin'] == "名詞")
			
		}//for ($i = 0; $i < count($tokens); $i++)
		
		debug("count(\$nouns)");
		debug(count($nouns));

		$nouns_unique = array_unique($nouns);
		
		debug("count(\$nouns_unique)");
		debug(count($nouns_unique));
		
		$len_unique = count($nouns_unique);
		
		$nouns_unique = array_values($nouns_unique);
		
		$histo = array($len_unique);
		
		for ($i = 0; $i < $len_unique; $i++) {
			
			$histo[$nouns_unique[$i]] = 0;
			
		}
		
		$len_total = count($nouns);
		
		for ($i = 0; $i < $len_total; $i++) {
			
			$histo[$nouns[$i]] ++;
			
		}
		
// 		debug(array_slice($histo, 0, 10));
		
		/*******************************
		 sort
		*******************************/
		asort($histo);
		
		$histo = array_reverse($histo);
		
		
		/*******************************
		 set: values
		*******************************/
		$this->set("total", count($nouns));
// 		$this->set("total", count($tokens));
		
		$this->set("histo", $histo);
		
		/**********************************
		 * view
		**********************************/
		$this->render("/Tokens/tests/test_NVP_nouns_list_V3");		
		
	}//test_NVP_nouns_list_V3
	
	public function
	test_NVP_nouns_list_V4() {
		
		/*******************************
			query
		*******************************/
		$query_CatId = "cat_id";
		
		@$cat_Id = $this->request->query[$query_CatId];
		
		if ($cat_Id == null) {
			
			/*******************************
				get: category id
			*******************************/
			$cat_Name = "医療・介護";
			
			$cat = Utils::get_Category_From_Name($cat_Name);
			
			$cat_Id = $cat['Category']['id'];
			
		}
		
		
// 		debug($cat);
		
		/*******************************
		 get: tokens
		*******************************/
		$option = array('conditions' => 
				
// 							array("OR" => array(
							array("AND" => 
									array("Token.category_id" => $cat_Id),
// 									array("Token.category_id" => $cat['Category']['id']),
// 									array("Token.category_id" => 8),
// 									array('Token.hin' => "名詞")
							),
			
// 							array('Token.hin' => "名詞")

		);//array('conditions'
		
		$tokens = $this->Token->find('all', $option);
		
		debug(count($tokens));		
		
		/*******************************
			build: list
		*******************************/
		$s = "";
		
		$nouns = array();
		
		for ($i = 0; $i < count($tokens); $i++) {
			
			$t = $tokens[$i];
			
			if ($t['Token']['hin'] == "名詞") {
				
				$s .= $t['Token']['form'];
				
				continue;
				
			} else {
				
				if ($s == "") {
				
					continue;
				
				} else {

// 					if ($s != null) {	//=> w
// 					if ($s != null && $s != "") {	//=> w
					if ($s != null && $s != "" && $s != -1) {	//=> w
// 					if ($s != null && $s != "" && $s != -1 && $s != 0) {	//=> debug displayed
// 					if ($s != null && $s != "" && $s != -1 && $s != 0) {
// 					if ($s != "０" && $s != "0") {
// 					if ($s != "０") {
						
// 						debug($s);
						
						array_push($nouns, $s);;
						
					} else {
						
						debug($s);
						
					}
					
// 					array_push($nouns, $s);
					
					$s = "";
					
					continue;
				
				}
				
			}//if ($t['Tokens']['hin'] == "名詞")
			
		}//for ($i = 0; $i < count($tokens); $i++)
		
		debug("count(\$nouns)");
		debug(count($nouns));

		$nouns_unique = array_unique($nouns);
		
// 		// omit '0'
// 		$len = count($nouns_unique);
		
// // 		debug($nouns_unique[10]);
		
// // 		debug(array_slice($nouns_unique, 600, 10));
// // 		debug($len);
		
// 		for ($i = 0; $i < $len; $i++) {
// // 		for ($i = 0; $i < count($nouns_unique); $i++) {
			
// 			debug($nouns_unique[$i]."(".$i.")");
			
// // 			$noun = $nouns_unique[$i];
// // 			$n = $nouns_unique[$i];
			
// // 			if ($n == "0") {
// // // 			if ($n == '0') {
				
// // 				debug("yes");
// // // 				debug("='0'");
				
// // 			}
// 		}
		
		
// // 		$nouns_unique = array_diff($nouns_unique, array('0'));
		
		
		debug("count(\$nouns_unique)");
		debug(count($nouns_unique));

		$len_unique = count($nouns_unique);
		
		$nouns_unique = array_values($nouns_unique);
		
// 		// omit '0'
// 		unset($nouns_unique[0]);
		
// 		debug("unset => \$nouns_unique[0]");
		
// 		debug(array_slice($nouns_unique, 0, 20));

		for ($i = 0; $i < $len_unique; $i++) {
// 		for ($i = 0; $i < count($nouns_unique); $i++) {
	
			$n = $nouns_unique[$i];
			
			if ($n == '0') {
				
				debug("='0'");
				
			} else if ($n == "0") {
				
				debug("=\"0\"");
				
			} else if ($n == "０") {
				
				debug("=\"０\"");
				
			}
			
			
// 			debug($nouns_unique[$i]."(".$i.")");
	
// 			$noun = $nouns_unique[$i];
// 			$n = $nouns_unique[$i];
	
// 			if ($n == "0") {
// // 			if ($n == '0') {

// 				debug("yes");
// // 				debug("='0'");

// 			}
		}

// 		$nouns_unique = array_diff($nouns_unique, array("０"));
		
// 		$len_unique = count($nouns_unique);
		
// 		$nouns_unique = array_values($nouns_unique);
		
		/*******************************
			histogram
		*******************************/
		$histo = array($len_unique);
		
		for ($i = 0; $i < $len_unique; $i++) {
			
			$histo[$nouns_unique[$i]] = 0;
			
		}
		
		$len_total = count($nouns);
		
		for ($i = 0; $i < $len_total; $i++) {
			
			$histo[$nouns[$i]] ++;
			
		}
		
// 		debug(array_slice($histo, 0, 10));
		
		/*******************************
		 sort
		*******************************/
		asort($histo);
		
		$histo = array_reverse($histo);
		
		// omit '0'
		$omit = array(0, 'こと', '人', 'ロボット', '理由', '場合', '中止', 'ため', 'の');
		
		$histo = Utils::unset_Vars($histo, $omit);
// 		$histo = Utils::unset_Vars($histo, array(0, 'こと', '人', 'ロボット'));
// 		$histo = Utils::unset_Vars($histo, array(0, 'こと'));	//=> w
// 		$histo = Utils::unset_Vars($histo, array(0));	//=> w
// 		Utils::unset_Vars($histo, array(0));
// 		Utils::unset_Vars(array($histo[0], $histo['こと']));
// 		unset($histo[0]);
		
// 		debug($histo);
		
		/*******************************
		 set: values
		*******************************/
		$total = 0;
		
// 		debug(array_slice($histo, 10,10));
		
// 		$total += $histo[0] + $histo[1];
		
// 		debug($total);
		
// 		debug($histo[0]);
// 		debug($histo[1]);
		
		$count = 0;
		
		foreach ($histo as $h) {
			
			$total += $h;
			
// 			debug($h."/".$total);
			
// 			$count ++;
			
// 			if ($count > 10) {
				
// 				break;;
				
// 			}
			
		}
		
// 		debug($total);
		
// 		for ($i = 0; $i < count($histo); $i++) {
			
// 			$total += $histo[$i];
			
// 		}
		
		$this->set("total", $total);
// 		$this->set("total", count($nouns));
// 		$this->set("total", count($tokens));
		
		$this->set("histo", $histo);
		
		/**********************************
		 * view
		**********************************/
		$this->render("/Tokens/tests/test_NVP_nouns_list_V3");		
		
	}//test_NVP_nouns_list_V4
	
	public function
	test_D3() {

// 		//debug(count(CONS::$hin1_Noun_Names));
// 		debug(CONS::$map_Hin1_Noun_Symbols[count(CONS::$hin1_Noun_Names) - 1]);
		
		/*******************************
			get: history id
		*******************************/
		@$hist_id = $this->request->query['hist_id'];

		if ($hist_id == null) {
		
			$hist_id = 63;
		
		} else {
		
// 			$hist_id;
		
		}//if ($hist_id == null)

		/*******************************
			validate: history exists
		*******************************/
		$res = Utils::exists_History($hist_id);
		
		if ($res == false) {
			
			$this->set("message", "No history for id $hist_id");
			
			$this->render("/Tokens/tests/test_NVP");
			
			return;
			
		}//if ($res == false)
		
		/*******************************
			get: tokens
		*******************************/
		
		$option = array('conditions' => array('Token.history_id' => $hist_id));
		
		$tokens = $this->Token->find('all', $option);
		
		//debug(count($tokens));

		/*******************************
			build: NL sentence
		*******************************/
		$this->set("hist_id", $hist_id);
		
		if ($tokens == null || count($tokens) < 1) {
		
			$this->set("sen_NL", "NO TOKENS");
		
		} else {
		
			$ary_Forms = array();
			$ary_Syms = array();
			
			$max = 50;
			
			$count = 1;
			
			for ($i = 0; $i < count($tokens); $i++) {
				
				/*******************************
					hin, sym
				*******************************/
				$hin = $tokens[$i]['Token']['hin'];
				$sym = CONS::$map_HinSymbols[$hin];

				/*******************************
				 modify: particles => subparticles
				*******************************/
				if ($hin == "助詞") {
					
					$sym = $this->conv_Particle_2_SubParticle($tokens[$i]['Token']['hin_1']);
					
				} else if ($hin == "名詞") {
					
					$sym = $this->conv_Noun_2_SubNoun($tokens[$i]['Token']['hin_1']);
					
				}//if ($hin == "助詞")
				
				array_push($ary_Forms, $tokens[$i]['Token']['form']);
				array_push($ary_Syms, $sym);
// 				array_push($ary_Syms, CONS::$map_HinSymbols[$tokens[$i]['Token']['hin']]);
				
				if ($i > $max) {
					
					break;
					
				}
				
				// delimiter
				if ($i % 5 == 0) {
					
					array_push($ary_Forms, "/($count)");
					array_push($ary_Syms, "/($count)");
					
					$count ++;
					
				}
				
			}//for ($i = 0; $i < count($tokens); $i++)
			
			$sen_NL = implode(" ", $ary_Forms);
// 			$sen_Syms = implode("", $ary_Syms);
			$sen_Syms = implode(" ", $ary_Syms);
			
			$this->set("sen_NL", $sen_NL);
			$this->set("sen_Syms", $sen_Syms);
			
	// 		debug($sen_NL);
		
		}//if ($tokens == null || count($tokens) < 1)

		/*******************************
			stat: hin_1 names => "助詞"
		*******************************/
		$option2 = array('conditions' => 
							array('Token.hin' => CONS::$hin_Names[2]));	// 名詞
// 							array('Token.hin' => "助詞"));
		
		$tokens2 = $this->Token->find('all', $option2); 
		
		$total = count($tokens2);
		
		//debug("tokens with ".CONS::$hin_Names[2]);
		//debug($total);
// 		debug(count($tokens2));
		
// 		debug($tokens2[0]);

		/*******************************
			number of each kind of particles
		*******************************/
		$count = 0;
		
		$cnt_NoMatch = 0;
		
		$particles = array();
		
		for ($i = 0; $i < count(CONS::$hin1_Noun_Names); $i++) {
			
			$particles[CONS::$hin1_Noun_Names[$i]] = 0;
			
		}
		
		for ($i = 0; $i < count($tokens2); $i++) {

			$match = false;
			
			for ($j = 0; $j < count(CONS::$hin1_Noun_Names); $j++) {

				$hin_1 = $tokens2[$i]['Token']['hin_1'];
					
				if ($hin_1 == CONS::$hin1_Noun_Names[$j]) {
				
					$particles[CONS::$hin1_Noun_Names[$j]] += 1;
// 					$count ++;
					
					$match = true;
				
					break;
					
				}
				
			}//for ($j = 0; $j < count(CONS::$hin1_Noun_Names); $j++)

			// no match
			if ($match == false) {
				
				$cnt_NoMatch ++;
				
			}
			
		}
		
		//debug($particles);
		
		/*******************************
			build: message
		*******************************/
		$message = "";
		
		asort($particles);
		
		$keys = array_keys($particles);
		
		for ($i = 0; $i < count($particles); $i++) {
			
			$message .= $keys[$i]." => "
					.$particles[$keys[$i]]
					."("
					.(($particles[$keys[$i]]) / $total * 100)
					.")"
					."<br>";
			
		}

		$message .= "no match"." => "
				.$cnt_NoMatch
				."("
						.(($cnt_NoMatch) / $total * 100)
						.")"
								."<br>";

		/*******************************
			names of hins, particles
		*******************************/
		/*******************************
			hin names
		*******************************/
		$tmp = "";
		$keys_HinSymbols = array_keys(CONS::$map_HinSymbols);
		
		for ($i = 0; $i < count(CONS::$map_HinSymbols); $i++) {
			
			$tmp .= $keys_HinSymbols[$i]." => "
					.CONS::$map_HinSymbols[$keys_HinSymbols[$i]]."/";
			
		}//for ($i = 0; $i < count(CONS::$map_HinSymbols); $i++)
		
		$message .= $tmp."<br>";

		/*******************************
			subnouns
		*******************************/
		$tmp = "";
		$keys_Hin1_Noun_Symbols = array_keys(CONS::$map_Hin1_Noun_Symbols);
		
		for ($i = 0; $i < count(CONS::$map_Hin1_Noun_Symbols); $i++) {
			
			$tmp .= $keys_Hin1_Noun_Symbols[$i]." => "
					.CONS::$map_Hin1_Noun_Symbols[$keys_Hin1_Noun_Symbols[$i]]."/";
			
		}
		
		$message .= $tmp."<br>";
		
		
		
		$this->set("message", $message);
		
		/**********************************
		 * view
		**********************************/
// 		$this->layout = 'plain';
		
		$this->render("/Tokens/tests/test_D3");
		
	}//test_D3
	
	public function
	get_JSON_Data_deprecated() {

		//REF rand http://php.net/manual/en/function.rand.php
		$data = array("a" => rand(0,10), "b" => rand(0,10), "c" => rand(0,10));
// 		$data = array("a" => 10, "b" => 20, "c" => 30);
// 		$data = array(1 => 10, 2 => 20, 3 => 30);
		
		//REF http://php.net/manual/en/function.json-encode.php
		$this->set("data", json_encode($data));
		
		/**********************************
		 * view
		**********************************/
		$this->layout = 'plain';
		
		$this->render("/Tokens/tests/get_JSON_Data");
		
	}//get_JSON_Data
	
	public function
	get_JSON_Data() {

		/*******************************
			build: particles list
		*******************************/
		/*******************************
		 get: history id
		*******************************/
		@$hist_id = $this->request->query['hist_id'];
		
		if ($hist_id == null) {
		
			$hist_id = 63;
		
		} else {
		
			// 			$hist_id;
		
		}//if ($hist_id == null)
		
		/*******************************
		 validate: history exists
		*******************************/
		$res = Utils::exists_History($hist_id);
		
		if ($res == false) {

			$data = array();
			
			$this->set("data", json_encode($data));
			
			/**********************************
			 * view
			**********************************/
			$this->layout = 'plain';
			$this->render("/Tokens/tests/get_JSON_Data");
			
			return;
				
		}//if ($res == false)
		
		/*******************************
		 get: tokens
		*******************************/
		$option = array('conditions' => array('Token.history_id' => $hist_id));
		
		$tokens = $this->Token->find('all', $option);
		
// 		debug(count($tokens));
		
		/*******************************
		 build: NL sentence
		*******************************/
		$this->set("hist_id", $hist_id);
		
		if ($tokens == null || count($tokens) < 1) {
		
			$this->set("sen_NL", "NO TOKENS");
		
		} else {
		
			$ary_Forms = array();
			$ary_Syms = array();
				
			$max = 50;
				
			$count = 1;
				
			for ($i = 0; $i < count($tokens); $i++) {
		
				/*******************************
				 hin, sym
				*******************************/
				$hin = $tokens[$i]['Token']['hin'];
				$sym = CONS::$map_HinSymbols[$hin];
		
				/*******************************
				 modify: particles => subparticles
				*******************************/
				if ($hin == "助詞") {
						
					$sym = $this->conv_Particle_2_SubParticle($tokens[$i]['Token']['hin_1']);
						
				} else if ($hin == "名詞") {
						
					$sym = $this->conv_Noun_2_SubNoun($tokens[$i]['Token']['hin_1']);
						
				}//if ($hin == "助詞")
		
				array_push($ary_Forms, $tokens[$i]['Token']['form']);
				array_push($ary_Syms, $sym);
					// 				array_push($ary_Syms, CONS::$map_HinSymbols[$tokens[$i]['Token']['hin']]);
		
				if ($i > $max) {
						
					break;
						
				}
		
				// delimiter
				if ($i % 5 == 0) {
						
					array_push($ary_Forms, "/($count)");
					array_push($ary_Syms, "/($count)");
						
					$count ++;
						
				}
		
			}//for ($i = 0; $i < count($tokens); $i++)
				
			$sen_NL = implode(" ", $ary_Forms);
				// 			$sen_Syms = implode("", $ary_Syms);
			$sen_Syms = implode(" ", $ary_Syms);
				
			$this->set("sen_NL", $sen_NL);
			$this->set("sen_Syms", $sen_Syms);
				
			// 		debug($sen_NL);
		
		}//if ($tokens == null || count($tokens) < 1)
		
		/*******************************
		 stat: hin_1 names => "助詞"
		*******************************/
		$option2 = array('conditions' =>
				array('Token.hin' => CONS::$hin_Names[2]));	// 名詞
		// 							array('Token.hin' => "助詞"));
		
		$tokens2 = $this->Token->find('all', $option2);
		
		$total = count($tokens2);
		
// 		debug("tokens with ".CONS::$hin_Names[2]);
// 		debug($total);
		// 		debug(count($tokens2));
		
		// 		debug($tokens2[0]);
		
		/*******************************
		 number of each kind of particles
		*******************************/
		$count = 0;
		
		$cnt_NoMatch = 0;
		
		$particles = array();
		
		for ($i = 0; $i < count(CONS::$hin1_Noun_Names); $i++) {
				
			$particles[CONS::$hin1_Noun_Names[$i]] = 0;
				
		}
		
		$total_hin1_Noun_Names = count(CONS::$hin1_Noun_Names);
		
		for ($i = 0; $i < $total; $i++) {
// 		for ($i = 0; $i < count($tokens2); $i++) {
		
			$match = false;
				
			for ($j = 0; $j < $total_hin1_Noun_Names; $j++) {
// 			for ($j = 0; $j < count(CONS::$hin1_Noun_Names); $j++) {
		
				$hin_1 = $tokens2[$i]['Token']['hin_1'];
					
				if ($hin_1 == CONS::$hin1_Noun_Names[$j]) {
		
					$particles[CONS::$hin1_Noun_Names[$j]] += 1;
					// 					$count ++;
						
					$match = true;
		
					break;
						
				}
		
			}//for ($j = 0; $j < count(CONS::$hin1_Noun_Names); $j++)
		
			// no match
			if ($match == false) {
		
				$cnt_NoMatch ++;
		
			}
				
		}
		
// 		debug($particles);
		
		/*******************************
		 build: message
		*******************************/
// 		$message = "";
		
		asort($particles);
		
// 		$data = array();
		
		$keys = array_keys($particles);
		
		for ($i = 0; $i < count($particles); $i++) {
				
// 			$data[$keys[$i]] = $particles[$keys[$i]];
			
// 			$message .= $keys[$i]." => "
// 					.$particles[$keys[$i]]
// 					."("
// 							.(($particles[$keys[$i]]) / $total * 100)
// 							.")"
// 									."<br>";
				
		}
		
// 		$message .= "no match"." => "
// 				.$cnt_NoMatch
// 				."("
// 						.(($cnt_NoMatch) / $total * 100)
// 						.")"
// 								."<br>";
		

		//REF http://php.net/manual/en/function.json-encode.php
		$this->set("data", json_encode($particles));
// 		$this->set("data", json_encode($data));

		/**********************************
		 * view
		**********************************/
		$this->layout = 'plain';

		$this->render("/Tokens/tests/get_JSON_Data");

// 		//REF rand http://php.net/manual/en/function.rand.php
// 		$data = array("a" => rand(0,10), "b" => rand(0,10), "c" => rand(0,10));
// // 		$data = array("a" => 10, "b" => 20, "c" => 30);
// // 		$data = array(1 => 10, 2 => 20, 3 => 30);
		
// 		//REF http://php.net/manual/en/function.json-encode.php
// 		$this->set("data", json_encode($data));
		
// 		/**********************************
// 		 * view
// 		**********************************/
// 		$this->layout = 'plain';
		
// 		$this->render("/Tokens/tests/get_JSON_Data");
		
	}//get_JSON_Data

	public function
	create_Tokens() {
		
		/*******************************
		 query
		*******************************/
		$query_CatId = "cat_id";
		
		@$cat_Id = $this->request->query[$query_CatId];
		
		if ($cat_Id == null) {

			$this->Session->setFlash(__('no category id'));

			$this->render("/Tokens/tests/create_Tokens");
			
			return;
				
		} else {
			
			debug("category id => ".$cat_Id);
			
		}
		
		/*******************************
			get: history list
		*******************************/
		
		
		/**********************************
		 * view
		**********************************/
		$this->render("/Tokens/tests/create_Tokens");
		
	}//create_Tokens
	
}