<?php

	require_once 'CONS.php';
	
	
class Utils_2 {
		
		public static function
		conv_Xml_2_AryOf_Pieces($xml) {
			
// 			debug($xml->word[4]);
			
			$words_ary = $xml->word;
			
// 			debug("count(\$words_ary) => ".count($words_ary));	//=> 'count($words_ary) => 158'
			
			$model = ClassRegistry::init('Piece');
			
			$aryOf_Pieces = array();
			
			#ref Utils::save_token_list(...)
			$count = 0;
			$count_max = 10;
		
			/*******************************
				build : ary of pieces
			*******************************/
			foreach ($words_ary as $w) {
			
				$data = array();
				
				$data['Piece']['created_at'] = Utils::get_CurrentTime(); 
				$data['Piece']['updated_at'] = Utils::get_CurrentTime(); 
				#ref (string) http://www.pahoo.org/e-soul/webtech/php06/php06-12-01.shtm
				$data['Piece']['form'] = (string)$w->surface;
				
				$tmp = explode(',', (string)$w->feature);
				
				$data['Piece']['hin']	= $tmp[0];
				
				$data['Piece']['hin_1']= $tmp[1];
				$data['Piece']['hin_2']	= $tmp[2];
				$data['Piece']['hin_3']	= $tmp[3];
				
				$data['Piece']['katsu_kei']	= $tmp[4];
				$data['Piece']['katsu_kata']	= $tmp[5];
				$data['Piece']['genkei']	= $tmp[6];
				
				if ($tmp == null || count($tmp) == 7 ) {
					
					$data['Piece']['yomi']	= "*";
					
					$data['Piece']['hatsu']	= "*";
					
				} else if (count($tmp) == 9) {
					
					$data['Piece']['yomi']	= $tmp[7];
					
					$data['Piece']['hatsu']	= $tmp[8];
					
				} else {
		
					debug("irregular number of tokens -> "
							.count($tmp)
							." (".(string)$w->feature.")");
					
					continue;
		
				}
				
// 				debug($tmp);	
				// 				array(
				// 						(int) 0 => '記号',
				// 						(int) 1 => '読点',
				// 						(int) 2 => '*',
				// 						(int) 3 => '*',
				// 						(int) 4 => '*',
				// 						(int) 5 => '*',
				// 						(int) 6 => '、',
				// 						(int) 7 => '、',
				// 						(int) 8 => '、'
				// 				)
				
// 				debug("count(\$tmp) => ".count($tmp));
				
// 				if (count($tmp) != 9) {
				
// 					debug("not 9");
					
// // 					debug($tmp);
					
// 				}//if (count($tmp) != 9)
// 				;
				
// 				debug($data['Piece']['form']);
// 				debug($tmp);
				
				# push to array
				array_push($aryOf_Pieces, $data);
				
// 				# count
// 				$count += 1;
				
// 				if ($count > $count_max) {
						
// 					debug("count => more than ".$count_max);
					
// 					break;
// // 					return ;
				
// 				}//if ($count > $count_max)
				
				
			}//foreach ($words_ary as $w)
			
// 			#debug
// 			debug("returning...");
// 			return;
			
			
			$count = 0;
			$count_max = 5;

			foreach ($aryOf_Pieces as $piece) {
				
				/*
				 * <Notice>
				 * 1. The model object needs to be created each time of the iterations
				 * 2. Otherwise, ONLY the last element in the iterations will be saved 
				 */
				$model->create();
				
				if ($model->save($piece)) {
					
					$count += 1;
					
// 					if ($count > $count_max) {
					
// 						break;
						
// 					}//if ($count > $count_max)
					
				} else {
					
					debug("data NOT saved : ".$piece['Piece']['form']);
				}
				
			}//foreach ($aryOf_Pieces as $piece)
			
			debug("pieces saved => '$count'");
			
		}//conv_Xml_2_AryOf_Pieces(xml)
		
