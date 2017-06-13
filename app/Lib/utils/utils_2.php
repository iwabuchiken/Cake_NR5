<?php

	require_once 'CONS.php';
	
	class Utils_2 {
		
		/**********************************
		* @param<br>
		* $key	=> e.g. "form"
		**********************************/
		public static function 
		isIn_Array_Tokens($tokens_base, $token, $key) {
			
			for ($i = 0; $i < count($tokens_base); $i++) {
				
				$t = $tokens_base[$i];
				
				if ($token['Token'][$key] == $t['Token'][$key]) {
					
					return true;
					
				}
			}
			
			return false;
			
		}
		
		public static function 
		get_HostName() {
			
			$pieces = parse_url(Router::url('/', true));
			
			return $pieces['host'];
			
		}//public function get_HostName()
		
		public static function
		get_CurrentTime2($labelType) {
			//REF http://stackoverflow.com/questions/470617/get-current-date-and-time-in-php
			date_default_timezone_set('Asia/Tokyo');
		
			switch($labelType) {
					
				case CONS::$timeLabelTypes["rails"]:
		
					return date('Y-m-d H:i:s', time());
		
				case CONS::$timeLabelTypes["basic"]:
		
					return date('Y/m/d H:i:s', time());
		
				case CONS::$timeLabelTypes["serial"]:
		
					return date('Ymd_His', time());
						
				default:
		
					return date('Y/m/d H:i:s', time());
		
			}//switch($labelType)
		
			// 		return date('m/d/Y H:i:s', time());
		
		}//function get_CurrentTime2($labelType)

		public static function 
		write_Log($dpath, $text, $file, $line) {
		
			$max_LineNum = CONS::$logFile_maxLineNum;
		
			$path_LogFile = join(
					DS,
					array($dpath, "log.txt"));
		
			/****************************************
				* Dir exists?
			****************************************/
			if (!file_exists($dpath)) {
					
				mkdir($dpath, $mode=0777, $recursive=true);
					
			}
		
			/****************************************
				* File exists?
			****************************************/
			if (!file_exists($path_LogFile)) {
					
				// 			mkdir($path_LogFile, $mode=0777);
				//REF touch http://php.net/touch
				$res = touch($path_LogFile);
					
				if ($res == false) {
		
					return;
		
				}
					
			}
		
			/****************************************
				* File => longer than the max num?
			****************************************/
			//REF read content http://www.php.net/manual/en/function.file.php
			$lines = file($path_LogFile);
		
			$file_Length = count($lines);
		
			$log_File = null;
		
			if ($file_Length > $max_LineNum) {
		
				$dname = dirname($path_LogFile);
					
				$new_name = join(
						DS,
						array(
								$dname,
								"log"."_".Utils::get_CurrentTime2(
										CONS::$timeLabelTypes['serial'])
								.".txt")
				);
		
				$res = rename($path_LogFile, $new_name);
					
			} else {
					
			}
		
			/******************************
			
				modify: file name
			
			******************************/
			$tmp = strpos(strtolower($file), "c");
			
			if ($tmp == 0) {
				
				$file = str_replace(ROOT, "", $file);
				
			}
			
			/****************************************
				* File: open
			****************************************/
			$log_File = fopen($path_LogFile, "a");
		
			/****************************************
				* Write
			****************************************/
			// 		//REF replace http://oshiete.goo.ne.jp/qa/3163848.html
			// 		$file = str_replace(ROOT.DS, "", $file);
		
			$time = Utils::get_CurrentTime();

			/**********************************
			* modify: dir path
			**********************************/
			//REF http://stackoverflow.com/questions/2192170/how-to-remove-part-of-a-string answered Feb 3 '10 at 13:33
			$file_new = str_replace(ROOT, "", $file);
			
			/**********************************
			* write
			**********************************/
			// 		$full_Text = "[$time : $file : $line] %% $text"."\n";
			$full_Text = "[$time : $file_new : $line] $text"."\n";
// 			$full_Text = "[$time : $file : $line] $text"."\n";
		
			$res = fwrite($log_File, $full_Text);
			
			/****************************************
				* File: Close
			****************************************/
			fclose($log_File);
				
		}//function write_Log($dpath, $text, $file, $line)
		
		public static function 
		get_CurrentTime() {
			//REF http://stackoverflow.com/questions/470617/get-current-date-and-time-in-php
			date_default_timezone_set('Asia/Tokyo');
		
// 			return date('m/d/Y H:i:s.u', time());
			return date('m/d/Y H:i:s', time());
		
		}
		
		public static function 
		get_dPath_Log() {
				
			return join(DS, array(ROOT, "lib", "log"));
			// 			return join(DS, array(ROOT, "lib", "log", "log.txt"));
				
		}
		
		public static function 
		get_fPath_DB_Sqlite() {
				
			$msg = "WEBROOT_DIR => ".WEBROOT_DIR
			."/"
					."WWW_ROOT => ".WWW_ROOT;
				
// 			write_Log(
// 			CONS::get_dPath_Log(),
// 			// 				$this->get_dPath_Log(),
// 			$msg,
// 			__FILE__,
// 			__LINE__);
				
				
			return join(DS,
					array(ROOT, APP_DIR, WEBROOT_DIR, CONS::$dbName_Local));
			// 					array(ROOT, APP_DIR, WEBROOT_DIR, $this->dbName_Local));
				
		}

		public static function
		conv_Float_to_TimeLabel ($float_time) {
				
			// 			$integer = (int) $float_time;
			// 			$integer = floor($float_time) / 1;
			$integer = floor($float_time);
			// 			$integer = (int)intval($float_time, 10);
			// 			$integer = (int)intval($float_time);
			// 			$integer = intval($float_time);
			// 			$integer = (intval)floor($float_time);
			// 			$integer = floor($float_time);
				
			$decimal = $float_time - $integer;
				
			$sec_num = $integer;
			// 			$sec_num = parseInt($float_time, 10); // don't forget the $second param
			$hours   = floor($sec_num / 3600);
			$minutes = floor(($sec_num - ($hours * 3600)) / 60);
			$seconds = $sec_num - ($hours * 3600) - ($minutes * 60);
		
			if ($hours   < 10) {$hours_str   = "0$hours";}
			else {$hours_str = $hours;}
		
			if ($minutes < 10) {$minutes_str = "0$minutes";}
			else {$minutes_str = $minutes;}
				
			if ($seconds < 10) {$seconds_str = "0".number_format(($seconds + $decimal), 3, '.', '');}
			else {$seconds_str = number_format(($seconds + $decimal), 3, '.', '');}
			// 				else {$seconds_str = ($seconds + $decimal);}
		
			// 			$time    = "$hours:$minutes:$seconds.".number_format($decimal, 3, '.', '');
			//REF http://www.php.net/manual/en/function.number-format.php
			// 			$time    = "$hours_str:$minutes_str";
				
			if ($hours == "00") {
					
				$time    = "$minutes_str:$seconds_str";
		
			} else {
					
				$time    = "$hours_str:$minutes_str:$seconds_str";
					
			}
			;
		
			// 			$time    = "$hours_str:$minutes_str:$seconds_str";
			// 			$time    = "$hours:$minutes:"
			// 						.number_format(($seconds + $decimal), 3, '.', '');
			// 			$time    = "$integer.$decimal";
				
			return $time;
				
		}//conv_Float_to_TimeLabel ($float_time)

		public static function 
		startsWith
		($haystack, $needle) {
			$length = strlen($needle);
			return (substr($haystack, 0, $length) === $needle);
		}
		
		public static function 
		endsWith
		($haystack, $needle) {
			$length = strlen($needle);
			if ($length == 0) {
				return true;
			}
		
			return (substr($haystack, -$length) === $needle);
		}

		/**********************************
		* csv_to_array
		* 
		* Steps for handling multibyte chars in a csv file
		* 	1. setlocale()	=> that's it
		* 		=> syntax is ---> setlocale(LC_ALL, 'ja_JP.UTF-8');
		* 		=> notice: encoding string needed after the locale place string
		* 			---> i.e. "UTF-8" after "ja_JP", preceeded by a dot "."
		**********************************/
		//REF http://php.net/manual/ja/function.str-getcsv.php
		public static function
		csv_to_array
		($filename='', $delimiter=',') {
			
// 			//test
// 			Utils::write_Log(
// 					Utils::get_dPath_Log(),
// 					//REF http://www.phpbook.jp/func/string/index7.html
// 					"mb_internal_encoding => ".mb_internal_encoding(),
// 					__FILE__, __LINE__);
					
			
			//test
// 			setlocale(LC_ALL, 'ja-JP');
			setlocale(LC_ALL, 'ja_JP.UTF-8');
			
			/**********************************
			* validate
			**********************************/
			if(!file_exists($filename) || !is_readable($filename))
				return FALSE;
		
			// 		$header = NULL;
			$data = array();
		
			if (($handle = fopen($filename, 'r')) !== FALSE) {
					
				while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
		
					// 				if(!$header)
						// 					$header = $row;
						// 				else
							// 					$data[] = array_combine($header, $row);
						array_push($data, $row);
		
				}
					
				fclose($handle);
					
			}
		
			return $data;
		
		}//csv_to_array

		public static function
		_get_Selector_Category() {
		
			$this->loadModel('Category');
		
			$option = array('order' => array('Category.name' => 'asc'));
		
			$genres = $this->Category->find('all', $option);
		
			$select_Categories = array();
		
			foreach ($genres as $genre) {
		
				$genre_Name = $genre['Category']['name'];
				$genre_Id = $genre['Category']['id'];
		
				$select_Categories[$genre_Id] = $genre_Name;
		
			}
		
			return $select_Categories;
		
		}//_get_Selector_Category
		
		public static function
		_get_Selector_Category_From_GenreID($id) {
		
			//REF http://stackoverflow.com/questions/2802677/what-are-the-possible-reasons-for-appimport-not-working answered May 10 '10 at 13:18
			$model = ClassRegistry::init('Category');
			
// 			$option = array('order' => array('Category.name' => 'asc'));
				
// 			$this->loadModel('Category');
		
			if ($id != null) {
					
				$option = array(
							
						'order' => array('Category.name' => 'asc'),
						'conditions'	=> array('Category.genre_id' => $id)
							
				);
					
			} else {
					
				$option = array('order' => array('Category.name' => 'asc'));
					
			}
		
		
			$categories = $model->find('all', $option);
// 			$categories = $this->Category->find('all', $option);
		
			$select_Categories = array();
		
			foreach ($categories as $category) {
		
				$category_Name = $category['Category']['name'];
				$category_Id = $category['Category']['id'];
		
				$select_Categories[$category_Id] = $category_Name;
		
			}
		
			return $select_Categories;
		
		}//_get_Selector_Category
		
		public static function
		_get_Selector_Genre() {
		
// 			$this->loadModel('Genre');
// 			App::import("Genre");
		
// 			$model = new Genre();
	
			//REF http://stackoverflow.com/questions/2802677/what-are-the-possible-reasons-for-appimport-not-working answered May 10 '10 at 13:18
			$model = ClassRegistry::init('Genre');
						
			$option = array('order' => array('Genre.name' => 'asc'));
			
			$genres = $model->find('all', $option);
			
		
// 			$genres = $this->Genre->find('all', $option);
			// 		$genres = $this->Genre->find('all');
		
			$select_Genres = array();
		
			foreach ($genres as $genre) {
		
				$genre_Name = $genre['Genre']['name'];
				$genre_Id = $genre['Genre']['id'];
		
				$select_Genres[$genre_Id] = $genre_Name;
		
			}
		
			return $select_Genres;
		
		}//_get_Selector_Genre

		public static function
		isKanji_All
		($str) {
			
			foreach ($str as $chr) {
			
				if (!preg_match("/^[一-龠]+$/u",$chr)) {
					
					return false;
					
				};
			
			}
			
			return true;
			
		}//isKanji_All
		
		/**********************************
		* @return
		* 	1	=> Kanji<br>
		* 	2	=> Hiragana<br>
		* 	3	=> Katakana<br>
		* 	4	=> Number<br>
		**********************************/
		public static function
		get_Type
		($str) {
			
			$flag = true;
			
			/**********************************
			* kanji
			**********************************/
			//REF http://stackoverflow.com/questions/2556289/php-split-multibyte-string-word-into-separate-characters answered Mar 31 '10 at 21:56
			foreach (preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY) as $chr) {
// 			foreach ($str as $chr) {
			
// 				debug($chr);
				
				if (!preg_match("/^[一-龠]+$/u",$chr)) {
					
					$flag = false;
					
// 					debug("not match, kanji");
					
					break;
					
				} else {
					
// 					debug("mactch, kanji");
					
				}
			
			}
			
			if ($flag == true) {
				
// 				debug("all match, kanji");
				
				return 1;
				
			}
			
			/**********************************
			* hiragana
			**********************************/
			$flag = true;
			
			foreach (preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY) as $chr) {
// 			foreach ($str as $chr) {
			
// 				debug($chr);
				
				if (!preg_match("/^[ぁ-んー]+$/u",$chr)) {
					
// 					debug("not match, hira");
					
					$flag = false;
					
					break;
					
				} else {
					
// 					debug("match, hira");
					
				}
			
			}
			
			if ($flag == true) {
				
// 				debug("all match, hira");
				
				return 2;
				
			}
			
			/**********************************
			* katakana
			**********************************/
			$flag = true;
			
			foreach (preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY) as $chr) {
// 			foreach ($str as $chr) {
			
// 				debug($chr);
				
				if (!preg_match("/^[ァ-ヶー]+$/u",$chr)) {
					
// 					debug("not match, hira");
					
					$flag = false;
					
					break;
					
				} else {
					
// 					debug("match, hira");
					
				}
			
			}
			
			if ($flag == true) {
				
// 				debug("all match, hira");
				
				return 3;
				
			}
			
			/**********************************
			* number
			**********************************/
			$flag = true;
			
			foreach (preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY) as $chr) {
// 			foreach ($str as $chr) {
			
// 				debug($chr);
				
				if (!preg_match("/^[0-9０-９]+$/u",$chr)) {
					
// 					debug("not match, hira");
					
					$flag = false;
					
					break;
					
				} else {
					
// 					debug("match, hira");
					
				}
			
			}
			
			if ($flag == true) {
				
// 				debug("all match, hira");
				
				return 4;
				
			}
			
			return 0;
			
