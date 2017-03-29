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
		$this->test_2_1_1_build_genres_list();
		
		$articles = $this->test_1_1_3_build_articles_list();
		
// 		$this->test_1_1_2_get_hrefs_for_articles();
// 		$this->test_1_1_1_get_html_content();

		/*******************************
			build: genres list
		*******************************/
		
		
		
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
		/*******************************
			get: genre name
		*******************************/
		$genre_name = @$this->request->query['genre_name'];
		
		$genre_id = @$this->request->query['genre_id'];

		$genres_List = $this->get_genres_list();
		
// 		debug($genres_List);
		
		debug("\$genre_id => ".$genre_id);

		if ($genre_id == NULL) {

			debug("genre id => NULL");
	
			$name_genre = "tech_science";

		} else if ($genre_id == "") {

			debug("genre id => blank");
	
			$name_genre = "tech_science";
	
		} else {
	
			debug("genre id => $genre_id");
// 			debug("genre name => unknown type ---> ");
// 			debug($genre_id);
	
			$name_genre = $genres_List[$genre_id];
// 			$name_genre = $genre_id;
// 			$name_genre = "tech_science";
	
		}//if ($genre_id == NULL)

		debug("\$name_genre => ".$name_genre);
		
// 		if ($genre_name == NULL) {
		
// 			debug("genre name => NULL");
			
// 			$name_genre = "tech_science";
		
// 		} else if ($genre_name == "") {
		
// 			debug("genre name => blank");
			
// 			$name_genre = "tech_science";
			
// 		} else {
			
// 			debug("genre name => $genre_name");
// // 			debug("genre name => unknown type ---> ");
// // 			debug($genre_name);
			
// 			$name_genre = $genre_name;
// // 			$name_genre = "tech_science";
			
// 		}//if ($genre_name == NULL)
		
		
		
// 		$name_genre = "tech_science";

		debug("tech_science, international, national, politics, business, eco");
		
		/*******************************
			build hrefs list
		*******************************/
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
						
// 						debug($ahref->find('span'));

			}//if (Utils::startsWith($ahref->href, "/articles"))
		
		}//foreach ($ahrefs as $ahref)
			
		//debug
		debug("count(\$ahrefs_articles) => ".count($ahrefs_articles));
		
		/******************** (20 '*'s)
		*
		* build: articles list
		*
		********************/
		unset($ahrefs_articles);
		
		$ahrefs_articles = array();
		
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
		
				array_push($ahrefs_articles, $a);
				
// 				//debug
// 				if ($count < $max ) {
					
// // 					debug($a);
// 					debug($ahref->find('span'));
					
// 					$count ++;
					
// 				}
				
				
		
			}//if (Utils::startsWith($ahref->href, "/articles"))
		
		}//foreach ($ahrefs as $ahref)
		
		//debug
		debug("(re) count(\$ahrefs_articles) => ".count($ahrefs_articles));

// 		/**************************************************************
// 			test: add nikkei articles
// 		**************************************************************/
// 		$url = "http://www.nikkei.com/news/category/world/?bn=1";

// 		//REF http://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/
// 		unset($html);

// 		$html = file_get_html($url);

// 		// hrefs
// 		unset($ahrefs);

// 		//ref http://so-zou.jp/web-app/tech/programming/php/library/simplehtmldom/ "id属性がfooである、すべてのdiv要素を取得する"
// 		// <div class="cmn-section cmn-indent">
// 		$ahrefs = $html->find('div[class=cmn-section cmn-indent]');

// 		debug("\$ahrefs(div) => ".count($ahrefs));
		
		/**************************************************************
			add: nikkei articles
		**************************************************************/
		/*******************************
		 build hrefs list
		 *******************************/
// 		$url = "http://www.asahi.com/".$name_genre."/list/";
		$url = "http://www.nikkei.com/news/category/politics/";
// 		$url = "http://www.nikkei.com/news/category/world/";
// 		$url = "http://www.nikkei.com/news/category/world/?bn=1";
		
		//REF http://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/
		unset($html);
		
		$html = file_get_html($url);
		
		// hrefs
		unset($ahrefs);
		
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
// 		$ahrefs_articles = array();
// 		unset($ahrefs_articles);