		/*******************************
			@return
			> 0		=> number of pieces saved
			-1		=> This geschichte has already been saved
			-2		=> "find" method returned 'null'
		*******************************/
		public static function
		conv_Xml_2_AryOf_Pieces_2($xml, $geschichte) {

			/*******************************
				validate
			*******************************/
			$model = ClassRegistry::init('Piece');
			
			$id = $geschichte['Geschichte']['id'];
			
			$piece_tmp = $model->find('first', 
						array('conditions' => 
// 								array('Piece.geschichte_id' => 700))
								array('Piece.geschichte_id' => $id))
			);
			
			# validate
// 			if ($piece_tmp == null) {
// // 			if ($piece_tmp == null || count($piece_tmp) == 0) {
			
// // 				debug("'find' method returned 'null' : $id");
				
// // 				debug($piece_tmp);
				
// // 				debug(count($piece_tmp));
			
// // 				return -2;
				
// 			} else if (count($piece_tmp) > 0) {//if ($piece_tmp == null || count($piece_tmp) == 0)
			if (count($piece_tmp) > 0) {//if ($piece_tmp == null || count($piece_tmp) == 0)
// 			if ($piece_tmp == null || count($piece_tmp) == 0) {
			
				debug("This geschichte already piece-processed : $id");
			
				return -1;
				
			}//if ($piece_tmp == null || count($piece_tmp) == 0)
			;
			
			
// 			#debug
// 			debug("\$piece_tmp => ".count($piece_tmp));
// // 			debug("\$piece_tmp => ");
// 			debug($piece_tmp);
// 			return 0;
			
			/*******************************
				processing
			*******************************/
// 			debug($xml->word[4]);
			
			$words_ary = $xml->word;
			
// 			debug("count(\$words_ary) => ".count($words_ary));	//=> 'count($words_ary) => 158'
			
// 			$model = ClassRegistry::init('Piece');
			
			$aryOf_Pieces = array();
			
			#ref Utils::save_token_list(...)
			$count = 0;
			$count_max = 10;
		
			/*******************************
				build : ary of pieces
			*******************************/
			foreach ($words_ary as $w) {
			
				$data = array();
				
				$data['Piece']['created_at'] = Utils::get_CurrentTime(); 
				$data['Piece']['updated_at'] = Utils::get_CurrentTime(); 
				#ref (string) http://www.pahoo.org/e-soul/webtech/php06/php06-12-01.shtm
				$data['Piece']['form'] = (string)$w->surface;

				// 				* 	1	=> Kanji<br>
				// 				* 	2	=> Hiragana<br>
				// 				* 	3	=> Katakana<br>
				// 				* 	4	=> Number<br>
				// 				* 	5	=> Kanji & Hiragana<br>
				// 				* 	6	=> Kanji & Katakana<br>
				// 				* 	7	=> Hiragana & Katakana<br>
				// 				*
				// 				* 	0	=> Other<br>
				$data['Piece']['type'] = CONS::$dict[Utils::get_Type((string)$w->surface)];
// 				$data['Piece']['type'] = Utils::get_Type((string)$w->surface);
				
				/*******************************
					id numbers
				*******************************/
				$data['Piece']['geschichte_id'] = $geschichte['Geschichte']['id'];
				$data['Piece']['category_id'] = $geschichte['Geschichte']['category_id'];
				$data['Piece']['genre_id'] = $geschichte['Geschichte']['genre_id'];
				
				$data['Piece']['intext_id'] = $count;
				
				/*******************************
					word strings
				*******************************/
				$tmp = explode(',', (string)$w->feature);
				
				$data['Piece']['hin']	= $tmp[0];
				
				$data['Piece']['hin_1']= $tmp[1];
				$data['Piece']['hin_2']	= $tmp[2];
				$data['Piece']['hin_3']	= $tmp[3];
				
				$data['Piece']['katsu_kei']	= $tmp[4];
				$data['Piece']['katsu_kata']	= $tmp[5];
				$data['Piece']['genkei']	= $tmp[6];
				
				if ($tmp == null || count($tmp) == 7 ) {
					
					$data['Piece']['yomi']	= "*";
					
					$data['Piece']['hatsu']	= "*";
					
				} else if (count($tmp) == 9) {
					
					$data['Piece']['yomi']	= $tmp[7];
					
					$data['Piece']['hatsu']	= $tmp[8];
					
				} else {
		
					debug("irregular number of tokens -> "
							.count($tmp)
							." (".(string)$w->feature.")");
					
					continue;
		
				}
				
				/*******************************
					save data
				*******************************/
				/*
				 * <Notice>
				 * 1. The model object needs to be created each time of the iterations
				 * 2. Otherwise, ONLY the last element in the iterations will be saved
				 */
				$model->create();
				
				if ($model->save($data)) {
// 				if ($model->save($piece)) {
						
					$count += 1;
						
					// 					if ($count > $count_max) {
						
					// 						break;
				
					// 					}//if ($count > $count_max)
						
				} else {
						
					debug("data NOT saved : ".$piece['Piece']['form']);
				}
				
				
// 				debug($tmp);	
				// 				array(
				// 						(int) 0 => '記号',
				// 						(int) 1 => '読点',
				// 						(int) 2 => '*',
				// 						(int) 3 => '*',
				// 						(int) 4 => '*',
				// 						(int) 5 => '*',
				// 						(int) 6 => '、',
				// 						(int) 7 => '、',
				// 						(int) 8 => '、'
				// 				)
				
// 				debug("count(\$tmp) => ".count($tmp));
				
// 				if (count($tmp) != 9) {
				
// 					debug("not 9");
					
// // 					debug($tmp);
					
// 				}//if (count($tmp) != 9)
// 				;
				
// 				debug($data['Piece']['form']);
// 				debug($tmp);
				
				# push to array
				array_push($aryOf_Pieces, $data);
				
// 				# count
// 				$count += 1;
				
// 				if ($count > $count_max) {
						
// 					debug("count => more than ".$count_max);
					
// 					break;
// // 					return ;
				
// 				}//if ($count > $count_max)
				
				
			}//foreach ($words_ary as $w)
			
// 			#debug
// 			debug("returning...");
// 			return;
			
			
// 			$count = 0;
// 			$count_max = 5;

// 			foreach ($aryOf_Pieces as $piece) {
				
// // 				/*
// // 				 * <Notice>
// // 				 * 1. The model object needs to be created each time of the iterations
// // 				 * 2. Otherwise, ONLY the last element in the iterations will be saved 
// // 				 */
// // 				$model->create();
				
// // 				if ($model->save($piece)) {
					
// // 					$count += 1;
					
// // // 					if ($count > $count_max) {
					
// // // 						break;
						
// // // 					}//if ($count > $count_max)
					
// // 				} else {
					
// // 					debug("data NOT saved : ".$piece['Piece']['form']);
// // 				}
				
// 			}//foreach ($aryOf_Pieces as $piece)
			
// 			debug("pieces saved => '$count'");
			
			$ret = $count;
			
			/*******************************
				return
			*******************************/
			return $ret;
			
		}//conv_Xml_2_AryOf_Pieces_2($xml, $geschichte)
	
