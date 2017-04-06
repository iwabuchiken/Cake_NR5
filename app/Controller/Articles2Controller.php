<?php

class Articles2Controller extends AppController {
// class ArticlesController extends AppController {
	public $helpers = array('Html', 'Form', 'Mytest');
// 	public $helpers = array('Html', 'Form');

	public function 
	index() {

		/*******************************
			build: articles
		*******************************/
		$genre_id = $this->test_2_1_1_build_genres_list();
		
// 		$articles = $this->test_1_1_3_build_articles_list();
		$ahrefs_articles = $this->test_1_1_3_build_articles_list();
		
		/******************** (20 '*'s)
		 *
		 * set: articles
		 *
		 ********************/
		$this->set("articles", $ahrefs_articles);
		
// 		debug("articles => set"."(".count($ahrefs_articles)." articles)");
		
		/*******************************
			categorize
		*******************************/
		$articles_categorized = $this->categorize_articles($ahrefs_articles, $genre_id);
		
		$this->set("articles_categorized", $articles_categorized);

		/*******************************
			view: swtich
		*******************************/
		$test = @$this->request->query['test'];
		
		if (isset($test)) {
		
			debug("test view --> used");
			
			$this -> render('index_2');
			
		} else {//if (isset($test))

			debug("test view --> NOT used");

		}
		
		
		
	}//index()

	function test_1_1_1_get_html_content() {

		/******************** (20 '*'s)
		 *
		 * get: url content
		 *
		 * ref: app\Controller\ArticlesController.php\__index_Get_Articles__Top
		 *
		 ********************/
		$name_genre = "tech_science";
		
		$url = "http://www.asahi.com/".$name_genre."/list/";
		// 		$url = "http://headlines.yahoo.co.jp/hl?c=$genre&t=l";
		
		//REF http://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/
		$html = file_get_html($url);
		
		// hrefs
		$ahrefs = $html->find('a[href]');
		
		debug("\$ahrefs => ".count($ahrefs));
		
		// validate
		if (count($ahrefs) < 1) {
			
			debug("\$ahrefs => less than 1");
			
			return;
			
		}
		
// 		//debug	//=> Error: Allowed memory size of 134217728 bytes exhausted (tried to allocate 73330 bytes)	
// 		if (count($ahrefs) > 0) {
// // 		if (count($ahrefs) > 5) {
		
		//ref http://php.net/manual/ja/function.array-slice.php
// // 			debug(array_slice($ahrefs, 0, 3));
// 			debug($ahrefs[0]);
	
		
// 		} else {
		
// 			debug("\$ahrefs => less than 1");
			
// 		}//if (count($ahrefs) > 5)

		/******************** (20 '*'s)
		*
		* show href value
		*
		********************/
		$count = 0;
		$max = 5;

		foreach ($ahrefs as $ahref) {
			
			debug("\$ahref->href => $ahref->href");
			//ref http://php.net/manual/ja/function.mb-strlen.php
			debug("\$ahref->plaintext => $ahref->plaintext"." (".mb_strlen($ahref->plaintext).") chars");
// 			debug("\$ahref->plaintext => $ahref->plaintext"." (".count($ahref->plaintext).") chars");
// 			debug("\$ahref => $ahref");
			
// 			debug("get_class(\$ahref->plaintext) => ".get_class($ahref->plaintext));
			
			$count += 1;
			
			if ($count > $max) {
				
				break;
				
			}
		
// 			if (Utils::startsWith($ahref->href, "http://headlines")
// 					&& count(explode("-", $ahref->href)) > 3) {
		
// 						array_push($ahrefs_hl, $ahref);
		
// 					}
		
		}//foreach ($ahrefs as $ahref)

		
		
		
	}//test_1_1_1_get_html_content()

