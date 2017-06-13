<?php

	require_once 'CONS.php';
	
// 	include 'C:\WORKS_2\WS\Eclipse_Luna\Cake_NR5\app\Model\Piece.php';
// 	include 'Piece.php';
	
	class Utils_2 {
		
		public static function
		conv_Xml_2_AryOf_Pieces($xml) {
			
			debug($xml->word[4]);
			
			$words_ary = $xml->word;
// 			$words_ary = array($xml->word);
			
			debug("count(\$words_ary) => ".count($words_ary));	//=> 'count($words_ary) => 158'
			
			$model = ClassRegistry::init('Piece');
			
			$aryOf_Pieces = array();
			
			#ref Utils::save_token_list(...)
			$count = 0;
			$count_max = 10;
		
			foreach ($words_ary as $w) {
			
				$model->create();
				
				$data = array();
				
// 				$data = array('Piece' =>
				
// 						array(
									
// 								'created_at'	=> Utils::get_CurrentTime(),
// 								'updated_at'	=> Utils::get_CurrentTime(),
									
// 								'form'			=> (string)$w->surface
// // 								'form'			=> $token->form
// 						)
// 				);
				// 			array(
				// 					'Piece' => array(
				// 							'created_at' => '06/13/2017 15:53:50',
				// 							'updated_at' => '06/13/2017 15:53:50',
				// 							'form' => '、'
				// 					)
				// 			)
				
				
				$data['Piece']['created_at'] = Utils::get_CurrentTime(); 
				$data['Piece']['updated_at'] = Utils::get_CurrentTime(); 
				#ref (string) http://www.pahoo.org/e-soul/webtech/php06/php06-12-01.shtm
				$data['Piece']['form'] = (string)$w->surface;
				// 				array(
				// 						'Piece' => array(
				// 								'created_at' => '06/13/2017 15:54:55',
				// 								'updated_at' => '06/13/2017 15:54:55',
				// 								'form' => '、'
				// 						)
				// 				)
				
// 				$data['Piece']['form'] = $w->surface->content;
// 				$data['Piece']['form'] = $w->surface->content;	//=> blank
// 				$data['Piece']['form'] = $w->surface;
				
// 				debug($w);
// 				debug($w->surface);	//=> blank
// 				debug($w->surface->text);	//=> blank
// 				debug(get_class($w->surface));	//=> 'SimpleXMLElement'
// 				debug((string)$w->surface);	//=> 

				array_push($aryOf_Pieces, $data);
				
// 				# save data
// 				if ($model->save($data)) {
						
// 					debug("piece => saved : ".$data['Piece']['form']);

// // 					$count += 1;

// // 					if ($count > $count_max) {
	
// // 						break;
	
// // 					}//if ($count > $count_max)

// 				} else {

// 					debug("data NOT saved : ".$data['Piece']['form']);
// 				}
				
// 				// count
// 				$count += 1;
				
// 				if($count > $count_max ) {
					
// 					debug("count => 10");
					
// 					break;
// 				}
				
			}//foreach ($words_ary as $w)
			
			//debug
			debug("count(\$aryOf_Pieces) => '".count($aryOf_Pieces)."'");
			
// 			debug($aryOf_Pieces[10]);
			
			//debug
			for ($i = 0; $i < 10; $i++) {
			
				debug("\$aryOf_Pieces[$i]['Piece']['form'] => ".$aryOf_Pieces[$i]['Piece']['form']);
// 				debug("\$words_ary[$i]['form'] => ".$words_ary[$i]['form']);
				
			}//for ($i = 0; $i < 10; $i++)
			

			$count = 0;
			$count_max = 5;
// 			$count_max = 10;

			foreach ($aryOf_Pieces as $piece) {
				
				/*
				 * <Notice>
				 * 1. The model object needs to be created each time of the iterations
				 * 2. Otherwise, ONLY the last element in the iterations will be saved 
				 */
				$model->create();
				
// 				debug("saving piece => ");
// 				debug($piece);
				
				if ($model->save($piece)) {
					
// 					debug("piece => saved : ".$piece['Piece']['form']);
					
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
		
	}//class Utils
	
	