		/*******************************
			@return
			> 0		=> number of pieces saved
			-1		=> This geschichte has already been saved
			-2		=> "find" method returned 'null'
		*******************************/
		public static function
		conv_Xml_2_AryOf_Pieces_3($xml, $geschichte) {

			/*******************************
				processing
			*******************************/
			$words_ary = $xml->word;
			
			$aryOf_Pieces = array();
			
			#ref Utils::save_token_list(...)
			$count = 0;
			$count_max = 10;
		
			/*******************************
				build : ary of pieces
			*******************************/
			foreach ($words_ary as $w) {
			
				$data = array();
				
				$data['Piece']['created_at'] = Utils::get_CurrentTime(); 
				$data['Piece']['updated_at'] = Utils::get_CurrentTime(); 
				#ref (string) http://www.pahoo.org/e-soul/webtech/php06/php06-12-01.shtm
				$data['Piece']['form'] = (string)$w->surface;

				// 				* 	1	=> Kanji<br>
				// 				* 	2	=> Hiragana<br>
				// 				* 	3	=> Katakana<br>
				// 				* 	4	=> Number<br>
				// 				* 	5	=> Kanji & Hiragana<br>
				// 				* 	6	=> Kanji & Katakana<br>
				// 				* 	7	=> Hiragana & Katakana<br>
				// 				*
				// 				* 	0	=> Other<br>
				$data['Piece']['type'] = CONS::$dict[Utils::get_Type((string)$w->surface)];
// 				$data['Piece']['type'] = Utils::get_Type((string)$w->surface);
				
				/*******************************
					id numbers
				*******************************/
				$data['Piece']['geschichte_id'] = $geschichte['Geschichte']['id'];
				$data['Piece']['category_id'] = $geschichte['Geschichte']['category_id'];
				$data['Piece']['genre_id'] = $geschichte['Geschichte']['genre_id'];
				
				$data['Piece']['intext_id'] = $count;
				
				/*******************************
					word strings
				*******************************/
				$tmp = explode(',', (string)$w->feature);
				
				$data['Piece']['hin']	= $tmp[0];
				
				$data['Piece']['hin_1']= $tmp[1];
				$data['Piece']['hin_2']	= $tmp[2];
				$data['Piece']['hin_3']	= $tmp[3];
				
				$data['Piece']['katsu_kei']	= $tmp[4];
				$data['Piece']['katsu_kata']	= $tmp[5];
				$data['Piece']['genkei']	= $tmp[6];
				
				if ($tmp == null || count($tmp) == 7 ) {
					
					$data['Piece']['yomi']	= "*";
					
					$data['Piece']['hatsu']	= "*";
					
				} else if (count($tmp) == 9) {
					
					$data['Piece']['yomi']	= $tmp[7];
					
					$data['Piece']['hatsu']	= $tmp[8];
					
				} else {
		
					debug("irregular number of tokens -> "
							.count($tmp)
							." (".(string)$w->feature.")");
					
					continue;
		
				}
				
				# push to array
				array_push($aryOf_Pieces, $data);
				
			}//foreach ($words_ary as $w)
			
			$ret = $count;
			
			/*******************************
				return
			*******************************/
			return $aryOf_Pieces;
// 			return $ret;
			
		}//conv_Xml_2_AryOf_Pieces($xml) {
	
