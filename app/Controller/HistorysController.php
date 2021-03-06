<?php

class HistorysController extends AppController {
	public $helpers = array('Html', 'Form');

	public $components = array('Paginator');
	
	public function index() {

		$tmp = @$session_Filter = $this->Session->read("filter");
		
		/**********************************
		 * options
		**********************************/
		$opt_conditions = $this->_index__Options();

		if ((@$range = $this->request->query["range"]) != null) {

			$opt_conditions = $this->_index__Options__Range($opt_conditions, $range);
			
			//REF http://stackoverflow.com/questions/11931633/cakephp-find-condition-for-a-query-between-two-dates answered Aug 13 '12 at 10:13
// 			$opt_conditions['History.news_time >='] = $range;
// 			$opt_conditions['History.news_time >='] = "20150601";
	// 		$opt_conditions['History.news_time >='] = "20150408";	//=> w
	// 		$opt_conditions['History.news_time'] = "20150408";		//=> w
	// 		$opt_conditions['History.news_time'] = ">= 20150408";	//=> n/w
	// 		$opt_conditions['History.news_time'] = "= '20150408'";	//=> n/w
	// 		$opt_conditions['History.news_time'] = ">= '20150408'";
		
			
		}
		
// 		debug($opt_conditions);
		
		/*******************************
			total limit
		*******************************/
		$totalCount = $this->History->find('count');
		
		/**********************************
		 * paginate
		**********************************/
		$page_limit = 10;
		
		$opt_order = $this->_index__Orders();

		$opt_Fields = array(
					'History.id',
				
					'History.line',
					'History.url',
					'History.vendor',
					'History.news_time',
				
					'History.updates',
				
					'History.created_at', 
					'History.updated_at',
					'History.category_id',
				
					'Category.id',
					'Category.name',
					'Category.genre_id',
		);
		
		$this->paginate = array(
				
				'limit' => $page_limit,
				'order' => $opt_order,
				'conditions'	=> $opt_conditions,
				'fields'		=> $opt_Fields,
// 				'limit'			=> 4,
				//REF http://book.cakephp.org/2.0/en/core-libraries/components/pagination.html "The number of results that are fetched is"
// 				'maxLimit'			=> 7,
// 				'totallimit'			=> 2,
				
		);

		$time_fetch_Start = microtime(true);
		
		$histories_Current = $this->paginate('History');

		$time_fetch_End = microtime(true);
		
		debug("fetch: start = ".$time_fetch_Start
				."/"
				."end = ".$time_fetch_End
				."/"
				." diff = ".($time_fetch_End - $time_fetch_Start)
		);
		
		//debug("count(\$histories_Current)");
		//debug(count($histories_Current));
		
		$this->set('historys', $histories_Current);

		$time_set_historys_End = microtime(true);
		
		debug("fetch end ~ historys set => ".($time_set_historys_End - $time_fetch_End));
		
// 		debug("historys => obtained");
		
		$this->set('num_of_histories_Current', count($histories_Current));

		$num_of_histories = count($this->History->find('all'));

		$this->set('num_of_histories', $num_of_histories);

		$this->set('num_of_pages', (int) ceil(count($histories_Current) / $page_limit));
		
		// time
		$time_set_all_End = microtime(true);
		
		$t = new DateTime(date("Y-m-d H:i:s", $time_set_all_End - $time_set_historys_End));
// 		$t = new DateTime($time_set_all_End - $time_set_historys_End);	//=> n/w
		
		debug($t->format("Y/m/d H:i:s.u"));
		
		debug("historys set ~ all set => "
				.number_format($time_set_all_End - $time_set_historys_End, 6, "!", "")
// 				.($time_set_all_End - $time_set_historys_End)
				."\n"
				."("
// 				.date($time_set_all_End - $time_set_historys_End)->format("Y-m-d H:i:s")
// 				.date($time_set_all_End - $time_set_historys_End)->format("Y-m-d H:i:s")
				.")"
		);
		
	}//index
	
	public function 
	_index__Options__Range($opt_conditions, $range) {
		
		$tokens = explode("-", $range);
		
		if (count($tokens) == 2) {
		
			$tmp = array(
				
				'AND' => array(
						
						'History.news_time >=' => $tokens[0],
						'History.news_time <=' => $tokens[1],
				)
			);

			if (array_key_exists("AND", $opt_conditions)) {
// 			if (defined($opt_conditions['AND']) == true) {
// 			if ($opt_conditions['AND'] != null) {
			
				array_push($opt_conditions['AND'], $tmp);
			
			} else {
			
// 				array_push($opt_conditions, $tmp);	//=> n/w
				
				$opt_conditions['AND'] = $tmp['AND'];
				
			}//if ($opt_conditions['AND'] != null)
			
			
// 			array_push($opt_conditions, $tmp);
// 			array_push($opt_conditions, $tmp);
			
// 			'AND' => array(
// 					(int) 0 => array(
// 							'OR' => array(
// 									'History.line  LIKE' => '%日本%',
// 									'History.content  LIKE' => '%日本%'
// 							)
// 					),
// 					(int) 1 => array(
// 							'OR' => array(
// 									'History.line  LIKE' => '%中国%',
// 									'History.content  LIKE' => '%中国%'
// 							)
// 					)
// 			)
// 			$opt_conditions['History.news_time >='] = $tokens[0];
			
// 			$opt_conditions['History.news_time >='] = $tokens[0];
		
		} else if (count($tokens) == 1) {
			
			$opt_conditions['History.news_time >='] = $tokens[0];
			
		} else {
		
			$opt_conditions['History.news_time >='] = $range;
			
		}//if (count($tokens) == 2)
		
		
		
// // 		//REF http://stackoverflow.com/questions/11931633/cakephp-find-condition-for-a-query-between-two-dates answered Aug 13 '12 at 10:13
// 		$opt_conditions['History.news_time >='] = $range;
		
		/*******************************
			return
		*******************************/
		return $opt_conditions;
		
	}//_index__Options__Range($opt_conditions)
	
