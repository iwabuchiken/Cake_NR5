<?php 

	//ref sql dump : http://qiita.com/kazu56/items/fa72b97db235193fe2d3
// echo $this->element('sql_dump');

// 	echo "yes";
	
// 	echo "<br>"; echo "<br>";
	
// 	echo count($listOf_Pieces);
	
?>

<div id="stats_area">
	
	<?php 
	
		echo count($listOf_Pieces);
	
	?>

</div>


<table id="pieces">

	<?php 
		
		echo $this->element('pieces/index_2/_index_t_headers')
	
	?>

	<?php 
			
		echo $this->element('pieces/index_2/_index_t_entries')
	
	?>

</table>

	
<!-- WHERE ( -->
<!-- 	("Piece"."type" = 'kanji')  -->
<!-- 	AND ( -->
<!-- 			( -->
<!-- 				("Piece"."hin" = '副詞')  -->
<!-- 				OR ("Piece"."hin" = '助詞') -->
<!-- 			) -->
<!-- 		)  -->
<!-- 	AND ( -->
<!-- 			( -->
<!-- 				("Piece"."hin" = '形容詞')  -->
<!-- 				AND  -->
<!-- 				("Piece"."hin_1" = '自立') -->
<!-- 			) -->
<!-- 		) -->
<!-- ) -->

<!-- http://localhost/Eclipse_Luna/Cake_NR5/pieces/filter_List_By_Type?type=Kanji,Hiragana,Katakana,Number,Other&sort=id&sort_direction=asc&filter_Hins=2,3,5&group_by=&filter_hin_1_hin_name=%E5%BD%A2%E5%AE%B9%E8%A9%9E&filter_hin_1_chosen_hin_1=0	 -->
<!-- Controller : $pieces = $this->Piece->find('all', $conditions); -->
<!-- WHERE ( -->
<!-- 		( -->
<!-- 			( -->
<!-- 				("Piece"."type" = 'Kanji')  -->
<!-- 				OR  -->
<!-- 				("Piece"."type" = 'Hiragana')  -->
<!-- 				OR ("Piece"."type" = 'Katakana')  -->
<!-- 				OR ("Piece"."type" = 'Number')  -->
<!-- 				OR ("Piece"."type" = 'Other') -->
<!-- 			) -->
<!-- 		)  -->
<!-- 		AND ( -->
<!-- 				( -->
<!-- 					("Piece"."hin" = '副詞')  -->
<!-- 					OR ("Piece"."hin" = '助詞') -->
<!-- 				) -->
<!-- 			)  -->
<!-- 		AND ( -->
<!-- 				( -->
<!-- 					("Piece"."hin" = '形容詞')  -->
<!-- 					AND ("Piece"."hin_1" = '自立') -->
<!-- 				) -->
<!-- 			) -->
<!-- 	)  -->

<!-- Controller : $pieces = $this->Piece->find('all', $options); -->
<!-- ==> works	 -->
<!-- WHERE ( -->
<!-- 		( -->
<!-- 			( -->
<!-- 				("Piece"."type" = 'Kanji')  -->
<!-- 				OR ("Piece"."type" = 'Hiragana')  -->
<!-- 				OR ("Piece"."type" = 'Katakana')  -->
<!-- 				OR ("Piece"."type" = 'Number')  -->
<!-- 				OR ("Piece"."type" = 'Other') -->
<!-- 			) -->
<!-- 		)  -->
<!-- 		AND ( -->
<!-- 				( -->
<!-- 					("Piece"."hin" = '副詞')  -->
<!-- 					OR ("Piece"."hin" = '助詞') -->
<!-- 				) -->
<!-- 			)  -->
<!-- 		AND ( -->
<!-- 				( -->
<!-- 					("Piece"."hin" = '形容詞')  -->
<!-- 					AND ("Piece"."hin_1" = '自立') -->
<!-- 				) -->
<!-- 			) -->
<!-- 	) -->

<!-- ==> works -->
<!-- WHERE ( -->
<!-- 		( -->
<!-- 			( -->
<!-- 				("Piece"."type" = 'Kanji')  -->
<!-- 				OR ("Piece"."type" = 'Hiragana')  -->
<!-- 				OR ("Piece"."type" = 'Katakana')  -->
<!-- 				OR ("Piece"."type" = 'Number')  -->
<!-- 				OR ("Piece"."type" = 'Other') -->
<!-- 			) -->
<!-- 		)  -->
<!-- 		AND ( -->
<!-- 				( -->
<!-- 					("Piece"."hin" = '形容詞')  -->
<!-- 					OR ("Piece"."hin" = '助詞') -->
<!-- 				) -->
<!-- 			) -->
<!-- 	) -->