		/*
		 * <Information>
		 * 	1. url parameters are expected to have both key and value;
		 * 		=> if no value, then errors will be generated ---> 'Notice (8): Undefined offset: 1'
		 * 		(2017/06/23 12:35:43)
		 */
		public static function
		update_URL__Param_Sort($param_new, $sort_direction_type = 'asc') {
// 		update_URL__Param_Sort($param_new) {
			
			#ref https://stackoverflow.com/questions/6768793/get-the-full-url-in-php 'answered Jul 20 '11 at 21:33'
			$url =  (isset($_SERVER['HTTPS']) ? "https" : "http")
					. "://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

			$url_2 = parse_url($url);
			// 			array(
			// 					'host' => '*****',
			// 					'scheme' => 'http',
			// 					'path' => '/Eclipse_Luna/Cake_NR5/Pieces',
			// 					'query' => 'sort=created_at'
			// 			)
			//	http://localhost/Eclipse_Luna/Cake_NR5/Pieces/index/page:186?sort=created_at&filter=hin-%E5%90%8D%E8%A9%9E
			
// 			debug($url_2);
// 			debug(isset($url_2['query']) ? urldecode($url_2['query']) : "query => Not set");
// 			debug($url_2);
			
// 			$url_new = $url_2['host'];
			$url_new = $url_2['scheme']."://".$url_2['host']
			
					.$url_2['path']
			;
			
// 			debug("\$url_new => ".$url_new);

			/*******************************
				process : query
			*******************************/
			$query_new = array();
			
			$key_Sort = "sort";
			
			if (isset($url_2['query'])) {
			
				$tokens = explode("&", $url_2['query']);
				
// 				debug($tokens);
				
				foreach ($tokens as $token) {
				
					$key_val = explode("=", $token);
					
// 					debug($key_val);
					
					if ($key_val[0] == $key_Sort) {
					
						$key_val[1] = $param_new;
					
					} else {
					
						
						
					}//if ($key_val[0] == $key_Sort)
					
					$query_new[$key_val[0]] = $key_val[1];
					
				}//foreach ($tokens as $token)
				
				
// 				debug("\$query_new => ");
// 				debug($query_new);
				
// 				debug(array_keys($query_new));
				
				$query_new_Keys = array_keys($query_new);
				
				$ary_tmp = array();
				
				foreach ($query_new_Keys as $key) {
				
					array_push($ary_tmp, $key."=".urldecode($query_new[$key]));
// 					array_push($ary_tmp, $key."=".$query_new[$key]);
					
				}//foreach ($query_new as $pair)
				
// 				debug($ary_tmp);
				
				$query_string_new = implode("&", $ary_tmp);
				
// 				debug("\$query_string_new => ".$query_string_new);
				
				#ref http://phpspot.net/php/man/php/function.http-build-query.html
// 				debug(urldecode(http_build_query($query_new)));
				
				# add to url
				$url_new .= "?".$query_string_new;
				
			}//if (isset($url_2['query']))
			
			
			
			
			/*******************************
				return
			*******************************/
			return $url_new;
			
// 			$url_new = http_build_url($url_2);
			
// 			debug("\$url_new => ".$url_new);	#=> Error: Call to undefined function http_build_url()
			
					
// 			debug("\$url => ".$url);
// 			// 			'$url => http://localhost/Eclipse_Luna/Cake_NR5/Pieces?sort=created_at'
					
// 			debug("\$_SERVER['QUERY_STRING'] =>");	#=> 'sort=created_at'
// 			debug($_SERVER['QUERY_STRING']);
			
// 			if ($_SERVER['QUERY_STRING'] == '') {
			
// 				debug("QUERY_STRING => blank");
				
// 			}//if ($_SERVER['QUERY_STRING'] == '')

// 			# test
// 			$url_2 = parse_url($url);
			
// 			debug("\$url_2 => ");
// 			debug($url_2);
			
// 			#ref https://stackoverflow.com/questions/2317508/get-fragment-value-after-hash-from-a-url-in-php 'answered Feb 23 '10 at 11:05'
// 			debug("\$url_2[\"frangment\"] =>");
// 			debug($url_2["frangment"]);
		
// 			#test
// 			debug("\$_GET['fragment'] => ");
// 			debug($_GET['fragment']);
			
		}
	
