<?php 
				echo "<td>";

				$option = array(
						'target'	=> '_blank',
						'escape'	=> false,
						// 						'?'	=> "article_url=".$a['url']
				// 						'article_url'	=> $a['url']
				);
				
// 				$param_1 = array(
							
// 						'article_url'	=> $article_set['url'],
// 						'article_line'	=> $article_set['line'],
// 						'article_vendor'	=> $article_set['vendor'],
// // 						'article_news_time'	=> $a['news_time'],
// 						'article_category_id'	=> $k,
// 						'article_genre_id'	=> $genre_id,

// 						'article_url'	=> $a['url'],
// 						'article_line'	=> $a['line'],
// 						'article_vendor'	=> $a['vendor'],
// 						'article_news_time'	=> $a['news_time'],
// 						'article_category_id'	=> $k,
// 						'article_genre_id'	=> $genre_id,
// 				);
					
				if ($category_name != "others") {

					$kw = Utils::get_Keyword_From_Keyword_Id($article_set[1]);
					
// 					$genre = Utils::get_Genre_From_Genre_Id($kw['Category']['genre_id']);
					
					$param = array(
								
							'article_url'	=> $article_set[0]['url'],
							'article_line'	=> $article_set[0]['line'],
							'article_vendor'	=> $article_set[0]['vendor'],
							// 						'article_news_time'	=> $a['news_time'],
							'article_category_id'	=> $kw['Category']['id'],
							'article_genre_id'	=> $kw['Category']['genre_id'],
// 							'article_category_id'	=> $k,
// 							'article_genre_id'	=> $genre_id,
					);
					
					echo $this->Html->link(
							
// 						$a['line'],
						$article_set[0]['line'],
							
						array(
								'action'	=> 'open_article',
								//REF http://book.cakephp.org/2.0/ja/core-libraries/helpers/html.html "'?' => array('height' => 400, 'width' => 500))"
								'?'			=> $param
								// 									'?'	=> "article_url=".$a['url']
								// 									'article_url'	=> $a['url']
						),
							
// 														$a['url'],
						
						$option
							
					);
			
// 					echo "<a href=\"".$article_set[0]['url']."\" target=_blank".">"
// 					// 						."$count) "
// 					// 						.mb_string($a['line'])
// 					.mb_convert_encoding($article_set[0]['line'], 'UTF-8')
// 					// 						.$a['line']
// 					."</a>";
						
// // 					echo $article_set[0]['line'];
				
				} else {

// 					$kw = Utils::get_Keyword_From_Keyword_Id($article_set[1]);
						
					$genre = Utils::get_Genre_From_Genre_Name($article_set['genre_name']);
					
					// 					$genre = Utils::get_Genre_From_Genre_Id($kw['Category']['genre_id']);
						
					$param = array(
					
							'article_url'	=> $article_set['url'],
							'article_line'	=> $article_set['line'],
							'article_vendor'	=> $article_set['vendor'],
							// 						'article_news_time'	=> $a['news_time'],
							'article_category_id'	=> -1,
							'article_genre_id'	=> $genre['Genre']['id'],
// 							'article_genre_id'	=> $genre['id'],
							// 							'article_category_id'	=> $k,
					// 							'article_genre_id'	=> $genre_id,
					);
						
					echo $this->Html->link(
								
					// 						$a['line'],
							$article_set['line'],
								
							array(
									'action'	=> 'open_article',
									//REF http://book.cakephp.org/2.0/ja/core-libraries/helpers/html.html "'?' => array('height' => 400, 'width' => 500))"
									'?'			=> $param
									// 									'?'	=> "article_url=".$a['url']
									// 									'article_url'	=> $a['url']
							),
								
							// 														$a['url'],
					
							$option
								
					);
						
// // 					echo $article_set['line'];
// 					echo "<a href=\"".$article_set['url']."\" target=_blank".">"
// 							// 						."$count) "
// 					// 						.mb_string($a['line'])
// 					.mb_convert_encoding($article_set['line'], 'UTF-8')
// 					// 						.$a['line']
// 					."</a>";
						
					
				}//if ($category_name != "others")

				//debug
				echo "AAAAA";
				
				echo "</td>";
				
?>