// 		$ahrefs_articles = array();
		
		// 		$count = 0;
		// 		$max = 5;
		
		$count = 0;
		
		foreach ($ahrefs as $ahref) {
		
			//ref view-source:http://www.asahi.com/tech_science/list/
				
// 			if (Utils::startsWith($ahref->href, "/articles")) {
// 			if (Utils::startsWith($ahref->href, "/article")) {
			if (Utils::startsWith($ahref->href, "/article")
					
					&& !isset($ahref->class)
// 					&& $ahref->find('span')
					
// 					&& $ahref->class != "cmnc-title"
// 					&& $ahref->class != "m-sub_access_ranking_link"
// 					&& $ahref->class != ""
// 					&& !($ahref->class)
					
					) {
				// 			if (Utils::startsWith($ahref->href, "http://headlines")
				// 					&& count(explode("-", $ahref->href)) > 3) {
		
// 						//debug
// 						debug("\$ahref->class => ".$ahref->class);

// 				//debug
// 				if (isset($ahref->class)) {
// // 				if (!isset($ahref->class)) {
					
// 					debug("class --> SET: ".$ahref->plaintext);
// // 					debug("class --> not set: ".$ahref->plaintext);
					
// 				}
						
// 				debug("isset(\$ahref->class) => \"".isset($ahref->class)."\"");
// 				debug($ahref->find(('span'))[0]);
// 				debug($ahref->find(('span')));
						
// 				array_push($ahrefs_articles, $ahref);
				$a = $this->Article->create();
				
				$a['url'] = "http://www.asahi.com".$ahref->href;
				// 				$a['url'] = $ahref->href;
				
				$a['line'] = mb_convert_encoding($ahref->plaintext, 'UTF-8');
				// 				$a['line'] = $ahref->plaintext;
				
				$a['vendor'] = "www.nikkei.com"; 
				
				array_push($ahrefs_articles, $a);
				
				// count
				$count ++;
				
			}//if (Utils::startsWith($ahref->href, "/articles"))
		
		}//foreach ($ahrefs as $ahref)
			
		//debug
		debug("nikkei site articles => ".$count);
		
		//debug
		debug("count(\$ahrefs_articles) (nikkei site added) => ".count($ahrefs_articles));
		
		/******************** (20 '*'s)
		*
		* set: articles
		*
		********************/
		$this->set("articles", $ahrefs_articles);
		
		debug("articles => set"."(".count($ahrefs_articles)." articles)");
		
// 		/******************** (20 '*'s)
// 		 *
// 		 * return: articles
// 		 *
// 		 ********************/
// 		$this->set("articles", $a);
// 		return $ahrefs_articles;
// 		return $a;
		
		
	}//function test_1_1_3_build_articles_list()

	function test_2_1_1_build_genres_list() {

		/*******************************
			genres list
		*******************************/
		$this->loadModel('Genre');
		
		$select_Genres = $this->get_genres_list();
		
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

		/*******************************
			genre id
		*******************************/
		$genre_id = @$this->request->query['genre_id'];
		
		if ($genre_id == NULL) {
		
			debug("genre id => NULL");
			
			$genre_id = $select_Genres[0];
		
// 			$name_genre = "tech_science";
		
		} else if ($genre_id == "") {
		
			debug("genre id => blank");
		
// 			$name_genre = "tech_science";
			
			$genre_id = $select_Genres[0];
		
		} else {
		
			debug("genre id => $genre_id");
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
		$this->set("genre_id", $genre_id);
		
		
	}//test_2_1_1_build_genres_list()

	function get_genres_list() {

		$select_Genres = array();
		
		// tech_science, international, national, politics, business, eco
		$select_Genres[0] = "tech_science";
		$select_Genres[1] = "international";
		$select_Genres[2] = "national";
		$select_Genres[3] = "politics";
		$select_Genres[4] = "business";
		$select_Genres[5] = "eco";
		
		// return
		return $select_Genres;
	}//get_genres_list()
	
}//class ArticlesController extends AppController