	function test_1_1_2_get_hrefs_for_articles() {
		
		/******************** (20 '*'s)
		 *
		 * get: url content
		 *
		 * ref: app\Controller\ArticlesController.php\__index_Get_Articles__Top
		 *    : test_1_1_1_get_html_content()
		 *
		 ********************/
		$name_genre = "tech_science";
		
		$url = "http://www.asahi.com/".$name_genre."/list/";
		
		//REF http://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/
		$html = file_get_html($url);
		
		// hrefs
		$ahrefs = $html->find('a[href]');
		
		debug("\$ahrefs => ".count($ahrefs));
		
		// validate
		if (count($ahrefs) < 1) {
				
			debug("\$ahrefs => less than 1");
				
			return;
				
		}
		
		/******************** (20 '*'s)
		 *
		 * filter: hrefs for articles
		 *
		 ********************/
		$ahrefs_articles = array();
		
// 		$count = 0;
// 		$max = 5;
		
		foreach ($ahrefs as $ahref) {

			//ref view-source:http://www.asahi.com/tech_science/list/
			
			if (Utils::startsWith($ahref->href, "/articles")) {
// 			if (Utils::startsWith($ahref->href, "http://headlines")
// 					&& count(explode("-", $ahref->href)) > 3) {

						array_push($ahrefs_articles, $ahref);

			}//if (Utils::startsWith($ahref->href, "/articles"))
		
		}//foreach ($ahrefs as $ahref)
			
		//debug
		debug("count(\$ahrefs_articles) => ".count($ahrefs_articles));
		
	}//function test_1_1_2_get_hrefs_for_articles()

	function test_1_1_3_build_articles_list() {
		
		/******************** (20 '*'s)
		 *
		 * get: url content
		 *
		 * ref: app\Controller\ArticlesController.php\__index_Get_Articles__Top
		 *    : test_1_1_1_get_html_content()
		 *
		 ********************/
		/**************************************************************
		 add: asahi articles
		 **************************************************************/
		$ahrefs_articles = array();
		
		$ahrefs_articles = $this->get_articles_list_Asahi($ahrefs_articles);

		//debug
		debug("(re) count(\$ahrefs_articles) => ".count($ahrefs_articles));

		/**************************************************************
			add: nikkei articles
		**************************************************************/
		// add
		$ahrefs_articles = $this->get_articles_list_Nikkei($ahrefs_articles);

		//debug
		debug("count(\$ahrefs_articles) (nikkei site added) => ".count($ahrefs_articles));

		/*******************************
			return
		*******************************/
		return $ahrefs_articles;
		
// 		/******************** (20 '*'s)
// 		*
// 		* set: articles
// 		*
// 		********************/
// 		$this->set("articles", $ahrefs_articles);
		
// 		debug("articles => set"."(".count($ahrefs_articles)." articles)");
		
	}//function test_1_1_3_build_articles_list()

	function get_articles_list_Asahi($ahrefs_articles) {
		
		/******************** (20 '*'s)
		 *
		 * get: url content
		 *
		 * ref: app\Controller\ArticlesController.php\__index_Get_Articles__Top
		 *    : test_1_1_1_get_html_content()
		 *
		 ********************/
		/*******************************
			get: genre name
		*******************************/
		$genre_name = @$this->request->query['genre_name'];
		
		$genre_id = @$this->request->query['genre_id'];

		$genres_List = $this->get_genres_list_Generic('asahi');
// 		$genres_List = $this->get_genres_list_Asahi();
		
// 		debug($genres_List);
		
// 		debug("\$genre_id => ".$genre_id);

		if ($genre_id == NULL) {

// 			debug("genre id => NULL");
	
			$name_genre = "tech_science";

		} else if ($genre_id == "") {

			debug("genre id => blank");
	
			$name_genre = "tech_science";
	
		} else {
	
// 			debug("genre id => $genre_id");
	
			$name_genre = $genres_List[$genre_id];
	
		}//if ($genre_id == NULL)

		debug("\$name_genre (asahi) => ".$name_genre);
		
		/*******************************
			build hrefs list
		*******************************/
// 		http://www.asahi.com/business/list/finance.html
		if ($genre_id >= 16) {
// 		if ($genre_id >= 6) {

			$url = "http://www.asahi.com/business/list/".$name_genre.".html";
		
		} else {
		
			$url = "http://www.asahi.com/".$name_genre."/list/";
			
		}//if ($genre_id >= 5)
		
		
// 		$url = "http://www.asahi.com/".$name_genre."/list/";
		
		//REF http://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/
		$html = file_get_html($url);
		
		// hrefs
		$ahrefs = $html->find('a[href]');
		
// 		debug("\$ahrefs => ".count($ahrefs));
		
		// validate
		if (count($ahrefs) < 1) {
				
			debug("\$ahrefs => less than 1");
				
			return;
				
		}
		
		/******************** (20 '*'s)
		*
		* build: articles list
		*
		********************/
		// load model
		$this->loadModel('Article');
		
		$count = 0; $max = 5;
		
		//test
		mb_language("Japanese");
		
		$max = 4; $count = 0;
		
		foreach ($ahrefs as $ahref) {
		
			//ref view-source:http://www.asahi.com/tech_science/list/
				
			if (Utils::startsWith($ahref->href, "/articles")) {
				// 			if (Utils::startsWith($ahref->href, "http://headlines")
				// 					&& count(explode("-", $ahref->href)) > 3) {
				
				$a = $this->Article->create();
				
				$a['url'] = "http://www.asahi.com".$ahref->href;
// 				$a['url'] = $ahref->href;
				
				$a['line'] = mb_convert_encoding($ahref->plaintext, 'UTF-8');
// 				$a['line'] = $ahref->plaintext;

				$a['vendor'] = "www.asahi.com";
		
				array_push($ahrefs_articles, $a);
				
			}//if (Utils::startsWith($ahref->href, "/articles"))
		
		}//foreach ($ahrefs as $ahref)
		
		//debug
// 		debug("(re) count(\$ahrefs_articles) => ".count($ahrefs_articles));
		
		/*******************************
			return
		*******************************/
		return $ahrefs_articles;

	}//get_articles_list_Asahi($ahrefs_articles)