	public static function
	get_Hin_Names() {

		$model = ClassRegistry::init('Piece');
		
		$options = array(
		
				'group'	=> array("Piece.hin")
		);
		
		$pieces = $model->find('all', $options);
		
		debug("count(\$pieces) => " + count($pieces));
		
		$aryOf_Hin_Values = array();
		
		foreach ($pieces as $piece) {
		
			array_push($aryOf_Hin_Values, $piece['Piece']['hin']);
				
		}//foreach ($pieces as $piece)
		
		debug($aryOf_Hin_Values);
		
		$text = implode(",", $aryOf_Hin_Values);
		
		$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$text";
			
		$xml = simplexml_load_file($url);
		
		$words = $xml->word;
		
		debug(count($words));
		
// 		debug($words);

		$pairOf_HinNames = array();
		
		$genkei = "";
		$yomi = "";
		
		foreach ($words as $w) {
		
			$surface = (string)$w->surface;
			
// 			debug($surface);
			
			if ($surface == ",") {
			
				array_push($pairOf_HinNames, array($genkei, $yomi));
				
				$genkei = "";
				$yomi = "";
				
			} else {//if ($surface == ",")
			
				$tokens = explode(",", (string)$w->feature);
				
				$genkei .= $tokens[6];
				$yomi .= $tokens[7];
			
			}//if ($surface == ",")
			
// // 			debug(explode(",", (string)$w->feature)[6]);
// 			debug(explode(",", (string)$w->feature));
// // 			debug((string)$w->feature);
			
// 			$tokens = explode(",", (string)$w->feature);
			
// 			if (isset($tokens[7])) {
				
// 				array_push($pairOf_HinNames, array($tokens[6], $tokens[7]));
				
// 			}
			
		}//foreach ($words as $w)
		
		debug($pairOf_HinNames);
		
// 		debug($xml);
	
		/*******************************
			modify
		*******************************/
		$pairOf_HinNames_new = array();
		
		foreach ($pairOf_HinNames as $pair) {
		
			$genkei = $pair[0];
		
			if ($genkei == '接頭詞') {
			
				debug("\$genkei => ".$genkei);
				
				$pair[1] = 'セットウシ';
				
			}//if ($genkei == '接頭詞')
			
			array_push($pairOf_HinNames_new, $pair);
			
		}//foreach ($pairOf_HinNames as $pair)
		
		
		
		/*******************************
			sort
		*******************************/
// 		usort($pairOf_HinNames,
		usort($pairOf_HinNames_new,
				array("utils_2", "cmp_Sort_HinNames_By_Yomi"));
		
// 		debug($pairOf_HinNames_new);

		foreach ($pairOf_HinNames_new as $pair) {
		
			debug($pair[0]." ".$pair[1]);
			
		}//foreach ($pairOf_HinNames_new as $pair)
		
		
		
		
	}//get_Hin_Names()

