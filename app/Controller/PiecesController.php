<!-- 

http://yapi.ta2o.net/apis/mecapi.cgi?sentence=

 -->
<?php

/*
 http://localhost/Eclipse_Luna/Cake_NR5/pieces/create_Tokens
 
 */

class PiecesController extends AppController {
	public $helpers = array('Html', 'Form');

	public $components = array('Paginator');
// 	public $components = array(
// 			'Paginator' => array(
// 					'limit' => 10,
// 					'maxLimit' => 10,
// 					'order' => array('Pieces.id' => 'desc')
// // 					'order' => array('Hoge.modified' => 'desc')
// 			)
// 	);
	
	
	public function 
	index() {

		/*******************************
			option : sort
		*******************************/
		$sort_key = "sort";
		
		$sort_direction_key = "sort-direction";
		
		@$query_Sort = $this->request->query[$sort_key];
		
		@$query_SortDirection = $this->request->query[$sort_direction_key];

		$sort_type = isset($query_Sort) ? $query_Sort : "id";
		$sort_direction_type = isset($query_SortDirection) ? $query_SortDirection : "asc";
		
		debug($sort_type." / ".$sort_direction_type);
		
		/*******************************
			pagination
		*******************************/
		#ref C:\WORKS_2\WS\Eclipse_Luna\Cake_NR5\app\Controller\TokensController.php
		$paginate_array = array(
				//REF http://stackoverflow.com/questions/861960/how-can-i-limit-the-find-to-a-specific-number-in-cakephp answered May 14 '10 at 0:08
		// 					'limit' => "13314,10",
		// 					'recursive'	=> -1,
				'limit' => 10,
				#ref $opt_order["Token.$session_Sort"] = "asc";
				'order' => array("Pieces.$sort_type" => $sort_direction_type),
// 				'order' => array("Pieces.id" => "asc"),
// 				'conditions'	=> $opt_conditions,
					
		);
		
// 		debug($paginate_array);
		
// 		$this->paginate = $paginate_array;
// 		$this->paginate = array(
// 				//REF http://stackoverflow.com/questions/861960/how-can-i-limit-the-find-to-a-specific-number-in-cakephp answered May 14 '10 at 0:08
// 		// 					'limit' => "13314,10",
// 		// 					'recursive'	=> -1,
// 				'limit' => 10,
// 				#ref $opt_order["Token.$session_Sort"] = "asc";
// 				'order' => array("Pieces.$sort_type" => $sort_direction_type),
// // 				'order' => array("Pieces.id" => "asc"),
// // 				'conditions'	=> $opt_conditions,
					
// 		);
		
		#ref https://book.cakephp.org/2.0/ja/core-libraries/components/pagination.html
		#ref public $this->Paginator->settings = array(
// 		public $this->Paginator->settings = array(
		$pagination_settings = array(
// 				'limit' => 3,
				'limit' => 10,
				'maxLimit' => 10,
				
// 				'conditions'	=> array(
						
// 						"Piece.type"	=> 'Hiragana'
// 				),
				
				'order' => array(
// 							"Piece.hin" => 'asc',
							"Piece.hin" => 'desc',
							"Piece.hin_1" => 'desc',
							"Piece.type" => 'desc',
// 							"Piece.type" => 'asc',
// 							"Piece.$sort_type" => 'desc',
				),
				
// 				'order' => array("Piece.$sort_type" => 'desc')
// 				'order' => array('Piece.hin' => 'desc')
// 				'order' => array('Piece.form' => 'desc')
// 				'order' => array('Piece.id' => 'desc')
// 				'order' => array('Hoge.modified' => 'desc')
		);
		
		debug($pagination_settings);
		
		$this->Paginator->settings = $pagination_settings;
// 		$this->Paginator->settings = array(
// 				'limit' => 10,
// 				'maxLimit' => 10,
// 				'order' => array(
// 							"Piece.hin" => 'desc',
// 							"Piece.hin_1" => 'desc',
// // 							"Piece.$sort_type" => 'desc',
// 				)
// // 				'order' => array("Piece.$sort_type" => 'desc')
// // 				'order' => array('Piece.hin' => 'desc')
// // 				'order' => array('Piece.form' => 'desc')
// // 				'order' => array('Piece.id' => 'desc')
// // 				'order' => array('Hoge.modified' => 'desc')
// 		);
		
		$pieces_Paginated = $this->Paginator->paginate('Piece');
// 		$pieces_Paginated = $this->paginate('Piece');
// 		$tokens = $this->paginate('Token');
		
		
		$pieces = $this->Piece->find('all');
		
		debug("count(\$pieces) => '".count($pieces)."'");
		
		$this->set("pieces_Paginated", $pieces_Paginated);
		
		#test
// 		$url =  (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// 		$param_new = "abc";
		
// 		$sort_type = isset($query_Sort) ? $query_Sort : "id";
// 		$sort_direction_type = isset($query_SortDirection) ? $query_SortDirection : "asc";
		
		$url_new = Utils_2::update_URL__Param_Sort($sort_type, $sort_direction_type);
// 		$url_new = Utils_2::update_URL__Param_Sort($param_new);
		
		debug("\$url_new => ".$url_new);
		
		#test
		$this->set("url_new", $url_new);
		
// 		debug($_SERVER['HTTP_HOST']);	#=> 'localhost'
// 		debug($_SERVER['REQUEST_URI']);	#=> '/Eclipse_Luna/Cake_NR5/Pieces?sort=id'
		
// 		debug("\$_SERVER['QUERY_STRING'] =>");
// 		debug($_SERVER['QUERY_STRING']);
		
// 		debug(str_replace($_SERVER['QUERY_STRING'], "", $_SERVER['REQUEST_URI']));
		
// 		debug("\$_GET => ");
// 		debug($_GET);
		
	}//index