	function get_articles_list_Nikkei($ahrefs_articles) {
		
		/******************** (20 '*'s)
		 *
		 * get: url content
		 *
		 * ref: app\Controller\ArticlesController.php\__index_Get_Articles__Top
		 *    : test_1_1_1_get_html_content()
		 *
		 ********************/
		/*******************************
			get: genre name
		*******************************/
// 		$genre_name = @$this->request->query['genre_name'];
		
		$genre_id = @$this->request->query['genre_id'];

		$genres_List = $this->get_genres_list_Generic('nikkei');
// 		$genres_List = $this->get_genres_list_Nikkei();

// 		$select_Genres[0] = "tech_science";
// 		$select_Genres[1] = "international";
// 		$select_Genres[2] = "national";
// 		$select_Genres[3] = "politics";
// 		$select_Genres[4] = "business";
// 		$select_Genres[5] = "eco";
		
		if ($genre_id == NULL) {

// 			debug("genre id => NULL");
	
			$name_genre = $genres_List[10];
// 			$name_genre = "science";
// 			$name_genre = "tech_science";

		} else if ($genre_id == "") {

			debug("genre id => blank");
	
			$name_genre = $genres_List[10];
	
		} else {
	
// 			debug("genre id => $genre_id");
	
			$name_genre = $genres_List[$genre_id];
	
		}//if ($genre_id == NULL)

		debug("\$name_genre (nikkei) => ".$name_genre);
		
		/*******************************
			build hrefs list
		*******************************/
// 		$url = "http://www.asahi.com/".$name_genre."/list/";
		$url = "http://www.nikkei.com/news/category/$name_genre/";
		
		//REF http://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/
		$html = file_get_html($url);
		
		// hrefs
		$ahrefs = $html->find('a[href]');
		
// 		$div_h4s = $html->find("div[class='cmn-section cmn-indent'] ul li h4");
// // 		$div_h4s = $html->find("div[class='cmn-section cmn-indent']");
		
// 		debug($div_h4s != null ? "count(\$div_h4s) => ".count($div_h4s) : "\$div_h4s => null");	//=> 18
		
// 		//debug
// 		foreach ($div_h4s as $h4) {
		
// 			debug($h4->plaintext);
// // 			debug($h4);
			
// 		}//foreach ($div_h4s as $h4)
		
		

// 		debug($div_h4s);
// 		debug($div_h4s->a);
// 		debug($div_h4s[0]);	//=> n.w.
		
// 		$div_ahrefs = $div_h4s->ul;	//=> "Trying to get property of non-object"
// // 		$div_ahrefs = $div_h4s->ul->li->h4;
		
// 		debug($div_ahrefs != null ? "count(\$div_ahrefs) => ".count($div_ahrefs) : "\$div_ahrefs => null");
		
// 		debug("\$ahrefs => ".count($ahrefs));
		
		// validate
		if (count($ahrefs) < 1) {
				
			debug("\$ahrefs => less than 1");
				
			return;
				
		}
		
		/******************** (20 '*'s)
		*
		* build: articles list
		*
		********************/
		// load model
		$this->loadModel('Article');
		
		$count = 0; $max = 5;
		
		//test
		mb_language("Japanese");
		
		$max = 4; $count = 0;
		
		foreach ($ahrefs as $ahref) {

			if (Utils::startsWith($ahref->href, "/article")
						
					&& !isset($ahref->class)
						
					) {
						
				$a = $this->Article->create();
	
				$a['url'] = "http://www.nikkei.com".$ahref->href;
				// 				$a['url'] = "http://www.asahi.com".$ahref->href;
				// 				$a['url'] = $ahref->href;
	
				$a['line'] = mb_convert_encoding($ahref->plaintext, 'UTF-8');
				// 				$a['line'] = $ahref->plaintext;
	
				$a['vendor'] = "www.nikkei.com";
	
				array_push($ahrefs_articles, $a);
	
				// count
				$count ++;
				
			}
		}//foreach ($ahrefs as $ahref)
		
		//debug
// 		debug("(re) count(\$ahrefs_articles) => ".count($ahrefs_articles));
		
		/*******************************
			return
		*******************************/
		return $ahrefs_articles;

	}//get_articles_list_Nikkei

