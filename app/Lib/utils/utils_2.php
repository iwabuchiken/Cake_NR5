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
			
		}//conv_Xml_2_AryOf_Pieces_2($xml, $geschichte)
		
	}//class Utils
	
	