	public function 
	_index__Orders() {

		/**********************************
		 * param: sort
		**********************************/
		// 		debug($this->request->data);
		// 		debug($this->request->query);
		$opt_order = array();
		
// 		/**********************************
// 		* default
// 		**********************************/
// 		$opt_order["History.id"] = "desc";

		/**********************************
		* set: orders
		**********************************/
		$sort = "sort";
		
		@$query_Sort = $this->request->query[$sort];
		
		if ($query_Sort == null) {
		
			@$session_Sort = $this->Session->read($sort);
		
//			debug("session_Sort is ...");
//			debug($this->Session->read($sort));
		
			if ($session_Sort != null) {
				
				$opt_order["History.$session_Sort"] = "asc";

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
		
		} else if ($query_Sort == -1) {
			
			$session_Sort = $this->Session->write($sort, null);
			
			$this->set("sort", null);
			
		} else {
		
// 			$opt_order['History.line LIKE'] = "%$query_Sort%";
			
			$opt_order["History.$query_Sort"] = "asc";
			
			$session_Sort = $this->Session->write($sort, $query_Sort);
		
//			debug("session_Sort => written: ".$query_Sort);
				
			/**********************************
			 * set: var
			**********************************/
			$this->set("sort", $query_Sort);
			
		}

// 		/**********************************
// 		* set: var
// 		**********************************/
// 		$this->set("sort", $query_Sort);

		/**********************************
		 * default
		**********************************/
		if (count($opt_order) < 1) {
			
			$opt_order["History.id"] = "desc";
			
		}
		
		return $opt_order;
		
	}//_index__Orders
	
	public function 
	_index__Options() {

		/*******************************
			filter: line, content
		*******************************/
		$opt_conditions = $this->_index__Options__Line();
		
//		debug($opt_conditions);
		
		/*******************************
			filter: category
		*******************************/
		$opt_conditions = $this->_index__Options__Category($opt_conditions);

		/*******************************
			return
		*******************************/
		return $opt_conditions;
		
	}//_index__Options
	
	public function 
	_index__Options__Line() {

		$filter_Line = "filter_Line";
		
		$opt_conditions = array();
		
		/**********************************
		 * param: filter
		**********************************/
		@$query_Filter = $this->request->query[$filter_Line];
		
		if ($query_Filter == "__@") {
				
			$this->Session->write($filter_Line, null);
				
			$this->set("filter_Line", '');
				
		} else if ($query_Filter == null) {
		
			@$session_Filter = $this->Session->read($filter_Line);
		
			if ($session_Filter != null) {

				$opt_conditions =
					$this->_index__Options__Line_Query($opt_conditions, $session_Filter);
				
				/**********************************
				 * set: var
				**********************************/
				$this->set("filter_Line", $session_Filter);
		
			} else {
		
				/**********************************
				 * set: var
				**********************************/
				$this->set("filter_Line", null);
		
			}
		
		} else {
		
			
			$opt_conditions = 
					$this->_index__Options__Line_Query($opt_conditions, $query_Filter);
				
			$session_Filter = $this->Session->write($filter_Line, $query_Filter);
		
			/**********************************
			 * set: var
			**********************************/
			$this->set("filter_Line", $query_Filter);
		
		}//if ($query_Filter == "__@")
		
		/*******************************
			return
		*******************************/
		return $opt_conditions;
		
	}//_index__Options__Line()
	
	public function 
	_index__Options__Line_Query
	($opt_conditions, $query_Filter) {

		/*******************************
			radio buttons
		*******************************/
		@$AND_OR = $this->request->query[CONS::$str_Filter_RadioButtons_Name_History];
		
		$target = preg_replace("/　/", " ", $query_Filter);
		
		$keywords = explode(" ", $target);

		$tmp = array();
		$not = array();
		
		$aor = "";		// $tmp array key "AND" or "OR"
		
		if ($AND_OR != null) {
		
			$aor = $AND_OR;
// 			$tmp[$AND_OR] = array();
		
		} else {
		
			$aor = 'OR';
			
		}//if ($AND_OR != null)
		
		$tmp[$aor] = array();
		
		$not['NOT'] = array();
		
		for ($i = 0; $i < count($keywords); $i++) {
			
			$w = $keywords[$i];
			
			if (mb_strlen($w) > 1) {
			
				if ($w[0] == "-") {
				
					$ary_not = array(
							'History.line LIKE' => "%".mb_substr($keywords[$i], 1)."%",
							'History.content LIKE' => "%".mb_substr($keywords[$i], 1)."%",
					);
					
					array_push($not['NOT'], $ary_not);
				
				} else {
				
					if ($aor == "AND") {
					
						$sensitive = "";
						
// 						if (strpos($w, "*s") !== false) {
						
// // 							$sensitive = "GLOB";
// // 							$sensitive = "caseSensitiveField";
						
// 							$w = str_replace("*s", "", $w);
// // 							$w = substr($w, strpos($w, "*s"), strlen("*s"));
							
// 						} else {
						
// // 							$sensitive = "caseInsensitiveField";
							
// // 							$w = str_replace("*s", "", $w);
// // 							$w = substr($w, strpos($w, "*s"), strlen("*s"));
							
// 						}//if (conditions)
						
						
						
						$ary = array("OR" => 
// 								array("$sensitive History.line GLOB" => "%$w%",
// 								"$sensitive History.content GLOB" => "%$w%"
// 								array("$sensitive History.line LIKE" => "%$w%",
// 								"$sensitive History.content LIKE" => "%$w%"
								array("History.line $sensitive LIKE" => "%$w%",	//=> n/w
								"History.content $sensitive LIKE" => "%$w%"
// 								array("History.line $sensitive LIKE" => "%$keywords[$i]%",
// 								"History.content $sensitive LIKE" => "%$keywords[$i]%"
// 								array('History.line LIKE' => "%$keywords[$i]%",
// 								'History.content LIKE' => "%$keywords[$i]%"
								)
						);
					
					} else {
					
						$ary = array(
								'History.line LIKE' => "%$keywords[$i]%",
								'History.content LIKE' => "%$keywords[$i]%"
						);
						
					}//if ($aor == "AND")
					
					if (isset($ary) && $ary != null) {
// 					if (isset($ary)) {
					
						array_push($tmp[$aor], $ary);
// 						array_push($tmp['OR'], $ary);
					
					}
						
				}//if ($w[0] == "-")
			
			} else {

				if ($aor == "AND") {
						
					$ary = array("OR" =>
							array('History.line LIKE' => "%$keywords[$i]%",
									'History.content LIKE' => "%$keywords[$i]%"
							)
					);
						
				} else {
						
					$ary = array(
							'History.line LIKE' => "%$keywords[$i]%",
							'History.content LIKE' => "%$keywords[$i]%"
					);
				
				}//if ($aor == "AND")
				
				if (isset($ary) && $ary != null) {
// 				if (isset($ary)) {
						
					array_push($tmp[$aor], $ary);
// 					array_push($tmp['OR'], $ary);
						
				}
			}//if (conditions)
			
		}//for ($i = 0; $i < count($keywords); $i++)
			
		//REF http://book.cakephp.org/2.0/en/models/retrieving-your-data.html
		$opt_conditions[$aor] = $tmp[$aor];
// 		$opt_conditions['OR'] = $tmp['OR'];
		
		$opt_conditions['NOT'] = $not['NOT'];
		
		return $opt_conditions;
		
	}//_index__Options__Line_Query
	
	public function 
	_index__Options__Category($opt_conditions) {

		$filter_Cat = "filter_Cat";
		
// 		$opt_conditions = array();

		$category_Id_Array = $this->_get_Category_Id_Array();

		$this->set("category_Id_Array", $category_Id_Array);
		
// 		debug($category_Id_Array);	
		
		/**********************************
		 * param: filter
		**********************************/
		@$query_Filter = $this->request->query[$filter_Cat];
		
		if ($query_Filter == "-1") {
				
			$this->Session->write($filter_Cat, null);
				
			$this->set("filter_Cat", '');
				
		} else if ($query_Filter == null) {
		
			@$session_Filter = $this->Session->read($filter_Cat);
		
			if ($session_Filter != null) {
		
				$opt_conditions['History.category_id'] = $session_Filter;
		
				/**********************************
				 * set: var
				**********************************/
				$this->set("filter_Cat", $category_Id_Array[$session_Filter]);
// 				$this->set("filter_Cat", $session_Filter);
		
			} else {
		
				/**********************************
				 * set: var
				**********************************/
				$this->set("filter_Cat", null);
		
			}
		
		} else {
		
			$opt_conditions['History.category_id'] = $query_Filter;
			
			$session_Filter = $this->Session->write($filter_Cat, $query_Filter);
		
			/**********************************
			 * set: var
			**********************************/
// 			$this->set("filter_Cat", $query_Filter);
		
			$this->set("filter_Cat", $category_Id_Array[$query_Filter]);
			
		}//if ($query_Filter == "__@")
		
		/*******************************
			return
		*******************************/
		return $opt_conditions;
		
	}//_index__Options__Line()
	
	
	public function 
	_get_Category_Id_Array() {
		
		/*******************************
			load: category
		*******************************/
// 		$this->loadModel('Category');
		$this->loadModel('Genre');
		
// 		$categories = $this->Category->find('all');

		$histories = $this->History->find('all');
		
		/*******************************
			build: array
		*******************************/
		$cats = array();
		
// 		debug($histories[100]);
		
// 		$option = array('conditions' 
// 							=> array(
// 									'Genre.id' 
// 										=> $histories[100]['Category']['genre_id']));
// // 		$option = array('conditions' => array('Category.genre_id' => $histories[0]['Category']['id']));
		
// 		$genre = $this->Genre->find('first', $option);
// 		$cat = $this->Category->find('first', $option);
		
// 		debug($genre);
// 		debug($cat);
		
		
		for ($i = 0; $i < count($histories); $i++) {
// 		for ($i = 0; $i < count($categories); $i++) {
			
			$hist = $histories[$i];
// 			$cat = $categories[$i];
			
			$option = array('conditions'
					=> array(
							'Genre.id'
							=> $hist['Category']['genre_id']));
// 							=> $histories[100]['Category']['genre_id']));
			// 		$option = array('conditions' => array('Category.genre_id' => $histories[0]['Category']['id']));
			
			$genre = $this->Genre->find('first', $option);
			
// 			$cat = $this->Category->find('first', $option);
			
			if ($genre != null) {
			
				$genre_Name = "(".$genre['Genre']['name'].")";
			
			} else {
			
				$genre_Name = "(No entry)";
			
			}
			
			if ($hist['Category']['name'] != null) {
			
				$cats[$hist['Category']['id']] = $hist['Category']['name'].$genre_Name;
			
			} else {
			
				$cats[$hist['Category']['id']] = $hist['Category']['name'];
			
			}
			
// 			$cats[$hist['Category']['id']] = $hist['Category']['name'].$genre_Name;
// 			$cats[$hist['Category']['id']] = $hist['Category']['name'];
// 			$cats[$hist['Category']['name']] = $hist['Category']['id'];
			
		}
		
		asort($cats);
		
		$cats['-1'] = "ALL";
// 		$cats['ALL'] = -1;
		
		/*******************************
			return
		*******************************/
		return $cats;
		
// 		/*******************************
// 			report
// 		*******************************/
// 		debug($cats);
		
// 		asort($cats);
// // 		$cats = asort($cats);
		
// 		debug($cats);
		
	}
	
	public function 
	view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid history'));
		}
	