	function test_2_1_1_build_genres_list() {

		/*******************************
			genres list
		*******************************/
		$this->loadModel('Genre');
		
		$select_Genres = $this->get_genres_list_Asahi();
		
// 		$select_Genres = array();
		
// 		// tech_science, international, national, politics, business, eco
// 		$select_Genres[0] = "tech_science";
// 		$select_Genres[1] = "international";
// 		$select_Genres[2] = "national";
// 		$select_Genres[3] = "politics";
// 		$select_Genres[4] = "business";
// 		$select_Genres[5] = "eco";
		
		// set
		$this->set('select_Genres', $select_Genres);

// 		debug($select_Genres);
		
// 		debug(array_keys($select_Genres));
		
		/*******************************
			genre id
		*******************************/
		$genre_id = @$this->request->query['genre_id'];
		
		if ($genre_id == NULL) {
		
			debug("genre id => NULL");
			
			$genre_id = array_keys($select_Genres)[0];
// 			$genre_id = $select_Genres[10];
		
// 			$name_genre = "tech_science";
		
		} else if ($genre_id == "") {
		
			debug("genre id => blank");
		
// 			$name_genre = "tech_science";
			
			$genre_id = array_keys($select_Genres)[0];
// 			$genre_id = $select_Genres[10];
		
		} else {
		
// 			debug("genre id => $genre_id");
			// 			debug("genre name => unknown type ---> ");
			// 			debug($genre_id);
		
// 			$name_genre = $genres_List[$genre_id];
			// 			$name_genre = $genre_id;
			// 			$name_genre = "tech_science";
		
		}//if ($genre_id == NULL)
		
// 		debug("\$name_genre => ".$name_genre);
		
		/*******************************
			set: genre id
		*******************************/
		debug("\$genre_id => ".$genre_id);
		
		
		$this->set("genre_id", $genre_id);
		
		/*******************************
			return
		*******************************/
		return $genre_id;
		
	}//test_2_1_1_build_genres_list()

	function get_genres_list_Asahi() {

		$select_Genres = array();
		
		// tech_science, international, national, politics, business, eco
		$select_Genres[10] = "tech_science";
		$select_Genres[11] = "international";
		$select_Genres[12] = "national";
		$select_Genres[13] = "politics";
		$select_Genres[14] = "business";
		$select_Genres[15] = "eco";
		
		$select_Genres[16] = "industry";
		$select_Genres[17] = "finance";
		
		// return
		return $select_Genres;
	}//get_genres_list_Asahi()
	
