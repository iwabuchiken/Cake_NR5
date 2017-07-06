<!-- 

http://yapi.ta2o.net/apis/mecapi.cgi?sentence=

C:\WORKS_2\WS\Eclipse_Luna\Cake_NR5
C:\WORKS_2\WS\Eclipse_Luna\Cake_NR5\app
C:\WORKS_2\WS\Eclipse_Luna\Cake_NR5\app\Controller
C:\WORKS_2\WS\Eclipse_Luna\Cake_NR5\app\Controller\PiecesController.php

http://benfranklin.chips.jp/cake_apps/Cake_NR5/pieces/index
/cake_apps/Cake_NR5/app
/cake_apps/Cake_NR5

<regular expressions>
^[ \t]+debug

https://docs.google.com/spreadsheets/d/1GlMjFYCAdSc87V-BhGAM-sz-Kka6AlyxgS-0jqvPlPc/edit#gid=0
https://mysqladmin.lolipop.jp/pma/import.php#PMAURL-0:sql.php?db=LAA0278957-cakenr5&table=genre_names&server=137&target=&token=6d3d1dd80da492b5e63c64fbd6fa5ec3
https://user.lolipop.jp/?mode=mysql&database=LAA0278957-cakenr5&user_db_id=

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
			guilde to : filter
		*******************************/
		@$query_Action = $this->request->query['action'];
		
// 		debug("\$query_Action =>");
// 		debug($query_Action);
		
		if ($query_Action == 'filter') {
		
//			debug("action ==> filter");
			
			$this->filter_List_By_Type();
			
			return;
			
		} else if ($query_Action == 'get_list_of_hin_name') {
			
			$this->get_ListOf__Hin_1();
			
			return;
			
		} else if ($query_Action == 'stats') {
			
			$this->stats();
			
			return;

		} else if ($query_Action == 'svo') {
			
// 			$this->svo_table();
			$this->svo();
			
			return;

		} else if ($query_Action == 'svo_table') {
			
			$this->svo_table();
// 			$this->svo();
			
			return;

		} else {//if ($query_Action == 'filter')

//			debug("action is 'else' => " . $query_Action);
			
		}//if ($query_Action == 'filter')
		
		
// 		$hostname = $_SERVER['HTTP_HOST'];	// 'localhost'

//		debug(env('SERVER_NAME'));
		
		$servername = env('SERVER_NAME');
		
		if ($servername == 'localhost') {
		
			/*******************************
			 option : sort
			 *******************************/
			$sort_key = "sort";
			
			$sort_direction_key = "sort-direction";
			
			@$query_Sort = $this->request->query[$sort_key];
			
			@$query_SortDirection = $this->request->query[$sort_direction_key];
			
			$sort_type = isset($query_Sort) ? $query_Sort : "id";
			$sort_direction_type = isset($query_SortDirection) ? $query_SortDirection : "asc";
			
//			debug($sort_type." / ".$sort_direction_type);
			
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
			
//			debug($pagination_settings);
			
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
			
//			debug("count(\$pieces) => '".count($pieces)."'");
			
			$this->set("pieces_Paginated", $pieces_Paginated);
			
			#test
			// 		$url =  (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			// 		$param_new = "abc";
			
			// 		$sort_type = isset($query_Sort) ? $query_Sort : "id";
			// 		$sort_direction_type = isset($query_SortDirection) ? $query_SortDirection : "asc";
			
			$url_new = Utils_2::update_URL__Param_Sort($sort_type, $sort_direction_type);
			// 		$url_new = Utils_2::update_URL__Param_Sort($param_new);
			
//			debug("\$url_new => ".$url_new);
			
			#test
			$this->set("url_new", $url_new);
			
		} else {//if ($servername == 'localhost')

			$this->_index_Remote();
			
// 			debug("not localhost");
			
// 			/**********************************
// 			 * view
// 			 **********************************/
// // 			$this->layout = 'plain';
			
// 			$this->render("/Pieces/index_3");
// // 			$this->render("/Pieces/partials/_index_filter_by_type");
				
		}
		
// 		/*******************************
// 			option : sort
// 		*******************************/
// 		$sort_key = "sort";
		
// 		$sort_direction_key = "sort-direction";
		
// 		@$query_Sort = $this->request->query[$sort_key];
		
// 		@$query_SortDirection = $this->request->query[$sort_direction_key];

// 		$sort_type = isset($query_Sort) ? $query_Sort : "id";
// 		$sort_direction_type = isset($query_SortDirection) ? $query_SortDirection : "asc";
		
// 		debug($sort_type." / ".$sort_direction_type);
		
