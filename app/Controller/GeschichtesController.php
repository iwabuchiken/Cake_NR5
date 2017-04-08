<?php

class GeschichtesController extends AppController {
// class ArticlesController extends AppController {
	public $helpers = array('Html', 'Form', 'Mytest');
// 	public $helpers = array('Html', 'Form');

	public function 
	index() {

		/*******************************
			build: articles
		*******************************/
		$genre_id = $this->test_2_1_1_build_genres_list();
		
// 		$articles = $this->test_1_1_3_build_articles_list();
		$ahrefs_articles = $this->test_1_1_3_build_articles_list();
		
		/******************** (20 '*'s)
		 *
		 * set: articles
		 *
		 ********************/
		$this->set("articles", $ahrefs_articles);
		
// 		debug("articles => set"."(".count($ahrefs_articles)." articles)");
		
		/*******************************
			categorize
		*******************************/
		$articles_categorized = $this->categorize_articles($ahrefs_articles, $genre_id);
		
		$this->set("articles_categorized", $articles_categorized);

		/*******************************
			view: swtich
		*******************************/
		$test = @$this->request->query['test'];
		
		if (isset($test)) {
		
			debug("test view --> used");
			
			$this -> render('index_2');
			
		} else {//if (isset($test))

			debug("test view --> NOT used");

		}
		
		
		
	}//index()

	
}//class GeschichtesController extends AppController

