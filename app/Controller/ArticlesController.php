<?php

class ArticlesController extends AppController {
	public $helpers = array('Html', 'Form', 'Mytest');
// 	public $helpers = array('Html', 'Form');

	public function 
	index() {
		
// 		$this->set('articles', $this->Article->find('all'));
		
		/**********************************
		* genre id
		**********************************/
		$query_genre_id = $this->_index_Get_GenreID();
		
		/**********************************
		* get: articles
		**********************************/
		$this->_index_GetArticles_D9_V_2_0($query_genre_id);
// 		$this->_index_GetArticles_D9($query_genre_id);
// 		$this->_index_GetArticles_T9($query_genre_id);
// 		$this->_index_GetArticles_T8();

		/**********************************
		* genres list
		**********************************/
		$this->loadModel('Genre');
			
		$genres = $this->Genre->find('all');
			
		$select_Genres = array();
			
		foreach ($genres as $genre) {
		
			$genre_Name = $genre['Genre']['name'];
			$genre_Id = $genre['Genre']['id'];
		
			$select_Genres[$genre_Id] = $genre_Name;
				
		}
		
		$this->set('select_Genres', $select_Genres);
		
	}

	public function
	_index_Get_GenreID() {
		
		$genre_id = @$this->request->query['genre_id'];

		/**********************************
		* default
		**********************************/
		$this->loadModel('Genre');
			
		$option = array(
		
				'conditions' =>
				array(
							
						'Genre.code' => CONS::$genre_code_dflt
		
				)
		);
		
		$genre_dflt = $this->Genre->find('first', $option);
		
		if ($genre_id == null) {
			
			$genre_id = $genre_dflt['Genre']['id'];
			
		}
		
		$this->set("genre_id", $genre_id);

		return $genre_id;
		
	}//_index_Get_GenreID
	
	public function
	_index_GetArticles_D9_V_2_0
	($query_genre_id) {

		/**********************************
		* get: articles (initial)
		**********************************/
		$articles = $this->__index_GetArticles_D9__Get_Articles($query_genre_id);

		/**********************************
		* grouping
		**********************************/
		$a_categorized = 
					$this->__index_GetArticles_D9_V_2_0__Grouping(
								$articles,
								$query_genre_id);
		
		/**********************************
		* set: vars
		**********************************/
		$this->set('articles', $articles);
		
		$this->set('a_categorized', $a_categorized);

	}//_index_GetArticles_D9_V_2_0

	public function
	__index_GetArticles_D9_V_2_0__Grouping
	($articles, $query_genre_id) {
		/**********************************
			* categories
		**********************************/
		$this->loadModel('Category');
			
		$option = array(
	
				'conditions' =>
				array(
							
						'Category.genre_id' => $query_genre_id
	
				)
		);
	
		$categories = $this->Category->find('all', $option);
	
		/**********************************
			* keywords
		**********************************/
		$kw_sets = $this->__index_GetArticles_D9_V_2_0__Get_KW_sets($categories);
		
// 		$category = $categories[0];
	
// 		// 		debug($category['Category']);
	
// 		$this->loadModel('Keyword');
			
// 		$option = array(
	
// 				'conditions' =>
// 				array(
							
// 						'Keyword.category_id' => $category['Category']['id']
	
// 				)
// 		);
	
// 		$keywords = $this->Keyword->find('all', $option);
	
		/**********************************
			* grouping
		**********************************/
		// 		debug($articles[5]);
	
		$a_categorized =
			$this->__index_GetArticles_D9_V_2_0__Categorize(
								$articles, $kw_sets, $categories);
// 								$articles, $keywords, $category);
	
		return $a_categorized;
	
	}//__index_GetArticles_D9_V_2_0__Grouping

	public function
	__index_GetArticles_D9_V_2_0__Get_KW_sets
	($categories) {

		$kw_sets = array();
		
		$this->loadModel('Keyword');
			
		foreach ($categories as $cat) {
		
			$option = array(
		
					'conditions' =>
					array(
								
							'Keyword.category_id' => $cat['Category']['id']
		
					)
			);
		
			$keywords = $this->Keyword->find('all', $option);
				
// 			$kw_sets[$cat['Category']['id']] = $keywords;
			array_push($kw_sets, $keywords);
			
		}//foreach ($categories as $cat)

		return $kw_sets;
		
	}//__index_GetArticles_D9_V_2_0__Get_KW_sets
	