	function get_genres_list_Nikkei() {

		$select_Genres = array();
		
		// asahi.com
		// tech_science, international, national, politics, business, eco
// 		$select_Genres[10] = "tech_science";
// 		$select_Genres[11] = "international";
// 		$select_Genres[12] = "national";
// 		$select_Genres[13] = "politics";
// 		$select_Genres[14] = "business";
// 		$select_Genres[15] = "eco";
// 		$select_Genres[16] = "industry";
// 		$select_Genres[17] = "finance";
		
		// nikkei.com
		$select_Genres[10] = "science";
		$select_Genres[11] = "world";
		$select_Genres[12] = "national";
		$select_Genres[13] = "politics";
		$select_Genres[14] = "economy";
		$select_Genres[15] = "eco";
		$select_Genres[16] = "company";
		$select_Genres[17] = "markets";
		
		/*******************************
			use GenreName model
		*******************************/
		$this->loadModel('GenreName');
		
		$genre_names_Asahi = $this->GenreName->find(
				
				'all',
				//ref conditions https://book.cakephp.org/2.0/ja/models/retrieving-your-data.html
				array('conditions' => 
						
							array(
									'media_name'	=> 'asahi',
									
							)
					, 'order' =>
						
							array('GenreName.genre_id'	=> 'asc')
// 							array('GenreName.id_master'	=> 'asc')
						
				)
				
		);
		
		debug("count(\$genre_names_Asahi) => ".count($genre_names_Asahi));

		//test
// 		$this->get_genres_list_Generic('nikkei');
// 		$this->get_genres_list_Generic('asahi');
		
		
		// return
		return $select_Genres;
	}//get_genres_list_Nikkei()

	function get_genres_list_Generic($media_name) {

		$select_Genres = array();
		
		// asahi.com
		// tech_science, international, national, politics, business, eco
// 		$select_Genres[10] = "tech_science";
// 		$select_Genres[11] = "international";
// 		$select_Genres[12] = "national";
// 		$select_Genres[13] = "politics";
// 		$select_Genres[14] = "business";
// 		$select_Genres[15] = "eco";
// 		$select_Genres[16] = "industry";
// 		$select_Genres[17] = "finance";
		
// 		// nikkei.com
// 		$select_Genres[10] = "science";
// 		$select_Genres[11] = "world";
// 		$select_Genres[12] = "national";
// 		$select_Genres[13] = "politics";
// 		$select_Genres[14] = "economy";
// 		$select_Genres[15] = "eco";
// 		$select_Genres[16] = "company";
// 		$select_Genres[17] = "markets";
		
		/*******************************
			use GenreName model
		*******************************/
		$this->loadModel('GenreName');
		
		$genre_names_Asahi = $this->GenreName->find(
				
				'all',
				//ref conditions https://book.cakephp.org/2.0/ja/models/retrieving-your-data.html
				array('conditions' => 
						
							array(
									'media_name'	=> $media_name,
// 									'media_name'	=> 'asahi',
									
							)
					, 'order' =>
						
							array('GenreName.genre_id'	=> 'asc')
// 							array('GenreName.id_master'	=> 'asc')
						
				)
				
		);
		
// 		debug("$media_name => ".count($genre_names_Asahi));

		// build array
		foreach ($genre_names_Asahi as $genre_name) {
		
			$select_Genres[$genre_name['GenreName']['genre_id']] = 
// 			$select_Genres[$genre_name['GenreName']['id_master']] = 
						$genre_name['GenreName']['genre_name'];
			
		}//foreach ($genre_names_Asahi as $genre_name)
		
		//debug
// 		debug($select_Genres);
		
		// return
		return $select_Genres;
		
	}//get_genres_list_Generic($media_name)

	function convto_categorized_articles($ahrefs_articles) {
	
		// new array
		$categorized_articles = array();

		// genre id
		$genre_id = @$this->request->query['genre_id'];
		
		if ($genre_id == NULL) {
		
			debug("genre id => NULL");
		
			$name_genre = "tech_science";
		
		} else if ($genre_id == "") {
		
			debug("genre id => blank");
		
			$name_genre = "tech_science";
		
		} else {
		
			// 			debug("genre id => $genre_id");
		
			$name_genre = $genres_List[$genre_id];
		
		}//if ($genre_id == NULL)
		
	}