		$history = $this->History->findById($id);
		if (!$history) {
			throw new NotFoundException(__('Invalid history'));
		}
		
		$this->set('history', $history);
		
		/*******************************
			test: detect refresh
		*******************************/
		$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'];

		if ($pageWasRefreshed) {
		
// 			debug("view => refreshed");
		
		} else {
		
// 			debug("view => NOT refreshed");
			/*******************************
				save: updates info
			*******************************/
			$this->_view_Updates($history);
			
		}//if ($pagew)
		
		
		
// 		/*******************************
// 			save: updates info
// 		*******************************/
// 		$this->_view_Updates($history);
		
		/**********************************
		* content: modified
		**********************************/
		$content_Length = mb_strlen($this->sanitize($history['History']['content']));
		
//		debug("content_Length => ".$content_Length);
		
// 		debug("lines: length => "
// 				.count(explode("。", $this->sanitize($history['History']['content']))));
		
		/**********************************
		* dispatch
		**********************************/
		if ($content_Length > 2500) {
			
			/**********************************
			* prep: data
			**********************************/
			$words_ary = $this->_view_Mecab($history);
// 			$words = $this->_view_Mecab($history);

//			debug("count(\$words_ary) => ".count($words_ary));

			$val_1 = $this->get_Admin_Value(CONS::$admin_Colorize, "val1");
				
			
			$content_multiline = "";
			
			$num = count($words_ary);

			/**********************************
			* build: content
			**********************************/
			// plain texts
			if ($val_1 == null || !is_numeric($val_1) || intval($val_1) == 1) {

				//debug("\$val_1 == null");
				
				for ($i = 0; $i < $num; $i++) {
					
					$content_multiline .= $this->build_Text($words_ary[$i]);
					
				}
// 				$content_multiline = $this->build_Text($words);

			// color texts
			} else {
					
				//debug("else");
				
				for ($i = 0; $i < $num; $i++) {
						
					$content_multiline .= 
							$this->build_Text_Colorize_Kanji($words_ary[$i]);
						
				}
				
// 				$content_multiline = $this->build_Text_Colorize_Kanji($words);
					
			}//if ($val_1 == null || !is_numeric($val_1) || intval($val_1) == 1)
					
		} else {
			/**********************************
			 * prep: data
			**********************************/
// 			debug($history);		//=> whole content
			
			$words_ary = $this->_view_Mecab($history);
			// 			$words = $this->_view_Mecab($history);

// 			debug($words_ary);		//=> content --> shortened
			
			$val_1 = $this->get_Admin_Value(CONS::$admin_Colorize, "val1");
			
			$content_multiline = "";
				
			$num = count($words_ary);
			
			/**********************************
			 * build: content
			**********************************/
					
// 			$words = $this->_view_Mecab($history);
	
// 			$val_1 = $this->get_Admin_Value(CONS::$admin_Colorize, "val1");
			
			if ($val_1 == null || !is_numeric($val_1) || intval($val_1) == 1) {

				//debug("\$val_1 == null, etc.");
				
				for ($i = 0; $i < $num; $i++) {
						
					$content_multiline .= $this->build_Text($words_ary[$i]);
						
				}
				
// 				$content_multiline = $this->build_Text($words);
				
			} else {
				
				//debug("else!");

// 				debug($words_ary);
				
				for ($i = 0; $i < $num; $i++) {
				
					$content_multiline .=
						$this->build_Text_Colorize_Kanji($words_ary[$i]);
				
				}
				
// 				debug($content_multiline);
				
// 				$content_multiline = $this->build_Text_Colorize_Kanji($words);
					
			}//if ($val_1 == null || !is_numeric($val_1) || intval($val_1) == 1)
			
		}//if ($content_Length > 2500)

// 		debug($content_multiline);
		