// 			return true;
			
		}//isKanji_All

		/**********************************
		* from: test_Texts.php: test_ArraySlice($sen, $numOf_SubSentences, $split_Char)
		**********************************/
		public static function
		breakdown_Sentence
		($sen, $numOf_SubSentences, $split_Char) {

			/**********************************
			* prep: data
			**********************************/
			$ary = mb_split($split_Char, $sen);
		
			$numOf_Tokens = count($ary);
		
			/**********************************
			 * slice
			**********************************/
			$numOf_Lots = $numOf_SubSentences;
		
			$numOf_Tokens_perLot = intval(ceil($numOf_Tokens / $numOf_Lots));
		
			$ary_SlicedArrays = array($numOf_Lots);
		
			for ($i = 0; $i < $numOf_Lots; $i++) {
		
				$ary_SlicedArrays[$i] = array_slice(
						$ary,
						$numOf_Tokens_perLot * $i,
						$numOf_Tokens_perLot);
		
			}
		
			/**********************************
			* return
			**********************************/
			return $ary_SlicedArrays;
			
		}//breakdown_Sentence

		/**********************************
		* REF http://www.kinghost.com.br/php/ref.simplexml.php 09-Dec-2011 08:31
		* 
		* parameters of the original => &$base, $add
		* changed to				=> $base, $add
		**********************************/
		public static function
		mergeXML($base, $add) {
// 		mergeXML(&$base, $add) {
			$new = $base->addChild($add->getName());
			foreach ($add->attributes() as $a => $b) {
				$new[$a] = $b;
			}
			foreach ($add->children() as $child) {
				
				Utils::mergeXML($new, $child);
// 				$this->mergeXML($new, $child);
			}
			
			/**********************************
			* return => this code is not in the REF code
			**********************************/
			return $base;
			
		}
		
		public static function