	function categorize_articles($ahrefs_articles, $genre_id) {
// 	function categorize_articles($articles) {
		
		/*******************************
			test
		*******************************/
// 		debug($ahrefs_articles[0]);
		
		/*******************************
			build: keywords list
		*******************************/
		$genre_category_keyword_2 = array();

		$genre = Utils::get_Genre_From_Genre_Id($genre_id);
		
		$genre_name = $genre['Genre']['name'];
		
		debug("\$genre_name => ".$genre_name);
		
		// build list
		$genre_category_keyword_2 = 
					Utils::get_GenreCategoryKeyword_List($genre_id);
		
		/**************************************************************
			categorize
		**************************************************************/
		/*******************************
			iterate: keywords
		*******************************/
		$listof_cat_and_kws = $genre_category_keyword_2[2];

// 		debug($listof_cat_and_kws);
		
		$listof_cat_name_and_kw_id_and_article_id = 
			$this->_categorize_articles__get_CatName_KwId_ArticleIndex_list(
					$ahrefs_articles,
					$listof_cat_and_kws);
		
// 		debug("\$listof_cat_name_and_kw_id_and_article_id =>");
// 		debug($listof_cat_name_and_kw_id_and_article_id);

		/*******************************
			build: final list
		*******************************/
		$categorized_articles = 
				$this->_categorize_articles__build_final_list(
							$genre_name,
							$ahrefs_articles,
							$listof_cat_name_and_kw_id_and_article_id);

		/*******************************
			return
		*******************************/
		return $categorized_articles;
		
	}//categorize_articles($articles)