	/**********************************
	 * @return
	*
	* array(
	* 		"China" => array(
			* 						article_1, article_2,...
			* 					),
	* 		"Others"=> array(
			* 						article_1, article_2,...
			* 					),
	**********************************/
	public function
	__index_GetArticles_D9_V_2_0__Categorize
	($articles, $kw_sets, $categories) {
	
		$a_categorized_main = array();
	
		$a_categorized = array();
		$a_categorized_others = array();
	
		/**********************************
			* grouping
		**********************************/
		foreach ($articles as $a) {
	
			// 			//debug
			// 			debug($a);
			// 			break;
				
			$found = false;
				
			$line = $a['line'];
			// 			$line = $a['Article']['line'];
				
			foreach ($keywords as $k) {
	
				$k_name = $k['Keyword']['name'];
	
				$p = "/$k_name/";
	
				$res = preg_match($p, $line);
	
				if ($res == 1) {
	
					array_push($a_categorized, $a);
						
					$found = true;
						
					break;
						
				}
					
			}//foreach ($keywords as $k)
				
			if ($found == false) {
	
				array_push($a_categorized_others, $a);
	
			} else {
	
				$found == true;
	
			}
	
		}//foreach ($articles as $a)
	
		/**********************************
			* build: master list
		**********************************/
		$a_categorized_main[$category['Category']['name']] = $a_categorized;
		$a_categorized_main['Others'] = $a_categorized_others;
		// 		array_push($a_categorized_main, $a_categorized);
		// 		array_push($a_categorized_main, $a_categorized_others);
	
		// 		debug(count($a_categorized_main));
	
		// 		debug(array_keys($a_categorized_main));
	
		return $a_categorized_main;
	
	}//__index_GetArticles_D9_V_2_0__Categorize
	
	
	public function
	_index_GetArticles_D9($query_genre_id) {

		/**********************************
		* get: articles (initial)
		**********************************/
		$articles = $this->__index_GetArticles_D9__Get_Articles($query_genre_id);

		/**********************************
		* grouping
		**********************************/
		$a_categorized = 
					$this->__index_GetArticles_D9__Grouping(
								$articles,
								$query_genre_id);
		
		/**********************************
		* set: vars
		**********************************/
		$this->set('articles', $articles);
		
		$this->set('a_categorized', $a_categorized);

	}//_index_GetArticles

	public function
	__index_GetArticles_D9__Get_Articles
	($query_genre_id) {
		
		/**********************************
		 * get: html
		**********************************/
		if ($query_genre_id == null) {
				
			$genre = "soci";
				
		} else {
				
			$genre = $this->_get_GenreCode_from_GenreID($query_genre_id);
				
		}
		
		$url = "http://headlines.yahoo.co.jp/hl?c=$genre&t=l";
		
		//REF http://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/
		$html = file_get_html($url);
		
		$ahrefs = $html->find('a[href]');
		
		$ahrefs_hl = array();
		
		foreach ($ahrefs as $ahref) {
		
			// 			if (Utils::startsWith($ahref->href, "/hl")) {
			if (Utils::startsWith($ahref->href, "/hl")
				&& count(explode("-", $ahref->href)) > 3) {
	
					$ahref->href = "http://headlines.yahoo.co.jp".$ahref->href;
	
					array_push($ahrefs_hl, $ahref);
	
			}
		
		}//foreach ($ahrefs as $ahref)
		
		/**********************************
		 * build: list
		**********************************/
		$articles = array();
		
		foreach ($ahrefs_hl as $ahref) {
		
			$a = $this->Article->create();
				
			$a['url'] = $ahref->href;
				
			$a['line'] = $ahref->plaintext;
				
			// 			$a->vendor = $this->conv_Url_to_VendorName($ahref->href);
			$a['vendor'] = $this->conv_Url_to_VendorName($ahref->href);
				
			$a['news_time'] = $this->conv_Url_to_NewsTime($ahref->href);
				
			array_push($articles, $a);
		
		}
		
		/**********************************
		* return
		**********************************/
		return $articles;
		
	}//__index_GetArticles_D9__Get_Articles
	