// 		mergeXML_2(&$base, $add) {
		mergeXML_2($base, $add) {
			
			$new = $base->addChild($add->getName());

			$new->surface = $add->surface;
			$new->feature = $add->feature;
			
// 			/**********************************
// 			* return => this code is not in the REF code
// 			**********************************/
			return $base;
			
		}//mergeXML_2

		/**********************************
		 * @return
		*
		* 	=> array(words)
		*
		*	Copied from => HistorysController._view_Mecab($history)
		**********************************/
		public static function
		get_Mecab_WordsArray($text) {
		
			/**********************************
				* prep: sentences
			**********************************/
			$sen = $text;
// 			$sen = $this->sanitize($history['History']['content']);
		
			/**********************************
				* experi
			**********************************/
			$max = 800;
		
			if (mb_strlen($sen) > $max) {
					
				$words_ary = Utils::get_Mecab_WordsArray__MultiLots($sen, $max);
// 				$words_ary = $this->_view_Mecab__MultiLots($sen, $max);
					
			} else {
		
				$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$sen";
		
				//REF http://stackoverflow.com/questions/12542469/how-to-read-xml-file-from-url-using-php answered Sep 22 '12 at 9:17
				$xml = simplexml_load_file($url);
		
				$words_ary = array($xml->word);
				// 			$words = $xml->word;
					
			}
		
			return $words_ary;
		
		}//get_Mecab_WordsArray
		
		public static function
		get_Mecab_WordsArray__MultiLots($sen, $max) {
		
// 			debug("mb_strlen(\$sen) > $max");
				
// 			debug("needs => ".intval(ceil(mb_strlen($sen) / $max))." lots");
		
		
			/**********************************
				* split: original sentence
			**********************************/
			$sen_Array = mb_split("。", $sen);
		
// 			debug("sen_Array => ".count($sen_Array));
		
			$numOf_SentenceArray = count($sen_Array);
		
			/**********************************
				* prep: sentences derived from the original
			**********************************/
			$numOf_Lots = intval(ceil(mb_strlen($sen) / $max));
		
// 			debug("numOf_Lots => $numOf_Lots");
		
			$numOf_Senteces_perLot = intval(ceil($numOf_SentenceArray / $numOf_Lots));
		
// 			debug("numOf_Senteces_perLot => $numOf_Senteces_perLot");
		
			/**********************************
				* split: original sentence => again
			**********************************/
			$split_Char = "。";
		
			$ary_SlicedArrays = Utils::breakdown_Sentence($sen, $numOf_Lots, $split_Char);
		
			$numOf_SlicedArrays = count($ary_SlicedArrays);
		
// 			debug("ary_SlicedArrays => ".$numOf_SlicedArrays);
			// 		debug("ary_SlicedArrays => ".count($ary_SlicedArrays));
		
			// get xmls
			$xmls = array($numOf_SlicedArrays);
		
			for ($i = 0; $i < $numOf_SlicedArrays; $i++) {
					
				$text = implode($split_Char, $ary_SlicedArrays[$i]);
					
				$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$text";
					
				$xmls[$i] = simplexml_load_file($url);
					
			}
		
			/**********************************
				* shorten sentence
			**********************************/
			$sen = mb_substr($sen, 0, $max);
		
			$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$sen";
		
			//REF http://stackoverflow.com/questions/12542469/how-to-read-xml-file-from-url-using-php answered Sep 22 '12 at 9:17
			$xml = simplexml_load_file($url);
		
			if ($xmls == null) {
		
				return array($xml->word);
					
			} else {
		
				$num = count($xmls);
					
				$words_ary = array();
				// 			$words_ary = array($num);
					
				for ($i = 0; $i < $num; $i++) {
		
					array_push($words_ary, $xmls[$i]);
		
				}
					
				return $words_ary;
					
			}
		
		}//get_Mecab_WordsArray__MultiLots

		public static function
		get_Words($text) {
		
// 			debug("\$text => ");
// 			debug($text);
			
			$sen = Utils::_sanitize($text);
// 			$sen = $this->_sanitize($text);
		
// 			debug("\$sen is...");
// 			debug($sen);
			
			$max = 800;
			// 		$max = 1500;	//=> error
			// 		$max = 2000;	//=> error
			
// 			debug("mb_strlen(\$sen) => ".mb_strlen($sen)." / "."\$max => ".$max );
			
			if (mb_strlen($sen) > $max) {
					
				$words_ary = Utils::get_Mecab_WordsArray__MultiLots($sen, $max);
// 				$words_ary = $this->_view_Mecab__MultiLots($sen, $max);
				// 			$words = $this->_view_Mecab__MultiLots($sen, $max);
					
			} else {
			
				$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$sen";
			
				//REF http://stackoverflow.com/questions/12542469/how-to-read-xml-file-from-url-using-php answered Sep 22 '12 at 9:17
				$xml = simplexml_load_file($url);
				
// 				debug("\$xml =>");
// 				debug($xml);
				// 				object(SimpleXMLElement) {
				// 					word => array(
				// 							(int) 0 => object(SimpleXMLElement) {
				// 								surface => '---'
				// 										feature => '名詞,サ変接続,*,*,*,*,*'
				// 					},
				// 					(int) 1 => object(SimpleXMLElement) {
				// 						surface => '　'
				// 								feature => '記号,空白,*,*,*,*,　,　,　'
			
				$words_ary = array($xml->word);
				// 			$words = $xml->word;
				
// 				debug("\$xml->word =>");
// 				debug($xml->word);
				
// 				debug("count(\$xml->word) =>");
// 				debug(count($xml->word));
				
				
// 				debug("count(\$words_ary) => ");
// 				debug(count($words_ary));
				
// 				debug("\$words_ary =>");
// 				debug($words_ary);
					
			}
			
			return $words_ary;
				
		}//_view_Mecab

		public static function
		get_Words_2($text) {
		
			$sen = Utils::_sanitize($text);
			
			$max = 800;
			// 		$max = 1500;	//=> error
			// 		$max = 2000;	//=> error
			
			if (mb_strlen($sen) > $max) {
					
				$words_ary = Utils::get_Mecab_WordsArray__MultiLots($sen, $max);
// 				$words_ary = $this->_view_Mecab__MultiLots($sen, $max);
				// 			$words = $this->_view_Mecab__MultiLots($sen, $max);
					
			} else {
			
				$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$sen";
			
				//REF http://stackoverflow.com/questions/12542469/how-to-read-xml-file-from-url-using-php answered Sep 22 '12 at 9:17
				$xml = simplexml_load_file($url);
				
// 				debug("\$xml =>");
// 				debug($xml);
				// 				object(SimpleXMLElement) {
				// 					word => array(
				// 							(int) 0 => object(SimpleXMLElement) {
				// 								surface => '---'
				// 										feature => '名詞,サ変接続,*,*,*,*,*'
				// 					},
				// 					(int) 1 => object(SimpleXMLElement) {
				// 						surface => '　'
				// 								feature => '記号,空白,*,*,*,*,　,　,　'
			
				$words_ary = $xml->word;
// 				$words_ary = array($xml->word);
				// 			$words = $xml->word;
				
// 				debug("\$xml->word =>");
// 				debug($xml->word);
				
// 				debug("count(\$xml->word) =>");
// 				debug(count($xml->word));
				
				
// 				debug("count(\$words_ary) => ");
// 				debug(count($words_ary));
				
// 				debug("\$words_ary =>");
// 				debug($words_ary);
					
			}
			
			return $words_ary;
				
		}//get_Words_2($text)

		public static function
		_sanitize
		($str, $tag="font") {
		
			$tag = "font";
			$p = "/<$tag.+?>(.+)<\/$tag>/";
		
			$rep = '${1}';
		
			return preg_replace($p, $rep, $str);
		
		}

		public static function
		get_BS_Subject($token_Sen, &$id) {
			
			$ary_Ha = array();
			
			for ($i = 0; $i < count($token_Sen); $i++) {
					
				$token_Combo = array();
					
// 				debug("\$token_Sen[".$i."] is...");
// 				debug($token_Sen[$i]);
				
				if ($token_Sen[$i]['Token']['form'] == 'は'
						&& $token_Sen[$i]['Token']['hin'] == '助詞'
// 						&& $token_Sen[$i]['Token']['history_id'] == '82'
						// 					&& $tokens[$i]['Token']['insentence_id'] == $i
				) {
			
					debug("yes => ");
					array_push($token_Combo, $token_Sen[$i]);
					array_push($token_Combo, $i);
			
					array_push($ary_Ha, $token_Combo);
					// 				array_push($text_Ha_ary, $token_Sen[$i]);
			
				}
				
			}

			/**********************************
			* validate
			**********************************/
			if (count($ary_Ha) < 1) {
				
				debug("\$ary_Ha => no entry");
				
				return null;
				
			}
			
			/**********************************
			* build: word
			**********************************/
			
			$bs_Subject = Utils::get_Word_Ha($token_Sen, $ary_Ha[0]);
			
			$id = $ary_Ha[0][1];
			
			return $bs_Subject;
			
// 			debug("count(\$ary_Ha) is ...");
// 			debug(count($ary_Ha));
// 			debug($ary_Ha[0]);
// 			debug($token_Combo);
			
		}//get_BS_Subject

		public static function
		get_BS_Verb($token_Sen, $start_Id) {
			
			$ary_Verb = array();
			
			for ($i = $start_Id; $i < count($token_Sen); $i++) {
// 			for ($i = 0; $i < count($token_Sen); $i++) {
					
				$token_Combo = array();
				
				if (
// 						$token_Sen[$i]['Token']['form'] == 'は'
// 						&& $token_Sen[$i]['Token']['hin'] == '助詞'
						$token_Sen[$i]['Token']['hin'] == '動詞'
// 						&& $token_Sen[$i]['Token']['history_id'] == '82'
						// 					&& $tokens[$i]['Token']['insentence_id'] == $i
				) {
			
					debug("yes => ");
					array_push($token_Combo, $token_Sen[$i]);
					array_push($token_Combo, $i);
			
					array_push($ary_Verb, $token_Combo);
					// 				array_push($text_Ha_ary, $token_Sen[$i]);
			
				}
				
			}

			/**********************************
			* validate
			**********************************/
			if (count($ary_Verb) < 1) {
				
				debug("\$ary_Verb => no entry");
				
				return null;
				
			}
			
			/**********************************
			* build: word
			**********************************/
			$bs_Verb = Utils::get_Word_Verb($token_Sen, $ary_Verb[0]);
			
			return $bs_Verb;
			
		}//get_BS_Verb

		
		public static function
		get_Word_Ha($tokens, $combo) {
		
			$insentence_Id = $combo[1];
		
			$word_Final = $combo[0]['Token']['form'];
		
			// 		debug("\initial \$word_Final is...");
			// 		debug($word_Final);
		
			$token_Index_Offset = -1;
		
			$target_Index = $insentence_Id + $token_Index_Offset;
		
			while ($target_Index >= 0) {
					
				$token_Prev = $tokens[$target_Index];
					
				if ($token_Prev['Token']['hin'] != '名詞') {
		
					break;
		
				}
					
				// 			debug($token_Prev['Token']['form']);
					
				$word_Final = $token_Prev['Token']['form'].$word_Final;
					
				// 			debug($word_Final);
					
				$target_Index --;
					
			}
		
			return ($word_Final == $combo[0]['Token']['form']) ? null : $word_Final;
			// 		return ($token_Index_Offset == -1) ? null : $word_Final;
			// 		if ($insentence_Id > 0) {
				
			// 			$token_Prev = $tokens[$insentence_Id - 1];
				
			// 			debug($token_Prev['Token']['form']);
				
			// 			$word_Final = $token_Prev['Token']['form'].$word_Final;
				
			// 			debug($word_Final);
				
			// 		}
		
		}
		
		public static function
		get_Word_Verb($tokens, $combo) {
		
			$insentence_Id = $combo[1];
		
			$word_Final = $combo[0]['Token']['form'];
		
			// 		debug("\initial \$word_Final is...");
			// 		debug($word_Final);
		
			$token_Index_Offset = 1;
// 			$token_Index_Offset = -1;
		
			$target_Index = $insentence_Id + $token_Index_Offset;
		
			while ($target_Index < count($tokens)) {
					
				$token_Next = $tokens[$target_Index];
					
				if ($token_Next['Token']['form'] == '。'
					|| $token_Next['Token']['form'] == '、') {

					$word_Final .= $token_Next['Token']['form'];
					
					break;
		
				} else {
					
					$word_Final .= $token_Next['Token']['form'];
					
				}
					
				// 			debug($token_Prev['Token']['form']);
					
// 				$word_Final = $token_Next['Token']['form'].$word_Final;
					
				// 			debug($word_Final);
					
				$target_Index ++;
					
			}
		
			return ($word_Final == $combo[0]['Token']['form']) ? null : $word_Final;
			// 		return ($token_Index_Offset == -1) ? null : $word_Final;
			// 		if ($insentence_Id > 0) {
				
			// 			$token_Prev = $tokens[$insentence_Id - 1];
				
			// 			debug($token_Prev['Token']['form']);
				
			// 			$word_Final = $token_Prev['Token']['form'].$word_Final;
				
			// 			debug($word_Final);
				
			// 		}
		
		}

		/*******************************
			@param
			$hist_id	=> History id
		*******************************/
		public static function
		exists_History($hist_id) {
			
			/*******************************
				load
			*******************************/
// 			$option = array('conditions' => array('id' => $hist_id));
			$option = array('conditions' => array('History.id' => $hist_id));
			
			$model = ClassRegistry::init('History');
			
// 			$hist = $model->find('first', $option);

			try {
				
				$hist = $model->find('first', $option);
				
			} catch (Exception $e) {
				
				debug($e);
				
			}
			
			if ($hist != null) {
				
				return true;
				
			} else {
				
				return false;
				
			}
			
		}//exists_History($hist_id)
		
		public static function
		get_Category_From_Id($cat_Id) {

			/*******************************
				get: category
			*******************************/
// 			$this->loadModel('Category');
			$model = ClassRegistry::init('Category');
			
			$option = array('conditions' => array('Category.id' => $cat_Id));
			
			return $model->find('first', $option);
// 			return $this->Category->find('first', $option);
				
		}

		public static function
		get_Category_From_Name($cat_Name) {

			/*******************************
				get: category
			*******************************/
// 			$this->loadModel('Category');
			$model = ClassRegistry::init('Category');
			
			$option = array('conditions' => array('Category.name' => $cat_Name));
			
			return $model->find('first', $option);
// 			return $this->Category->find('first', $option);
				
		}

		public static function
		get_Genre_From_Genre_Code($genre_code) {

			/*******************************
				get: category
			*******************************/
// 			$this->loadModel('Category');
			$model = ClassRegistry::init('Genre');
			
			$option = array('conditions' => array('Genre.code' => $genre_code));
			
			return $model->find('first', $option);
// 			return $this->Category->find('first', $option);
				
		}

		public static function
		get_Genre_From_Genre_Id($genre_id) {

			/*******************************
				get: category
			*******************************/
// 			$this->loadModel('Category');
			$model = ClassRegistry::init('Genre');
			
			$option = array('conditions' => array('Genre.id' => $genre_id));
			
			$genre = $model->find('first', $option);
			
// 			debug($genre);
			
			return $genre;
// 			return $model->find('first', $option);
// 			return $this->Category->find('first', $option);
				
		}//get_Genre_From_Genre_Id($genre_id)

		public static function
		get_Genre_From_Genre_Name($genre_name) {

			/*******************************
				get: category
			*******************************/
// 			$this->loadModel('Category');
			$model = ClassRegistry::init('Genre');
			
			$option = array('conditions' => array('Genre.name' => $genre_name));
			
			$genre = $model->find('first', $option);
			
// 			debug($genre);
			
			return $genre;
// 			return $model->find('first', $option);
// 			return $this->Category->find('first', $option);
				
		}//get_Genre_From_Genre_Name($genre_name)

		public static function
		sanitize_Tags($article_line, $tag_array) {
			
			for ($i = 0; $i < count($tag_array); $i++) {
				
				$tag = $tag_array[$i];
				
				$pattern = "/<$tag.*?>/";
// 				$pattern = "/<$tag.+>/";
// 				$pattern = "<$tag.+>";
				$replacement = "";
				
				$article_line = preg_replace($pattern, $replacement, $article_line);
// 				preg_replace($pattern, $replacement, $article_line);
				
				$pattern = "/<\/$tag>/";
// 				$pattern = "/<$tag.+>/";
// 				$pattern = "<$tag.+>";
				$replacement = "";
				
				$article_line = preg_replace($pattern, $replacement, $article_line);
// 				preg_replace($pattern, $replacement, $article_line);
				
			}
			
			return $article_line;
			
		}//sanitize_Tags

		public static function
		unset_Vars($target, $var_Array) {
			
			$count = 0;
			
			foreach ($var_Array as $v) {
				
				unset($target[$v]);
// 				unset($v);
				
				$count ++;
				
			}
			
			return $target;
// 			return $count;
			
		}//unset_Vars

		public static function
		find_Tokens_from_CatId($cat_id) {
			
			/*******************************
				model
			*******************************/
			$model = ClassRegistry::init('Token');
			
			/*******************************
			 get: tokens
			*******************************/
			$option = array('conditions' =>
			
// 					array("AND" =>
							array("Token.category_id" => $cat_id),
// 							array('Token.hin' => "名詞")
// 					),
			);//array('conditions'
			
			$tokens = $model->find('all', $option);

			return $tokens;
			
		}//find_Tokens_from_CatId_and_Hin

		public static function
		find_Genre_from_Code($code) {
			
			/*******************************
				model
			*******************************/
			$model = ClassRegistry::init('Genre');
			
			/*******************************
			 get: tokens
			*******************************/
			$option = array('conditions' =>
			
// 					array("AND" =>
							array("Genre.code" => $code),
// 							array('Token.hin' => "名詞")
// 					),
			);//array('conditions'
			
			$genre = $model->find('first', $option);

			return $genre;
			
		}//find_Genre_from_Code($code)

		/*******************************
			@return
			$histo, $total
		*******************************/
		
		public static function
		get_Histo($tokens_1) {
			
			/*******************************
			 build: list
			*******************************/
			$s = "";
			
			$nouns = array();
			
			for ($i = 0; $i < count($tokens_1); $i++) {
					
				$t = $tokens_1[$i];
					
				if ($t['Token']['hin'] == "名詞") {
			
					$s .= $t['Token']['form'];
			
					continue;
			
				} else {
			
					if ($s == "") {
			
						continue;
			
					} else {
			
						// 					if ($s != null) {	//=> w
						// 					if ($s != null && $s != "") {	//=> w
						if ($s != null && $s != "" && $s != -1) {	//=> w
							// 					if ($s != null && $s != "" && $s != -1 && $s != 0) {	//=> debug displayed
							// 					if ($s != null && $s != "" && $s != -1 && $s != 0) {
							// 					if ($s != "０" && $s != "0") {
							// 					if ($s != "０") {
			
							// 						debug($s);
			
							array_push($nouns, $s);;
			
						} else {
			
//							debug($s);
			
						}
							
						// 					array_push($nouns, $s);
							
						$s = "";
							
						continue;
			
					}
			
				}//if ($t['Tokens']['hin'] == "名詞")
					
			}//for ($i = 0; $i < count($tokens_1); $i++)
			
			$nouns_unique = array_unique($nouns);
			
// 			debug("count(\$nouns_unique)");
// 			debug(count($nouns_unique));
			
				// 		// omit '0'
				// 		$len = count($nouns_unique);
			
			// // 		debug($nouns_unique[10]);
			
			// // 		debug(array_slice($nouns_unique, 600, 10));
			// // 		debug($len);
			
			// 		for ($i = 0; $i < $len; $i++) {
			// // 		for ($i = 0; $i < count($nouns_unique); $i++) {
				
			// 			debug($nouns_unique[$i]."(".$i.")");
				
			// // 			$noun = $nouns_unique[$i];
			// // 			$n = $nouns_unique[$i];
				
			// // 			if ($n == "0") {
			// // // 			if ($n == '0') {
			
			// // 				debug("yes");
			// // // 				debug("='0'");
			
			// // 			}
			// 		}
			
			
			// // 		$nouns_unique = array_diff($nouns_unique, array('0'));
			
			
//			debug("count(\$nouns_unique)");
//			debug(count($nouns_unique));
			
			$len_unique = count($nouns_unique);
			
			$nouns_unique = array_values($nouns_unique);
			
// 			// 		// omit '0'
// 			// 		unset($nouns_unique[0]);
			
// 			// 		debug("unset => \$nouns_unique[0]");
			
// 			// 		debug(array_slice($nouns_unique, 0, 20));
			
// 			for ($i = 0; $i < $len_unique; $i++) {
// 				// 		for ($i = 0; $i < count($nouns_unique); $i++) {
			
// 				$n = $nouns_unique[$i];
					
// 				if ($n == '0') {
			
// //					debug("='0'");
			
// 				} else if ($n == "0") {
			
// //					debug("=\"0\"");
			
// 				} else if ($n == "０") {
			
// //					debug("=\"０\"");
			
// 				}
					
					
// 				// 			debug($nouns_unique[$i]."(".$i.")");
			
// 				// 			$noun = $nouns_unique[$i];
// 				// 			$n = $nouns_unique[$i];
			
// 				// 			if ($n == "0") {
// 				// // 			if ($n == '0') {
			
// 				// 				debug("yes");
// 				// // 				debug("='0'");
			
// 				// 			}
// 			}
			
// 			// 		$nouns_unique = array_diff($nouns_unique, array("０"));
			
// 			// 		$len_unique = count($nouns_unique);
			
// 			// 		$nouns_unique = array_values($nouns_unique);
			
			/*******************************
			 histogram
			*******************************/
			$histo = array($len_unique);
			
			for ($i = 0; $i < $len_unique; $i++) {
					
				$histo[$nouns_unique[$i]] = 0;
					
			}
			
			$len_total = count($nouns);
			
			for ($i = 0; $i < $len_total; $i++) {
					
				$histo[$nouns[$i]] ++;
					
			}
			
			// 		debug(array_slice($histo, 0, 10));
			
			/*******************************
			 sort
			*******************************/
			asort($histo);
			
			$histo = array_reverse($histo);
			
			// omit '0'
			$omit = array(0);
// 			$omit = array(0, 'こと', '人', 'ロボット', '理由', '場合', '中止', 'ため', 'の');
			
			$histo = Utils::unset_Vars($histo, $omit);
// 			// 		$histo = Utils::unset_Vars($histo, array(0, 'こと', '人', 'ロボット'));
// 			// 		$histo = Utils::unset_Vars($histo, array(0, 'こと'));	//=> w
// 			// 		$histo = Utils::unset_Vars($histo, array(0));	//=> w
// 			// 		Utils::unset_Vars($histo, array(0));
// 			// 		Utils::unset_Vars(array($histo[0], $histo['こと']));
// 			// 		unset($histo[0]);
			
// 			// 		debug($histo);
			
			/*******************************
			 set: values
			*******************************/
			$total = 0;
			
			// 		debug(array_slice($histo, 10,10));
			
			// 		$total += $histo[0] + $histo[1];
			
			// 		debug($total);
			
			// 		debug($histo[0]);
			// 		debug($histo[1]);
			
			$count = 0;
			
			foreach ($histo as $h) {
					
				$total += $h;
					
				// 			debug($h."/".$total);
					
				// 			$count ++;
					
				// 			if ($count > 10) {
			
				// 				break;;
			
				// 			}
					
			}
			
			// 		debug($total);
			
			// 		for ($i = 0; $i < count($histo); $i++) {
				
			// 			$total += $histo[$i];
				
			// 		}
			
// 			$this->set("total", $total);
// 			// 		$this->set("total", count($nouns));
// 			// 		$this->set("total", count($tokens));
			
// 			$this->set("histo", $histo);

			return array($histo, $total);
			
// 			return array();
			
		}//get_Histo

		/*******************************
			@return null => can't find the value
		*******************************/
		public static function
		get_Admin_Value
		($key, $val_1) {
		
// 			$this->loadModel('Admin');
	
			//REF http://stackoverflow.com/questions/2802677/what-are-the-possible-reasons-for-appimport-not-working answered May 10 '10 at 13:18
			$model = ClassRegistry::init('Admin');
		
			$option = array(
						
					'conditions'	=> array(
							'Admin.name LIKE'	=> $key
					)
			);
		
			// 		$admin = $this->Admin->find('first');
			$admin = $model->find('first', $option);
// 			$admin = $this->Admin->find('first', $option);
		
			// 		debug($admin);
		
			if ($admin == null) {
			
				return null;
			
			} else {
			
				return @$admin['Admin'][$val_1];
				
			}//if ($admin == null)
			
			
			
// 			return @$admin['Admin'][$val_1];
		
		}//get_Admin_Value


		public static function
		get_Matching_Scores($keys_Target, $keys_Ref) {
			
			$score_1 = 0;
			
			for ($i = 0; $i < $len; $i++) {
			
				for ($j = 0; $j < $len; $j ++) {
					// 			foreach ($keys_Ref as $data) {
					// 			foreach ($data_1[0] as $data) {
			
					$data = $keys_Ref[$j];
						
					if ($keys_Target[$i] == $data) {
			
						$score_1 ++;
			
						// 					debug("match => ".$keys_Target[$i]." / ".$data);
			
					}
				}
			
			}

			return $score_1;
			
		}//get_Matching_Scores

		public static function
		create_Tokens($cat_Id) {
			
			/*******************************
			 get: history list
			*******************************/
			$model = ClassRegistry::init('History');
			
			$option = array('conditions'
					=> array(
							'History.category_id'
							=> $cat_Id));
			
			$histories = $model->find('all', $option);
			
			/*******************************
			 validate: any history
			*******************************/
			if (count($histories) < 1) {
			
				debug("no history for category id: ".$cat_Id);
				
// 				$this->Session->setFlash(__('no history for category id: '.$cat_Id));
			
// 				$this->render("/Historys/tests/create_Tokens");
			
				return null;
			
			} else {
			
				debug("count(\$histories)");
				debug(count($histories)."(".$histories[0]['History']['genre_id'].")");
			
			}
			
			/**********************************
			 * validate:
			**********************************/
			$count = 0;
			
			foreach ($histories as $history) {
				
				$res = Utils::_save_Tokens__TokensExist($history);
	// 			$res = $this->_save_Tokens__TokensExist($history);
				
				// 		debug("tokens exist => ".$res);
				
				if ($res == true) {
						
// 					$msg_Flash = "Tokens exist for this history: id = "
// 							.$history['History']['id'];
				
// 					$this->Session->setFlash(__($msg_Flash));
						
					// 			debug("message => set");
					
					$count ++;
						
				} else {
					
					debug("tokens => don't exist for the history: "
							.$history['History']['id']);
					
					/**********************************
					 * words array
					**********************************/
					$words_ary = Utils::get_Words($history['History']['content']);
						
					// 			debug("\$words_ary length...");
					// 			debug(count($words_ary));
					
// 					/**********************************
// 					 * save tokens
// 					**********************************/
					$msg_Flash = Utils::save_Tokens__V2($words_ary, $history);
// 					$msg_Flash = $this->save_Tokens__V2($words_ary, $history);

				}
				
			}//foreach ($histories as $history)

			debug("histories ".count($histories)." / "."tokens found ". $count);
			
			return null;
			
		}//create_Tokens

		public static function
		_save_Tokens__TokensExist($history) {
		
// 			$this->loadModel('Token');

			$model = ClassRegistry::init('Token');
		
			$options = array(
					'conditions' =>
					array("Token.history_id" => $history['History']['id'])
			);
		
			$tokens = $model->find('all', $options);
// 			$tokens = $this->Token->find('all', $options);
		
			// 		debug("\$tokens ...");
			// 		debug(count($tokens));
		
			/**********************************
				* return
			**********************************/
			if ($tokens == null) {
					
				return false;
					
			} else if (count($tokens) > 0) {
					
				return true;
					
			} else {
					
				return true;
					
			}
		
		}//_save_Tokens__TokensExist

		/*******************************
		 @return
		1. Flash message string
		*******************************/
		public static function
		save_Tokens__V2
		($words_ary, $history) {
		
			/**********************************
				* vars
			**********************************/
			$msg_Flash = "";
		
			$tokens = array();
		
			/**********************************
				* processing
			**********************************/
			$count = 0;
			
			for ($i = 0; $i < count($words_ary); $i++) {
					
				/**********************************
					* get: words list
				**********************************/
				$words = $words_ary[$i];
					
				// 			$words= $this->get_Mecab_WordList($history['History']['content']);
		
				/**********************************
					* conv: words to tokens
				**********************************/
				$tokens = Utils::conv_MecabWords_to_Tokens__V2($words, $tokens);
// 				$tokens = $this->conv_MecabWords_to_Tokens__V2($words, $tokens);
				// 			$tokens = $this->conv_MecabWords_to_Tokens($words);
		
				/**********************************
					* save: tokens
				**********************************/
				$res = Utils::save_token_list($tokens, $history);
				// 			$res = $this->save_token_list($tokens, $history['History']['id']);
		
				if ($res == true) {
				
					$count ++;
				
				} else {
				
					
				}//if ($res == true)
				
			}//for ($i = 0; $i < count($words_ary); $i++)

			debug("words_ary => ".count($words_ary)." / "."words saved => ".$count);
			
			/*******************************
			 return
			*******************************/
			return $msg_Flash;
			// 		return $history['History']['id'];
		
		}//save_Tokens

		public static function
		conv_MecabWords_to_Tokens__V2
		($words, $token_list) {
		
			// 		$token_list = array();
		
			$counter = 0;
		
			foreach ($words as $w) {
		
				$token = new Token();
		
				/**********************************
					* form
				**********************************/
				$token->form = $w->surface;
				// 			$token->form = $w->surface;
		
				/**********************************
					* features
				**********************************/
				// 			$token->hin = $w->feature;
					
				$tmp = explode(',', (string)$w->feature);
				// 			$tmp = explode(',', $w->feature);
		
				// 			if ($counter < 20) {
		
				// 				debug((string)$w->surface);
				// 				debug((string)$w->feature);
				// // 				debug($w->surface);
		
				// // 				break;
				// 			}
					
					
					
				// 			//log
				// 			$msg = "count(\$tmp) => " + count($tmp);
				// 			Utils::write_Log($this->path_Log, $msg, __FILE__, __LINE__);
					
				// 			debug($tmp);
		
				// 			if ($counter < 20) {
					
				// 				debug($tmp);
				// 				// 				debug($w->surface);
					
				// 				// 				break;
				// 			}
		
				if ($tmp == null || count($tmp) == 7 ) {
					// 			if ($tmp == null || count($tmp) < 9) {
		
					$token->hin		= $tmp[0];
		
					$token->hin_1	= $tmp[1];
					$token->hin_2	= $tmp[2];
					$token->hin_3	= $tmp[3];
		
					$token->katsu_kei	= $tmp[4];
					$token->katsu_kata	= $tmp[5];
					$token->genkei	= $tmp[6];
					$token->yomi	= "*";
		
					$token->hatsu	= "*";
		
					// 				debug($w->feature);
		
					// 				continue;
		
				} else if (count($tmp) == 9) {
		
					$token->hin		= $tmp[0];
		
					$token->hin_1	= $tmp[1];
					$token->hin_2	= $tmp[2];
					$token->hin_3	= $tmp[3];
		
					$token->katsu_kei	= $tmp[4];
					$token->katsu_kata	= $tmp[5];
					$token->genkei	= $tmp[6];
					$token->yomi	= $tmp[7];
		
					$token->hatsu	= $tmp[8];
		
				} else {
		
					continue;
		
				}
					
				/**********************************
					* hin
				**********************************/
					
					
					
				array_push($token_list, $token);
		
				//test
				$counter += 1;
					
				// 			if ($counter < 10) {
		
				// 				debug($token);
		
				// // 				break;
				// 			}
					
			}//foreach ($words as $w)
		
			return $token_list;
		
		}//conv_MecabWords_to_Tokens

		public static function
		save_token_list
		($tokens, $history) {
			// 	($tokens, $history_id) {
		
			$history_id = $history['History']['id'];
		
			$category_id = $history['Category']['id'];
		
			$genre_id = $history['Category']['genre_id'];
		
			$counter = 0;
		
// 			$this->loadModel('Token');

			$model = ClassRegistry::init('Token');
		
			foreach ($tokens as $token) {
		
				$model->create();
// 				$this->Token->create();
		
				// 			$cat_id = $this->_save_Data_Keywords_from_CSV__Get_CatID_From_OrigID(
				// 								$kw_pair[3], $categories);
					
				// 			// valiate
				// 			if ($cat_id == false) {
		
				// 				continue;
		
				// 			}
					
				// build param
				$param = array('Token' =>
		
						array(
									
								'created_at'	=> Utils::get_CurrentTime(),
								'updated_at'	=> Utils::get_CurrentTime(),
									
								'form'			=> $token->form,
									
								'hin'			=> $token->hin,
								'hin_1'			=> $token->hin_1,
								'hin_2'			=> $token->hin_2,
								'hin_3'			=> $token->hin_3,
									
								'katsu_kei'		=> $token->katsu_kei,
								'katsu_kata'	=> $token->katsu_kata,
								'genkei'		=> $token->genkei,
								'yomi'			=> $token->yomi,
								'hatsu'			=> $token->hatsu,
									
								'history_id'	=> $history_id,
									
								'category_id'	=> $category_id,
								'genre_id'		=> $genre_id,
									
						)
		
				);
					
				if ($model->save($param)) {
// 				if ($this->Token->save($param)) {
		
					$counter += 1;
		
				}
		
				// 			//test
				// 			if ($counter > 20) {
		
				// 				break;
		
				// 			}
					
			}//foreach ($cat_pairs as $cat_pair)
		
			return $counter;
		
		}//save_token_list
		
		public static function
		decode_HTML($text, $set) {
			
			foreach ($set as $key => $val) {
				
				$p = "/$key/";
				
				$rep = $val;
				
				$text = preg_replace($p, $rep, $text);
				
			}
			
			return $text;
			
// 			$p = '/&lt/';
			
// 			$rep = '<';
			
// 			return preg_replace($p, $rep, $text);
			
		}

		///////////////////////////////
		//
		// if can't get h1 tags => return null
		//
		 ///////////////////////////////
		public static function
		get_Article_Line($url) {

// 			debug("get_Article_Line");
			
			$html = file_get_html($url);
			
// 			debug("html => obtained");
			
			$h1s = $html->find('h1');
			
			/****************************
			 * validate
			 *****************************/
			if (count($h1s) < 1) {
				
				return null;
				
			}
			
// 			debug(count($h1s));
// 			debug(count($h1->plaintext));
// 			debug(count($h1->text));

// 			debug($h1s[0]);	//=> out of mem
			
			$texts = array();
			
			foreach ($h1s as $h1) {
			
// 				debug($h1->plaintext);

				array_push($texts, $h1->plaintext);
				
// 				if ($h1->class == "ynDetailText") {
			
					// 				return $h1->plaintext;
// 					array_push($texts, $h1->plaintext);
			
// 				}
			
			}//foreach ($h1s as $h1)
			
			///////////////////////////////
			//
			// return
			//
			 ///////////////////////////////
			return $texts[0];
			
		}//get_Article_Line($url)

		/*******************************
			get_GenreCategoryKeyword_List($genre_id)
			
			@return
			[$genre_id, $genre_name, ary_2]
			ary_2	=> [ary_1, ary_1, ...]
			ary_1	=> [$category_id, $category_name, ary_0]
			ary_0	=> [$keyword, $keyword, ...]
			 
		*******************************/
		public static function
		get_GenreCategoryKeyword_List($genre_id) {
	
			/*******************************
				get: genre
			*******************************/
			$model = ClassRegistry::init('Genre');
			
			$option = array('conditions' => array('Genre.id' => $genre_id));
				
			$genre = $model->find('first', $option);
			
			$genre_name = $genre['Genre']['name'];
			
// 			debug("genre_id = $genre_id ---> ".$genre_name);
// 			debug("genre_id = $genre_id ---> ".$genre['Genre']['name']);

			/*******************************
				categories: ids and names
			*******************************/
			$categories = $genre['Category'];
			
// 			debug($categories);
			
			$aryof_category_ids_and_names = array();
			
			// build list
			foreach ($categories as $category) {
	
				array_push(
						$aryof_category_ids_and_names, 
						array($category['id'], $category['name']));
				
			}//foreach ($categories_0 as $category)

// 			debug($aryof_category_ids_and_names);
			
			//test
// 			asort($aryof_category_ids_and_names);
			//REF http://cakephp.1045679.n5.nabble.com/Using-usort-in-Cake-td1327099.html Aug 11, 2009; 9:18pm
			usort($aryof_category_ids_and_names, 
					array("utils", "cmp_Sort_Categories_By_Name"));	//=> working (20170405_142133)
// 					array(&$this, "cmp_Sort_Categories_By_Name"));
				
// 			debug("sorted");
			
// 			debug($aryof_category_ids_and_names);
			
			/*******************************
				build array: ary_1, ary_2
				
				ary_1 = array("49", "computer", array("AI", "アプリ"))
				ary_2 = array(ary_1, ary_1, ...)
			*******************************/
			$ary_2 = array();	// ary of ary_1
			
			foreach ($aryof_category_ids_and_names as $pair) {

				$ary_1 = array();	// ary of cat id, cat name, keywords
				
// 				debug("cat id = ".$pair[0]." / "."cat name = ".$pair[1]);
				//	'cat id = 49 / cat name = computer'
	
				$keywords = Utils::get_Keywords_From_Category_Id($pair[0]);

// 				debug("category name => ".$pair[1]);
// 				debug($keywords);

				array_push($ary_1, $pair[0], $pair[1], $keywords);
				
				// ary_2
				array_push($ary_2, $ary_1);
				
			}//foreach ($aryof_category_ids_and_names as $pair)

			//debug
// 			debug("count(\$ary_2) => ".count($ary_2));
// 			debug("count(\$ary_1) => ".count($ary_1));
			
// 			debug($ary_2);
// 			debug($ary_1);

			/*******************************
				array: ary_3
				
				ary_3 = array($genre_id, $genre_name, ary_2)
			*******************************/
			$ary_3 = [
					
					$genre_id,
					$genre_name,
					$ary_2
			];
			
// 			debug($ary_3);
			
			/*******************************
				return
			*******************************/
			return $ary_3;
			
		}//get_GenreCategoryKeyword_List($genre_id)
	
		public static function
		get_Keywords_From_Category_Id($category_id) {
			
			// keywords
// 			$this->loadModel('Keyword');
			$model = ClassRegistry::init('Keyword');
			
			$keywords = $model->find('all',
			
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
			
		}//get_Keywords_From_Category_Id($pair[0])
		
		public static function
		get_Keyword_From_Keyword_Id($keyword_id) {
			
			// keywords
// 			$this->loadModel('Keyword');
			$model = ClassRegistry::init('Keyword');
			
			$keyword = $model->find('first',
			
					array('conditions' =>
			
							array(
									'Keyword.id'	=> $keyword_id,
										
							)
							, 'order' =>
			
							array('Keyword.id'	=> 'asc')
			
					)
					);
			
			// return
			return $keyword;
			
		}//get_Keywords_From_Category_Id($pair[0])

		public static function
		cmp_Sort_Categories_By_Name($cat_1, $cat_2) {
		
			//REF http://www.php.net/manual/en/function.floatval.php
			$cat_name_1 = $cat_1[1];
			$cat_name_2 = $cat_2[1];
			
			//REF http://stackoverflow.com/questions/481466/php-string-to-float answered Jan 26 '09 at 21:35
			
// 			return $cat_name_1 < $cat_name_2;
			return $cat_name_1 > $cat_name_2;
			// 		return $point_1 < $point_2;
					
			
		}//cmp_Sort_Categories_By_Name($cat_1, $cat_2)
	
		public static function
		test_Utils_2_Copied() {
			
			debug("test_Utils_2_Copied");
			
		}
		
	}//class Utils
	
	