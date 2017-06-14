<?php

class PiecesController extends AppController {
	public $helpers = array('Html', 'Form');

	public $components = array('Paginator');
	
	public function 
	index() {

		$pieces = $this->Piece->find('all');
		
		debug("count(\$pieces) => '".count($pieces)."'");
		
	}//index

	public function
	create_Tokens() {
	
		$this->loadModel('Geschichte');
		
		$geschichtes = $this->Geschichte->find('all');
		
		debug("count(\$geschichtes) => ".count($geschichtes));
		
		$lenOf_Geschichtes = count($geschichtes);
		
		$max_word_num = 800;
		
		$tickOf_Geschichtes = 5;
		
		$index_Start = 31;
		
		for ($i = $index_Start; $i < $index_Start + $tickOf_Geschichtes; $i++) {
// 		for ($i = 31; $i < 40; $i++) {
// 		for ($i = 31; $i < $lenOf_Geschichtes; $i++) {
		
			$text = $geschichtes[$i]['Geschichte']['content'];
			
			debug("\$i = $i : $text");
			debug(" (".mb_strlen($text).")");
			
			# validate
			if (mb_strlen($text) > $max_word_num) {
				
				debug("words more than $max_word_num");
				
				continue;
				
			}
			
			# tokeninze
			$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$text";
			
			$xml = simplexml_load_file($url);
			
			Utils_2::conv_Xml_2_AryOf_Pieces_2($xml, $geschichtes[$i]);
// 			Utils_2::conv_Xml_2_AryOf_Pieces($xml);
			
		}//for ($i = 0; $i < $lenOf_Geschichtes; $i++)
		
		
// 		debug($geschichtes[31]);	//=> 民進東京都連の長島幹事長が辞表　都議らの離党届相次ぎ(4/7)
// 		debug($geschichtes[100]);
		
// 		$tmp_tokens = $this->Token->find('count', array('conditions' => $opt_conditions));
		
		$text = "　【ロサンゼルス＝共同】シャープは９日、北米での液晶テレビ販売を巡り５年間の商標使用許可を与えた中国の電機大手、海信集団（ハイセンス）に対し、低品質の製品を販売して評判をおとしめたなどとして商標の使用差し止めと少なくとも１億ドル（約110億円）の損害賠償を求める訴訟を米カリフォルニア州の裁判所に起こした。　シャープ側の訴えによると、海信は契約に反して品質と値段を下げた製品をシャープブランドで販売するなどした、という。　シャープは2017年４月に手紙で契約打ち切りを通告したが、海信はその後もシャープ名で販売を続けているとしている。";
		
		#ref C:\WORKS_2\WS\Eclipse_Luna\Cake_NR5\app\Lib\utils\utils.php
		$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$text";
		
// 		debug($text);
		
// 		$xml = simplexml_load_file($url);
		
// // 		debug($xml);
// 		debug($xml->word);
// 			// 		object(SimpleXMLElement) {
// 			// 			surface => '　'
// 			// 					feature => '記号,空白,*,*,*,*,　,　,　'
// 			// 		}
// 		debug($xml->word[1]);
// 			// 		object(SimpleXMLElement) {
// 			// 			surface => '【'
// 			// 					feature => '記号,括弧開,*,*,*,*,【,【,【'
// 			// 		}
		
// 		debug("count(\$xml->word) => '".count($xml->word)."'");

// 		debug($xml->word[2]);
// 			// 		object(SimpleXMLElement) {
// 			// 			surface => 'ロサンゼルス'
// 			// 					feature => '名詞,固有名詞,地域,一般,*,*,ロサンゼルス,ロサンゼルス,ロサンゼルス'
// 			// 		}
		
// 		debug($xml->word[4]);
		
		
		
// 		Utils_2::test_Utils_2_Copied();	//=> works.

// 		Utils_2::conv_Xml_2_AryOf_Pieces($xml);
			
	}//create_Tokens
	
	
}