	public static function
	cmp_Sort_HinNames_By_Yomi($cat_1, $cat_2) {
	
		//REF http://www.php.net/manual/en/function.floatval.php
		$cat_name_1 = $cat_1[1];
		$cat_name_2 = $cat_2[1];
			
		//REF http://stackoverflow.com/questions/481466/php-string-to-float answered Jan 26 '09 at 21:35
			
		// 			return $cat_name_1 < $cat_name_2;
		return $cat_name_1 > $cat_name_2;
		// 		return $point_1 < $point_2;
			
			
	}//cmp_Sort_Categories_By_Name($cat_1, $cat_2)
	
	public static function
	sort_Stats_Data__By_Data($list, $sort_Direction = "DESC") {
// 	sort_Stats_Data__By_Data($list) {
		
		$func_Name = "";
		
		if ($sort_Direction == "ASC") {
		
			$func_Name = "cmp_Sort_Stats_Data__By_Data__ASC";
		
		} else {
		
			$func_Name = "cmp_Sort_Stats_Data__By_Data__DESC";
			
		}//if ($sort_Direction == "ASC")
		
		
		
// 		$func_Name = "cmp_Sort_Stats_Data__By_Data__ASC";
		
		usort($list,
// 				array("utils_2", "cmp_Sort_Stats_Data__By_Data", "abc")
				array("utils_2", $func_Name)
// 				array("utils_2", "cmp_Sort_Stats_Data__By_Data")
		);
		
		return $list;
		
	}
	
	public static function
	sort_Stats_Top10__Genres($list, $sort_Direction = "DESC") {
// 	sort_Stats_Data__By_Data($list) {
		
		$func_Name = "";
		
		if ($sort_Direction == "ASC") {
		
			$func_Name = "cmp_Sort_Stats_Top10_Genres__ASC";
		
		} else {
		
			$func_Name = "cmp_Sort_Stats_Top10_Genres__DESC";
			
		}//if ($sort_Direction == "ASC")
		
		usort($list, array("utils_2", $func_Name));
		
		return $list;
		
	}
	
// 	public static function
// 	sort_Stats_Top10__GenresANDCategories($list, $sort_Direction = "DESC") {
// // 	sort_Stats_Data__By_Data($list) {
		
// 		$func_Name = "";
		
// 		if ($sort_Direction == "ASC") {
		
// 			$func_Name = "cmp_Sort_Stats_Top10__GenresANDCategories__ASC";
		
// 		} else {
		
// 			$func_Name = "cmp_Sort_Stats_Top10_Genres__DESC";
			
// 		}//if ($sort_Direction == "ASC")
		
// 		usort($list, array("utils_2", $func_Name));
		
// 		return $list;
		
// 	}//sort_Stats_Top10__GenresANDCategories

// 	public static function
// 	cmp_Sort_Stats_Top10__GenresANDCategories__ASC($item_1, $item_2) {
	
// 		//REF http://www.php.net/manual/en/function.floatval.php
// 		$data_1 = $item_1[2];
// 		$data_2 = $item_2[2];
			
// 		//REF http://stackoverflow.com/questions/481466/php-string-to-float answered Jan 26 '09 at 21:35
			
// 		// 			return $cat_name_1 < $cat_name_2;
// 		return $data_1 > $data_2;
	
// 	}
	
	
	public static function
	cmp_Sort_Stats_Data__By_Data__ASC($item_1, $item_2) {
		
		//REF http://www.php.net/manual/en/function.floatval.php
		$data_1 = $item_1[1];
		$data_2 = $item_2[1];
			
		//REF http://stackoverflow.com/questions/481466/php-string-to-float answered Jan 26 '09 at 21:35
			
		// 			return $cat_name_1 < $cat_name_2;
		return $data_1 > $data_2;
		
		
	}
	
	public static function
	cmp_Sort_Stats_Data__By_Data__DESC($item_1, $item_2) {
		
		//REF http://www.php.net/manual/en/function.floatval.php
		$data_1 = $item_1[1];
		$data_2 = $item_2[1];
			
		//REF http://stackoverflow.com/questions/481466/php-string-to-float answered Jan 26 '09 at 21:35
			
		// 			return $cat_name_1 < $cat_name_2;
		return $data_1 < $data_2;
		
		
	}

	public static function
	cmp_Sort_Stats_Top10_Genres__ASC($item_1, $item_2) {
	
		//REF http://www.php.net/manual/en/function.floatval.php
		$data_1 = $item_1[2];
		$data_2 = $item_2[2];
			
		//REF http://stackoverflow.com/questions/481466/php-string-to-float answered Jan 26 '09 at 21:35
			
		// 			return $cat_name_1 < $cat_name_2;
		return $data_1 > $data_2;
	
	}
	