	function 
	_categorize_articles__build_final_list
	($genre_name, $ahrefs_articles, $listof_cat_name_and_kw_id_and_article_id) {
	
		/*******************************
			load model: Keyword
		*******************************/
		$this->loadModel('Keyword');
		
		/*******************************
			arrays
		*******************************/
		$final_list = array($genre_name);
		
		
		
		/*******************************
			iterate: category
		*******************************/
		$setof_cat_and_articles = array();
		
		// list of article nums ---> others
		$listof_article_nums_categorized = array();
		
		foreach ($listof_cat_name_and_kw_id_and_article_id as $cat_and_kws) {
		
			/*******************************
				arrays
			*******************************/
// 			$setof_cat_and_articles = array();
			
			$listof_ahrefs_modified = array();
			
			/*******************************
				vars
			*******************************/
			$cat_name = $cat_and_kws[0];
			
// 			debug("\$cat_and_kws[0] => ".$cat_name);
			
			/*******************************
				iterate: keywords
			*******************************/
			$lenof_keyword_article_pairs = count($cat_and_kws[1]);
			
			for ($i = 0; $i < $lenof_keyword_article_pairs; $i++) {
			
				$pair = $cat_and_kws[1][$i];
			
// 				debug("\$pair =>");
// 				debug($pair);
	
				$keyword_id = $pair[0];
				$article_num = $pair[1];
				
				/*******************************
					get: keyword instance
				*******************************/
				$kw = Utils::get_Keyword_From_Keyword_Id($keyword_id);
				
// 				debug($kw);

// 				debug($ahrefs_articles[$article_num]);
				
				array_push($listof_ahrefs_modified, 
						array(
								$ahrefs_articles[$article_num],
								$keyword_id
								
								, $kw['Keyword']['name']
								
						)
				);
				
				// add to categorized num array
				array_push($listof_article_nums_categorized, $article_num);

			}//for ($i = 0; $i < $lenof_keyword_article_pairs; $i++)
			
			/*******************************
				build array
			*******************************/
			array_push($setof_cat_and_articles, array($cat_name, $listof_ahrefs_modified));
			
		}//foreach ($listof_cat_name_and_kw_id_and_article_id as $cat_and_kws)

// 		debug("\$listof_article_nums_categorized =>");
// 		debug($listof_article_nums_categorized);

// 		debug("\$setof_cat_and_articles[0] =>");
// 		debug($setof_cat_and_articles[0]);

		/*******************************
			build: "others" list
		*******************************/
		$cat_others = array("others");
		
		$article_others = array();
	
		$lenof_ahrefs_articles = count($ahrefs_articles);

		for ($i = 0; $i < $lenof_ahrefs_articles; $i++) {
		
			if (!in_array($i, $listof_article_nums_categorized)) {
				
// 				debug("\not in array: \$i => $i: ".$ahrefs_articles[$i]['line']);
				
				array_push($article_others, $ahrefs_articles[$i]);
				
			}//if (in_array())
			;;
			
		}//for ($i = 0; $i < $lenof_ahrefs_articles; $i++)

// 		//debug
// 		debug("count(\$article_others) =>");
// 		debug(count($article_others));
		
		// build category array
		array_push($cat_others, $article_others);
		
// 		debug("\$cat_others =>");
// 		debug($cat_others);
		
		// add "others" to --> the set
		array_push($setof_cat_and_articles, $cat_others);
		
// 		debug("\$setof_cat_and_articles =>");
// 		debug($setof_cat_and_articles);
		
		/*******************************
			build: final list
		*******************************/
		array_push($final_list, $setof_cat_and_articles);
		
// 		debug("\$final_list =>");
// 		debug($final_list);
		// 		array(
		// 				(int) 0 => 'Tech & Science',
		// 				(int) 1 => array(
		// 						(int) 0 => array(
		// 								(int) 0 => 'computer',
		// 								(int) 1 => array(
		// 										(int) 0 => array(
		// 												(int) 0 => array(
		// 														'url' => 'http://www.asahi.com/articles/ASK444SBDK44PLBJ003.html',
		// 														'line' => 'あえてＡＩ使わずに　リアルに動くムカデロボ、３２本脚(4/5)  ',
		// 														'vendor' => 'www.asahi.com'
		// 												),
		// 												(int) 1 => '924'
		// 										),
		// 										(int) 1 => array(
		
// 		debug("\$final_list[1] =>");
// 		debug($final_list[1]);
		
// 		debug($final_list[1][0][0]);	//=> 'computer'
		
// 		debug($final_list[1][0][1][0][0]);
		// 		array(
		// 				'url' => 'http://www.asahi.com/articles/ASK444SBDK44PLBJ003.html',
		// 				'line' => 'あえてＡＩ使わずに　リアルに動くムカデロボ、３２本脚(4/5)  ',
		// 				'vendor' => 'www.asahi.com'
		// 		)
		
// 		debug(isset($final_list[1][0][1][0]) ? $final_list[1][0][1][0] : "\$final_list[1][0][1][0] => not set");
// 		debug($final_list[1][0][1][0]);
		// 		array(
		// 				(int) 0 => array(
		// 						'url' => 'http://www.asahi.com/articles/ASK444SBDK44PLBJ003.html',
		// 						'line' => 'あえてＡＩ使わずに　リアルに動くムカデロボ、３２本脚(4/5)  ',
		// 						'vendor' => 'www.asahi.com'
		// 				),
		// 				(int) 1 => '924',
		// 				(int) 2 => 'ＡＩ'
		// 		)
		
		// 		array(
		// 				(int) 0 => array(
		// 						(int) 0 => 'computer',
		// 						(int) 1 => array(
		// 								(int) 0 => array(
		// 										(int) 0 => '924',
		// 										(int) 1 => (int) 0
		// 								),
		// 								(int) 1 => array(
		// 										(int) 0 => '924',
		// 										(int) 1 => (int) 37
		// 								),
		// 								(int) 2 => array(
		// 										(int) 0 => '924',
		// 										(int) 1 => (int) 46
		// 								),
		// 								(int) 3 => array(
		// 										(int) 0 => '925',
		// 										(int) 1 => (int) 11
		// 								)
		// 						)
		// 				),
		// 				(int) 1 => array(
		// 						(int) 0 => 'biology',
		// 						(int) 1 => array(
		// 								(int) 0 => array(
		// 										(int) 0 => '923',

		
		/*******************************
			add: number of the articles
		*******************************/
		array_push($final_list, count($ahrefs_articles));
		
		/*******************************
			return
		*******************************/
		return $final_list;
		
	}//_categorize_articles__build_final_list
			