// 		/*******************************
// 			pagination
// 		*******************************/
// 		#ref C:\WORKS_2\WS\Eclipse_Luna\Cake_NR5\app\Controller\TokensController.php
// 		$paginate_array = array(
// 				//REF http://stackoverflow.com/questions/861960/how-can-i-limit-the-find-to-a-specific-number-in-cakephp answered May 14 '10 at 0:08
// 		// 					'limit' => "13314,10",
// 		// 					'recursive'	=> -1,
// 				'limit' => 10,
// 				#ref $opt_order["Token.$session_Sort"] = "asc";
// 				'order' => array("Pieces.$sort_type" => $sort_direction_type),
// // 				'order' => array("Pieces.id" => "asc"),
// // 				'conditions'	=> $opt_conditions,
					
// 		);
		
// // 		debug($paginate_array);
		
// // 		$this->paginate = $paginate_array;
// // 		$this->paginate = array(
// // 				//REF http://stackoverflow.com/questions/861960/how-can-i-limit-the-find-to-a-specific-number-in-cakephp answered May 14 '10 at 0:08
// // 		// 					'limit' => "13314,10",
// // 		// 					'recursive'	=> -1,
// // 				'limit' => 10,
// // 				#ref $opt_order["Token.$session_Sort"] = "asc";
// // 				'order' => array("Pieces.$sort_type" => $sort_direction_type),
// // // 				'order' => array("Pieces.id" => "asc"),
// // // 				'conditions'	=> $opt_conditions,
					
// // 		);
		
// 		#ref https://book.cakephp.org/2.0/ja/core-libraries/components/pagination.html
// 		#ref public $this->Paginator->settings = array(
// // 		public $this->Paginator->settings = array(
// 		$pagination_settings = array(
// // 				'limit' => 3,
// 				'limit' => 10,
// 				'maxLimit' => 10,
				
// // 				'conditions'	=> array(
						
// // 						"Piece.type"	=> 'Hiragana'
// // 				),
				
// 				'order' => array(
// // 							"Piece.hin" => 'asc',
// 							"Piece.hin" => 'desc',
// 							"Piece.hin_1" => 'desc',
// 							"Piece.type" => 'desc',
// // 							"Piece.type" => 'asc',
// // 							"Piece.$sort_type" => 'desc',
// 				),
				
// // 				'order' => array("Piece.$sort_type" => 'desc')
// // 				'order' => array('Piece.hin' => 'desc')
// // 				'order' => array('Piece.form' => 'desc')
// // 				'order' => array('Piece.id' => 'desc')
// // 				'order' => array('Hoge.modified' => 'desc')
// 		);
		
// 		debug($pagination_settings);
		
// 		$this->Paginator->settings = $pagination_settings;
// // 		$this->Paginator->settings = array(
// // 				'limit' => 10,
// // 				'maxLimit' => 10,
// // 				'order' => array(
// // 							"Piece.hin" => 'desc',
// // 							"Piece.hin_1" => 'desc',
// // // 							"Piece.$sort_type" => 'desc',
// // 				)
// // // 				'order' => array("Piece.$sort_type" => 'desc')
// // // 				'order' => array('Piece.hin' => 'desc')
// // // 				'order' => array('Piece.form' => 'desc')
// // // 				'order' => array('Piece.id' => 'desc')
// // // 				'order' => array('Hoge.modified' => 'desc')
// // 		);
		
// 		$pieces_Paginated = $this->Paginator->paginate('Piece');
// // 		$pieces_Paginated = $this->paginate('Piece');
// // 		$tokens = $this->paginate('Token');
		
		
// 		$pieces = $this->Piece->find('all');
		
// 		debug("count(\$pieces) => '".count($pieces)."'");
		
// 		$this->set("pieces_Paginated", $pieces_Paginated);
		
// 		#test
// // 		$url =  (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// // 		$param_new = "abc";
		
// // 		$sort_type = isset($query_Sort) ? $query_Sort : "id";
// // 		$sort_direction_type = isset($query_SortDirection) ? $query_SortDirection : "asc";
		
// 		$url_new = Utils_2::update_URL__Param_Sort($sort_type, $sort_direction_type);
// // 		$url_new = Utils_2::update_URL__Param_Sort($param_new);
		
// 		debug("\$url_new => ".$url_new);
		
// 		#test
// 		$this->set("url_new", $url_new);
		
	}//index

	public function
	_index_Remote() {

// 		debug("not localhost");
		
		/*******************************
		 option : sort
		 *******************************/
		$sort_key = "sort";
		
		$sort_direction_key = "sort-direction";
		
		@$query_Sort = $this->request->query[$sort_key];
		
		@$query_SortDirection = $this->request->query[$sort_direction_key];
		
		$sort_type = isset($query_Sort) ? $query_Sort : "id";
		$sort_direction_type = isset($query_SortDirection) ? $query_SortDirection : "asc";
		
//		debug($sort_type." / ".$sort_direction_type);
		
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
		
			
		/**********************************
		 * view
		 **********************************/
		// 			$this->layout = 'plain';
			
		$this->render("/Pieces/index_2");
// 		$this->render("/Pieces/index_3");
		// 			$this->render("/Pieces/partials/_index_filter_by_type");
		
	}//_index_Remote() {
	
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
		