<!-- ==> not working -->
<!-- WHERE ( -->
<!-- 		( -->
<!-- 			( -->
<!-- 				("Piece"."type" = 'Kanji')  -->
<!-- 				OR ("Piece"."type" = 'Hiragana')  -->
<!-- 				OR ("Piece"."type" = 'Katakana')  -->
<!-- 				OR ("Piece"."type" = 'Number')  -->
<!-- 				OR ("Piece"."type" = 'Other') -->
<!-- 			) -->
<!-- 		)  -->
<!-- 		AND ( -->
<!-- 				( -->
<!-- 					("Piece"."hin" = '形容詞')  -->
<!-- 					OR ("Piece"."hin" = '助詞') -->
<!-- 				) -->
<!-- 			)  -->
<!-- 		AND ( -->
<!-- 				( -->
<!-- 					( -->
<!-- 						( -->
<!-- 							("Piece"."hin" = '副詞')  -->
<!-- 							AND  -->
<!-- 							("Piece"."hin_1" = '一般') -->
<!-- 						) -->
<!-- 					)  -->
<!-- 					OR ( -->
<!-- 							( -->
<!-- 								("Piece"."hin" = '副詞')  -->
<!-- 								AND ("Piece"."hin_1" = '助詞類接続') -->
<!-- 							) -->
<!-- 						) -->
<!-- 					) -->
<!-- 				) -->
<!-- 	) -->

<!-- $options = array( -->
<!-- 				'order'			=> $valOf_SortArray, -->
<!-- 				'conditions'	=> array( -->
<!-- 						'AND'	=> array( -->
<!-- 						// 								'OR'	=> $aryOf_Filtered_Hins -->
<!-- 								array('OR'	=> $aryOf_ORs), -->
<!-- 								array('OR'	=> $valOf_HinArray_2), -->
								
<!-- 								array('OR'	=> $tmp_array), -->
<!-- // 								array('OR'	=> $valOf_HinArray), -->
<!-- // 								$cond_Filter_Hin_1, -->
		
<!-- 						)//'AND'	=> array( -->
<!-- 				)//'conditions'	=> array( -->
<!-- 				, -->
<!-- 		); -->
<!-- ==> not working		 -->
<!-- WHERE ( -->
<!-- 		( -->
<!-- 			( -->
<!-- 				("Piece"."type" = 'Kanji')  -->
<!-- 				OR ("Piece"."type" = 'Hiragana')  -->
<!-- 				OR ("Piece"."type" = 'Katakana')  -->
<!-- 				OR ("Piece"."type" = 'Number')  -->
<!-- 				OR ("Piece"."type" = 'Other') -->
<!-- 			) -->
<!-- 		)  -->
<!-- 		AND ( -->
<!-- 				( -->
<!-- 					("Piece"."hin" = '形容詞')  -->
<!-- 					OR ("Piece"."hin" = '助詞') -->
<!-- 				) -->
<!-- 			) -->
<!-- 		AND ( -->
<!-- 				( -->
<!-- 					( -->
<!-- 						( -->
<!-- 							("Piece"."hin" = '副詞')  -->
<!-- 							AND ("Piece"."hin_1" = '一般') -->
<!-- 						) -->
<!-- 					)  -->
<!-- 				OR ( -->
<!-- 						( -->
<!-- 							("Piece"."hin" = '副詞')  -->
<!-- 							AND ("Piece"."hin_1" = '助詞類接続') -->
<!-- 						) -->
<!-- 					) -->
<!-- 				) -->
<!-- 			) -->
<!-- 	) -->

<!-- array('OR'	=> $tmp_array[0]) -->
<!-- WHERE ( -->
<!-- 		( -->
<!-- 			( -->
<!-- 				("Piece"."type" = 'Kanji')  -->
<!-- 				OR ("Piece"."type" = 'Hiragana')  -->
<!-- 				OR ("Piece"."type" = 'Katakana')  -->
<!-- 				OR ("Piece"."type" = 'Number')  -->
<!-- 				OR ("Piece"."type" = 'Other') -->
<!-- 			) -->
<!-- 		)  -->
<!-- 		AND ( -->
<!-- 				( -->
<!-- 					("Piece"."hin" = '形容詞')  -->
<!-- 					OR ("Piece"."hin" = '助詞') -->
<!-- 				) -->
<!-- 			)  -->
<!-- 		AND ( -->
<!-- 				( -->
<!-- 					("Piece"."hin" = '副詞')  -->
<!-- 					AND ("Piece"."hin_1" = '一般') -->
<!-- 				) -->
<!-- 			) -->
<!-- 	) -->
