<?php

	require_once 'CONS.php';
	
// 	include 'C:\WORKS_2\WS\Eclipse_Luna\Cake_NR5\app\Model\Piece.php';
// 	include 'Piece.php';
	
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
		
		public static function
		conv_Xml_2_AryOf_Pieces_2($xml, $geschichte) {
			
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
				
				$data['Piece']['geschichte_id'] = $geschichte['Geschichte']['id'];
				$data['Piece']['category_id'] = $geschichte['Geschichte']['category_id'];
				$data['Piece']['genre_id'] = $geschichte['Geschichte']['genre_id'];
				
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
			
			$ret = $count;
			
			/*******************************
				return
			*******************************/
			return $ret;
			
		}//conv_Xml_2_AryOf_Pieces_2($xml, $geschichte)
	
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
// 		(isset($_SERVER['HTTPS']) ? "https" : "http")
		
		
	}//class Utils
	
	