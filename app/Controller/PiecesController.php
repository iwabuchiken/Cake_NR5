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
	
	public function
	filter_List_By_Type() {
		
		/*******************************
			query : filter : type : default
		*******************************/
		@$query_Type = $this->request->query["type"];
		
		if ($query_Type == '') {

			$query_Type = 'kanji';
			
		}//if ($query_Type == '')
		;
		
		debug("\$query_Type => ".$query_Type);
		
		$type_Tokens = explode(",", $query_Type);
		
		debug($type_Tokens);
		
		/*******************************
		 query : sort
		 *******************************/
		@$query_Sort = $this->request->query["sort"];
		@$query_Sort_Direction = $this->request->query["sort_direction"];
		
		debug("\$query_Sort => ");
		debug($query_Sort);
		
		debug("\$query_Sort_Direction =>");
		debug($query_Sort_Direction);
		
// 		$data_Sort = explode()
		
		$sort_Param_Set = array($query_Sort, $query_Sort_Direction);
		
		/*******************************
		 query : filter : hins
		 *******************************/
		@$query_Filter_Hins = $this->request->query["filter_Hins"];
		
		debug("\query_Filter_Hins => ");
		debug($query_Filter_Hins);
		
		// build array of hins
		$aryOf_Filtered_Hins = array();
		
		$tokensOf_Filtered_Hins_Indexes = explode(",", $query_Filter_Hins);
		
		debug("\$tokensOf_Filtered_Hins_Indexes");
		debug($tokensOf_Filtered_Hins_Indexes);
		
		foreach ($tokensOf_Filtered_Hins_Indexes as $token) {
		
			array_push($aryOf_Filtered_Hins, CONS::$listOf_Hin_Nams[$token]);
			
		}//foreach ($tokensOf_Filtered_Hins_Indexes as $token)
		
		debug("\$aryOf_Filtered_Hins");
		debug($aryOf_Filtered_Hins);
		
		
		/*******************************
			get : pieces
		*******************************/
		$listOf_Pieces = $this->_filter_List_By_Type_2($type_Tokens, $sort_Param_Set);
// 		$listOf_Pieces = $this->_filter_List_By_Type($type_Tokens);
		
		/*******************************
			variables
		*******************************/
		$this->set("listOf_Pieces", $listOf_Pieces);
		
		/**********************************
		 * view
		 **********************************/
		$this->layout = 'plain';
		
		$this->render("/Pieces/partials/_index_filter_by_type");
		
	}//_filter_List_By_Type($type)
}