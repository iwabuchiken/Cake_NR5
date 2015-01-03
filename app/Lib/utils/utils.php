<?php

	require_once 'CONS.php';
	
	class Utils {
		
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
				
			write_Log(
			CONS::get_dPath_Log(),
			// 				$this->get_dPath_Log(),
			$msg,
			__FILE__,
			__LINE__);
				
				
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
		
			$sen = Utils::_sanitize($text);
// 			$sen = $this->_sanitize($text);
		
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
			
				$words_ary = array($xml->word);
				// 			$words = $xml->word;
					
			}
			
			return $words_ary;
				
		}//_view_Mecab

		public static function
		_sanitize
		($str, $tag="font") {
		
			$tag = "font";
			$p = "/<$tag.+?>(.+)<\/$tag>/";
		
			$rep = '${1}';
		
			return preg_replace($p, $rep, $str);
		
		}
		
	}//class Utils
	