	public function
	__index_GetArticles_D9__Grouping
	($articles, $query_genre_id) {
		/**********************************
		* categories
		**********************************/
		$this->loadModel('Category');
			
		$option = array(
				
					'conditions' => 
							array(
									
								'Category.genre_id' => $query_genre_id

							)
		);
		
		$categories = $this->Category->find('all', $option);
		
		/**********************************
		* keywords
		**********************************/
		$category = $categories[0];
		
// 		debug($category['Category']);
		
		$this->loadModel('Keyword');
			
		$option = array(
		
				'conditions' =>
				array(
							
						'Keyword.category_id' => $category['Category']['id']
		
				)
		);
		
		$keywords = $this->Keyword->find('all', $option);

		/**********************************
		* grouping
		**********************************/
// 		debug($articles[5]);
		
		$a_categorized = 
				$this->__index_GetArticles_D9__Categorize($articles, $keywords, $category);


		return $a_categorized;
		
	}//__index_GetArticles_D9__Grouping
	
	
	/**********************************
	 * @return
	*
	* array(
	* 		"China" => array(
	* 						article_1, article_2,...
	* 					),
	* 		"Others"=> array(
	* 						article_1, article_2,...
	* 					),
	**********************************/
	public function
	__index_GetArticles_D9__Categorize
	($articles, $keywords, $category) {
		
		$a_categorized_main = array();
		
		$a_categorized = array();
		$a_categorized_others = array();

		/**********************************
		* grouping
		**********************************/
		foreach ($articles as $a) {

// 			//debug
// 			debug($a);
// 			break;
			
			$found = false;
			
			$line = $a['line'];
// 			$line = $a['Article']['line'];
			
			foreach ($keywords as $k) {

				$k_name = $k['Keyword']['name'];
				
				$p = "/$k_name/";
				
				$res = preg_match($p, $line);
				
				if ($res == 1) {

					array_push($a_categorized, $a);
					
					$found = true;
					
					break;
					
				}
			
			}//foreach ($keywords as $k)
			
			if ($found == false) {
				
				array_push($a_categorized_others, $a);
				
			} else {
				
				$found == true;
				
			}
		
		}//foreach ($articles as $a)

		/**********************************
		* build: master list
		**********************************/
		$a_categorized_main[$category['Category']['name']] = $a_categorized;
		$a_categorized_main['Others'] = $a_categorized_others;
// 		array_push($a_categorized_main, $a_categorized);
// 		array_push($a_categorized_main, $a_categorized_others);

// 		debug(count($a_categorized_main));
		
// 		debug(array_keys($a_categorized_main));
		
		return $a_categorized_main;
		
	}//__index_GetArticles_D9__Categorize
	
	
	public function
	_index_GetArticles_T9($query_genre_id) {
	
		/**********************************
		 * get: html
		**********************************/
		if ($query_genre_id == null) {
			
			$genre = "soci";
			
		} else {
			
			$genre = $this->_get_GenreCode_from_GenreID($query_genre_id);
			
		}
		
		
		
// 		$genre = "soci";
	
		$url = "http://headlines.yahoo.co.jp/hl?c=$genre&t=l";
	
		//REF http://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/
		$html = file_get_html($url);
	
		$ahrefs = $html->find('a[href]');
	
		$ahrefs_hl = array();
	
		foreach ($ahrefs as $ahref) {
				
// 			if (Utils::startsWith($ahref->href, "/hl")) {
			if (Utils::startsWith($ahref->href, "/hl")
					&& count(explode("-", $ahref->href)) > 3) {
				// 			if (Utils::startsWith($ahref, "/hl")) {
				// 			if (Utils::startsWith($ahref, "/hl?")) {
	
				$ahref->href = "http://headlines.yahoo.co.jp".$ahref->href;
				
				array_push($ahrefs_hl, $ahref);
	
				// 				a_tag['href'] = "http://headlines.yahoo.co.jp" + a_tag['href']
			}
				
		}

		/**********************************
		* build: list
		**********************************/
		$articles = array();
		
		foreach ($ahrefs_hl as $ahref) {
		
			$a = $this->Article->create();
			
			$a['url'] = $ahref->href;
			
			$a['line'] = $ahref->plaintext;
			
// 			$a->vendor = $this->conv_Url_to_VendorName($ahref->href);
			$a['vendor'] = $this->conv_Url_to_VendorName($ahref->href);
			
			$a['news_time'] = $this->conv_Url_to_NewsTime($ahref->href);
			
			array_push($articles, $a);
		
		}
		
		/**********************************
		* build list: Articles
		**********************************/
// 		$list_Articles = $this->_index_Get_ArticlesList($ahrefs_hl);
// 		aa
		
		
// 		debug(count($articles));
		
// 		$a = $this->Article->create();
	
// 		$a['url'] = "abcde";
	
// 		$this->set('a', $a);
		
// 		$this->set('ahrefs_hl', $ahrefs_hl);
		$this->set('articles', $articles);

// 		debug($articles);
		
// 		debug(get_class($ahrefs_hl[0]));
		
	}//_index_GetArticles

	public function
	_get_GenreCode_from_GenreID($query_genre_id) {
		
		$this->loadModel('Genre');
			
		$genres = $this->Genre->find('all');
		
		/**********************************
		* get genre id
		**********************************/
		foreach ($genres as $genre) {

			//REF http://stackoverflow.com/questions/239136/fastest-way-to-convert-string-to-integer-in-php answered Oct 27 '08 at 5:51
			if ($genre['Genre']['id'] == (int)$query_genre_id) {
				
				return $genre['Genre']['code'];
				
			};
		
		}
		
		/**********************************
		* genre not found
		**********************************/
		return "soci";
		
	}
	
	public function
	_index_GetArticles_T8() {
	
		/**********************************
		 * get: html
		**********************************/
		$genre = "soci";
	
		$url = "http://headlines.yahoo.co.jp/hl?c=$genre&t=l";
	
		//REF http://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/
		$html = file_get_html($url);
	
		$ahrefs = $html->find('a[href]');
	
		$ahrefs_hl = array();
	
		foreach ($ahrefs as $ahref) {
				
// 			if (Utils::startsWith($ahref->href, "/hl")) {
			if (Utils::startsWith($ahref->href, "/hl")
					&& count(explode("-", $ahref->href)) > 3) {
				// 			if (Utils::startsWith($ahref, "/hl")) {
				// 			if (Utils::startsWith($ahref, "/hl?")) {
	
				$ahref->href = "http://headlines.yahoo.co.jp".$ahref->href;
				
				array_push($ahrefs_hl, $ahref);
	
				// 				a_tag['href'] = "http://headlines.yahoo.co.jp" + a_tag['href']
			}
				
		}

		/**********************************
		* build: list
		**********************************/
		$articles = array();
		
		foreach ($ahrefs_hl as $ahref) {
		
			$a = $this->Article->create();
			
			$a['url'] = $ahref->href;
			
			$a['line'] = $ahref->plaintext;
			
// 			$a->vendor = $this->conv_Url_to_VendorName($ahref->href);
			$a['vendor'] = $this->conv_Url_to_VendorName($ahref->href);
			
			$a['news_time'] = $this->conv_Url_to_NewsTime($ahref->href);
			
			array_push($articles, $a);
		
		}
		
		/**********************************
		* build list: Articles
		**********************************/
// 		$list_Articles = $this->_index_Get_ArticlesList($ahrefs_hl);
// 		aa
		
		
// 		debug(count($articles));
		
// 		$a = $this->Article->create();
	
// 		$a['url'] = "abcde";
	
// 		$this->set('a', $a);
		
// 		$this->set('ahrefs_hl', $ahrefs_hl);
		$this->set('articles', $articles);

// 		debug($articles);
		
// 		debug(get_class($ahrefs_hl[0]));
		
	}//_index_GetArticles