	public function 
	index_2() {

		/*******************************
			option : sort
		*******************************/
		$sort_key = "sort";
		
		$sort_direction_key = "sort-direction";
		
		@$query_Sort = $this->request->query[$sort_key];
		
		@$query_SortDirection = $this->request->query[$sort_direction_key];

		$sort_type = isset($query_Sort) ? $query_Sort : "id";
		$sort_direction_type = isset($query_SortDirection) ? $query_SortDirection : "asc";
		
		debug($sort_type." / ".$sort_direction_type);
		
		/*******************************
			sort column : item list
		*******************************/
		#ref column names https://stackoverflow.com/questions/5840150/how-to-get-the-field-names-of-the-table-in-cakephp 'answered Apr 30 '11 at 9:27'
// 		debug(array_keys($this->Piece->getColumnTypes()));
		
		$listOf_ColumnNames = array_keys($this->Piece->getColumnTypes());
		
		$this->set("listOf_ColumnNames", $listOf_ColumnNames);
		
// 		debug($this->Piece->schema());	//=> works.
		
		/*******************************
			group by : hin names
		*******************************/
		$this->set("listOf_Hin_Nams", CONS::$listOf_Hin_Nams);
		
		$this->set("numOf_Pieces_All", count($this->Piece->find('all')));
		
// 		$result = Utils_2::get_Hin_Names();
		
	}//index

	public function
	create_Tokens() {
	
// 		#debug
// 		return;
	
		
		$this->loadModel('Geschichte');
		
		$geschichtes = $this->Geschichte->find('all');
		
		debug("count(\$geschichtes) => ".count($geschichtes));
		
		$lenOf_Geschichtes = count($geschichtes);
		
		$max_word_num = 800;
		
// 		$tickOf_Geschichtes = 50;
// 		$tickOf_Geschichtes = 15;
// 		$tickOf_Geschichtes = 10;
		$tickOf_Geschichtes = 5;
// 		$tickOf_Geschichtes = 1;
		
		$index_Start = 31;
		
		for ($i = $index_Start; $i < $index_Start + $tickOf_Geschichtes; $i++) {
// 		for ($i = 31; $i < 40; $i++) {
// 		for ($i = 31; $i < $lenOf_Geschichtes; $i++) {
		
			$text = $geschichtes[$i]['Geschichte']['content'];
			
			/*******************************
				processes
			*******************************/
			$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$text";
			
			$xml = simplexml_load_file($url);

			$result = Utils_2::conv_Xml_2_AryOf_Pieces_2($xml, $geschichtes[$i]);
	
			debug(sprintf("Geschichte %d : Total words %d / Saved %d", 
						$geschichtes[$i]['Geschichte']['id'], count($xml->word), $result));
// 						$geschichtes[$i]['id'], count($xml->word), $result));
			
// 			#test
// 			#ref http://pentan.info/php/30timeout.html
// 			echo str_pad('Y',10);
// 			flush();
			
// 			debug("\$i = $i : $text");
// 			debug(" (".mb_strlen($text).")");
			
// 			# validate
// 			if (mb_strlen($text) > $max_word_num) {
				
// 				debug("words more than $max_word_num");

// 				$text = $geschichtes[$i]['Geschichte']['content'];
					
// 				debug("\$i = $i : $text");
// 				debug(" (".mb_strlen($text).")");
	
// 				$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$text";
				
// 				$xml = simplexml_load_file($url);
				
// 				Utils_2::conv_Xml_2_AryOf_Pieces_2($xml, $geschichtes[$i]);
				
// // 				debug($xml);
				
// 				continue;
				
// 			}
			
// 			# tokeninze
// 			$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$text";
			
// 			$xml = simplexml_load_file($url);
			
// 			Utils_2::conv_Xml_2_AryOf_Pieces_2($xml, $geschichtes[$i]);
			
		}//for ($i = 0; $i < $lenOf_Geschichtes; $i++)
		
		
		$text = "　【ロサンゼルス＝共同】シャープは９日、北米での液晶テレビ販売を巡り５年間の商標使用許可を与えた中国の電機大手、海信集団（ハイセンス）に対し、低品質の製品を販売して評判をおとしめたなどとして商標の使用差し止めと少なくとも１億ドル（約110億円）の損害賠償を求める訴訟を米カリフォルニア州の裁判所に起こした。　シャープ側の訴えによると、海信は契約に反して品質と値段を下げた製品をシャープブランドで販売するなどした、という。　シャープは2017年４月に手紙で契約打ち切りを通告したが、海信はその後もシャープ名で販売を続けているとしている。";
		
		#ref C:\WORKS_2\WS\Eclipse_Luna\Cake_NR5\app\Lib\utils\utils.php
		$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$text";
		
// 		debug($text);
		
// 		$xml = simplexml_load_file($url);
		
// // 		debug($xml);
// 		debug($xml->word);
// 			// 		object(SimpleXMLElement) {
// 			// 			surface => '　'
// 			// 					feature => '記号,空白,*,*,*,*,　,　,　'
// 			// 		}
// 		debug($xml->word[1]);
// 			// 		object(SimpleXMLElement) {
// 			// 			surface => '【'
// 			// 					feature => '記号,括弧開,*,*,*,*,【,【,【'
// 			// 		}
		
// 		debug("count(\$xml->word) => '".count($xml->word)."'");

// 		debug($xml->word[2]);
// 			// 		object(SimpleXMLElement) {
// 			// 			surface => 'ロサンゼルス'
// 			// 					feature => '名詞,固有名詞,地域,一般,*,*,ロサンゼルス,ロサンゼルス,ロサンゼルス'
// 			// 		}
		
// 		debug($xml->word[4]);
		
		
		
// 		Utils_2::test_Utils_2_Copied();	//=> works.

// 		Utils_2::conv_Xml_2_AryOf_Pieces($xml);
			
	}//create_Tokens
	
