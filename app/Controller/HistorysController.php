<?php

class HistorysController extends AppController {
	public $helpers = array('Html', 'Form');

	public function index() {
		$this->set('historys', $this->History->find('all'));
	}
	
	public function 
	view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid history'));
		}
	
		$history = $this->History->findById($id);
		if (!$history) {
			throw new NotFoundException(__('Invalid history'));
		}
		$this->set('history', $history);
		
		/**********************************
		* mecab
		**********************************/
		$this->_view_Mecab($history);
		
	}//view($id = null)

	public function 
	_view_Mecab($history) {
		
		$sen = $this->sanitize($history['History']['content']);
// 		$sen = $this->sanitize($history['History']['line']);
// 		$sen = $this->History->sanitize($history['History']['line']);
// 		$sen = $history['History']['line'];
		
// 		debug($sen);
		
// 		$sen = mb_convert_encoding($sen, "UTF-8", "SJIS");
		
		$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$sen";
		
// 		$html = file_get_contents($url);
// 		$html = file_get_html($url);
		
// 		debug($html);

		//REF http://stackoverflow.com/questions/9559796/php-simple-html-dom-parser-accessing-custom-attributes answered Mar 4 '12 at 23:44
// 		$dom = new DOMDocument;
// 		$dom->loadXML($html);
		
// 		debug($dom);		// n/w

		//REF http://php.net/manual/en/function.simplexml-load-file.php
// 		$xml = simplexml_load_file($html);	// n/w

		//REF http://stackoverflow.com/questions/12542469/how-to-read-xml-file-from-url-using-php answered Sep 22 '12 at 9:25
// 		$data = simplexml_load_string($html);	// n/w

		//REF http://stackoverflow.com/questions/12542469/how-to-read-xml-file-from-url-using-php answered Sep 22 '12 at 9:17
		$xml = simplexml_load_file($url);
		
// 		debug($xml);

		$words = $xml->word;
		
// 		$tmp = "<head><meta "
// 				."http-equiv=\"Content-Type\" "
// 				."content=\"text/html; charset=utf-8\" />"
// 				."</head>";
		
// 		debug($tmp);	// n/c
		
// 		debug(mb_convert_encoding((string)$words[10]->surface, "UTF-8", "SJIS"));	// n/c
// 		debug(mb_convert_encoding((string)$words[10]->surface, "UTF-8", "EUCJP"));
// 		debug(mb_convert_encoding((string)$words[10]->surface, "UTF-8", "EUCJP"));	// n/c
// 		debug((string)$words[10]->surface);
		
// 		debug($words, true);
// 		debug($words[0]);
// 		debug(get_class($words[0]));
// 		debug($words[10]);
// 		debug($words[10]->surface);
		
// 		//REF http://stackoverflow.com/questions/10233732/getting-an-elements-inner-text-with-simplexmlelement answered Apr 19 '12 at 18:22
// 		//REF (indirect clues) http://stackoverflow.com/questions/1133931/getting-actual-value-from-php-simplexml-node
// 		debug($words[10]);
		debug((string)$words[10]->feature);
// 		debug((string)$words[10]->surface);
		
// 		debug($words[10]->surface->innerNode);
// 		debug(count($words));
		
		$this->set("word", $words[10]->surface);
		
	}//_view_Mecab
	
	public function 
	add() {
		if ($this->request->is('post')) {
			$this->History->create();
			
			$this->request->data['History']['created_at'] = Utils::get_CurrentTime();
			$this->request->data['History']['updated_at'] = Utils::get_CurrentTime();
			
			if ($this->History->save($this->request->data)) {
				$this->Session->setFlash(__('Your historys has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('Unable to add your historys.'));
			
		} else {
			
			$select_Genres = Utils::_get_Selector_Genre();
// 			$select_Genres = $this->_get_Selector_Genre();
			
// 			debug($select_Genres);
			
// 			debug(array_keys($select_Genres));
			
			$this->set('select_Genres', $select_Genres);
			
			if (count($select_Genres) > 1) {
				
				$keys = array_keys($select_Genres);
				
// 				$tmp = $keys[1];
				
				$genre_id = $keys[1];
// 				$genre_id = 0;
// 				$genre_id = array_keys($select_Genres)[1];	// error in remote --> Parse error: syntax error, unexpected '[' 
				
			} else {
				
				$genre_id = 0;
				
			}
			
			
			$select_Categories = 
					Utils::_get_Selector_Category_From_GenreID($genre_id);
			
			$this->set('select_Categories', $select_Categories);
			
			$this->set('genre_id', $genre_id);
			
		}//if ($this->request->is('post'))
			
	}//add

	public function delete($id) {
		/******************************
	
		validate
	
		******************************/
		if (!$id) {
			throw new NotFoundException(__('Invalid history id'));
		}
	
		$history = $this->History->findById($id);
	
		if (!$history) {
			throw new NotFoundException(__("Can't find the history. id = %d", $id));
		}
	
		/******************************
	
		delete
	
		******************************/
		if ($this->History->delete($id)) {
			// 		if ($this->Genre->save($this->request->data)) {
	
			$this->Session->setFlash(__(
					"History deleted => %s",
					$history['History']['line']));
	
			return $this->redirect(
					array(
							'controller' => 'historys',
							'action' => 'index'
	
					));
	
		} else {
	
			$this->Session->setFlash(
					__("History can't be deleted => %s",
							$history['History']['line']));
	
			// 			$page_num = _get_Page_from_Id($id - 1);
	
			return $this->redirect(
					array(
							'controller' => 'historys',
							'action' => 'view',
							$id
					));
	
		}
	
	}//public function delete($id)

	public function
	sanitize
	($str, $tag="font") {
	
		$tag = "font";
		$p = "/<$tag.+?>(.+)<\/$tag>/";
	
		$rep = '${1}';
	
		return preg_replace($p, $rep, $str);
	
	}
	
	
}