		// add "<br>" to each sentence
		$content_multiline =
				$this->_content_multilines_GetHtml($content_multiline);
		
		
		
// 		debug($content_multiline);
		
		$this->set('content_html', $content_multiline);
		
	}//view($id = null)

	public function 
	_view_Updates($history) {

		/*******************************
			update: updates, updated_at
		*******************************/
		$tmp = $history['History']['updates'];
		
		$current_Time = Utils::get_CurrentTime2(CONS::$timeLabelTypes["basic"]);
		
		if ($tmp == null) {
		
			$tmp = $current_Time;
// 			$tmp = Utils::get_CurrentTime2(CONS::$timeLabelTypes["basic"]);
		
		} else {
		
			$tmp .= CONS::$his_Updates_Delimiter.$current_Time;
// 			$tmp .= CONS::$his_Updates_Delimiter.Utils::get_CurrentTime2(CONS::$timeLabelTypes["basic"]);
// 			$tmp .= " ".Utils::get_CurrentTime2(CONS::$timeLabelTypes["basic"]);
			
		}//if ($tmp == null)
		
		$history['History']['updates'] = $tmp;
		$history['History']['updated_at'] = $current_Time;
// 								Utils::get_CurrentTime2(CONS::$timeLabelTypes["basic"]);
		
		/*******************************
			save
		*******************************/
		$res = $this->History->save($history);
		
		if ($res == true) {
		
			debug("updates => saved");
		
		} else {
		
			debug("updates => NOT saved");
			
		}//if ($res == true)
		
	}//_view_Updates($history)
	
	public function 
	bufferTo_View($id = null) {

		/*******************************
			validate
		*******************************/
		if (!$id) {
			throw new NotFoundException(__("Invalid history: id = $id"));
			
			return $this->redirect(array('action' => 'index'));
			
		}
		
		$history = $this->History->findById($id);
		
		if (!$history) {
			
			throw new NotFoundException(__("History not found: id = $id"));
			
			return $this->redirect(array('action' => 'index'));
			
		}
		
		/*******************************
			save: updates info
		*******************************/
		$this->_view_Updates($history);

		/*******************************
			redir
		*******************************/
		return $this->redirect(
				
					array(
							'controller'	=> 'historys',
							'action' => 'view', $history['History']['id'])
		
		);
		
	}//bufferTo_View($id = null)
	
	
	public function 
	_build_Text_Colorize_Kanji
	($words) {

		//test
		$tmp = $words[10];

		$tmp_str = (string)$tmp->surface;
		
// 		debug(preg_split('//u', $tmp_str));
		
// 		for ($i = 0; $i < mb_strlen($tmp_str); $i++) {
// 		for ($i = 0; $i < mb_strlen((string)$tmp->surface)); $i++) {
// 		foreach (str_split as item) {
		
// 			debug($tmp_str[$i]);
			
// 		}
// 		debug(mb_strlen((string)$tmp->surface));
// 		debug((string)$tmp->surface);
// 		foreach ((string)$tmp->surface as $chr) {
		
// 			debug($chr);
		
// 		}
		
// 		debug($tmp);
		
		
		
		$content = "";
		
// 		$str = $words->surface;
		
		foreach ($words as $w) {
		
			$str = $w->surface;
			
// 			debug(mb_split('', $str));
// 			debug(preg_split('//u', mb_convert_encoding($str, "UTF-8")));
// 			debug(preg_split('//u', $str));
// 			debug(preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY));
			
			$res = Utils::get_Type($str);

// 			debug((string)$str);
// 			debug(mb_strlen((string)$str));
// 			debug(strlen((string)$str));
// 			debug((string)$str)[1];
// 			debug($res);
			
			//REF color names http://www.colordic.org/
			
			switch ($res) {
				case 1:
					
// 					$content .="<font color=\"black\">".$str."</font>";
					$content .="<font color=\"darkgreen\">".$str."</font>";
// 					$content .="<font color=\"green\">".$str."</font>";
					
					break;
				
				case 2:	// hiragana
					// blue
// 					$content .="<font color=\"#7368EF\">".$str."</font>";
// 					$content .="<font color=\"#9F9CBC\">".$str."</font>";
					$content .="<font color=\"blue\">".$str."</font>";
					
					break;
					
				case 3:	// katakana
					
					$content .="<font color=\"purple\">".$str."</font>";
// 					$content .="<font color=\"palevioletred\">".$str."</font>";
// 					$content .="<font color=\"green\">".$str."</font>";
// 					$content .="<font color=\"#B5A243\">".$str."</font>";
					
					break;
				
				case 4:	// number
					
					$content .="<font color=\"#575757\">".$str."</font>";
					
					break;
				
				case 0:
					
					$content .= $str;
					
				break;
				
				default:
					
					$content .= $str;
					
				break;
				
			}
		
// 			$res = Utils::isKanji_All($w->surface);
			
// 			if ($res == true) {
				
// 				$content .="<font color=\"green\">".$w->surface."</font>";
				
// 			} else {
				
// 				$content .=$w->surface;
				
// 			}
		
		}//foreach ($words as $w)
		
		return $content;
		
		
	}//_build_Text_Colorize_Kanji
	
	public function 
	_build_Text
	($words) {

		//test
		$tmp = $words[10];

		$tmp_str = (string)$tmp->surface;
		
		$content = "";
		
		foreach ($words as $w) {
		
			$str = $w->surface;
			
			$content .= $str;
			
		}//foreach ($words as $w)
		
		return $content;
		
	}//_build_Text

	/**********************************
	* @return
	* 
	* 	=> array(words)
	* 
	**********************************/
	public function 
	_view_Mecab($history) {
		
		/**********************************
		* prep: sentences
		**********************************/
// 		$sen = $this->sanitize($history['History']['content']);
		$sen = $history['History']['content'];
		
// 		debug("sen");
// 		debug($sen);		//=> not shortened
		
		/**********************************
		* experi
		**********************************/
		$max = 800;
// 		$max = 1500;	//=> error
// 		$max = 2000;	//=> error
		
		if (mb_strlen($sen) > $max) {

			//debug("mb_strlen(\$sen) > \$max");
			
			$words_ary = $this->_view_Mecab__MultiLots($sen, $max);
// 			$words = $this->_view_Mecab__MultiLots($sen, $max);

// 			debug($words_ary);	//=> shortened
			
		} else {
		
			//debug("else");
			
			$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$sen";
	
			//REF http://stackoverflow.com/questions/12542469/how-to-read-xml-file-from-url-using-php answered Sep 22 '12 at 9:17
			$xml = simplexml_load_file($url);
	
			$words_ary = array($xml->word);
// 			$words = $xml->word;
			
		}		
		
		
		
		return $words_ary;
		
	}//_view_Mecab

	public function 
	_view_Mecab__MultiLots($sen, $max) {

// 		debug("mb_strlen(\$sen) > $max");
			
// 		debug("needs => ".intval(ceil(mb_strlen($sen) / $max))." lots");

		
		/**********************************
		* split: original sentence
		**********************************/
		$sen_Array = mb_split("。", $sen);
		
// 		debug("sen_Array");
// 		debug($sen_Array);		//=> not short
		
// 		debug("sen_Array => ".count($sen_Array));
		
		$numOf_SentenceArray = count($sen_Array);
		
		/**********************************
		* prep: sentences derived from the original
		**********************************/
		$numOf_Lots = intval(ceil(mb_strlen($sen) / $max));
		
// 		debug("numOf_Lots => $numOf_Lots");
		
		$numOf_Senteces_perLot = intval(ceil($numOf_SentenceArray / $numOf_Lots));
		
// 		debug("numOf_Senteces_perLot => $numOf_Senteces_perLot");

		/**********************************
		* split: original sentence => again
		**********************************/
		$split_Char = "。";
		
		$ary_SlicedArrays = Utils::breakdown_Sentence($sen, $numOf_Lots, $split_Char);
		
// 		debug("\$ary_SlicedArrays");
// 		debug($ary_SlicedArrays);		//=> not short
		
		$numOf_SlicedArrays = count($ary_SlicedArrays);
		
// 		debug("ary_SlicedArrays => ".$numOf_SlicedArrays);
// 		debug("ary_SlicedArrays => ".count($ary_SlicedArrays));
		
		// get xmls
		$xmls = array($numOf_SlicedArrays);
		
		for ($i = 0; $i < $numOf_SlicedArrays; $i++) {
			
			$text = implode($split_Char, $ary_SlicedArrays[$i]);
			
// 			debug($text);
			
// 			debug($text);
			
// 			$tmp = Utils::decode_HTML($text, array("&lt;" => "", "&gt;" => ""));

			$replace_set = array(
// 								"&lt;" => "<", 
// 								"&gt;" => ">"
								"&lt;" => "(", 
								"&gt;" => ")"
			);
			
			$text = Utils::decode_HTML($text, $replace_set);
// 			$text = Utils::decode_HTML($text, array("&lt;" => "", "&gt;" => ""));
			
// 			debug($tmp);
// 			debug($text);
			
// 			$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=".urlencode($text);
			$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$text";
			
			$xmls[$i] = simplexml_load_file($url);
			
		}

		/**********************************
		* shorten sentence
		**********************************/
		$sen = mb_substr($sen, 0, $max);

// 		debug("\$sen");
// 		debug($sen);		//=> not short
		
		$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$sen";
		
		//REF http://stackoverflow.com/questions/12542469/how-to-read-xml-file-from-url-using-php answered Sep 22 '12 at 9:17
		$xml = simplexml_load_file($url);
		
		if ($xmls == null) {

			return array($xml->word);
			
		} else {

// 			debug("else");

// 			debug($xmls);
			
			$num = count($xmls);
			
			$words_ary = array();
// 			$words_ary = array($num);
			
			for ($i = 0; $i < $num; $i++) {
				
				array_push($words_ary, $xmls[$i]);
				
			}
			
			return $words_ary;
			
		}
		
	}//_view_Mecab__MultiLots($sen)
	
	public function 
	_view_Mecab_MultiWords($history) {
		
		/**********************************
		* prep: sentences
		**********************************/
		$sen = $this->sanitize($history['History']['content']);

		$lines = explode("。", $sen);
		
		$lines_1 = array_slice($lines, 0, count($lines) / 2);
		
		$lines_2 = array_slice($lines, count($lines) / 2);
		
		$sen_1 = implode("。", $lines_1);
		$sen_2 = implode("。", $lines_2);
		
// 		debug("sen length => ".mb_strlen($sen));
		
		$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$sen_1";

		//REF http://stackoverflow.com/questions/12542469/how-to-read-xml-file-from-url-using-php answered Sep 22 '12 at 9:17
		$xml_1 = simplexml_load_file($url);

		$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$sen_2";

		//REF http://stackoverflow.com/questions/12542469/how-to-read-xml-file-from-url-using-php answered Sep 22 '12 at 9:17
		$xml_2 = simplexml_load_file($url);

		$words_1 = $xml_1->word;
		$words_2 = $xml_2->word;
		
		return array($words_1, $words_2);
		
	}//_view_Mecab_MultiWords
	
	public function 
	add() {
		if ($this->request->is('post')) {
			$this->History->create();
			
			$this->request->data['History']['created_at'] = Utils::get_CurrentTime();
			$this->request->data['History']['updated_at'] = Utils::get_CurrentTime();
			
			if ($this->History->save($this->request->data)) {
				$this->Session->setFlash(__('Your historys has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('Unable to add your historys.'));
			
		} else {
			
			$select_Genres = Utils::_get_Selector_Genre();
// 			$select_Genres = $this->_get_Selector_Genre();
			
// 			debug($select_Genres);
			
// 			debug(array_keys($select_Genres));
			
			$this->set('select_Genres', $select_Genres);
			
			if (count($select_Genres) > 1) {
				
				$keys = array_keys($select_Genres);
				
// 				$tmp = $keys[1];
				
				$genre_id = $keys[1];
// 				$genre_id = 0;
// 				$genre_id = array_keys($select_Genres)[1];	// error in remote --> Parse error: syntax error, unexpected '[' 
				
			} else {
				
				$genre_id = 0;
				
			}
			
			
			$select_Categories = 
					Utils::_get_Selector_Category_From_GenreID($genre_id);
			
			$this->set('select_Categories', $select_Categories);
			
			$this->set('genre_id', $genre_id);
			
		}//if ($this->request->is('post'))
			
	}//add

	public function delete($id) {
		/******************************
	
		validate
	
		******************************/
		if (!$id) {
			throw new NotFoundException(__('Invalid history id'));
		}
	
		$history = $this->History->findById($id);
	
		if (!$history) {
			throw new NotFoundException(__("Can't find the history. id = %d", $id));
		}
	
		/******************************
	
		delete
	
		******************************/
		if ($this->History->delete($id)) {
			// 		if ($this->Genre->save($this->request->data)) {
	
			$this->Session->setFlash(__(
					"History deleted => %s",
					$history['History']['line']));
	
			return $this->redirect(
					array(
							'controller' => 'historys',
							'action' => 'index'
	
					));
	
		} else {
	
			$this->Session->setFlash(
					__("History can't be deleted => %s",
							$history['History']['line']));
	
			// 			$page_num = _get_Page_from_Id($id - 1);
	
			return $this->redirect(
					array(
							'controller' => 'historys',
							'action' => 'view',
							$id
					));
	
		}
	
	}//public function delete($id)

	public function
	sanitize
	($str, $tag="font") {
	
		$tag = "font";
		$p = "/<$tag.+?>(.+)<\/$tag>/";
	
		$rep = '${1}';
	
		return preg_replace($p, $rep, $str);
	
	}

	public function
	save_Tokens
	($id = null) {

		if (!$id) {
			throw new NotFoundException(__('Invalid history id'));
		}

		/**********************************
		* create: tokens
		**********************************/
		$history = $this->History->findById($id);
		
			if (!$history) {
				
				throw new NotFoundException(__('Invalid history'));
				
		}

		/**********************************
		* validate:
		**********************************/
		$res = $this->_save_Tokens__TokensExist($history);
		
// 		debug("tokens exist => ".$res);
		
		if ($res == true) {
			
			$msg_Flash = "Tokens exist for this history: id = "
						.$history['History']['id'];

			$this->Session->setFlash(__($msg_Flash));
			
// 			debug("message => set");
			
		} else {
		
			/**********************************
			* words array
			**********************************/
			$words_ary = Utils::get_Words($history['History']['content']);
			
// 			debug("\$words_ary length...");
// 			debug(count($words_ary));
	
			/**********************************
			* save tokens
			**********************************/
			$msg_Flash = $this->save_Tokens__V2($words_ary, $history);
		
		}

// 		$this->Session->setFlash(__($msg_Flash));
		
	}//save_Tokens
	
	/*******************************
		@return
		1. Flash message string
	*******************************/
	public function
	save_Tokens__V2
	($words_ary, $history) {

		/**********************************
		* vars
		**********************************/
		$msg_Flash = "";
		
		$tokens = array();
		
		/**********************************
		* processing
		**********************************/
		for ($i = 0; $i < count($words_ary); $i++) {
			
			/**********************************
			* get: words list
			**********************************/
			$words = $words_ary[$i];
			
// 			$words= $this->get_Mecab_WordList($history['History']['content']);
	
			/**********************************
			* conv: words to tokens
			**********************************/
			$tokens = $this->conv_MecabWords_to_Tokens__V2($words, $tokens);
// 			$tokens = $this->conv_MecabWords_to_Tokens($words);
	
			/**********************************
			* save: tokens
			**********************************/
			$res = $this->save_token_list($tokens, $history);
// 			$res = $this->save_token_list($tokens, $history['History']['id']);
	
			if ($words != null) {
				
				$msg_Flash .= "save_Tokens => done. Words => ".count($words)
							."/"
							."save token => ".$res
							." /// "
							;
				
			} else {
				
				$msg_Flash .= "save_Tokens => done. Words => null /// ";
				
// 				$this->Session->setFlash(__("save_Tokens => done. Words => null"));
				
			}
		
		}//for ($i = 0; $i < count($words_ary); $i++)

		/**********************************
		* flash
		**********************************/
		$msg_Flash .= "(history.id = ".$history['History']['id'].")";
		
		$this->Session->setFlash(__($msg_Flash));

		/**********************************
		* set: vars
		**********************************/
		$this->set('tokens', $tokens);
		
		/*******************************
			return
		*******************************/
		return $msg_Flash;
// 		return $history['History']['id'];
		
	}//save_Tokens
	
	public function
	_save_Tokens__TokensExist($history) {

		$this->loadModel('Token');
		
		$options = array(
						'conditions' => 
								array("Token.history_id" => $history['History']['id'])
						);
		
		$tokens = $this->Token->find('all', $options);
		
// 		debug("\$tokens ...");
// 		debug(count($tokens));
		
		/**********************************
		* return
		**********************************/
		if ($tokens == null) {
			
			return false;
			
		} else if (count($tokens) > 0) {
			
			return true;
			
		} else {
			
			return true;
			
		}
		
	}//_save_Tokens__TokensExist
	
	public function
	save_token_list
	($tokens, $history) {
// 	($tokens, $history_id) {
		
		$history_id = $history['History']['id'];
		
		$category_id = $history['Category']['id'];
		
		$genre_id = $history['Category']['genre_id'];
		
		$counter = 0;
		
		$this->loadModel('Token');
	
		foreach ($tokens as $token) {
	
			$this->Token->create();

// 			$cat_id = $this->_save_Data_Keywords_from_CSV__Get_CatID_From_OrigID(
// 								$kw_pair[3], $categories);
			
// 			// valiate
// 			if ($cat_id == false) {
				
// 				continue;
				
// 			}
			
			// build param
			$param = array('Token' =>
						
					array(
							
							'created_at'	=> Utils::get_CurrentTime(),
							'updated_at'	=> Utils::get_CurrentTime(),
							
							'form'			=> $token->form,
							
							'hin'			=> $token->hin,
							'hin_1'			=> $token->hin_1,
							'hin_2'			=> $token->hin_2,
							'hin_3'			=> $token->hin_3,
							
							'katsu_kei'		=> $token->katsu_kei,
							'katsu_kata'	=> $token->katsu_kata,
							'genkei'		=> $token->genkei,
							'yomi'			=> $token->yomi,
							'hatsu'			=> $token->hatsu,
							
							'history_id'	=> $history_id,
							
							'category_id'	=> $category_id,
							'genre_id'		=> $genre_id,
							
					)
						
			);
			
			if ($this->Token->save($param)) {
	
				$counter += 1;
	
			}

// 			//test
// 			if ($counter > 20) {
				
// 				break;
				
// 			}
			
		}//foreach ($cat_pairs as $cat_pair)

		return $counter;
		
	}//save_token_list
	
	public function
	conv_MecabWords_to_Tokens
	($words) {
		
		$token_list = array();
		
		$counter = 0;
		
		foreach ($words as $w) {
		
			$token = new Token();

			/**********************************
			* form
			**********************************/
			$token->form = $w->surface;
// 			$token->form = $w->surface;

			/**********************************
			* features
			**********************************/
// 			$token->hin = $w->feature;
			
			$tmp = explode(',', (string)$w->feature);
// 			$tmp = explode(',', $w->feature);

// 			if ($counter < 20) {

// 				debug((string)$w->surface);
// 				debug((string)$w->feature);
// // 				debug($w->surface);

// // 				break;
// 			}
					
			
			
// 			//log
// 			$msg = "count(\$tmp) => " + count($tmp);
// 			Utils::write_Log($this->path_Log, $msg, __FILE__, __LINE__);
			
// 			debug($tmp);

// 			if ($counter < 20) {
			
// 				debug($tmp);
// 				// 				debug($w->surface);
			
// 				// 				break;
// 			}
				
			if ($tmp == null || count($tmp) == 7 ) {
// 			if ($tmp == null || count($tmp) < 9) {
				
				$token->hin		= $tmp[0];
				
				$token->hin_1	= $tmp[1];
				$token->hin_2	= $tmp[2];
				$token->hin_3	= $tmp[3];
				
				$token->katsu_kei	= $tmp[4];
				$token->katsu_kata	= $tmp[5];
				$token->genkei	= $tmp[6];
				$token->yomi	= "*";
				
				$token->hatsu	= "*";
				
// 				debug($w->feature);
				
// 				continue;
				
			} else if (count($tmp) == 9) {
				
				$token->hin		= $tmp[0];
				
				$token->hin_1	= $tmp[1];
				$token->hin_2	= $tmp[2];
				$token->hin_3	= $tmp[3];
				
				$token->katsu_kei	= $tmp[4];
				$token->katsu_kata	= $tmp[5];
				$token->genkei	= $tmp[6];
				$token->yomi	= $tmp[7];
				
				$token->hatsu	= $tmp[8];
				
			} else {
				
				continue;
				
			}
			
			/**********************************
			* hin
			**********************************/
			
			
			
			array_push($token_list, $token);
		
			//test
			$counter += 1;
			
// 			if ($counter < 10) {
				
// 				debug($token);
				
// // 				break;
// 			}
			
		}//foreach ($words as $w)
		
		return $token_list;
		
	}//conv_MecabWords_to_Tokens
	
	public function
	conv_MecabWords_to_Tokens__V2
	($words, $token_list) {
		
// 		$token_list = array();
		
		$counter = 0;
		
		foreach ($words as $w) {
		
			$token = new Token();

			/**********************************
			* form
			**********************************/
			$token->form = $w->surface;
// 			$token->form = $w->surface;

			/**********************************
			* features
			**********************************/
// 			$token->hin = $w->feature;
			
			$tmp = explode(',', (string)$w->feature);
// 			$tmp = explode(',', $w->feature);

// 			if ($counter < 20) {

// 				debug((string)$w->surface);
// 				debug((string)$w->feature);
// // 				debug($w->surface);

// // 				break;
// 			}
					
			
			
// 			//log
// 			$msg = "count(\$tmp) => " + count($tmp);
// 			Utils::write_Log($this->path_Log, $msg, __FILE__, __LINE__);
			
// 			debug($tmp);

// 			if ($counter < 20) {
			
// 				debug($tmp);
// 				// 				debug($w->surface);
			
// 				// 				break;
// 			}
				
			if ($tmp == null || count($tmp) == 7 ) {
// 			if ($tmp == null || count($tmp) < 9) {
				
				$token->hin		= $tmp[0];
				
				$token->hin_1	= $tmp[1];
				$token->hin_2	= $tmp[2];
				$token->hin_3	= $tmp[3];
				
				$token->katsu_kei	= $tmp[4];
				$token->katsu_kata	= $tmp[5];
				$token->genkei	= $tmp[6];
				$token->yomi	= "*";
				
				$token->hatsu	= "*";
				
// 				debug($w->feature);
				
// 				continue;
				
			} else if (count($tmp) == 9) {
				
				$token->hin		= $tmp[0];
				
				$token->hin_1	= $tmp[1];
				$token->hin_2	= $tmp[2];
				$token->hin_3	= $tmp[3];
				
				$token->katsu_kei	= $tmp[4];
				$token->katsu_kata	= $tmp[5];
				$token->genkei	= $tmp[6];
				$token->yomi	= $tmp[7];
				
				$token->hatsu	= $tmp[8];
				
			} else {
				
				continue;
				
			}
			
			/**********************************
			* hin
			**********************************/
			
			
			
			array_push($token_list, $token);
		
			//test
			$counter += 1;
			
// 			if ($counter < 10) {
				
// 				debug($token);
				
// // 				break;
// 			}
			
		}//foreach ($words as $w)
		
		return $token_list;
		
	}//conv_MecabWords_to_Tokens
	
	public function
	get_Mecab_WordList
	($text) {
		
		$sen = $this->sanitize($text);
		
		$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$sen";
		
		//REF http://stackoverflow.com/questions/12542469/how-to-read-xml-file-from-url-using-php answered Sep 22 '12 at 9:17
		$xml = simplexml_load_file($url);
		
		return $xml->word;
		
	}//get_MecabList	

	public function
	content_multilines
	($id = null) {
		
// 		$q = $this->request->query;
		
// 		debug($q);
		
		$this->layout = 'plain_1';

		/**********************************
		* get: id
		**********************************/
		$id_get = @$this->request->query['id'];
		
// 		debug($id_get);
		
// 		$this->Session->setFlash(__('Your historys has been saved.'));
		
		
		if ($id_get == null) {
			
			$msg = "null";
			
			$this->set("msg", $msg);
			
			$this->render("error");
			
// 			$this->set("history_id", $id);
			
// 			$this->Session->setFlash(__("id is ".$id));
// 			$this->Session->setFlash(__('id is null'));
			
// 			$this->render("Layouts/plain_1");
// 			$this->render("plain_1");
// 			$this->render("AAA", "plain_1");
			
		} else {
			
			$this->set("history_id", $id_get);
			
			$history = $this->History->findById($id_get); 
			
			if ($history == null) {
				
				$msg = "unknown id => ".$id_get;
				
				$this->set("msg", $msg);
				
				$this->render("error");
				
				return;
				
			}
			
// 			debug($history);
			$content_html = $this->_content_multilines_GetHtml(
								$history['History']['content']);
			
			$this->set("content_html", $content_html);
// 			$this->set("content", $history['History']['content']);
// 			$this->Session->setFlash(__("id is ".$id));
// 			$this->render("plain_1");
// 			$this->render("no id", "plain_1");
			
		}
		
	}//content_multilines
	
	/**********************************
	* divide text with "。"
	**********************************/
	public function
	_content_multilines_GetHtml
	($content) {
		
		$lines = explode("。", $content);
		
		$lines_new = array();
		
		foreach ($lines as $line) {
		
			$tmp = $line."。"."<br>";
			
			$space = "";
			
			for ($i = 0; $i < 10; $i++) {
				$space .="&nbsp;";
			}
			
			$tmp = str_replace(
						"、",
// 						"、<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", 
						"、<br>".$space, 
						$tmp);
			
			array_push($lines_new, $tmp);
		
		}
		
		return implode("", $lines_new);
		
	}//_content_multilines_GetHtml
	
	public function
	test_1() {
		
		$params = array('fields'	=> array('History.id', 'History.created_at'));
		
		
		$histories = $this->History->find('all', $params);

		//debug($histories[0]);
		
		debug(count($histories));
		
	}

	public function
	create_Tokens() {
	
		/*******************************
		 query
		*******************************/
		$query_CatId = "cat_id";
	
		@$cat_Id = $this->request->query[$query_CatId];
	
		if ($cat_Id == null) {
	
			$this->Session->setFlash(__('no category id'));
	
			$this->render("/Historys/tests/create_Tokens");
				
			return;
	
		} else {
				
			debug("category id => ".$cat_Id);
				
		}
	
		/*******************************
		 get: history list
		*******************************/
		$option = array('conditions'
							=> array(
									'History.category_id'
										=> $cat_Id));
		
		$histories = $this->History->find('all', $option);
		
// 		debug("count(\$histories)");
// 		debug(count($histories));

		/*******************************
			validate: any history
		*******************************/
		if (count($histories) < 1) {
		
			$this->Session->setFlash(__('no history for category id: '.$cat_Id));
		
			$this->render("/Historys/tests/create_Tokens");
		
			return;
		
		} else {
		
			debug("count(\$histories)");
			debug(count($histories));
						
		}
		
		/*******************************
			tokenize
		*******************************/
		$len = count($histories);
		
		$count = 0;
		
		for ($i = 0; $i < $len; $i++) {
			
			$h = $histories[$i];
			
			$res = $this->_save_Tokens__TokensExist($h); 
			
			/*******************************
				validate: tokens exist
			*******************************/
			if ($res == true) {
				
				continue;
				
			}
			
			$count ++;

			/**********************************
			 * words array
			**********************************/
			$words_ary = Utils::get_Words($h['History']['content']);
				
			// 			debug("\$words_ary length...");
			// 			debug(count($words_ary));
			
			/**********************************
			 * save tokens
			**********************************/
			$msg_Flash = $this->save_Tokens__V2($words_ary, $h);
			
			debug($msg_Flash);
			
		}
		
// 		debug("tokenizing => $count histories");
		
		/**********************************
		 * view
		**********************************/
		$this->render("/Historys/tests/create_Tokens");
	
	}//create_Tokens
	
}