	public function
	_edit_Database__Get_TypeNames() {

// 		* 	1	=> Kanji<br>
// 		* 	2	=> Hiragana<br>
// 		* 	3	=> Katakana<br>
// 		* 	4	=> Number<br>
		$dict = CONS::$dict;
// 		$dict = [
			
// 				1	=> "Kanji",
// 				2	=> "Hiragana",
// 				3	=> "Katakana",
// 				4	=> "Number",
// 				0	=> "Other",
// 		];
		
		debug($dict);
		
		$pieces = $this->Piece->find('all');
		
		debug("count(\$pieces) => ".count($pieces));	//=> 'count($pieces) => 2396'
		
		$count = 0;
		$count_max = 100;
		
		$count_done = 0;
		$count_NOT_done = 0;
		
		foreach ($pieces as $piece) {
		
			debug($piece['Piece']['form']);
			// 			debug($piece);
				
			# judge : type
			$result = Utils::get_Type($piece['Piece']['form']);
				
			debug("\$result => ".$result." (".$dict[$result].")");
			
			// update column 'type'
			if ($piece['Piece']['type'] == null
					|| $piece['Piece']['type'] == "") {
						
				debug("column 'type' is null or blank");
				
				$piece['Piece']['type'] = $dict[$result];
						
				if ($this->Piece->save($piece)) {
					
					debug("update => done");
					
					$count_done += 1;
					
				} else {
					
					debug("update => NOT done");
					
					$count_NOT_done += 1;
					
				}
				
			}
			
// 			if ($piece['Piece']['type'] == null) {
			
// 				debug("column 'type' is null");
				
// 			} //if ($piece['Piece']['type'] == null)
// 			else if ($piece['Piece']['type'] == "") {
			
// 				debug("column 'type' is blank");
				
// 			}//if ($piece['Piece']['type'] == null)
// 			;
				
			$count += 1;
				
// 			if ($count > $count_max) {
					
// 				debug("count max");
					
// 				break;
		
// 			}//if ($count > $count_max)
// 			;
				
		}//foreach ($pieces as $piece)
		
		/*******************************
			report
		*******************************/
		debug("total = $count / update done = $count_done / NOT done = $count_NOT_done");
		
	}//edit_Database__Get_TypeNames()
	
	public function
	edit_Database() {

		/*******************************
			insert : type names
		*******************************/
		$this->_edit_Database__Get_TypeNames();
		
// 		$pieces = $this->Piece->find('all');
		
// 		debug("count(\$pieces) => ".count($pieces));	//=> 'count($pieces) => 2396'
		
// 		$count = 0;
// 		$count_max = 100;
		
// 		foreach ($pieces as $piece) {

// 			debug($piece['Piece']['form']);
// // 			debug($piece);
			
// 			# judge : type
// 			$result = Utils::get_Type($piece['Piece']['form']);
			
// 			debug("\$result => ".$result);
			
// 			$count += 1;
			
// 			if ($count > $count_max) {
			
// 				debug("count max");
			
// 				break;
				
// 			}//if ($count > $count_max)
// 			;
			
// 		}//foreach ($pieces as $piece)
		
		
		
	}//edit_Database()
	
	public function
	_filter_List_By_Type__Hiragana() {
		
		$conditions = array(
				
				'conditions'	=>
					array("Piece.type"	=> "Hiragana")
// 					array("Piece.type"	=> "hiragana")
		);
		
		$pieces = $this->Piece->find('all', $conditions);
		
		return $pieces;
		
	}
	
	public function
	_filter_List_By_Type($type_Tokens) {

		$aryOf_ORs = array();
		
		foreach ($type_Tokens as $token) {
		
			array_push(
					
					$aryOf_ORs, 
					array("Piece.type"	=> $token)
					
			);
			
		}//foreach ($type_Tokens as $token)
		
		
		
// 		$aryOf_ORs = array(
				
// 				array("Piece.type"	=> "Katakana"),
// // 				array("Piece.type"	=> "Hiragana"),
// 				array("Piece.type"	=> "Number"),
				
// 		);
		
		$conditions = array(
		
				'conditions'	=>
// 				array("Piece.type"	=> "Hiragana")
				array('OR'	=> $aryOf_ORs
// 						array(
						
// 							array("Piece.type"	=> "Hiragana"),
// 							array("Piece.type"	=> "Number"),
// 				)
					
			)
				// 					array("Piece.type"	=> "hiragana")
		);
		
		$pieces = $this->Piece->find('all', $conditions);
		
		return $pieces;
		
	}//_filter_List_By_Type($type_Tokens)