	public static function
	cmp_Sort_Stats_Top10_Genres__DESC($item_1, $item_2) {
	
		//REF http://www.php.net/manual/en/function.floatval.php
		$data_1 = $item_1[2];
		$data_2 = $item_2[2];
			
		//REF http://stackoverflow.com/questions/481466/php-string-to-float answered Jan 26 '09 at 21:35
			
		// 			return $cat_name_1 < $cat_name_2;
		return $data_1 < $data_2;
	
	}//cmp_Sort_Stats_Top10_Genres__DESC($item_1, $item_2)
	
	public static function
	build_PairOf_Sens_Symbols($sen_New, $sen_Symbolized) {
		
		$tokensOf_Sens = explode("。", $sen_New);
		
		$tokensOf_Symbolized = explode("。", $sen_Symbolized);

		$lenOf_TokensOf_Sens = count($tokensOf_Sens);
		
		$lenOf_TokensOf_Symbolized = count($tokensOf_Symbolized);
		
// 		debug("sens => $lenOf_TokensOf_Sens");
		
// 		debug("sens => $lenOf_TokensOf_Symbolized");
	
		/*******************************
			build : pairs
		*******************************/
		$pairOf_Sens_Symbolized = array();
		
		for ($i = 0; $i < $lenOf_TokensOf_Sens; $i++) {
		
			array_push(
					$pairOf_Sens_Symbolized, 
					array($tokensOf_Sens[$i], $tokensOf_Symbolized[$i]));
			
		}//for ($i = 0; $i < $lenOf_TokensOf_Sens; $i++)
		
// 		debug($pairOf_Sens_Symbolized);
		
		return $pairOf_Sens_Symbolized;
		
	}//build_PairOf_Sens_Symbols($sen_New, $sen_Symbolized)
	
	public static function
	get_ListOf_Symbol_Forms() {
		
		$model = ClassRegistry::init('Piece');
		
		$option = array(
				
				'conditions'	=> array(
						'Piece.hin'	=> "記号",
// 						'group'	=> "form"
// 						'group'	=> array("Piece.form")
// 						'group'	=> "Piece.form"
				)
				,
				'group'	=> array("Piece.form")
		);
		
		$pieces = $model->find('all', $option);
		
		/*******************************
			validate
		*******************************/
		if ($pieces == null || count($pieces) < 1) {
		
			return null;
			
		}//if ($pieces == null || count($pieces) < 1)
		
		/*******************************
			list
		*******************************/
		$aryOf_Form_Names = array();
		
		foreach ($pieces as $p) {
		
			array_push($aryOf_Form_Names, $p['Piece']['form']);
			
		}//foreach ($pieces as $p)
		
		return $aryOf_Form_Names;
		
	}//get_ListOf_Symbol_Forms
	
	public static function
	get_WordsList_From_Geschichte($geschichte) {
		
		$content = $geschichte['Geschichte']['content'];
		
		$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$content";
			
		$xml = simplexml_load_file($url);
		
		$words = $xml->word;
		
		debug(count($words));
		
		$aryOf_Nouns = array();
		$aryOf_NounPieces = array();
		
		$numOf_Words = count($words);
		
		for ($i = 0; $i < $numOf_Words; $i++) {
// 		for ($i = 0; $i < 10; $i++) {
		
			$w = $words[$i];
			
// 			debug($words[$i]);
			// 			object(SimpleXMLElement) {
			// 				surface => '歴史'
			// 						feature => '名詞,一般,*,*,*,*,歴史,レキシ,レキシ'
			// 			}

			$str_Surface = (string) $w->surface;
			
			$str_Feature = (string) $w->feature;
			
			debug("feature => $str_Feature");
// 			debug("surface => $str_Surface");
			
			$tokens_Feature = explode(",", $str_Feature);
			
			debug($tokens_Feature[0]);
			
			// judge
			$hin = $tokens_Feature[0];
			
			if ($hin == '名詞') {
			
				array_push($aryOf_NounPieces, $str_Surface);
			
			} else {
			
				if (count($aryOf_NounPieces) < 1) {
				
					continue;
				
				// noun pieces exist; add these pieces into nouns array
				} else {
				
					array_push($aryOf_Nouns, implode("", $aryOf_NounPieces));
					
					$aryOf_NounPieces = array();
					
				}//if (count($aryOf_NounPieces) < 1)
				
			}//if ($hin == '名詞')
			
		}//for ($i = 0; $i < 10; $i++)

		debug($aryOf_Nouns);
		
	}//get_WordsList_From_Geschichte($geschichte)
	