	public function 
	_index_Get_ArticlesList($ahrefs_hl) {

		$list_Articles = array();
		
		foreach ($ahrefs_hl as $ahref) {
		
			$a = $this->Article->create();
			
// 			$a['line'] = 
		
		}
		
		
	}
	
	public function
	_index_GetArticles_T7() {
	
		/**********************************
		 * get: html
		**********************************/
		$genre = "soci";
	
		$url = "http://headlines.yahoo.co.jp/hl?c=$genre&t=l";
	
		//REF http://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/
		$html = file_get_html($url);
	
		$ahrefs = $html->find('a[href]');
	
		$ahrefs_hl = array();
	
		foreach ($ahrefs as $ahref) {
				
			if (Utils::startsWith($ahref->href, "/hl")) {
				// 			if (Utils::startsWith($ahref, "/hl")) {
				// 			if (Utils::startsWith($ahref, "/hl?")) {
	
				$ahref->href = "http://headlines.yahoo.co.jp".$ahref->href;
				
				array_push($ahrefs_hl, $ahref);
	
				// 				a_tag['href'] = "http://headlines.yahoo.co.jp" + a_tag['href']
			}
				
		}

		/**********************************
		* build: list
		**********************************/
		$articles = array();
		
		foreach ($ahrefs_hl as $ahref) {
		
			$a = $this->Article->create();
			
			$a['url'] = $ahref->href;
			
			$a['line'] = $ahref->plaintext;
			
// 			$a->vendor = $this->conv_Url_to_VendorName($ahref->href);
			$a['vendor'] = $this->conv_Url_to_VendorName($ahref->href);
			
			array_push($articles, $a);
		
		}
		
		debug(count($articles));
		
// 		$a = $this->Article->create();
	
// 		$a['url'] = "abcde";
	
// 		$this->set('a', $a);
		
		$this->set('ahrefs_hl', $ahrefs_hl);

		debug(get_class($ahrefs_hl[0]));
		
	}//_index_GetArticles
	

	public function 
	conv_Url_to_VendorName
	($url) {
		
		$tokens = explode("-", $url);
		
		$len = count($tokens);
		
		/**********************************
		* build string
		**********************************/
		if ($len > 1) {
			
			return $tokens[$len - 2];
			
		} else {
			
			return "";
			
		}
		
	}//conv_Url_to_VendorName
	
	public function 
	conv_Url_to_NewsTime
	($url) {

		/**********************************
		* get: news time token
		**********************************/
		$tokens_Meta = explode("=", $url);
		
		$tokens_TimeAndVendor = explode("-", $tokens_Meta[1]);
		
		$len = count($tokens_TimeAndVendor);
		
		/**********************************
		* build string
		**********************************/
		if ($len >= 4) {
			
			return $tokens_TimeAndVendor[$len - 4];
			
		} else {
			
			return "";
			
		}
		
	}//conv_Url_to_VendorName
	
	public function
	_index_GetArticles_T6() {
	
		/**********************************
		 * get: html
		**********************************/
		$genre = "soci";
	
		$url = "http://headlines.yahoo.co.jp/hl?c=$genre&t=l";
	
		//REF http://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/
		$html = file_get_html($url);
	
		$ahrefs = $html->find('a[href]');
	
		$ahrefs_hl = array();
	
		foreach ($ahrefs as $ahref) {
				
			if (Utils::startsWith($ahref->href, "/hl")) {
				// 			if (Utils::startsWith($ahref, "/hl")) {
				// 			if (Utils::startsWith($ahref, "/hl?")) {
	
				$ahref->href = "http://headlines.yahoo.co.jp".$ahref->href;
				
				array_push($ahrefs_hl, $ahref);
	
				// 				a_tag['href'] = "http://headlines.yahoo.co.jp" + a_tag['href']
			}
				
		}

		/**********************************
		* build: list
		**********************************/
		$articles = array();
		
		foreach ($ahrefs_hl as $ahref) {
		
			$a = $this->Article->create();
			
			$a['url'] = $ahref->href;
			
			$a['line'] = $ahref->plaintext;
			
			array_push($articles, $a);
		
		}
		
		debug(count($articles));
		
		$a = $this->Article->create();
	
		$a['url'] = "abcde";
	
		$this->set('a', $a);
		
		$this->set('ahrefs_hl', $ahrefs_hl);
	
	
	}//_index_GetArticles
	