	/*******************************
		@param $sort_Param_Set => array($query_Sort, $query_Sort_Direction);
	*******************************/
	public function
	_filter_List_By_Type_2($type_Tokens, $sort_Param_Set) {

		/*******************************
			condition : OR
		*******************************/
		$aryOf_ORs = array();

		foreach ($type_Tokens as $token) {
		
			array_push(
					
					$aryOf_ORs, 
					array("Piece.type"	=> $token)
					
			);
			
		}//foreach ($type_Tokens as $token)

		$conditions = array(
		
				'conditions'	=>
				// 				array("Piece.type"	=> "Hiragana")
				array('OR'	=> $aryOf_ORs
						// 						array(
		
						// 							array("Piece.type"	=> "Hiragana"),
						// 							array("Piece.type"	=> "Number"),
						// 				)
							
				)
				// 					array("Piece.type"	=> "hiragana")
		);
		
		/*******************************
			sort
		*******************************/
		$valOf_SortArray = array();
		
		$tokensOf_Sorts = explode(",", $sort_Param_Set[0]);
		$tokensOf_SortsDirections = explode(",", $sort_Param_Set[1]);
		
		$lenOf_TokensOf_Sorts = count($tokensOf_Sorts);
		
// 		debug("\$tokensOf_Sorts =>");
// 		debug($tokensOf_Sorts);
		
		for ($i = 0; $i < $lenOf_TokensOf_Sorts; $i++) {
		
			array_push(
					$valOf_SortArray, 
					"Piece.$tokensOf_Sorts[$i] $tokensOf_SortsDirections[$i]"
// 					array($tokensOf_Sorts[$i] => $tokensOf_SortsDirections[$i])
			);
			
		}//for ($i = 0; $i < $lenOf_TokensOf_Sorts; $i++)
		
		debug("\$valOf_SortArray");
		debug($valOf_SortArray);
		
		// set option
		$conditions['order'] = $valOf_SortArray;
		
		debug("\$conditions");
		debug($conditions);
		
		/*******************************
			find
		*******************************/
		$pieces = $this->Piece->find('all', $conditions);
		
		return $pieces;
		
	}//_filter_List_By_Type_2($type_Tokens, $sort_Param_Set)
	
