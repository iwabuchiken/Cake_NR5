<?php

class ArticlesController extends AppController {
	public $helpers = array('Html', 'Form', 'Mytest');
// 	public $helpers = array('Html', 'Form');

	public function 
	index() {

// 		//test
// 		$now=new DateTime; //includes hours, minutes, seconds
// 		$today=new DateTime($now->format('Ymd')); //time set to 0:00
		
// 		debug($today);
		
		/**********************************
		* genre id
		**********************************/
		$query_genre_id = $this->_index_Get_GenreID();
		
		/**********************************
		* get: articles
		**********************************/
		$articles = $this->_index_GetArticles($query_genre_id);
		
		/*******************************
			vendors
		*******************************/
// 		debug("before filter");
// 		debug(count($articles));
		
// 		$articles = $this->_index_Filter_Vendor($articles);

// 		debug("after filter");
// 		debug(count($articles));
		
// 		$this->set("articles", $articles);
		
// 		$filter_vendor = $this->get_Admin_Value(CONS::$admin_FilterVendors, "val1");
// 		// 		$val_1 = $this->get_Admin_Value("open_mode", "val1");

// 		if (condition) {
// 			;
// 		}
		
// 		$vendors = array();
		
// 		for ($i = 0; $i < count($articles); $i++) {
			
// 			$vendor = $articles[$i]['vendor'];
			
// 			$vendors[$vendor] = $vendor;
			
// // 			array_push($vendors, $vendor);
			
// 		}
		
// 		$vendors = array_unique($vendors);
		
// 		asort($vendors);	
		
// // 		debug($vendors);
		
// // 		debug("count(\$vendors)");
// // 		debug(count($vendors));
		
// 		$this->set("vendors", $vendors);
		
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
	_index_Filter_Vendor($articles) {

		$filter_vendor = $this->get_Admin_Value(CONS::$admin_FilterVendors, "val1");

		/*******************************
			validate:
		*******************************/
		if ($filter_vendor == null) {
			
// 			debug("\$filter_vendor => null");
			
			return $articles;
			
		}
		
		/*******************************
			tokens
		*******************************/
		$tokens = explode(" ", $filter_vendor);
		
// 		debug($tokens);

		/*******************************
			filter
		*******************************/
		$articles_new = array();
		
// 		debug($articles[0]);
		
		for ($i = 0; $i < count($articles); $i++) {
			
			$v = $articles[$i]['vendor'];
			
			$is_In = false;
			
			for ($j = 0; $j < count($tokens); $j++) {
				
				if($v == $tokens[$j]) {

// 					debug($articles[$i]);
					
					$is_In = true;
					
					break;
					
				}
				
			}
			
			if ($is_In == false) {
				
				array_push($articles_new, $articles[$i]);
				
			} else {
				
// 				debug("not included");
// 				debug($articles[$i]);
			}
			
		}//for ($i = 0; $i < count($articles); $i++)
		
		/*******************************
			return
		*******************************/
// 		debug(count($articles));
// 		debug(count($articles_new));
		
		return $articles_new;
		
	}//_index_Filter_Vendor
	
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
	_index_GetArticles
	($query_genre_id) {

// 		debug($query_genre_id);
		
		/**********************************
		* get: articles (initial)
		**********************************/
		$articles = $this->__index_Get_Articles($query_genre_id);

// 		debug(count($articles));
		
		$articles = $this->_index_Filter_Vendor($articles);
		
// 		debug(count($articles));
		
// 		debug($articles[0]);
		
// 		debug("articles => ".count($articles));
		
		// validate
		if ($articles == null) {
			
			debug("articles => null");
			
			return;
			
		}
		
		/**********************************
		* get: categories
		**********************************/
		$categories = $this->__index_Get_Categories($query_genre_id);

		/**********************************
		* get: kw sets
		**********************************/
		$kw_sets = $this->__index_Get_KW_Sets($categories);
		
		/**********************************
		* categorize
		**********************************/
		$a_categorized_new = $this->__index_Grouping($articles, $categories, $kw_sets);
		
		ksort($a_categorized_new);
		
// 		debug(array_keys($a_categorized_new));
		
		/**********************************
		* sort
		**********************************/
// 		usort($a_categorized_new, array(&$this, 'cmp_Articles'));	// Undefined index: Category
		
		//REF http://cakephp.1045679.n5.nabble.com/Using-usort-in-Cake-td1327099.html Aug 11, 2009; 9:18pm
		@uksort($a_categorized_new, array(&$this, 'cmp_Articles'));	// n/c
		//REF https://groups.google.com/forum/#!topic/cake-php/hNOGb_yWLig "Finally got it figured out."
// 		uksort($a_categorized_new, array('ArticlesController', 'cmp_Articles'));
// 		uksort($a_categorized_new, "cmp_Articles");

		$a_categorized_new = $this->_index_Sort_CategorizedArticles($a_categorized_new);
		
		/**********************************
		* set: vars
		**********************************/
		$this->set('articles', $articles);
		
		$this->set('a_categorized', $a_categorized_new);

// 		debug($a_categorized_new[0]);
		
		//test
		$this->set('abc', "abcabc");

		/*******************************
			return
		*******************************/
		return $articles;
		
	}//_index_GetArticles_D9_V_2_1

	public function
	_index_Sort_CategorizedArticles($a_categorized_new) {

// 		@uksort($a_categorized_new, array(&$this, 'cmp_Articles__NewsTime'));	// n/c

		/*******************************
			get: keys
		*******************************/
		$keys = array_keys($a_categorized_new);
		
		/*******************************
			sort: test
		*******************************/
// 		$category = $a_categorized_new[$keys[2]];
		
// 		debug($category);
		
// 		@usort($category, array(&$this, 'cmp_Articles__NewsTime'));
		
// 		debug("sorted: news_time");
// 		debug($category);
		
// 		@usort($category, array(&$this, 'cmp_Articles__Vendor'));
		
// 		debug("sorted: vendor");
// 		debug($category);
		
		/*******************************
			sort
		*******************************/
		$a_categorized_new_Filtered = array();
		
		$categories = array();
		
		for ($i = 0; $i < count($a_categorized_new); $i++) {
			
// 			$categories[$i] = $a_categorized_new[$keys[$i]];
			$category = $a_categorized_new[$keys[$i]];
			
// 			debug("key");
// 			debug($keys[$i]);
			
			@usort($category, array(&$this, 'cmp_Articles__NewsTime'));

			@usort($category, array(&$this, 'cmp_Articles__Vendor'));
			
			$a_categorized_new_Filtered[$keys[$i]] = $category;
			
		}
		
		/*******************************
			return
		*******************************/
		return $a_categorized_new_Filtered;
// 		return $a_categorized_new;
		
	}//_index_Sort_CategorizedArticles($a_categorized_new)
	
	public function
	_index_GetArticles_D9_V_2_1
	($query_genre_id) {

		/**********************************
		* get: articles (initial)
		**********************************/
		$articles = $this->__index_Get_Articles($query_genre_id);

		/**********************************
		* get: categories
		**********************************/
		$categories = $this->__index_Get_Categories($query_genre_id);

		/**********************************
		* get: kw sets
		**********************************/
		$kw_sets = $this->__index_Get_KW_Sets($categories);
		
		/**********************************
		* categorize
		**********************************/
		$a_categorized_new = $this->__index_Grouping($articles, $categories, $kw_sets);
		
		/**********************************
		* set: vars
		**********************************/
		$this->set('articles', $articles);
		
		$this->set('a_categorized', $a_categorized_new);

	}//_index_GetArticles_D9_V_2_1

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
	__index_Get_KW_Sets
	($categories) {
// 		/**********************************
// 			* categories
// 		**********************************/
// 		$this->loadModel('Category');
			
// 		$option = array(
	
// 				'conditions' =>
// 				array(
							
// 						'Category.genre_id' => $query_genre_id
	
// 				)
// 		);
	
// 		$categories = $this->Category->find('all', $option);
	
		/**********************************
			* keywords
		**********************************/
		return $this->__index_GetArticles_D9_V_2_0__Get_KW_sets($categories);
		
	}//__index_Get_KW_Sets

	public function
	__index_Get_Categories
	($query_genre_id) {
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
	
		return $this->Category->find('all', $option);
	
	}//__index_Get_Categories


	public function
	__index_Grouping
	($articles, $categories, $kw_sets) {
// 		/**********************************
// 			* keywords
// 		**********************************/
// 		$kw_sets = $this->__index_GetArticles_D9_V_2_0__Get_KW_sets($categories);
		
		/**********************************
			* grouping
		**********************************/
		// 		debug($articles[5]);
	
		$a_categorized =
			$this->__index_GetArticles_D9_V_2_1__Categorize(
								$articles, $kw_sets, $categories);
// 								$articles, $keywords, $category);
	
		return $a_categorized;
	
	}//__index_Grouping

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
		
		/**********************************
			* grouping
		**********************************/
		// 		debug($articles[5]);
	
		$a_categorized =
			$this->__index_GetArticles_D9_V_2_1__Categorize(
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
	__index_GetArticles_D9_V_2_1__Categorize
	($articles, $kw_sets, $categories) {
	
// 		debug("kw_sets => ".count($kw_sets));
// 		debug("categories => ".count($categories));
		
		$a_categorized_main = array();
	
		$a_categorized = array();
		$a_categorized_others = array();

		//tmp
		$keywords = $kw_sets[0];
		$category = $categories[0];
		
		// array
		$a_categorized_new = array();
		$a_categorized_others_new = array();
		$a_categorized_main_new = array();
		
		for ($i = 0; $i < count($categories); $i++) {
			
			$a_categorized_main_new[$categories[$i]['Category']['id']]
// 			$a_categorized_main_new[$categories[$i]['Category']['name']]
						= array();
			
		}

		/**********************************
		* categorize: new
		**********************************/
		for ($i = 0; $i < count($articles); $i++) {
			
			$a = $articles[$i];
			
			$line = $a['line'];
			
			$found = false;
			
			for ($j = 0; $j < count($kw_sets); $j++) {
				
				$kws = $kw_sets[$j];

				
				foreach ($kws as $k) {
				
					$k_name = $k['Keyword']['name'];
		
					$p = "/$k_name/";
		
					$res = preg_match($p, $line);
		
					if ($res == 1) {
		
// 						array_push($a_categorized_new, $a);
							
						// colorize
						$tmp = $a['line'];
						
						//REF http://php.net/manual/ja/function.str-replace.php
						$tmp = str_replace(
								$k_name, "<font color=\"blue\">".$k_name."</font>", $tmp);
						
						$a['line'] = $tmp;
						
						$found = true;
							
						break;
							
					}
				
				}//foreach ($kws as $k)
				
				// found?
				if ($found == true) {
					
					array_push(
							$a_categorized_main_new[$categories[$j]['Category']['id']], 
// 							$a_categorized_main_new[$categories[$j]['Category']['name']], 
							$a);
					
					break;
					
				}
				
			}//for ($j = 0; $j < count($kw_sets); $j++)
				
			// not found
			if ($found == false) {
				
				array_push(
						$a_categorized_others_new, 
						$a);
				
			}
			
		}//for ($i = 0; $i < count($articles); $i++)

		// Others
		$a_categorized_main_new[CONS::$category_Others_Num] = $a_categorized_others_new;
// 		$a_categorized_main_new[CONS::$category_Others_Label] = $a_categorized_others_new;
// 		$a_categorized_main_new['Others'] = $a_categorized_others_new;
// 		array_push(
// 				$a_categorized_main_new['Others'],
// 				$a_categorized_others_new);
		
		/**********************************
			* grouping
		**********************************/
// 		debug($keywords);
		
		foreach ($articles as $a) {
	
			$found = false;
				
			$line = $a['line'];
			// 			$line = $a['Article']['line'];
				
			foreach ($keywords as $k) {
	
				$k_name = $k['Keyword']['name'];
	
				$p = "/$k_name/";
	
				$res = preg_match($p, $line);
	
				if ($res == 1) {
		
// 					debug($a);
					
					// colorize
					$tmp = $a['line'];
						
					//REF http://php.net/manual/ja/function.str-replace.php
					$tmp = str_replace(
							$k_name, "<font color=\"blue\">".$k_name."</font>", $tmp);
						
					$a['line'] = $tmp;
					
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
	
		return $a_categorized_main_new;
// 		return $a_categorized_main;
	
	}//__index_GetArticles_D9_V_2_1__Categorize
	
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
	__index_Get_Articles
	($query_genre_id) {
		
		/**********************************
		 * get: html
		**********************************/
		$articles = $this->__index_Get_Articles__Top($query_genre_id);
		
// 		debug("top => ".count($articles));
		
		/**********************************
		* further pages
		**********************************/
		$numOf_Pages = $this->get_Admin_Value(CONS::$admin_NumOfPages, "val1");
		
		if ($numOf_Pages == null || !is_numeric($numOf_Pages)) {
			
			$numOf_Pages = 3;
			
		}
		
		for ($i = 1; $i <= $numOf_Pages; $i++) {
// 		for ($i = 1; $i <= 3; $i++) {
			
			$articles = $this->__index_Get_Articles__Page_X($query_genre_id, $articles, $i);
			
		}
		
// 		$articles = $this->__index_Get_Articles__Page_X($query_genre_id, $articles, 1);

// // 		debug("top + 1 => ".count($articles));
		
// 		$articles = $this->__index_Get_Articles__Page_X($query_genre_id, $articles, 2);
		
// // 		debug("top + 2 => ".count($articles));
		
		/***********************************************
			limit num of articles => by date
		***********************************************/
		$articles_Limited_BY_Date = array();
		
		/*******************************
			prep: dates
		*******************************/
		//ref http://php.net/manual/en/datetime.sub.php
		$date = new DateTime;
// 		$date = new DateTime('2000-01-20');

		// admin value
		$past_XDays = Utils::get_Admin_Value(CONS::$admin_LimitArticle_PastXDays, "val1");
		
		// validate: null
		if ($past_XDays === null) {
			
			$past_XDays = 3;
			
		}//$past_XDays === null
		
// 		$past_XDays = 3;
		
		//ref http://stackoverflow.com/questions/5368890/mixing-php-variable-with-string-literal answered Mar 20 '11 at 13:55
		$param = "P{$past_XDays}D";
		
// 		debug($param);
		
		$date->sub(new DateInterval($param));
// 		$date->sub(new DateInterval('P10D'));
// 		echo $date->format('Y-m-d') . "\n";
		
		$limit = $date->format('Ymd');

		debug("\$limit => ".$limit);
// 		debug($date->format('Ymd'));

		/*******************************
			limit
		*******************************/
		foreach ($articles as $elem) {
		
			// filter
			if ($elem['news_time'] > $limit) {
				
				array_push($articles_Limited_BY_Date, $elem);
				
			}//$elem['news_time'] > $limit
			
// 			debug($elem['news_time']);
			
// 			break;
			
		}//foreach ($articles as $elem)
		
		
		
		
		/**************************************************
		* return
		**************************************************/
		return $articles_Limited_BY_Date;
// 		return $articles;
		
	}//__index_Get_Articles
	
	public function
	__index_Get_Articles__Top
	($query_genre_id) {

		if ($query_genre_id == null) {
		
			$genre = "soci";
		
		} else {
		
			$genre = $this->_get_GenreCode_from_GenreID($query_genre_id);
		
		}
		
		$url = "http://headlines.yahoo.co.jp/hl?c=$genre&t=l";
		
		//REF http://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/
		$html = file_get_html($url);
		
		$ahrefs = $html->find('a[href]');
		
// 		debug(count($ahrefs));
		
		$ahrefs_hl = array();
		
		foreach ($ahrefs as $ahref) {
		
			if (Utils::startsWith($ahref->href, "http://headlines")
					&& count(explode("-", $ahref->href)) > 3) {
		
						array_push($ahrefs_hl, $ahref);
		
					}
		
		}//foreach ($ahrefs as $ahref)
		
// 		debug(count($ahrefs_hl));
		
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
		
		}//foreach ($ahrefs_hl as $ahref)
		
		return $articles;
		
	}//__index_Get_Articles__Top
	
	public function
	__index_Get_Articles__Page_X
	($query_genre_id, $articles, $page) {

		if ($query_genre_id == null) {
		
			$genre = "soci";
		
		} else {
		
			$genre = $this->_get_GenreCode_from_GenreID($query_genre_id);
		
		}
		
		$url = "http://headlines.yahoo.co.jp/hl?c=$genre&t=l&p=$page";
		
		//REF http://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/
		$html = file_get_html($url);
		
		$ahrefs = $html->find('a[href]');
		
// 		debug("\$ahrefs($page) => ".count($ahrefs));
		
		$ahrefs_hl = array();
		
		foreach ($ahrefs as $ahref) {
		
			// 			if (Utils::startsWith($ahref->href, "/hl")) {
// 			if (Utils::startsWith($ahref->href, "/hl")
// 					&& count(explode("-", $ahref->href)) > 3) {
		if (Utils::startsWith($ahref->href, "http://headlines")
				&& count(explode("-", $ahref->href)) > 3) {
		
// 						$ahref->href = "http://headlines.yahoo.co.jp".$ahref->href;
		
						array_push($ahrefs_hl, $ahref);
		
					}
		
		}//foreach ($ahrefs as $ahref)
		
// 		debug("\$ahrefs_hl($page) => ".count($ahrefs_hl));
		
		/**********************************
		 * build: list
		**********************************/
// 		$articles = array();
		
		foreach ($ahrefs_hl as $ahref) {
		
			$a = $this->Article->create();
		
			$a['url'] = $ahref->href;
		
			$a['line'] = $ahref->plaintext;
		
			// 			$a->vendor = $this->conv_Url_to_VendorName($ahref->href);
			$a['vendor'] = $this->conv_Url_to_VendorName($ahref->href);
		
			$a['news_time'] = $this->conv_Url_to_NewsTime($ahref->href);
		
			array_push($articles, $a);
		
		}//foreach ($ahrefs_hl as $ahref)
		
		return $articles;
		
	}//__index_Get_Articles__Page_X
	
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

					// colorize
					$tmp = $a['line'];
					
					//REF http://php.net/manual/ja/function.str-replace.php
					$tmp = str_replace(
								$k_name, "<font color=\"blue\">".$k_name."</font>", $tmp);
					
					$a['line'] = $tmp;
					
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

	public function
	open_article() {
		
		$article_url = @$this->request->query['article_url'];
		$article_line = @$this->request->query['article_line'];
		$article_vendor = @$this->request->query['article_vendor'];
		
		//sanitize
		$article_line = Utils::sanitize_Tags($article_line, array("font"));
		
		$article_category_id = @$this->request->query['article_category_id'];
		$article_genre_id = @$this->request->query['article_genre_id'];
		
		$article_news_time = @$this->request->query['article_news_time'];

		/**********************************
		* get: content
		**********************************/
		$article_content = $this->_open_article__GetContent_2($article_url);
// 		$article_content = $this->_open_article__GetContent($article_url);
		
		/**********************************
		* build: instance: History
		**********************************/
		$this->loadModel('History');
		
		$this->History->create();
		
		$this->History->set('url', $article_url);
		$this->History->set('line', $article_line);
		
		$this->History->set('vendor', $article_vendor);
		$this->History->set('news_time', $article_news_time);
		
		$this->History->set('category_id', $article_category_id);
		$this->History->set('genre_id', $article_genre_id);
		
		$this->History->set('content', $article_content);
		
		$this->History->set('created_at', Utils::get_CurrentTime());
		$this->History->set('updated_at', Utils::get_CurrentTime());

		/**********************************
		* get: setting value: open_mode
		**********************************/
		$val_1 = $this->get_Admin_Value(CONS::$admin_Open_Mode, "val1");
// 		$val_1 = $this->get_Admin_Value("open_mode", "val1");
		
		// default
		if ($val_1 == null || !is_numeric($val_1)) {
			
			$open_mode = 1;
			
		} else {
			
			$open_mode = intval($val_1);
			
		}
		
		/**********************************
		* save: history
		**********************************/
		if ($this->History->save()) {

			if ($open_mode == 1) {
				
				//REF http://book.cakephp.org/2.0/ja/controllers.html#id8
				$this->redirect($article_url);
			
			} else {
				
				/**********************************
				* build: article
				**********************************/
				$a = $this->Article->create();
// 				$a = new Article();
				
				$a['url'] = $article_url;
				$a['line'] = $article_line;
				$a['vendor'] = $article_vendor;
				$a['news_time'] = $article_news_time;
				$a['category_id'] = $article_category_id;
// 				$a['content'] = $article_content;

				/**********************************
				* colorize
				**********************************/
				$val_1 = $this->get_Admin_Value(CONS::$admin_Colorize, "val1");
				
				if ($val_1 == null || !is_numeric($val_1) || intval($val_1) == 1) {
				
					$a['content'] = 
							$this->_content_multilines_GetHtml($article_content);
					// 			$content_multiline = $this->_build_Text($words);
						
				} else {
				
					$line_Length = mb_strlen($article_content);
					
					debug("line_Length => ".$line_Length);
					
					$words_ary = Utils::get_Words($article_content);
// 					$words = $this->get_Words($article_content);
					
					$tmp = "";
					
					$array_num = count($words_ary);
					
					for ($i = 0; $i < $array_num; $i++) {
						
						$tmp .= $this->build_Text_Colorize_Kanji($words_ary[$i]);
						
					}
					
// 					$tmp = $this->build_Text_Colorize_Kanji($words);
					
					$a['content'] = $this->_content_multilines_GetHtml($tmp);
					// 			$content_multiline = $this->_build_Text_Colorize_Kanji($words);
				
				}
				
				
// 				$a['content'] = $this->_content_multilines_GetHtml($article_content);
				
// 				debug($a);
				
				$this->set("a", $a);
// 				$this->set("article", $this->History);
// 				$this->redirect();
				
			}
			
		} else {//if ($this->History->save())
			
			$this->Session->setFlash(__("Can't save history: line is => ".$article_line));
			
			$this->redirect(
						array(
							'controller' => 'historys', 
							'action' => 'index'));
			
		}//if ($this->History->save())
		
	}//open_article

	public function
	_open_article__GetContent
	($article_url) {
		
// 		$url = "http://headlines.yahoo.co.jp/hl?c=$genre&t=l";
		
		//REF http://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/
		$html = file_get_html($article_url);
		
		$ahrefs = $html->find('p[class]');

		$texts = array();
		
		foreach ($ahrefs as $ahref) {
		
			if ($ahref->class == "ynDetailText") {
				
// 				return $ahref->plaintext;
				array_push($texts, $ahref->plaintext);
				
			}
		
		}//foreach ($ahrefs as $ahref)
			
		/*******************************
			return
		*******************************/
		return implode("", $texts);
		
	}//_open_article__GetContent
	
	public function
	_open_article__GetContent_2
	($article_url) {
		
		$html = file_get_html($article_url);

// 		debug(get_class($html));
		
		/*******************************
			div[class]
		*******************************/
		//REF http://www.phpbuilder.com/columns/PHP_HTML_DOM_parser/PHPHTMLDOMParser.cc_09-07-2011.php3 "Find the element where the id is equal to a certain value"
// 		$pages = $html->find('div[class]');
// 		$pages = $html->find("div[class=ymuiPagingBottom]");	//=> working
// 		$pages = $html->find("div[class=ymuiPagingBottom] a");	//=> 2
		$pages = $html->find("div[class=ymuiPagingBottom] a[href]");	//=> 2

		
// 		debug("count(\$pages)");
// 		debug(count($pages));
		
// 		if (count($pages) > 0) {

// 			for ($i = 0; $i < count($pages); $i++) {
				
// 				debug($pages[$i]->href);
				
// 			}
			
// 		}
		
		/*******************************
			dispatch
		*******************************/
		$texts = array();
		
		if ($pages != null && count($pages) > 1) {
		
			/*******************************
				page 1
			*******************************/
			$text = $this->_open_article__GetContent($article_url);
			
			array_push($texts, "[PAGE-1]");
			array_push($texts, $text);
			
			/*******************************
				page 2 ~
			*******************************/
			for ($i = 0; $i < count($pages) - 1; $i++) {

				debug($pages[$i]->href);
				
				$text = $this->_open_article__GetContent($pages[$i]->href);
				
				if ($text != null) {
					
					array_push($texts, "[PAGE-".($i+2)."]");
					array_push($texts, $text);
					
				}
			}
		
		} else {
		
			/*******************************
			 p[class]
			*******************************/
			$ahrefs = $html->find('p[class]');
			
			
			
// 			$texts = array();
			
			foreach ($ahrefs as $ahref) {
			
				if ($ahref->class == "ynDetailText") {
			
					// 				return $ahref->plaintext;
					array_push($texts, $ahref->plaintext);
			
				}
			
			}//foreach ($ahrefs as $ahref)
					
		}
		
		
// 		/*******************************
// 			p[class]
// 		*******************************/
// 		$ahrefs = $html->find('p[class]');

		
		
// 		$texts = array();
		
// 		foreach ($ahrefs as $ahref) {
		
// 			if ($ahref->class == "ynDetailText") {
				
// // 				return $ahref->plaintext;
// 				array_push($texts, $ahref->plaintext);
				
// 			}
		
// 		}//foreach ($ahrefs as $ahref)
			
		/*******************************
			return
		*******************************/
		return implode("", $texts);
		
	}//_open_article__GetContent
	
	
	public function
	cmp_Articles($a1, $a2) {
		
// 		debug("a1 = ".$a1);
		
// 		$key_a1 = array_keys($a1)[0];
		
		$a1_new = mb_convert_encoding($this->get_CategoryName_From_CategoryID($a1), "UTF-8", "SJIS");	// n/c
		$a2_new = mb_convert_encoding($this->get_CategoryName_From_CategoryID($a2), "UTF-8", "SJIS");
// 		$a1_new = mb_convert_encoding($this->get_CategoryName_From_CategoryID($a1), "UTF-8");	// n/c
// 		$a2_new = mb_convert_encoding($this->get_CategoryName_From_CategoryID($a2), "UTF-8");
// 		$a1_new = $this->get_CategoryName_From_CategoryID($a1);
// 		$a2_new = $this->get_CategoryName_From_CategoryID($a2);
		
		
// 		debug($a1_new);
		
// 		$a1_new = $this->get_CategoryName_From_CategoryID($a1);	//  uksort(): Array was modified by the user comparison function
// 		$a2_new = $this->get_CategoryName_From_CategoryID($a2);
// 		$a1 = $this->get_CategoryName_From_CategoryID($a1);		//  uksort(): Array was modified by the user comparison function
// 		$a2 = $this->get_CategoryName_From_CategoryID($a2);
		
		return strcasecmp($a1_new, $a2_new);
		
	}
	
	public function
// 	cmp_Articles__NewsTime(&$a1, &$a2) {
	cmp_Articles__NewsTime($a1, $a2) {
		
// 		debug("a1 = ".$a1);
		
// 		$key_a1 = array_keys($a1)[0];
		
		$a1_new = $a1['news_time'];
		$a2_new = $a2['news_time'];
		
		return strcasecmp($a2_new, $a1_new);
// 		return strcasecmp($a1_new, $a2_new);
		
	}
	
	public function
// 	cmp_Articles__NewsTime(&$a1, &$a2) {
	cmp_Articles__Vendor($a1, $a2) {

		if ($a1['news_time'] != $a2['news_time']) {
			
// 			debug($a1);
// 			debug($a2);
			
// 			return 1;
// 			return -1;
			return strcasecmp($a2['news_time'], $a1['news_time']);;
// 			return 0;
			
		}
		
		$a1_new = $a1['vendor'];
		$a2_new = $a2['vendor'];
		
		return strcasecmp($a2_new, $a1_new);
// 		return strcasecmp($a1_new, $a2_new);
		
	}
	
	public function
	get_CategoryName_From_CategoryID
	($category_id){
	
		// 		debug($category_id);
		/**********************************
			* "Others"
		**********************************/
		if (((int)$category_id) == CONS::$category_Others_Num) {
				
			return CONS::$category_Others_Label;
				
		}
	
		/**********************************
			* category
		**********************************/
		//REF http://stackoverflow.com/questions/13356205/how-do-i-use-model-in-helper-cakephp-2-x answered Nov 13 '12 at 6:13
		App::import("Category");
		$model = new Category();
	
		$option = array(
				'conditions' => array('Category.id' => (int)$category_id));
		// 				'conditions' => array('Category.id' => $category_id));
	
		$category = $model->find('first', $option);
	
		// 		return $category;
		return $category['Category']['name'];
	
	}//get_Genre_From_KeywordID

	/**********************************<br>
	* build html => split with "。", add "<br>" tag, add numbering<br>
	**********************************/
	public function
	_content_multilines_GetHtml
	($content) {
	
		$lines = explode("。", $content);
	
		$lines_new = array();
	
		foreach ($lines as $line) {
	
			$tmp = $line."。"."<br>"."<br>";
				
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
	test_ymuiPagingBottom() {

		$url = "http://headlines.yahoo.co.jp/hl?a=20150206-00000021-bloom_st-bus_all";

		$text = $this->_open_article__GetContent_2($url);
		
		$this->set("text", $text);

		//REF http://stackoverflow.com/questions/11711385/rendering-controller-to-a-different-view-in-cakephp answered Jul 30 '12 at 5:10
		$this->render('test/test_1');		
		
	}

	public function
	store_Article_from_URL() {
		
// 		$url = @$this->request->query['url'];
		
// 		debug($url);
		
		$this->render('/Articles/others/add');
// 		$this->render('/Articles/others/plain');
		
	}//store_Article_from_URL
	
	public function
	store_Article() {
		
		$url = @$this->request->query['url'];
		
		debug($url);

		///////////////////////////////
		//
		// validate
		//
		 ///////////////////////////////
		if ($url == null) {
			
			$msg = "no url";
		
			$this->Session->setFlash(__($msg));
			
			return $this->redirect(array('action' => 'store_Article_from_URL'));
			
		}
		
		///////////////////////////////
		//
		// get: basic info
		//
		 ///////////////////////////////
// 		http://headlines.yahoo.co.jp/hl?a=20150528-00000051-reut-bus_all

		$tokens_1 = explode("=", $url);
		
// 		debug($tokens_1);
		
		$tokens_2 = explode("-", $tokens_1[1]);
		
		debug($tokens_2);
		
		///////////////////////////////
		//
		// processing
		//
		 ///////////////////////////////
		$article_url = $url;
		
		///////////////////////////////
		//
		// get: line
		//
		 ///////////////////////////////
		$article_line = Utils::get_Article_Line($url);
		
		debug($article_line);
		
		$article_vendor = $tokens_2[2];
		
		//sanitize
// 		$article_line = Utils::sanitize_Tags($article_line, array("font"));
		
		// -5
		$article_category_id = -1;
		
		$genre = Utils::get_Genre_From_Genre_Code($tokens_2[3]);
		
		$article_genre_id = $genre['Genre']['id'];
		
		$article_news_time = @$this->request->query['article_news_time'];
		
// 		debug("genre id = ".$article_genre_id);
		
		/**********************************
		 * get: content
		**********************************/
		$article_content = $this->_open_article__GetContent($article_url);
		
// 		debug($article_content);
		
// 		$article_content = $tokens_2[0];
		// 		$article_content = $this->_open_article__GetContent($article_url);
		
		/**********************************
		 * build: instance: History
		**********************************/
		$this->loadModel('History');
		
		$this->History->create();
		
		$this->History->set('url', $article_url);
		$this->History->set('line', $article_line);
		
		$this->History->set('vendor', $article_vendor);
		$this->History->set('news_time', $article_news_time);
		
		$this->History->set('category_id', $article_category_id);
		$this->History->set('genre_id', $article_genre_id);
		
		$this->History->set('content', $article_content);
		
		$this->History->set('created_at', Utils::get_CurrentTime());
		$this->History->set('updated_at', Utils::get_CurrentTime());
		
		debug("history => set");
		
		/**********************************
		 * get: setting value: open_mode
		**********************************/
		$val_1 = $this->get_Admin_Value(CONS::$admin_Open_Mode, "val1");
		// 		$val_1 = $this->get_Admin_Value("open_mode", "val1");
		
		// default
		if ($val_1 == null || !is_numeric($val_1)) {
				
			$open_mode = 1;
				
		} else {
				
			$open_mode = intval($val_1);
				
		}
		
		debug("open_mode => ".$open_mode);
		
		/**********************************
		 * save: history
		**********************************/
		if ($this->History->save()) {
		
			if ($open_mode == 1) {
		
				//REF http://book.cakephp.org/2.0/ja/controllers.html#id8
				$this->redirect($article_url);
					
			} else {
		
				/**********************************
				 * build: article
				**********************************/
				$a = $this->Article->create();
				// 				$a = new Article();
		
				$a['url'] = $article_url;
				$a['line'] = $article_line;
				$a['vendor'] = $article_vendor;
				$a['news_time'] = $article_news_time;
				$a['category_id'] = $article_category_id;
				// 				$a['content'] = $article_content;
		
				/**********************************
				 * colorize
				**********************************/
				$val_1 = $this->get_Admin_Value(CONS::$admin_Colorize, "val1");
		
				if ($val_1 == null || !is_numeric($val_1) || intval($val_1) == 1) {
		
					$a['content'] =
						$this->_content_multilines_GetHtml($article_content);
					// 			$content_multiline = $this->_build_Text($words);
		
				} else {
		
					$line_Length = mb_strlen($article_content);
						
					debug("line_Length => ".$line_Length);
						
					$words_ary = Utils::get_Words($article_content);
					// 					$words = $this->get_Words($article_content);
						
					$tmp = "";
						
					$array_num = count($words_ary);
						
					for ($i = 0; $i < $array_num; $i++) {
		
						$tmp .= $this->build_Text_Colorize_Kanji($words_ary[$i]);
		
					}
						
					// 					$tmp = $this->build_Text_Colorize_Kanji($words);
						
					$a['content'] = $this->_content_multilines_GetHtml($tmp);
					// 			$content_multiline = $this->_build_Text_Colorize_Kanji($words);
		
				}
		
		
				// 				$a['content'] = $this->_content_multilines_GetHtml($article_content);
		
				// 				debug($a);
		
				$this->set("a", $a);
				// 				$this->set("article", $this->History);
				// 				$this->redirect();
		
			}
				
		} else {//if ($this->History->save())
				
			$this->Session->setFlash(__("Can't save history: line is => ".$article_line));
				
			$this->redirect(
					array(
							'controller' => 'historys',
							'action' => 'index'));
				
		}//if ($this->History->save())
		
		$msg = "article stored";
		
		$this->Session->setFlash(__($msg));
		
		$this->render('/Articles/open_article');
// 		$this->render('/Articles/others/add_result');
// 		$this->render('/Articles/others/plain');
		
	}//store_Article_from_URL

	public function
	test() {
		
		/*******************************
			D-31
		*******************************/
		/*******************************
		 get: todays date
		*******************************/
		//ref http://php.net/manual/en/datetime.sub.php
		$date = new DateTime;
// 		$date = new DateTime('2000-01-20');

		$past_XDays = 3;
		
		//ref http://stackoverflow.com/questions/5368890/mixing-php-variable-with-string-literal answered Mar 20 '11 at 13:55
		$param = "P{$past_XDays}D";
		
		debug($param);
		
		$date->sub(new DateInterval($param));
// 		$date->sub(new DateInterval('P10D'));
// 		echo $date->format('Y-m-d') . "\n";
		
		debug($date->format('Ymd'));
// 		debug($date->format('Y-m-d'));
		
		//ref http://stackoverflow.com/questions/12424473/filtering-by-date-php-for-this-month-and-last-x-days-and-this-week answered Sep 14 '12 at 12:33
// 		$now=new DateTime; //includes hours, minutes, seconds
// 		$today=new DateTime($now->format('Ymd')); //time set to 0:00

// 		$mytime = new DateTime('2012-03-19 05:00:32');
// 		$mydate = new DateTime($mytime->format('Y-m-d')); //keep date only, exclude the time component
// 		$now=new DateTime; //includes hours, minutes, seconds
// 		$today=new DateTime($now->format('Y-m-d')); //time set to 0:00

// 		$interval = $mydate->diff($today);
// 		if($interval->format('d') <=7) { //assuming that $mydate isn't in the past
// 			//do something
// 		}

		
		$this->render("/Elements/plain");
		
	}
	
}//class ArticlesController extends AppController