	public function
	_index_GetArticles_T5() {
	
		/**********************************
		 * get: html
		**********************************/
		$genre = "soci";
	
		$url = "http://headlines.yahoo.co.jp/hl?c=$genre&t=l";
		// 		$url = "http://zasshi.news.yahoo.co.jp/newly/?p=1";
	
		//REF http://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/
		// 		$html = file_get_contents($url);
		$html = file_get_html($url);
	
		$ahrefs = $html->find('a[href]');
	
		$atags_2 = $html->find('div ul li a[href]');
	
		$ahrefs_hl = array();
	
		foreach ($ahrefs as $ahref) {
				
			if (Utils::startsWith($ahref->href, "/hl")) {
				// 			if (Utils::startsWith($ahref, "/hl")) {
				// 			if (Utils::startsWith($ahref, "/hl?")) {
	
				$ahref->href = "http://headlines.yahoo.co.jp".$ahref->href;
				
				array_push($ahrefs_hl, $ahref);
	
				// 				a_tag['href'] = "http://headlines.yahoo.co.jp" + a_tag['href']
			}
				
		}
	
		// 		foreach ($atags_2 as $atag) {
	
		// 			$res = strstr()
	
		// 		}
	
	
		//////////////////////////////////////////////
// 		debug("\$ahrefs");
// 		debug(count($ahrefs));
	
// 		debug("\$ahrefs_hl");
// 		debug(count($ahrefs_hl));
	
		debug($ahrefs_hl[0]->href);
		
		debug($ahrefs_hl[0]->plaintext);
		
// 		debug($ahrefs_hl[0]->strval());	// Call to undefined method simple_html_dom_node::strval()
		
// 		debug($ahrefs_hl[0]->InnerNode);	// "false"
		
	
// 		$ahrefs_hl[0]->href = "http://headlines.yahoo.co.jp".$ahrefs_hl[0]->href;
	
// 		debug($ahrefs_hl[0]->href);
	
// 		debug("atags_2");
// 		debug(count($atags_2));
	
		// 		debug($ahrefs[0]);	// Allowed memory size of 134217728 bytes exhausted
		// 		debug(count($ahrefs));
	
		// 		debug($html);
	
		//////////////////////////////////////////////
		$a = $this->Article->create();
	
		$a['url'] = "abcde";
	
		$this->set('a', $a);
		
		$this->set('ahrefs_hl', $ahrefs_hl);
	
	
	}//_index_GetArticles
	
	public function 
	_index_GetArticles_T1() {

		/**********************************
		* get: html
		**********************************/
		$url = "http://zasshi.news.yahoo.co.jp/newly/?p=1";
		
		//REF http://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/
		$html = file_get_contents($url);
// 		$dom = file_get_html($url);	// Allowed memory size of 134217728 bytes exhausted
// 		$html = file_get_html($url);
		
// 		$atags = $html->find('a');
		
// 		debug($atags);
		
// 		$this->set('atags', $atags);
		
		$domDocument = new DOMDocument();
		$domDocument->loadHTML($html);
		
// 		debug($domDocument);
		
		$xmlString = $domDocument->saveXML();
// 		$xmlObject = simplexml_load_string($html);	// Detected an illegal character in input string
		
		$xmlObject = simplexml_load_string($xmlString);
// 		$xmlObject = simplexml_load_string($html);	// error: encoding
// 		$xmlObject = simplexml_load_string(mb_convert_encoding($html, "UTF-8", "EUC-JP"));
		
		//////////////////////////////////////////
		
		//REF http://sato-san.hatenadiary.jp/entry/2013/05/06/155919
// 		debug($dom);;
		
// 		debug($xmlString);
		
// 		debug($xmlObject['head']);
// 		debug(count($xmlObject));
// 		debug($xmlObject->head['title']);	// null
		
// 		debug("body");	// null
// 		debug($xmlObject->body->div[0]);	// 
// 		debug($xmlObject->body);	// works
		
		
// 		debug($xmlObject->head);	// works
// 		debug($xmlObject->head->title);
// 		debug($xmlObject[0]['head']);
// 		debug($xmlObject[0]);
// 		debug($xmlObject);
		
// 		debug($domDocument);
		
		//REF http://blog.katty.in/1400
// 		$html = file_get_html($url);
		
		$a = $this->Article->create();

		$a['url'] = "abcde";

		$this->set('a', $a);

		
	}//_index_GetArticles
	