	/*******************************
	 @param $sort_Param_Set => array($query_Sort, $query_Sort_Direction);
	 @param $aryOf_Filtered_Hins	=> array(
										(int) 0 => '名詞',
										(int) 1 => '副詞',
										(int) 2 => '助動詞',
										(int) 3 => '助詞',
										(int) 4 => '接続詞',
										(int) 5 => '記号'
									)
	 *******************************/
	public function
	_filter_List_By_Type__5
	($type_Tokens, 
		$sort_Param_Set, 
		$aryOf_Filtered_Hins, 
		$tokensOf_Group_By_Names,
		$query_Filter_Hin_1_Hin_Name,
		$query_Filter_Hin_1_Chosen_Hin_1) {

		/*******************************
			condition : OR
		*******************************/
		$aryOf_ORs = array();

		foreach ($type_Tokens as $token) {
		
			array_push(
					
					$aryOf_ORs, 
					array("Piece.type"	=> $token)
					
			);
			
		}//foreach ($type_Tokens as $token)

		/*******************************
			sort
		*******************************/
		$valOf_SortArray = array();
		
		$tokensOf_Sorts = explode(",", $sort_Param_Set[0]);
		$tokensOf_SortsDirections = explode(",", $sort_Param_Set[1]);
		
		$lenOf_TokensOf_Sorts = count($tokensOf_Sorts);
		
		for ($i = 0; $i < $lenOf_TokensOf_Sorts; $i++) {
		
			array_push(
					$valOf_SortArray, 
					"Piece.$tokensOf_Sorts[$i] $tokensOf_SortsDirections[$i]"
// 					array($tokensOf_Sorts[$i] => $tokensOf_SortsDirections[$i])
			);
			
		}//for ($i = 0; $i < $lenOf_TokensOf_Sorts; $i++)
		
		/*******************************
		 	品詞
		 *******************************/
		$valOf_HinArray = array();

		$lenOf_AryOf_Filtered_Hins = count($aryOf_Filtered_Hins);
		
		for ($i = 0; $i < $lenOf_AryOf_Filtered_Hins; $i++) {
		
			array_push(
					$valOf_HinArray,
					array("Piece.hin" => $aryOf_Filtered_Hins[$i])
					// 					array($tokensOf_Sorts[$i] => $tokensOf_SortsDirections[$i])
					);
				
		}//for ($i = 0; $i < $lenOf_TokensOf_Sorts; $i++)
		
		/*******************************
			build : condtions
		*******************************/
		$conditions = array(
				'order'			=> $valOf_SortArray,
				'conditions'	=> array(
						'AND'	=> array(
// 								'OR'	=> $aryOf_Filtered_Hins
							array('OR'	=> $aryOf_ORs),
							array('OR'	=> $valOf_HinArray),
								
						)//'AND'	=> array(
					)//'conditions'	=> array(
				// 					array("Piece.type"	=> "hiragana")
				,

		);

// 		debug("\$conditions => ");
// 		debug($conditions);
		
		/*******************************
			option 2
		*******************************/
		$valOf_HinArray_2 = array();
		
		// exclide hin_1 hin name
		if (in_array($query_Filter_Hin_1_Hin_Name, $aryOf_Filtered_Hins)) {
		
			$tmp_array = array_diff($aryOf_Filtered_Hins, array($query_Filter_Hin_1_Hin_Name));
			
			$tmp_array = array_values($tmp_array);
			
			debug("hin name deleted => ");
			debug($tmp_array);
			
		} else {//if (in_array($query_Filter_Hin_1_Hin_Name, $aryOf_Filtered_Hins))
			
			$tmp_array = $aryOf_Filtered_Hins;
			
		}//if (in_array($query_Filter_Hin_1_Hin_Name, $aryOf_Filtered_Hins))

		
		$lenOf_AryOf_Filtered_Hins = count($tmp_array);
// 		$lenOf_AryOf_Filtered_Hins = count($aryOf_Filtered_Hins);
		
		for ($i = 0; $i < $lenOf_AryOf_Filtered_Hins; $i++) {
		
			array_push(
					$valOf_HinArray_2,
					array("Piece.hin" => $tmp_array[$i])
// 					array("Piece.hin" => $aryOf_Filtered_Hins[$i])
					// 					array($tokensOf_Sorts[$i] => $tokensOf_SortsDirections[$i])
					);
		
		}//for ($i = 0; $i < $lenOf_TokensOf_Sorts; $i++)
		
		debug("\$valOf_HinArray_2 =>");
		debug($valOf_HinArray_2);
		
		debug("\$query_Filter_Hin_1_Chosen_Hin_1 =>");
		debug($query_Filter_Hin_1_Chosen_Hin_1);	//=> '0,1'
		
		debug("\$query_Filter_Hin_1_Hin_Name =>");
		debug($query_Filter_Hin_1_Hin_Name);
		
		/*******************************
			add : hin_1 names
		*******************************/
		if ($query_Filter_Hin_1_Hin_Name != '0') {
		
			
			// hin_1
			$aryOf_Hin_1_Names = CONS::$listOf_Hin_1_Names[$query_Filter_Hin_1_Hin_Name];
			
			debug("\$aryOf_Hin_1_Names =>");
			debug($aryOf_Hin_1_Names);
			// 		array(
			// 				(int) 0 => '一般',
			// 				(int) 1 => '助詞類接続'
			// 		)
	
			$aryOf_Hin_1_Names_Chosen = 
					Utils::get_SubArray_By_Indexes(
							$aryOf_Hin_1_Names, 
							explode(",", $query_Filter_Hin_1_Chosen_Hin_1));
			
			debug("\$aryOf_Hin_1_Names_Chosen =>");
			debug($aryOf_Hin_1_Names_Chosen);
					
			$cond_Filter_Hin_1 = array();
			
			$tmp_array = array();
			
			foreach ($aryOf_Hin_1_Names_Chosen as $item) {
			
				array_push(
						$valOf_HinArray_2, 
	// 					$tmp_array, 
	// 					$cond_Filter_Hin_1, 
						array('AND'	=> array(
								
								array("Piece.hin"	=> $query_Filter_Hin_1_Hin_Name),
								array("Piece.hin_1"	=> $item),
								
							)
								
						)//array('AND'
				);//array_push(
				
			}//foreach ($aryOf_Hin_1_Names_Chosen as $item)
			
	// 		$cond_Filter_Hin_1['OR'] = $tmp_array;
			
			debug("\$cond_Filter_Hin_1 =>");
			debug($cond_Filter_Hin_1);
	
		}//if ($query_Filter_Hin_1_Hin_Name != '0')
			
					
		debug("\$valOf_HinArray_2 =>");
		debug($valOf_HinArray_2);
		
		$options = array(
				'order'			=> $valOf_SortArray,
				'conditions'	=> array(
						'AND'	=> array(
						// 								'OR'	=> $aryOf_Filtered_Hins
								array('OR'	=> $aryOf_ORs),
								array('OR'	=> $valOf_HinArray_2),
								
// 								array('OR'	=> $tmp_array[0]),
// 								array('OR'	=> $tmp_array),
// 								array('OR'	=> $valOf_HinArray),
// 								$cond_Filter_Hin_1,
		
						)//'AND'	=> array(
				)//'conditions'	=> array(
				,
		
		);
		
// 		debug("\$options =>");
// 		debug($options);
		
		/*******************************
			option : group by
		*******************************/
		if ($tokensOf_Group_By_Names == null) {
		
			debug("\$tokensOf_Group_By_Names => null");
		
		} else if (count($tokensOf_Group_By_Names) < 1) {
			
			debug("\$tokensOf_Group_By_Names => less than 1");
			
		} else if ($tokensOf_Group_By_Names[0] == '') {
			
			debug("\$tokensOf_Group_By_Names => 1 entry, value is ''");
			
		} else {
		
			//ref group by http://monmon.hateblo.jp/entry/20110115/1295099252
			$conditions['group'] = $tokensOf_Group_By_Names;
			
			$options['group'] = $tokensOf_Group_By_Names;
			
		}//if ($tokensOf_Group_By_Names == null)
		
		/*******************************
			options
		*******************************/
		debug("\$conditions => ");
		debug($conditions);
		
		debug("\$options =>");
		debug($options);
		
		/*******************************
			find
		*******************************/
		$pieces = $this->Piece->find('all', $options);
// 		$pieces = $this->Piece->find('all', $conditions);
		
		//debug
// 		debug($this->Piece->lastQuery());
		
		return $pieces;
		
	}//_filter_List_By_Type__4
	