	function 
	_categorize_articles__get_CatName_KwId_ArticleIndex_list
	($ahrefs_articles, $listof_cat_and_kws) {
		
		$listof_cat_name_and_kw_id_and_article_id = array();
		
		$listof_hit_article_nums = array();
		
		foreach ($listof_cat_and_kws as $cat_and_kws) {

			$category_name = $cat_and_kws[1];
			
// 			debug("\$category_name => ".$category_name);
			
// 			array_push($listof_cat_name_and_kw_id_and_article_id, $category_name);
			
// 			$hit_articles_num = array($category_name);
// 			$hit_articles_num = array();
			
// 			debug("\$cat_and_kws =>");
// 			debug($cat_and_kws);
			// 			(int) 0 => '50',
			// 			(int) 1 => 'biology',
			// 			(int) 2 => array(
			// 					(int) 0 => array(
			// 							'Keyword' => array(
			// 									'id' => '923',
			// 									'created_at' => '04/02/2017 16:34:14',
			// 									'updated_at' => '04/02/2017 16:34:14',
			// 									'name' => 'ｉＰＳ',
			// 									'category_id' => '50'
			// 							),
			// 							'Category' => array(
			// 									'id' => '50',
			
// 			debug($cat_and_kws[2]);

			// prep
			$lenof_cat_and_kws_2 = count($cat_and_kws[2]);

			// pair of hit article and keyword
			$pairof_keyword_and_article = array();
				
			for ($i = 0; $i < $lenof_cat_and_kws_2; $i++) {	// keyword['Keyword'], keyword['Category']
// 			foreach ($cat_and_kws[2] as $c_w) {	// keyword['Keyword'], keyword['Category']
			
// 				debug($c_w);

// 				debug($c_w['Keyword']['name']);	//=> 'ＡＩ', and others

				/*******************************
					search
				*******************************/
				$keyword = $cat_and_kws[2][$i]['Keyword']['name'];
// 				$keyword = $c_w['Keyword']['name'];
				
				$lenof_ahrefs_articles = count($ahrefs_articles);
				
// 				// pair of hit article and keyword
// 				$pairof_keyword_and_article = array();
				
				for ($j = 0; $j < $lenof_ahrefs_articles; $j++) {
// 				foreach ($ahrefs_articles as $article) {
				
					$line = $ahrefs_articles[$j]['line'];
// 					$line = $article['line'];
					
					if (strpos($line, $keyword) !== false) {
						
// // 						echo 'true';
// 						debug("hit: keyword => $keyword"
// 								."(id = ".$cat_and_kws[2][$i]['Keyword']['id'].")"
// // 								."(id = ".$c_w['Keyword']['id'].")"
// 								." / "
// 								."line = $line");
						
						/*******************************
							validate
							
							if already the article is in the already hit array
								==> not enter into the hist array
						*******************************/
						if (in_array($j, $listof_hit_article_nums)) {

// 							debug("already hit: keyword => $keyword"
// 									."(id = ".$cat_and_kws[2][$i]['Keyword']['id'].")"
// 									// 								."(id = ".$c_w['Keyword']['id'].")"
// 									." / "
// 									."line = $line");
							
							// next article
							continue;
							
						}//if (condition)
						
						// push
						array_push($pairof_keyword_and_article, 
									array($cat_and_kws[2][$i]['Keyword']['id'], $j));
// 						array_push($hit_articles_num, array($cat_and_kws[2][$i]['Keyword']['id'], $j));
// 						array_push($hit_articles_num, $j);
// 						array_push($hit_articles_num, $i);

						// hist numbers
						array_push($listof_hit_article_nums, $j);
						
					}//if (strpos($line, $keyword) !== false)
					
				}//foreach ($ahrefs_articles as $article)

			}//for ($i = 0; $i < $lenof_cat_and_kws_2; $i++)
// 			}//foreach ($cat_and_kws as $value)

			// push
			array_push(
					$listof_cat_name_and_kw_id_and_article_id, 
					array($category_name, $pairof_keyword_and_article));
// 			array_push($listof_cat_name_and_kw_id_and_article_id, $pairof_keyword_and_article);

		}//foreach ($listof_cat_and_kws as $cat_and_kws)
		
		// return
		return $listof_cat_name_and_kw_id_and_article_id;
		
	}//_categorize_articles__get_CatName_KwId_ArticleIndex_list

	function get_keywords($category_id) {

		// keywords
		$this->loadModel('Keyword');
		
		$keywords = $this->Keyword->find('all',
		
			array('conditions' => 
						
							array(
									'Keyword.category_id'	=> $category_id,
									
							)
					, 'order' =>
						
							array('Keyword.id'	=> 'asc')
						
				)				
		);
		
		// return
		return $keywords;
		
	}//get_keywords($category_id)
	
}//class ArticlesController extends AppController