	public function 
	_index_GetArticles_T2() {

		/**********************************
		* get: html
		**********************************/
		$url = "http://zasshi.news.yahoo.co.jp/newly/?p=1";
		
		//REF http://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/
		$html = file_get_contents($url);
		
		$domDocument = new DOMDocument();
		$domDocument->loadHTML($html);
		
// 		debug($domDocument);
		
		$xmlString = $domDocument->saveXML();
		
		$dom = simplexml_load_string($xmlString);
		
		$body = $dom->body;
		
		$ahref = $dom->find('a[href]');
// 		$ahref = $body->find('a[href]');
		
		//////////////////////////////////////////////
		
		debug($ahref);

		// $ahref = $body->find('a[href]');
// 		debug($ahref);	// Call to undefined method SimpleXMLElement::find()

// 		debug($body);
		
		
		
		//////////////////////////////////////////////
		$a = $this->Article->create();

		$a['url'] = "abcde";

		$this->set('a', $a);

		
	}//_index_GetArticles
	
	public function 
	_index_GetArticles_T3() {

		/**********************************
		* get: html
		**********************************/
		$url = "http://zasshi.news.yahoo.co.jp/newly/?p=1";
		
		//REF http://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/
// 		$html = file_get_contents($url);
		$html = file_get_html($url);

		$ahrefs = $html->find('a[href]');
		
		$ahref_0 = $ahrefs[0];
		
		//////////////////////////////////////////////
		debug($ahref_0->href);
		
		
// 		debug($ahrefs[0]);	// Allowed memory size of 134217728 bytes exhausted
// 		debug(count($ahrefs));
		
// 		debug($html);
		
		//////////////////////////////////////////////
		$a = $this->Article->create();

		$a['url'] = "abcde";

		$this->set('a', $a);

		
	}//_index_GetArticles

	public function
	_index_GetArticles_T4() {
	
		/**********************************
		 * get: html
		**********************************/
		$genre = "soci";
		
		$url = "http://headlines.yahoo.co.jp/hl?c=$genre&t=l";
// 		$url = "http://zasshi.news.yahoo.co.jp/newly/?p=1";
	
		//REF http://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/
		// 		$html = file_get_contents($url);
		$html = file_get_html($url);
	
		$ahrefs = $html->find('a[href]');

		$atags_2 = $html->find('div ul li a[href]');
		
		$ahrefs_hl = array();
		
		foreach ($ahrefs as $ahref) {
			
			if (Utils::startsWith($ahref->href, "/hl")) {
// 			if (Utils::startsWith($ahref, "/hl")) {
// 			if (Utils::startsWith($ahref, "/hl?")) {
				
				array_push($ahrefs_hl, $ahref);
				
// 				a_tag['href'] = "http://headlines.yahoo.co.jp" + a_tag['href']
			}
			
		}
		
// 		foreach ($atags_2 as $atag) {
		
// 			$res = strstr()
		
// 		}
		
		
		//////////////////////////////////////////////
		debug("\$ahrefs");
		debug(count($ahrefs));
		
		debug("\$ahrefs_hl");
		debug(count($ahrefs_hl));
	
		debug($ahrefs_hl[0]->href);
		
		$ahrefs_hl[0]->href = "http://headlines.yahoo.co.jp".$ahrefs_hl[0]->href;
		
		debug($ahrefs_hl[0]->href);
		
		debug("atags_2");
		debug(count($atags_2));
	
		// 		debug($ahrefs[0]);	// Allowed memory size of 134217728 bytes exhausted
		// 		debug(count($ahrefs));
	
		// 		debug($html);
	
		//////////////////////////////////////////////
		$a = $this->Article->create();
	
		$a['url'] = "abcde";
	
		$this->set('a', $a);
	
	
	}//_index_GetArticles
	
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid video'));
		}
	
		$video = $this->Video->findById($id);
		if (!$video) {
			throw new NotFoundException(__('Invalid video'));
		}
		
		$this->set('video', $video);
		
		/******************************
		
			positions
		
		******************************/
		$this->loadModel('Position');
			
		$positions = $this->Position->find('all',
							//REF conditions http://book.cakephp.org/2.0/en/models/retrieving-your-data.html#find
							array(
								'conditions' => array(
													'Position.video_id' => $id
			
												)
// 								,
// 								'order' => array('Position.point ASC')
							)
		);
		
		
		$positions = $this->sort_Position_by_Point($positions);
// 		$res = $this->sort_Position_by_Point($positions);

// 		debug($positions);
		
// 		if ($res == true) {
		
// 			debug("sort done");
			
// 		} else {
		
// 			debug("sort not done");
		
// 		}

		//REF http://blogs.bigfish.tv/adam/2008/03/24/sorting-with-setsort-in-cakephp-12/
		//REF referer http://cakephp.1045679.n5.nabble.com/Using-usort-in-Cake-td1327099.html Aug 10, 2009; 11:32pm
// 		$positions = Set::sort($positions, '{n}.Position.point', 'asc');
		
		$this->set('positions', $positions);
		
		/******************************
		
			test: SimpleXMLElement
		
		******************************/
		$this->_test_SimpleXMLElement();