	/*******************************
	 @param $sort_Param_Set => array($query_Sort, $query_Sort_Direction);
	 @param $aryOf_Filtered_Hins	=> array(
										(int) 0 => '名詞',
										(int) 1 => '副詞',
										(int) 2 => '助動詞',
										(int) 3 => '助詞',
										(int) 4 => '接続詞',
										(int) 5 => '記号'
									)
	 *******************************/
	public function
	_filter_List_By_Type__4
	($type_Tokens, 
			$sort_Param_Set, 
			$aryOf_Filtered_Hins, 
			$tokensOf_Group_By_Names) {

		/*******************************
			condition : OR
		*******************************/
		$aryOf_ORs = array();

		foreach ($type_Tokens as $token) {
		
			array_push(
					
					$aryOf_ORs, 
					array("Piece.type"	=> $token)
					
			);
			
		}//foreach ($type_Tokens as $token)

// 		$conditions = array(
		
// 				'conditions'	=>
// 				// 				array("Piece.type"	=> "Hiragana")
// 				array('OR'	=> $aryOf_ORs
// 						// 						array(
		
// 						// 							array("Piece.type"	=> "Hiragana"),
// 						// 							array("Piece.type"	=> "Number"),
// 						// 				)
							
// 				)
// 				// 					array("Piece.type"	=> "hiragana")
// 		);
		
		/*******************************
			sort
		*******************************/
		$valOf_SortArray = array();
		
		$tokensOf_Sorts = explode(",", $sort_Param_Set[0]);
		$tokensOf_SortsDirections = explode(",", $sort_Param_Set[1]);
		
		$lenOf_TokensOf_Sorts = count($tokensOf_Sorts);
		
// 		debug("\$tokensOf_Sorts =>");
// 		debug($tokensOf_Sorts);
		
		for ($i = 0; $i < $lenOf_TokensOf_Sorts; $i++) {
		
			array_push(
					$valOf_SortArray, 
					"Piece.$tokensOf_Sorts[$i] $tokensOf_SortsDirections[$i]"
// 					array($tokensOf_Sorts[$i] => $tokensOf_SortsDirections[$i])
			);
			
		}//for ($i = 0; $i < $lenOf_TokensOf_Sorts; $i++)
		
// 		debug("\$valOf_SortArray");
// 		debug($valOf_SortArray);
		
// 		// set option
// 		$conditions['order'] = $valOf_SortArray;
		
		
		
// 		debug("\$conditions");
// 		debug($conditions);
		
		/*******************************
		 	品詞
		 *******************************/
		$valOf_HinArray = array();

		$lenOf_AryOf_Filtered_Hins = count($aryOf_Filtered_Hins);
		
		for ($i = 0; $i < $lenOf_AryOf_Filtered_Hins; $i++) {
		
			array_push(
					$valOf_HinArray,
					array("Piece.hin" => $aryOf_Filtered_Hins[$i])
					// 					array($tokensOf_Sorts[$i] => $tokensOf_SortsDirections[$i])
					);
				
		}//for ($i = 0; $i < $lenOf_TokensOf_Sorts; $i++)
		
// 		debug("\$valOf_HinArray => ");
// 		debug($valOf_HinArray);
		
		// set option
// 		$conditions['order'] = $valOf_SortArray;
		
// 		aa
		
		/*******************************
			build : condtions
		*******************************/
// 		$conditions['order'] = array(
// 				'AND'	=> array(
// 						array('OR'	=> $valOf_SortArray),
// 						array('OR'	=> $valOf_HinArray),
						
// 				)
				
// 		);
		
		$conditions = array(
				'order'			=> $valOf_SortArray,
				'conditions'	=> array(
						'AND'	=> array(
// 								'OR'	=> $aryOf_ORs,
// 								'OR'	=> $aryOf_Filtered_Hins
							array('OR'	=> $aryOf_ORs),
							array('OR'	=> $valOf_HinArray),
// 							array('OR'	=> $aryOf_Filtered_Hins),
// 							array('OR'	=> $aryOf_Filtered_Hins),
								
						)//'AND'	=> array(
					)//'conditions'	=> array(
				// 					array("Piece.type"	=> "hiragana")
				,
// 				'group'	=> $tokensOf_Group_By_Names
		);

		debug("\$conditions => ");
		debug($conditions);
		
		/*******************************
			option : group by
		*******************************/
		if ($tokensOf_Group_By_Names == null) {
		
			debug("\$tokensOf_Group_By_Names => null");
		
		} else if (count($tokensOf_Group_By_Names) < 1) {
			
			debug("\$tokensOf_Group_By_Names => less than 1");
			
		} else if ($tokensOf_Group_By_Names[0] == '') {
			
			debug("\$tokensOf_Group_By_Names => 1 entry, value is ''");
			
		} else {
		
			//ref group by http://monmon.hateblo.jp/entry/20110115/1295099252
			$conditions['group'] = $tokensOf_Group_By_Names;
			
		}//if ($tokensOf_Group_By_Names == null)
		
				
		/*******************************
			find
		*******************************/
		$pieces = $this->Piece->find('all', $conditions);
		
		//debug
// 		debug($this->Piece->lastQuery());
		
		return $pieces;
		
	}//_filter_List_By_Type__4
	