//		debug($sort_type." / ".$sort_direction_type);
		
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
	inde() {

//		debug("inde");
		
	}
	
	public function
// 	index_3() {
	index3() {
		
		
		
	}
	
	public function
	create_Tokens() {
	
// 		#debug
// 		return;
	
		/*******************************
			query : tick
		*******************************/
		@$query_Tick = $this->request->query['tick'];
		
		if ($query_Tick == null) {
		
			$tickOf_Geschichtes = 15;
			
			debug("tick ==> null; set to 15");
		
		} else if ($query_Tick == '') {
			
			$tickOf_Geschichtes = 15;
			
			debug("tick ==> ''; set to 15");
			
		} else {
		
			$tickOf_Geschichtes = intval($query_Tick);
			
			debug("tick ===> set to $tickOf_Geschichtes");
			
		}//if ($query_Tick == null)
		
		
		
		
		
		$this->loadModel('Geschichte');
		
		$geschichtes = $this->Geschichte->find('all');
		
//		debug("count(\$geschichtes) => ".count($geschichtes));
		
		$lenOf_Geschichtes = count($geschichtes);
		
		$max_word_num = 800;
		
// 		$tickOf_Geschichtes = 50;
// 		$tickOf_Geschichtes = 15;
// 		$tickOf_Geschichtes = 15;
// 		$tickOf_Geschichtes = 10;
// 		$tickOf_Geschichtes = 5;
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
		
//		debug($dict);
		
		$pieces = $this->Piece->find('all');
		
//		debug("count(\$pieces) => ".count($pieces));	//=> 'count($pieces) => 2396'
		
		$count = 0;
		$count_max = 100;
		
		$count_done = 0;
		$count_NOT_done = 0;
		
		foreach ($pieces as $piece) {
		
//			debug($piece['Piece']['form']);
			// 			debug($piece);
				
			# judge : type
			$result = Utils::get_Type($piece['Piece']['form']);
				
//			debug("\$result => ".$result." (".$dict[$result].")");
			
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
		
//		debug("\$valOf_SortArray");
//		debug($valOf_SortArray);
		
		// set option
		$conditions['order'] = $valOf_SortArray;
		
//		debug("\$conditions");
//		debug($conditions);
		
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
			
// 			debug("hin name deleted => ");
// 			debug($tmp_array);
			
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
		
// 		debug("\$valOf_HinArray_2 =>");
// 		debug($valOf_HinArray_2);
		
// 		debug("\$query_Filter_Hin_1_Chosen_Hin_1 =>");
// 		debug($query_Filter_Hin_1_Chosen_Hin_1);	//=> '0,1'
		
// 		debug("\$query_Filter_Hin_1_Hin_Name =>");
// 		debug($query_Filter_Hin_1_Hin_Name);
		
		/*******************************
			add : hin_1 names
		*******************************/
		if ($query_Filter_Hin_1_Hin_Name != '0') {
		
			
			// hin_1
			$aryOf_Hin_1_Names = CONS::$listOf_Hin_1_Names[$query_Filter_Hin_1_Hin_Name];
			
// 			debug("\$aryOf_Hin_1_Names =>");
// 			debug($aryOf_Hin_1_Names);
			// 		array(
			// 				(int) 0 => '一般',
			// 				(int) 1 => '助詞類接続'
			// 		)
	
			$aryOf_Hin_1_Names_Chosen = 
					Utils::get_SubArray_By_Indexes(
							$aryOf_Hin_1_Names, 
							explode(",", $query_Filter_Hin_1_Chosen_Hin_1));
			
// 			debug("\$aryOf_Hin_1_Names_Chosen =>");
// 			debug($aryOf_Hin_1_Names_Chosen);
					
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
			
// 			debug("\$cond_Filter_Hin_1 =>");
// 			debug($cond_Filter_Hin_1);
	
		}//if ($query_Filter_Hin_1_Hin_Name != '0')
			
					
// 		debug("\$valOf_HinArray_2 =>");
// 		debug($valOf_HinArray_2);
		
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
		
//			debug("\$tokensOf_Group_By_Names => null");
		
		} else if (count($tokensOf_Group_By_Names) < 1) {
			
//			debug("\$tokensOf_Group_By_Names => less than 1");
			
		} else if ($tokensOf_Group_By_Names[0] == '') {
			
//			debug("\$tokensOf_Group_By_Names => 1 entry, value is ''");
			
		} else {
		
			//ref group by http://monmon.hateblo.jp/entry/20110115/1295099252
			$conditions['group'] = $tokensOf_Group_By_Names;
			
			// modify : group names
			$tokensOf_Group_By_Names__Final = array();
			
			foreach ($tokensOf_Group_By_Names as $t) {
			
				array_push($tokensOf_Group_By_Names__Final, "Piece." . $t);
				
			}//foreach ($tokensOf_Group_By_Names as $t)
			
// 			debug("\$tokensOf_Group_By_Names__Final =>");
// 			debug($tokensOf_Group_By_Names__Final);
			
			$options['group'] = $tokensOf_Group_By_Names__Final;
// 			$options['group'] = $tokensOf_Group_By_Names;
			
		}//if ($tokensOf_Group_By_Names == null)
		
		/*******************************
			options
		*******************************/
// 		debug("\$conditions => ");
// 		debug($conditions);
		
// 		debug("\$options =>");
// 		debug($options);
		
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
		
// 		
		
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

//		debug("\$conditions => ");
//		debug($conditions);
		
		/*******************************
			option : group by
		*******************************/
		if ($tokensOf_Group_By_Names == null) {
		
//			debug("\$tokensOf_Group_By_Names => null");
		
		} else if (count($tokensOf_Group_By_Names) < 1) {
			
//			debug("\$tokensOf_Group_By_Names => less than 1");
			
		} else if ($tokensOf_Group_By_Names[0] == '') {
			
//			debug("\$tokensOf_Group_By_Names => 1 entry, value is ''");
			
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

//		debug("\$conditions => ");
//		debug($conditions);
		
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
		
// 		debug("\$query_Filter_Hin_1_Hin_Name =>");
// 		debug($query_Filter_Hin_1_Hin_Name);	//=> '名詞'
		
// 		debug("\$query_Filter_Hin_1_Chosen_Hin_1 =>");
// // 		debug($query_Filter_Hin_1_Chosen_Hin_1);
// 		debug(($query_Filter_Hin_1_Chosen_Hin_1 == '') 
// 					? "blank" : $query_Filter_Hin_1_Chosen_Hin_1);
		
		/*******************************
			validate : hin name in filtered hin names list
		*******************************/
// 		$result = in_array($query_Filter_Hin_1_Hin_Name, $aryOf_Filtered_Hins);
// 		$result = true;
		$result = false;
		
		foreach ($aryOf_Filtered_Hins as $item) {
		
			if ($item == $query_Filter_Hin_1_Hin_Name) {
			
// 				debug("equal => $item / $query_Filter_Hin_1_Hin_Name");
				
				$result = true;
				
				break;
				
			} else {//if ($item == $query_Filter_Hin_1_Hin_Name)
			
//				debug("no : $item");
				
			}
			
		}//foreach ($aryOf_Filtered_Hins as $item)
		
		//debug
		if ($result == true) {
		
//			debug("result ---> true");
		
		} else {
		
//			debug("result ---> false");
			
		}//if ($result == true)
		
		
		
		
//		debug("\$result => " . (($result == false) ? "false!" : "not false"));
		
//		debug("\$aryOf_Filtered_Hins =>");
//		debug($aryOf_Filtered_Hins);
		
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
	filter() {
		
		
		
	}//filter() {
	
	public function
	_get_ListOf_Hin_1_Names($query_Hin_Name) {
			
		debug("\$query_Hin_Name => " . $query_Hin_Name);
		
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
		
// 		debug("count(\$pieces) => " . count($pieces));
		
// 		debug($pieces);
		
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
		
//			debug("\$query_Hin_Name => null");
		
		} else if ($query_Hin_Name == '') {
			
//			debug("\$query_Hin_Name => blank");
			
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
	
	public function
	_stats__Hinshis($numOf_Pieces_Total) {

		//test
		$listOf_Hin_Names = CONS::$listOf_Hin_Nams;
		
		$data_2 = array();
		
		foreach ($listOf_Hin_Names as $item) {
		
			$option = array(
		
					'conditions'	=> array('Piece.hin'	=> $item)
		
			);
		
			$pieces = $this->Piece->find('all', $option);
		
			$numOf_Pieces = count($pieces);
		
			array_push($data_2, array($item, $numOf_Pieces, $numOf_Pieces / $numOf_Pieces_Total));
		
		}//foreach ($listOf_Hin_Names as $item)
		
		return $data_2;
		
	}//_stats__Hinshis()
	
	public function
	_stats__Joshis($hin_Name, $numOf_Pieces_Total) {

		//test
		$listOf_Joshis = CONS::$listOf_Hin_1_Names[$hin_Name];
// 		$listOf_Joshis = CONS::$listOf_Hin_1_Names['助詞'];
		
		$data_2 = array();
		
		foreach ($listOf_Joshis as $item) {
		
			$option = array(
		
					'conditions'	=> array(
								
								'AND'	=> array(
										
										'Piece.hin'	=> $hin_Name,
										
										'Piece.hin_1'	=> $item,
										
								)
// 								'Piece.hin'	=> $item
					
					
					)
		
			);
		
			$pieces = $this->Piece->find('all', $option);
		
			$numOf_Pieces = count($pieces);
		
			array_push($data_2, array($item, $numOf_Pieces, $numOf_Pieces / $numOf_Pieces_Total));
		
		}//foreach ($listOf_Hin_Names as $item)
		
		return $data_2;
		
	}//_stats__Joshis($numOf_Pieces_Total)
	
	public function
	_stats__Nouns($hin_Name, $numOf_Pieces_Total) {

		//test
		$listOf_Nouns = CONS::$listOf_Hin_1_Names[$hin_Name];
// 		$listOf_Joshis = CONS::$listOf_Hin_1_Names['助詞'];
		
		$data_2 = array();
		
		foreach ($listOf_Nouns as $item) {
		
			$option = array(
		
					'conditions'	=> array(
								
								'AND'	=> array(
										
										'Piece.hin'	=> $hin_Name,
										
										'Piece.hin_1'	=> $item,
										
								)
// 								'Piece.hin'	=> $item
					
					
					)
		
			);
		
			$pieces = $this->Piece->find('all', $option);
		
			$numOf_Pieces = count($pieces);
		
			array_push($data_2, array($item, $numOf_Pieces, $numOf_Pieces / $numOf_Pieces_Total));
		
		}//foreach ($listOf_Hin_Names as $item)
		
		return $data_2;
		
	}//_stats__Nouns($numOf_Pieces_Total)
	
	public function
	_stats__Symbols($hin_Name, $numOf_Pieces_Total) {

		//test
		$listOf_Symbols = CONS::$listOf_Hin_1_Names[$hin_Name];
// 		$listOf_Joshis = CONS::$listOf_Hin_1_Names['助詞'];
		
		$data_2 = array();
		
		foreach ($listOf_Symbols as $item) {
		
			$option = array(
		
					'conditions'	=> array(
								
								'AND'	=> array(
										
										'Piece.hin'	=> $hin_Name,
										
										'Piece.hin_1'	=> $item,
										
								)
// 								'Piece.hin'	=> $item
					
					
					)
		
			);
		
			$pieces = $this->Piece->find('all', $option);
		
			$numOf_Pieces = count($pieces);
		
			array_push($data_2, array($item, $numOf_Pieces, $numOf_Pieces / $numOf_Pieces_Total));
		
		}//foreach ($listOf_Hin_Names as $item)
		
		return $data_2;
		
	}//_stats__Symbols($numOf_Pieces_Total)
	
	public function
	_stats__Top10s() {
		
		/*******************************
			genres
		*******************************/
		$this->loadModel('Geschichte');
		
		$geschichtes = $this->Geschichte->find('all');
		
// 		debug($geschichtes[10]);
		
		//ref https://webkaru.net/php/function-array-fill/
		$aryOf_Genres_tmp = array_fill(0, 20, 0);
		
// 		debug($aryOf_Genres);

		foreach ($geschichtes as $g) {
		
			$genre_Id = $g['Geschichte']['genre_id'];
			
			$aryOf_Genres_tmp[intval($genre_Id)] += 1;
			
		}//foreach ($geschichtes as $g)
		
// 		debug($aryOf_Genres_tmp);
		
		$aryOf_Genres = array_slice($aryOf_Genres_tmp, 10, 8);
		
// 		debug($aryOf_Genres);
		
		/*******************************
			build list
		*******************************/
		$aryOf_Data = array();
		
		$lenOf_AryOf_Genres = count($aryOf_Genres);
		
		$total = 0;
		
		for ($i = 0; $i < $lenOf_AryOf_Genres; $i++) {
		
			$genre_Id = $i + 10;
			
			$numOf_Entries = $aryOf_Genres[$i];
			
			$genre = Utils::get_Genre_From_Genre_Id($genre_Id);

// 			debug($genre);
			
			$genre_Name = $genre['Genre']['name'];
			
			array_push($aryOf_Data, array($genre_Id, $genre_Name, $numOf_Entries));
			
			// total
			$total += $numOf_Entries;
			
		}//for ($i = 0; $i < $lenOf_AryOf_Genres; $i++)
		
// 		debug($aryOf_Data);
		
		/*******************************
			sort
		*******************************/
		// sort
		$sort_Direction = "DESC";
		
		$aryOf_Data = Utils_2::sort_Stats_Top10__Genres($aryOf_Data, $sort_Direction);
		
		/*******************************
			variables
		*******************************/
		$this->set("aryOf_Data", $aryOf_Data);
		
		$this->set("numOf_Geschichte_Total", $total);
		
		/*******************************
			genre + category
		*******************************/
		$this->_stats__Top10s__Genre_Category();
		
	}//_stats__Top10s()
	
	public function
	_stats__Top10s__Genre_Category() {
		
		/*******************************
			genres
		*******************************/
		$this->loadModel('Geschichte');
		
		$geschichtes = $this->Geschichte->find('all');
		
		$numOf_Geschichtes = count($geschichtes);
		
		$lenOF_AryOf_Genres = 20;
		$lenOF_AryOf_Categories = 170;
		
		$aryOf_Data = array();
		
		for ($i = 0; $i < $lenOF_AryOf_Genres; $i++) {

			for ($j = 0; $j < $lenOF_AryOf_Categories; $j++) {
			
				$aryOf_Data["$i,$j"] = 0;
				
			}//for ($j = 0; $j < $lenOF_AryOf_Categories; $j++)
			
			
		}//for ($i = 0; $i < $lenOF_AryOf_Genres; $i++)
		
		
		//ref https://webkaru.net/php/function-array-fill/
// 		$aryOf_Genres_tmp = array_fill(0, $lenOF_AryOf_Genres, 0);
// 		$aryOf_Genres_tmp = array_fill(0, 20, 0);

// 		$aryOf_Data = array_fill(0, $lenOF_AryOf_Genres, 0);
		
// 		for ($i = 0; $i < $lenOF_AryOf_Genres; $i++) {
		
// 			$aryOf_Data[$i] = array_fill(0,$lenOF_AryOf_Categories,0);
// // 			$aryOf_Genres_tmp[$i] = array_fill(0,$lenOF_AryOf_Categories,0);
// // 			$aryOf_Genres_tmp[$i] = array_fill(0,5,0);
			
// 		}//for ($i = 0; $i < $lenOF_AryOf_Genres; $i++)
		
// 		foreach ($aryOf_Genres_tmp as $a) {
// // 		foreach ($aryOf_Genres_tmp as $a) {
		
// 			array_push($a, array_fill(0, 5, 0));
// // 			$a = array_fill(0, 5, 0);
			
// 		}//foreach ($aryOf_Genres_tmp as $a)
		
		
// 		$aryOf_Genres_tmp[8] = array_fill(0,5,0);
		
// 		debug("\$aryOf_Genres_tmp =>");
// 		debug($aryOf_Genres_tmp);
		
// 		$aryOf_Categories_tmp = array_fill(0, 170, 0);
		
// 		debug($aryOf_Genres);

// 		$aryOf_Data = array();
		
		foreach ($geschichtes as $g) {
		
			$genre_Id = $g['Geschichte']['genre_id'];
			
			$cat_Id = $g['Geschichte']['category_id'];

			// modify : category id
			$cat_Id = ($cat_Id == -1) ? 0 : $cat_Id;
			
// 			$aryOf_Data[intval($genre_Id)][intval($cat_Id)] += 1;
			
			$aryOf_Data["$genre_Id,$cat_Id"] += 1;
			
// 			$tmp_Ary = array($genre_Id, $cat_Id);
			
// 			array_push($aryOf_Data, )
			
// 			$aryOf_Genres_tmp[intval($genre_Id)] += 1;
			
		}//foreach ($geschichtes as $g)
		
// 		debug($aryOf_Genres_tmp);
		
// 		$aryOf_Genres = array_slice($aryOf_Genres_tmp, 10, 8);
		
// 		debug($aryOf_Genres);
// 		debug($aryOf_Data);
		
		/*******************************
		 sort
		 *******************************/
		// sort
		//ref http://php.net/manual/ja/function.arsort.php
		arsort($aryOf_Data);
		
// 		debug(array_slice($aryOf_Data, 0, 20));
		
// 		$sort_Direction = "DESC";

// 		$aryOf_Data = Utils_2::sort_Stats_Top10__GenresANDCategories($aryOf_Data, $sort_Direction);
		
		
		
		/*******************************
			build list
		*******************************/
		
// 		$aryOf_Data = array();
		
// 		$lenOf_AryOf_Genres = count($aryOf_Genres);
		
// 		$total = 0;
		
// 		for ($i = 0; $i < $lenOf_AryOf_Genres; $i++) {
		
// 			$genre_Id = $i + 10;
			
// 			$numOf_Entries = $aryOf_Genres[$i];
			
// 			$genre = Utils::get_Genre_From_Genre_Id($genre_Id);

// // 			debug($genre);
			
// 			$genre_Name = $genre['Genre']['name'];
			
// 			array_push($aryOf_Data, array($genre_Id, $genre_Name, $numOf_Entries));
			
// 			// total
// 			$total += $numOf_Entries;
			
// 		}//for ($i = 0; $i < $lenOf_AryOf_Genres; $i++)
		
// // 		debug($aryOf_Data);
		


		/*******************************
			variables
		*******************************/
		$numOf_Data_To_Show = 30;

		$this->set("aryOf_Data__Genres_And_Categories", array_slice($aryOf_Data, 0, $numOf_Data_To_Show));
// 		$this->set("aryOf_Data", array_slice($aryOf_Data, 0, $numOf_Data_To_Show));
// 		$this->set("aryOf_Data", $aryOf_Data);
		
		$this->set("numOf_Geschichtes", $numOf_Geschichtes);
		
	}//_stats__Top10s__Genre_Category
	
	public function
	stats() {

		/*******************************
			total
		*******************************/

		$pieces = $this->Piece->find('all');
		
		$numOf_Pieces_Total = count($pieces);
		
		/*******************************
			品詞
		*******************************/
		$data_2 = $this->_stats__Hinshis($numOf_Pieces_Total);

		// sort
		$sort_Direction = "DESC";
		
		$data_2 = Utils_2::sort_Stats_Data__By_Data($data_2, $sort_Direction);
		
		/*******************************
			助詞
		*******************************/
		$target = '助詞';
		
		$option = array(
		
			'conditions'	=> array(
			
				"Piece.hin"	=> $target
			
			)
		
		);
		
		$numOf_Pieces_Total__Joshis = count($this->Piece->find('all', $option));
		
		$data_Joshis = $this->_stats__Joshis($target, $numOf_Pieces_Total__Joshis);
// 		$data_Joshis = $this->_stats__Joshis('助詞', $numOf_Pieces_Total);
		
		// sort
		$sort_Direction = "DESC";
		
		$data_Joshis = Utils_2::sort_Stats_Data__By_Data($data_Joshis, $sort_Direction);
// 		Utils_2::sort_Stats_Data__By_Data($data_Joshis);
		
		/*******************************
			名詞
		*******************************/
		$target = '名詞';
		
		$option = array(
		
			'conditions'	=> array(
			
				"Piece.hin"	=> $target
			
			)
		
		);
		
		$numOf_Pieces_Total__Nouns = count($this->Piece->find('all', $option));
		
		$data_Nouns = $this->_stats__Nouns($target, $numOf_Pieces_Total__Nouns);
		
		// sort
		$sort_Direction = "DESC";
		
		$data_Nouns = Utils_2::sort_Stats_Data__By_Data($data_Nouns, $sort_Direction);
		
		/*******************************
			記号
		*******************************/
		$target = '記号';
		
		$option = array(
		
			'conditions'	=> array(
			
				"Piece.hin"	=> $target
			
			)
		
		);
		
		$numOf_Pieces_Total__Symbols = count($this->Piece->find('all', $option));
		
		$data_Symbols = $this->_stats__Symbols($target, $numOf_Pieces_Total__Symbols);
		
		// sort
		$sort_Direction = "DESC";
		
		$data_Symbols = Utils_2::sort_Stats_Data__By_Data($data_Symbols, $sort_Direction);

		/*******************************
			top 10s
		*******************************/
		$this->_stats__Top10s();
		
		/*******************************
			set : variables
		*******************************/
		$this->set("numOf_Pieces_Total", $numOf_Pieces_Total);
		$this->set("numOf_Pieces_Total__Joshis", $numOf_Pieces_Total__Joshis);
		
		$this->set("data_2", $data_2);
		
		$this->set("data_Joshis", $data_Joshis);
		
		$this->set("data_Nouns", $data_Nouns);
		
		$this->set("data_Symbols", $data_Symbols);

		/*******************************
			views
		*******************************/
		$this->render("/Pieces/stats");
		
	}//stats() {

	public function
	svo_table() {

		/*******************************
			query
		*******************************/
		$dflt_Geschichte_Id = 74;
		
		@$query_Geschichte_Id = $this->request->query['geschichte_id'];
		
		if ($query_Geschichte_Id == null) {
		
			$query_Geschichte_Id = $dflt_Geschichte_Id;
				
			debug("geschichte id ==> null; set to $dflt_Geschichte_Id");
		
		} else if ($query_Geschichte_Id == '') {
				
			$query_Geschichte_Id = $dflt_Geschichte_Id;
				
			debug("geschichte id ==> ''; set to $dflt_Geschichte_Id");
				
		} else {
		
			$query_Geschichte_Id = intval($query_Geschichte_Id);
				
// 			debug("geschichte id ===> set to $query_Geschichte_Id");
				
		}//if ($query_Geschichte_Id == null)
		
		/*******************************
		 get : sentence
		 *******************************/
		$this->loadModel('Geschichte');
		
// 		$geschichtes = $this->Geschichte->find('all');
		
		$option = array(
				
				'conditions' => array(

						'Geschichte.id'	=> $query_Geschichte_Id
				)
		);
		
		
		// 		debug($geschichtes[40]);	// 'line' => '土星の衛星、生命存在の環境整う？　水素分子を検出(4/14)  ',
		
		$geschichte_Target = $this->Geschichte->find('first', $option);
// 		$geschichte_Target = $geschichtes[$query_Geschichte_Id];
		
		// validate
		if ($geschichte_Target == null) {
		
			debug("geschichte => null : id = $query_Geschichte_Id");
		
			return;
			
		}//if ($geschichte_Target == null)
		;
		
		$sen = $geschichte_Target['Geschichte']['content'];
// 		$sen = $geschichtes[40]['Geschichte']['content'];
		
		$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$sen";
		
		$xml = simplexml_load_file($url);
		
		$result = Utils_2::conv_Xml_2_AryOf_Pieces_3($xml, $geschichte_Target);
		// 		$result = Utils_2::conv_Xml_2_AryOf_Pieces_3($xml);
		
		// 		debug($xml);
		
		
		// 		debug($result);
		$aryOf_Symbolized_Sentence = array();
		
		foreach ($result as $piece) {
		
			$ary_Temp= null;
				
			$ary_Temp = array(
		
					$piece['Piece']['form'],
					($piece['Piece']['hin'] == '記号') ?
					$piece['Piece']['form']
					: CONS::$Hin_Symbols[$piece['Piece']['hin']]
			);
				
			array_push($aryOf_Symbolized_Sentence, $ary_Temp);
				
		}//foreach ($result as $piece)
		
			// 		debug($aryOf_Symbolized_Sentence);
		
		/*******************************
		 rebuild : sentence
		 *******************************/
		$sen_New = "";
		$sen_Symbolized = "";
		
		foreach ($aryOf_Symbolized_Sentence as $item) {
		
			$sen_New .= $item[0];
				
			$sen_Symbolized .= $item[1];
				
		}//foreach ($aryOf_Symbolized_Sentence as $item)
		
		/*******************************
		 build : pairs
		 *******************************/
		$pairOf_Sens_Symbols = Utils_2::build_PairOf_Sens_Symbols($sen_New, $sen_Symbolized);
		
		/*******************************
		 set : variables
		 *******************************/
		$this->set("sen_New", $sen_New);
		
		$this->set("sen_Symbolized", $sen_Symbolized);
		
		$this->set("pairOf_Sens_Symbols", $pairOf_Sens_Symbols);
		
		$this->set("query_Geschichte_Id", $query_Geschichte_Id);
		
		/**********************************
		 * view
		 **********************************/
		$this->layout = 'plain';

		/*******************************
		 views
		 *******************************/
		$this->render("/Pieces/svo_table");
		
	}//svo_table()
	
	public function
	svo() {

		/*******************************
			get : sentence
		*******************************/
		$this->loadModel('Geschichte');
		
		$geschichtes = $this->Geschichte->find('all');

// 		debug($geschichtes[40]);	// 'line' => '土星の衛星、生命存在の環境整う？　水素分子を検出(4/14)  ',
		
		$sen = $geschichtes[40]['Geschichte']['content'];
		
		$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$sen";
		
		$xml = simplexml_load_file($url);

		$result = Utils_2::conv_Xml_2_AryOf_Pieces_3($xml, $geschichtes[40]);
// 		$result = Utils_2::conv_Xml_2_AryOf_Pieces_3($xml);
		
// 		debug($xml);

// 		debug($result);
		
		$aryOf_Symbolized_Sentence = array();
		
		foreach ($result as $piece) {
		
			$ary_Temp= null;
			
			$ary_Temp = array(
				
					$piece['Piece']['form'],
					($piece['Piece']['hin'] == '記号') ?
						$piece['Piece']['form']
						: CONS::$Hin_Symbols[$piece['Piece']['hin']]
			);
			
			array_push($aryOf_Symbolized_Sentence, $ary_Temp);
			
		}//foreach ($result as $piece)
		
// 		debug($aryOf_Symbolized_Sentence);

		/*******************************
			rebuild : sentence
		*******************************/
		$sen_New = "";
		$sen_Symbolized = "";
		
		foreach ($aryOf_Symbolized_Sentence as $item) {
		
			$sen_New .= $item[0];
			
			$sen_Symbolized .= $item[1];
			
		}//foreach ($aryOf_Symbolized_Sentence as $item)

		/*******************************
			build : pairs
		*******************************/
		$pairOf_Sens_Symbols = Utils_2::build_PairOf_Sens_Symbols($sen_New, $sen_Symbolized);
		
		/*******************************
			set : variables
		*******************************/
		$this->set("sen_New", $sen_New);
		
		$this->set("sen_Symbolized", $sen_Symbolized);
		
		$this->set("pairOf_Sens_Symbols", $pairOf_Sens_Symbols);

		/*******************************
		 views
		 *******************************/
		$this->render("/Pieces/svo");
		
		
	}//svo() {
	
}