// 		$this->_test_DOMXML();

		
	}
	
	public function _test_DOMXML() {
		
		$text = "台湾・台北（Taipei）にある日本の対台湾窓口機関、交流協会台北事務所前で7日、台湾労働党や中台統一派団体のメンバーら数十人が、安倍政権の集団的自衛権行使の容認など平和憲法に反する動きに対し抗議活動を行った";
		// 		$text = "南スーダンの国連平和維持活動（ＰＫＯ）に派遣された陸上自衛隊第５次派遣施設隊長";
		$params = "sentence=$text";
		
		$url = "http://chasen.org/~taku/software/mecapi/mecapi.cgi";
		
		$html = file_get_contents("$url?$params");

		$xmlDoc = new DOMDocument();
		
		$xmlDoc->loadXML($html);
// 		$xmlDoc->loadHTML($html);
		
		$xmlDom = $xmlDoc->documentElement;
		
		$this->set('xmlDom', $xmlDom);
		
	}
	
	public function _test_SimpleXMLElement() {

		$text = "台湾・台北（Taipei）にある日本の対台湾窓口機関、交流協会台北事務所前で7日、台湾労働党や中台統一派団体のメンバーら数十人が、安倍政権の集団的自衛権行使の容認など平和憲法に反する動きに対し抗議活動を行った";
		// 		$text = "南スーダンの国連平和維持活動（ＰＫＯ）に派遣された陸上自衛隊第５次派遣施設隊長";
		$params = "sentence=$text";
		
		$url = "http://chasen.org/~taku/software/mecapi/mecapi.cgi";
		
		$html = file_get_contents("$url?$params");
		
		$xml = simplexml_load_string($html);
		
		$this->set('xml', $xml);
		
	}

	public function add() {
		if ($this->request->is('post')) {
			
			$this->Video->create();
			
			$this->request->data['Video']['created_at'] =
						Utils::get_CurrentTime2(CONS::$timeLabelTypes["rails"]);
			
			$this->request->data['Video']['updated_at'] =
						Utils::get_CurrentTime2(CONS::$timeLabelTypes["rails"]);
			
			if ($this->Video->save($this->request->data)) {
				
				$this->Session->setFlash(__('Your video has been saved.'));
				return $this->redirect(array('action' => 'index'));
				
			}
			$this->Session->setFlash(__('Unable to add your video.'));
		} else {
			
			$this->loadModel('Genre');
			
			$genres = $this->Genre->find('all');
			
			$select_Genres = array();
			
			foreach ($genres as $genre) {
					
				$genre_Name = $genre['Genre']['name'];
				$genre_Id = $genre['Genre']['id'];
					
				$select_Genres[$genre_Id] = $genre_Name;
					
			}
				
			asort($select_Genres);
			
			$this->set('genre_names', $select_Genres);
				
		}
	}

	public function delete($id) {
		/******************************
	
		validate
	
		******************************/
		if (!$id) {
			throw new NotFoundException(__('Invalid video id'));
		}
	
		$video = $this->Video->findById($id);
	
		if (!$video) {
			throw new NotFoundException(__("Can't find the video. id = %d", $id));
		}
	
		/******************************
	
		delete
	
		******************************/
		if ($this->Video->delete($id)) {
			// 		if ($this->Video->save($this->request->data)) {
				
			$this->Session->setFlash(__("Video deleted => %s", $video['Video']['title']));
				
			return $this->redirect(
					array(
							'controller' => 'videos',
							'action' => 'index'
							
					));
				
		} else {
				
			$this->Session->setFlash(
					__("Video can't be deleted => %s", $video['Video']['title']));
				
			// 			$page_num = _get_Page_from_Id($id - 1);
				
			return $this->redirect(
					array(
							'controller' => 'videos',
							'action' => 'view',
							$id
					));
				
		}
	
	}//public function delete($id)
	
	public function retrieve_CurrentTime() {
		
		$this->layout = 'plain';
		
		$cur_Time = 500;
		
		$this->set('cur_Time', $cur_Time);
		
		//REF http://book.cakephp.org/2.0/en/controllers.html "This allows direct rendering of elements"
		$this->render('/Elements/videos/js/retrieve_CurrentTime');
		
// 		return $this->redirect(array('action' => 'index'));
		
	}

	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid text'));
		}
	
		/****************************************
			* Video
		****************************************/
		$video = $this->Video->findById($id);
		if (!$video) {
			throw new NotFoundException(__('Invalid video'));
		}
	
		if (count($this->params->data) != 0) {
				
			$this->Video->id = $id;
				
			$this->params->data['Video']['updated_at'] =
						Utils::get_CurrentTime2(CONS::$timeLabelTypes["rails"]);
				
			if ($this->Video->save($this->request->data)) {
	
				$this->Session->setFlash(__('Your video has been updated.'));
				return $this->redirect(
						array(
								'action' => 'view',
								$id));
	
			}//if ($this->Text->save($this->request->data))
				
			$this->Session->setFlash(__('Unable to update your video.'));
				
		}
	
		if (!$this->request->data) {
			$this->request->data = $video;;
		}
	
	}//public function edit($id = null)
	
	public function 
	save_CurrentTime() {
		
		$this->layout = 'plain';
		
// 		$result = $this->request->data['curTime'];
// 		$result = $this->request->data;
// 		$result = $this->request;
// 		$result = $this->request->query;
		$result = $this->request->query['curTime'];
		$video_id = $this->request->query['video_id'];
		
		/******************************
		
			save position
		
		******************************/
		$res = $this->save_Position($result, $video_id);
		
		$this->sort_PosList();
		
// 		if ($res == true) {
		
// // 			$result = "Saved: ".$result;
// // 			$arr = array ('saved'=> true,'point'=> $result, 'video_id' => $video_id);
// 			$arr = "<tr>"
// 					."<td>".Utils::conv_Float_to_TimeLabel($result)."</td>"
// 					."<td></td>"
// 					;
			
// 		} else {
		
// // 			$result = "Not saved: ".$result;
// // 			$arr = array ('saved'=> false,'point'=> $result, 'video_id' => $video_id);
// 			$arr = "Can't save position";
		
// 		}

// 		/******************************
		
// 			report
		
// 		******************************/
// 		$result = $result."/".$video_id;
		
// // 		debug($result);
		
// 		// set to return response=error
// // 		$arr = array ('response'=>'error','comment'=>'test comment here');
		
// 		$this->set('arr', $arr);
// // 		$this->set('result', $result);
		
// 		$this->render('/Elements/videos/js/return_SingleEntry');
// // 		$this->render('/Elements/videos/js/retrieve_CurrentTime');
		
		
	}//save_CurrentTime()
	
	public function 
	delete_Ajax() {
		
		$this->layout = 'plain';
		
		$position_id = $this->request->query['id'];
		
		/******************************
		
			delete position
		
		******************************/
// 		$res = true;
		
		$res = $this->_delete_Position($position_id);
		
		if ($res == true) {
		
			$this->sort_PosList();
// 			$this->render('/Elements/videos/js/delete_position_failed');
			
		} else {
		
// 			delete_position_failed.ctp
			$this->render('/Elements/videos/js/delete_position_failed');
		
		}
		;
		
	}//save_CurrentTime()

	public function 
	save_Position($result, $video_id) {
		
		$this->loadModel('Position');
		
		$this->Position->create();
		
		$this->Position->set('video_id', $video_id);
		$this->Position->set('point', $result);
		
		$this->Position->set('created_at', Utils::get_CurrentTime());
		$this->Position->set('updated_at', Utils::get_CurrentTime());
		
		if ($this->Position->save()) {
			
			return true;
			
		} else {
			
			return false;
		}
		
	}
	
	public function 
	_delete_Position($position_id) {
		
		$this->loadModel('Position');

// 		$position = $this->Position->find('all',
// 						//REF conditions http://book.cakephp.org/2.0/en/models/retrieving-your-data.html#find
// 						array(
// 								'conditions' => array(
// 										'Position.id' => $position_id
											
// 								)
// 						)
// 					);
		
		if ($this->Position->delete($position_id)) {
			
			return true;
			
		} else {
			
			return false;
		}
		
	}

	public function
	sort_Position_by_Point($positions) {
		
// 		usort($positions, "cmp_Position_by_Point");

		//REF http://cakephp.1045679.n5.nabble.com/Using-usort-in-Cake-td1327099.html Aug 11, 2009; 9:18pm
		usort($positions, array(&$this, "cmp_Position_by_Point"));
		
		return $positions;
		
// 		return usort($positions, array(&$this, "cmp_Position_by_Point"));
		
	}
	
	//REF http://stackoverflow.com/questions/4282413/php-sort-array-of-objects-by-object-fields answered Nov 26 '10 at 3:53
	public function
	cmp_Position_by_Point($pos1, $pos2) {

		//REF http://www.php.net/manual/en/function.floatval.php
		$point_1 = floatval($pos1['Position']['point']);
		$point_2 = floatval($pos2['Position']['point']);
		
		//REF http://stackoverflow.com/questions/481466/php-string-to-float answered Jan 26 '09 at 21:35
// 		$point_1 = (float) $pos1['Position']['point'];
// 		$point_2 = (float) $pos2['Position']['point'];
		
		return $point_1 > $point_2;
// 		return $point_1 < $point_2;
		
	}

	public function
	sort_PosList() {
		/******************************
		
			layout
		
		******************************/
		$this->layout = 'plain';
		
		/******************************
		
			get: parameter
		
		******************************/
		$id = $this->request->query['video_id'];
		
		/******************************
		
		positions
		
		******************************/
		$this->loadModel('Position');
			
		$positions = $this->Position->find('all',
			//REF conditions http://book.cakephp.org/2.0/en/models/retrieving-your-data.html#find
			array(
				'conditions' => array(
						'Position.video_id' => $id
							
				)
			)
		);
		
		$positions = $this->sort_Position_by_Point($positions);
		
		//REF http://blogs.bigfish.tv/adam/2008/03/24/sorting-with-setsort-in-cakephp-12/
		//REF referer http://cakephp.1045679.n5.nabble.com/Using-usort-in-Cake-td1327099.html Aug 10, 2009; 11:32pm
		// 		$positions = Set::sort($positions, '{n}.Position.point', 'asc');
		
		$this->set('positions', $positions);		

		$this->render('/Elements/videos/js/return_AllEntries');
		
	}//sort_PosList()

}