	/*******************************
	 @param $sort_Param_Set => array($query_Sort, $query_Sort_Direction);
	 @param $aryOf_Filtered_Hins	=> array(
										(int) 0 => '名詞',
										(int) 1 => '副詞',
										(int) 2 => '助動詞',
										(int) 3 => '助詞',
										(int) 4 => '接続詞',
										(int) 5 => '記号'
									)
	 *******************************/
	public function
	_filter_List_By_Type_3
	($type_Tokens, $sort_Param_Set, $aryOf_Filtered_Hins) {

		/*******************************
			condition : OR
		*******************************/
		$aryOf_ORs = array();

		foreach ($type_Tokens as $token) {
		
			array_push(
					
					$aryOf_ORs, 
					array("Piece.type"	=> $token)
					
			);
			
		}//foreach ($type_Tokens as $token)

// 		$conditions = array(
		
// 				'conditions'	=>
// 				// 				array("Piece.type"	=> "Hiragana")
// 				array('OR'	=> $aryOf_ORs
// 						// 						array(
		
// 						// 							array("Piece.type"	=> "Hiragana"),
// 						// 							array("Piece.type"	=> "Number"),
// 						// 				)
							
// 				)
// 				// 					array("Piece.type"	=> "hiragana")
// 		);
		
		/*******************************
			sort
		*******************************/
		$valOf_SortArray = array();
		
		$tokensOf_Sorts = explode(",", $sort_Param_Set[0]);
		$tokensOf_SortsDirections = explode(",", $sort_Param_Set[1]);
		
		$lenOf_TokensOf_Sorts = count($tokensOf_Sorts);
		
// 		debug("\$tokensOf_Sorts =>");
// 		debug($tokensOf_Sorts);
		
		for ($i = 0; $i < $lenOf_TokensOf_Sorts; $i++) {
		
			array_push(
					$valOf_SortArray, 
					"Piece.$tokensOf_Sorts[$i] $tokensOf_SortsDirections[$i]"
// 					array($tokensOf_Sorts[$i] => $tokensOf_SortsDirections[$i])
			);
			
		}//for ($i = 0; $i < $lenOf_TokensOf_Sorts; $i++)
		
// 		debug("\$valOf_SortArray");
// 		debug($valOf_SortArray);
		
// 		// set option
// 		$conditions['order'] = $valOf_SortArray;
		
		
		
// 		debug("\$conditions");
// 		debug($conditions);
		
		/*******************************
		 	品詞
		 *******************************/
		$valOf_HinArray = array();

		$lenOf_AryOf_Filtered_Hins = count($aryOf_Filtered_Hins);
		
		for ($i = 0; $i < $lenOf_AryOf_Filtered_Hins; $i++) {
		
			array_push(
					$valOf_HinArray,
					array("Piece.hin" => $aryOf_Filtered_Hins[$i])
					// 					array($tokensOf_Sorts[$i] => $tokensOf_SortsDirections[$i])
					);
				
		}//for ($i = 0; $i < $lenOf_TokensOf_Sorts; $i++)
		
// 		debug("\$valOf_HinArray => ");
// 		debug($valOf_HinArray);
		
		// set option
// 		$conditions['order'] = $valOf_SortArray;
		
		/*******************************
			build : condtions
		*******************************/
// 		$conditions['order'] = array(
// 				'AND'	=> array(
// 						array('OR'	=> $valOf_SortArray),
// 						array('OR'	=> $valOf_HinArray),
						
// 				)
				
// 		);
		
		$conditions = array(
				'order'			=> $valOf_SortArray,
				'conditions'	=> array(
						'AND'	=> array(
// 								'OR'	=> $aryOf_ORs,
// 								'OR'	=> $aryOf_Filtered_Hins
							array('OR'	=> $aryOf_ORs),
							array('OR'	=> $valOf_HinArray),
// 							array('OR'	=> $aryOf_Filtered_Hins),
// 							array('OR'	=> $aryOf_Filtered_Hins),
								
						)//'AND'	=> array(
					)//'conditions'	=> array(
				// 					array("Piece.type"	=> "hiragana")
		);

		debug("\$conditions => ");
		debug($conditions);
		
		/*******************************
			find
		*******************************/
		$pieces = $this->Piece->find('all', $conditions);
		
		return $pieces;
		
	}//_filter_List_By_Type_3($type_Tokens, $sort_Param_Set)
	