	/*******************************
		1 piece が、複数の漢字からできている ---> その piece 自体も、リストに　⇒　入れる
	*******************************/
	public static function
	get_WordsList_From_Geschichte__2($geschichte) {
		
		$content = $geschichte['Geschichte']['content'];
		
		$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$content";
			
		$xml = simplexml_load_file($url);
		
		$words = $xml->word;
		
		debug(count($words));
		
		$aryOf_Nouns = array();
		$aryOf_NounPieces = array();
		
		$numOf_Words = count($words);
		
		for ($i = 0; $i < $numOf_Words; $i++) {
		
			$w = $words[$i];
			
// 			debug($words[$i]);
			// 			object(SimpleXMLElement) {
			// 				surface => '歴史'
			// 						feature => '名詞,一般,*,*,*,*,歴史,レキシ,レキシ'
			// 			}

			$str_Surface = (string) $w->surface;
			
			$str_Feature = (string) $w->feature;
			
// 			debug("feature => $str_Feature");
			
			$tokens_Feature = explode(",", $str_Feature);
			
// 			debug($tokens_Feature[0]);
			
			// judge
			$hin = $tokens_Feature[0];
			
			if ($hin == '名詞') {
			
				array_push($aryOf_NounPieces, $str_Surface);
				
				//ref http://itpro.nikkeibp.co.jp/article/COLUMN/20070307/264117/?rt=nocnt
// 				debug(mb_strlen($str_Surface, "utf-8"));
	
				/*******************************
					length => if more than 2 ---> also, in
						==> if the next piece is of '接尾'
							---> append the next piece to the current
							---> then ~~> into the array
				*******************************/
				if (mb_strlen($str_Surface, "utf-8") >= 2) {

					/*******************************
						validate : next piece ---> '接尾'
					*******************************/
					if ($i < ($numOf_Words - 1)) {
					
						$w_Next = $words[$i + 1];
					
						$feature = (string) $w_Next->feature;
						
						$tokens_Tmp = explode(",", $feature);
						
						if ($tokens_Tmp[1] == '接尾') {
						
// 							continue;
		
							$total = $str_Surface . ((string) $w_Next->surface);
// 							$total = $str_Surface . $tokens_Tmp[1];
							
							if (!in_array($total, $aryOf_Nouns, true)) {
									
								array_push($aryOf_Nouns, $total);
							
							}//if (!in_array($candidate, $aryOf_Nouns, true))
							
						} else {//if ($tokens_Tmp[1] == '接尾')
							
							if (!in_array($str_Surface, $aryOf_Nouns, true)) {
								
								array_push($aryOf_Nouns, $str_Surface);
							
							}
						}
						
					} else if (!in_array($str_Surface, $aryOf_Nouns, true)) {
// 					}//if ($i < ($numOf_Words - 1))
// 					;
					
// 					//ref http://qiita.com/tadsan/items/2a4c3e6b0b74a408c038
// 					if (!in_array($str_Surface, $aryOf_Nouns, true)) {
					
						array_push($aryOf_Nouns, $str_Surface);
						
					}//if (!in_array($aryOf_Nouns))
					
				}//if (mb_strlen($str_Surface, "utf-8") >= 2)
			
			} else {
			
				if (count($aryOf_NounPieces) < 1) {
				
					continue;
				
				// noun pieces exist; add these pieces into nouns array
				} else {
				
					$candidate = implode("", $aryOf_NounPieces);
					
					if (!in_array($candidate, $aryOf_Nouns, true)) {
					
						array_push($aryOf_Nouns, $candidate);
						
					}//if (!in_array($candidate, $aryOf_Nouns, true))
					;
// 					array_push($aryOf_Nouns, $candidate);
// 					array_push($aryOf_Nouns, implode("", $aryOf_NounPieces));
					
					$aryOf_NounPieces = array();
					
				}//if (count($aryOf_NounPieces) < 1)
				
			}//if ($hin == '名詞')
			
		}//for ($i = 0; $i < 10; $i++)

		debug($aryOf_Nouns);
		
	}//get_WordsList_From_Geschichte($geschichte)
	
}//class Utils
	
	