	public function
	filter_List_By_Type() {
		
		/*******************************
			debug
		*******************************/
		@$query_Debug = $this->request->query["debug"];
		
		if ($query_Debug) {
		
			debug("debug --->enabled");
			
		}//if ($query_Debug)
		
		/*******************************
			query : filter : type : default
		*******************************/
		@$query_Type = $this->request->query["type"];
		
		if ($query_Type == '') {

			$query_Type = 'kanji';
			
		}//if ($query_Type == '')
		;
		
// 		debug("\$query_Type => ".$query_Type);
		
		$type_Tokens = explode(",", $query_Type);
		
// 		debug($type_Tokens);
		
		/*******************************
		 query : sort
		 *******************************/
		@$query_Sort = $this->request->query["sort"];
		@$query_Sort_Direction = $this->request->query["sort_direction"];
		
// 		debug("\$query_Sort => ");
// 		debug($query_Sort);
		
// 		debug("\$query_Sort_Direction =>");
// 		debug($query_Sort_Direction);
		
// 		$data_Sort = explode()
		
		$sort_Param_Set = array($query_Sort, $query_Sort_Direction);
		
		/*******************************
		 query : filter : hins
		 *******************************/
		@$query_Filter_Hins = $this->request->query["filter_Hins"];
		
// 		debug("\query_Filter_Hins => ");
// 		debug($query_Filter_Hins);
		
		// build array of hins
		$aryOf_Filtered_Hins = array();
		
		$tokensOf_Filtered_Hins_Indexes = explode(",", $query_Filter_Hins);
		
// 		debug("\$tokensOf_Filtered_Hins_Indexes");
// 		debug($tokensOf_Filtered_Hins_Indexes);
		
		foreach ($tokensOf_Filtered_Hins_Indexes as $token) {
		
			array_push($aryOf_Filtered_Hins, CONS::$listOf_Hin_Nams[$token]);
			
		}//foreach ($tokensOf_Filtered_Hins_Indexes as $token)
		
// 		debug("\$aryOf_Filtered_Hins");
// 		debug($aryOf_Filtered_Hins);
		// 		array(
		// 				(int) 0 => '名詞',
		// 				(int) 1 => '副詞',
		// 				(int) 2 => '助動詞',
		// 				(int) 3 => '助詞',
		// 				(int) 4 => '接続詞',
		// 				(int) 5 => '記号'
		// 		)

		/*******************************
		 query : group by
		 *******************************/
		@$query_Group_By = $this->request->query["group_by"];
		
// 		debug("\$query_Group_By => ");
// 		debug($query_Group_By);
		
		// build array of hins
		$aryOf_Group_By = array();
		
		$tokensOf_Group_By_Names = explode(",", $query_Group_By);
		
// 		debug("\$tokensOf_Group_By_Names =>");
// 		debug($tokensOf_Group_By_Names);
		
		/*******************************
		 query : filter : hin_1
		 *******************************/
		@$query_Filter_Hin_1_Hin_Name = $this->request->query["filter_hin_1_hin_name"];
		
		@$query_Filter_Hin_1_Chosen_Hin_1 = $this->request->query["filter_hin_1_chosen_hin_1"];
		
		debug("\$query_Filter_Hin_1_Hin_Name =>");
		debug($query_Filter_Hin_1_Hin_Name);	//=> '名詞'
		
		debug("\$query_Filter_Hin_1_Chosen_Hin_1 =>");
// 		debug($query_Filter_Hin_1_Chosen_Hin_1);
		debug(($query_Filter_Hin_1_Chosen_Hin_1 == '') 
					? "blank" : $query_Filter_Hin_1_Chosen_Hin_1);
		
		/*******************************
			validate : hin name in filtered hin names list
		*******************************/
// 		$result = in_array($query_Filter_Hin_1_Hin_Name, $aryOf_Filtered_Hins);
// 		$result = true;
		$result = false;
		
		foreach ($aryOf_Filtered_Hins as $item) {
		
			if ($item == $query_Filter_Hin_1_Hin_Name) {
			
				debug("equal => $item / $query_Filter_Hin_1_Hin_Name");
				
				$result = true;
				
				break;
				
			} else {//if ($item == $query_Filter_Hin_1_Hin_Name)
			
				debug("no : $item");
				
			}
			
		}//foreach ($aryOf_Filtered_Hins as $item)
		
		//debug
		if ($result == true) {
		
			debug("result ---> true");
		
		} else {
		
			debug("result ---> false");
			
		}//if ($result == true)
		
		
		
		
		debug("\$result => " . (($result == false) ? "false!" : "not false"));
		
		debug("\$aryOf_Filtered_Hins =>");
		debug($aryOf_Filtered_Hins);
		
		/*******************************
			get : pieces
		*******************************/
		$listOf_Pieces = $this->_filter_List_By_Type__5(
				$type_Tokens, 
				$sort_Param_Set, 
				$aryOf_Filtered_Hins, 
				$tokensOf_Group_By_Names,
				$query_Filter_Hin_1_Hin_Name,
				$query_Filter_Hin_1_Chosen_Hin_1
		);
		
// 		$listOf_Pieces = $this->_filter_List_By_Type__4(
// 				$type_Tokens, 
// 				$sort_Param_Set, 
// 				$aryOf_Filtered_Hins, 
// 				$tokensOf_Group_By_Names);
		
// 		$listOf_Pieces = $this->_filter_List_By_Type_3(
// 				$type_Tokens, 
// 				$sort_Param_Set, 
// 				$aryOf_Filtered_Hins);
		
		/*******************************
			variables
		*******************************/
		$this->set("listOf_Pieces", $listOf_Pieces);

// 		$this->set("numOf_Pieces_All", count($this->Piece->find('all')));
		
		/**********************************
		 * view
		 **********************************/
		$this->layout = 'plain';
		
		$this->render("/Pieces/partials/_index_filter_by_type");
		
	}//_filter_List_By_Type($type)

	public function
	_get_ListOf_Hin_1_Names($query_Hin_Name) {
			
		$options = array(
				
				"conditions"	=> array(
		
						"Piece.hin"	=> $query_Hin_Name
						
				),
				
				"group"	=> array(
						
						"Piece.hin_1"
				)
				
		);

// 		debug($options);
		
		/*******************************
			pieces
		*******************************/
		$pieces = $this->Piece->find('all', $options);
		
		/*******************************
			return
		*******************************/
		return $pieces;
		
	}//_get_ListOf_Hin_1_Names($query_Hin_Name)
	
	public function
	get_ListOf__Hin_1() {
		
		/*******************************
			query
		*******************************/
		@$query_Hin_Name = $this->request->query["hin_name"];
		
		/*******************************
			validate
		*******************************/
// 		//test
// 		//ref https://book.cakephp.org/3.0/en/controllers/components/flash.html
// // 		$this->Flash->set('This is a message');
// 		$this->Session->setFlash(__("Geschichte has been saved"));
		
// 		return;
		
		if ($query_Hin_Name == null) {
		
			debug("\$query_Hin_Name => null");
		
		} else if ($query_Hin_Name == '') {
			
			debug("\$query_Hin_Name => blank");
			
		} else {

			/*******************************
			 get : pieces
			 *******************************/
			$listOf_Hin_1_Names = $this->_get_ListOf_Hin_1_Names(
					$query_Hin_Name);
			
			/*******************************
			 variables
			 *******************************/
			$this->set("listOf_Hin_1_Names", $listOf_Hin_1_Names);
			
		}//if ($query_Hin_Name == null)
		
// 		/*******************************
// 		 get : pieces
// 		 *******************************/
// 		$listOf_Hin_1_Names = $this->_get_ListOf_Hin_1_Names(
// 				$query_Hin_Name);
		
// 		/*******************************
// 			variables
// 		*******************************/
// 		$this->set("listOf_Hin_1_Names", $listOf_Hin_1_Names);
		
		/**********************************
		 * view
		 **********************************/
		$this->layout = 'plain';
		
		$this->render("/Pieces/partials/_index_Filter__Hin_1");
		
		
	}//get_ListOf__Hin_1
	
}