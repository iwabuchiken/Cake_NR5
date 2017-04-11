<?php

class AdminsController extends AppController {
	public $helpers = array('Html', 'Form');

	public function index() {
		$this->set('admins', $this->Admin->find('all'));
	}
	
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid admin'));
		}
	
		$admin = $this->Admin->findById($id);
		if (!$admin) {
			throw new NotFoundException(__('Invalid admin'));
		}
		$this->set('admin', $admin);
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Admin->create();
			
			$this->request->data['Admin']['created_at'] = Utils::get_CurrentTime();
			$this->request->data['Admin']['updated_at'] = Utils::get_CurrentTime();
			
			if ($this->Admin->save($this->request->data)) {
				$this->Session->setFlash(__('Your admins has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to add your admins.'));
		}
	}

	public function delete($id) {
		/******************************
	
		validate
	
		******************************/
		if (!$id) {
			throw new NotFoundException(__('Invalid admin id'));
		}
	
		$admin = $this->Admin->findById($id);
	
		if (!$admin) {
			throw new NotFoundException(__("Can't find the admin. id = %d", $id));
		}
	
		/******************************
	
		delete
	
		******************************/
		if ($this->Admin->delete($id)) {
			// 		if ($this->Admin->save($this->request->data)) {
	
			$this->Session->setFlash(__(
					"Admin deleted => %d",
					$admin['Admin']['id']));
	
			return $this->redirect(
					array(
							'controller' => 'admins',
							'action' => 'index'
	
					));
	
		} else {
	
			$this->Session->setFlash(
					__("Admin can't be deleted => %d",
							$admin['Admin']['id']));
	
			// 			$page_num = _get_Page_from_Id($id - 1);
	
			return $this->redirect(
					array(
							'controller' => 'admins',
							'action' => 'view',
							$id
					));
	
		}
	
	}//public function delete($id)

	public function 
	edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid text'));
		}
	
		/****************************************
			* Admin
		****************************************/
		$admin = $this->Admin->findById($id);
		if (!$admin) {
			throw new NotFoundException(__('Invalid admin'));
		}
	
// 		debug($this->request);
// 		debug($this->request->is(array('admin', 'put')));
// 		debug($this->request->is('post'));
	
		// 		if ($this->request->is(array('admin', 'put'))) {
			
		/**********************************
		* save
		**********************************/
		if ($this->request->is(array('post', 'put'))) {
// 		if ($this->request->is('post')) {
			
			$this->Admin->id = $id;
			
			$this->request->data['Admin']['updated_at'] = Utils::get_CurrentTime();
			
			if ($this->Admin->save($this->request->data)) {
		
				$this->Session->setFlash(__('Your admin has been updated.'));
				return $this->redirect(
						array(
								'action' => 'view',
								$id));
		
			}//if ($this->Admin->save($this->request->data))
				
			$this->Session->setFlash(__('Unable to update your admin.'));
			
		}
			
		if (!$this->request->data) {
			$this->request->data = $admin;;
		}
	
	}//edit

	public function stats() {
		
		$this->loadModel('Token');
		$this->loadModel('History');
		
		/**********************************
		* num of histories
		**********************************/
		$historys = $this->History->find('all');
		
		$this->set("numOf_Histories", count($historys));
		
// 		debug(count($historys));

		
		/**********************************
		* num of histories: each vendor
		**********************************/
		$this->_stats__Vendors($historys);
		
// 		$opt_Vendor = array();
		
// 		$opt_Vendor['conditions'] = array('History.vendor' => 'san');
		
// 		$historys_Vendor_san = $this->History->find('all', $opt_Vendor);
		
// 		$this->set("numOf_Histories_Vendor_san", count($historys_Vendor_san));
		
// 		$this->set("numOf_Histories_Vendor_san_Ratio", 
// 								(double)count($historys_Vendor_san) / count($historys));
		
// 		debug(count($historys));

		/**********************************
		* render
		**********************************/
		$this->render("/Admins/stats/stats");
		
	}
	
	public function
	_stats__Vendors($historys) {

// 		$this->loadModel('Token');
// 		$this->loadModel('History');
		
		/**********************************
		* san
		**********************************/
		$opt_Vendor = array();
		
		$opt_Vendor['conditions'] = array('History.vendor' => 'san');
		
		$historys_Vendor_san = $this->History->find('all', $opt_Vendor);
		
		$this->set("numOf_Histories_Vendor_san", count($historys_Vendor_san));
		
		$this->set("numOf_Histories_Vendor_san_Ratio",
				(double)count($historys_Vendor_san) / count($historys));
		
		/**********************************
		* yom
		**********************************/
		$opt_Vendor = array();
		
		$opt_Vendor['conditions'] = array('History.vendor' => 'yom');
		
		$historys_Vendor_yom = $this->History->find('all', $opt_Vendor);
		
		$this->set("numOf_Histories_Vendor_yom", count($historys_Vendor_yom));
		
		$this->set("numOf_Histories_Vendor_yom_Ratio",
				(double)count($historys_Vendor_yom) / count($historys));
		
		/**********************************
		* asahi
		**********************************/
		$opt_Vendor = array();
		
		$opt_Vendor['conditions'] = array('History.vendor' => 'asahi');
		
		$historys_Vendor_asahi = $this->History->find('all', $opt_Vendor);
		
		$this->set("numOf_Histories_Vendor_asahi", count($historys_Vendor_asahi));
		
		$this->set("numOf_Histories_Vendor_asahi_Ratio",
				(double)count($historys_Vendor_asahi) / count($historys));
		
		/**********************************
		* mai
		**********************************/
		$opt_Vendor = array();
		
		$opt_Vendor['conditions'] = array('History.vendor' => 'mai');
		
		$historys_Vendor_mai = $this->History->find('all', $opt_Vendor);
		
		$this->set("numOf_Histories_Vendor_mai", count($historys_Vendor_mai));
		
		$this->set("numOf_Histories_Vendor_mai_Ratio",
				(double)count($historys_Vendor_mai) / count($historys));
		
		/**********************************
		* jij_afp
		**********************************/
		$opt_Vendor = array();
		
		$opt_Vendor['conditions'] = array('History.vendor' => 'jij_afp');
		
		$historys_Vendor_jij_afp = $this->History->find('all', $opt_Vendor);
		
		$this->set("numOf_Histories_Vendor_jij_afp", count($historys_Vendor_jij_afp));
		
		$this->set("numOf_Histories_Vendor_jij_afp_Ratio",
				(double)count($historys_Vendor_jij_afp) / count($historys));
		
		/**********************************
		* cnn
		**********************************/
		$opt_Vendor = array();
		
		$opt_Vendor['conditions'] = array('History.vendor' => 'cnn');
		
		$historys_Vendor_cnn = $this->History->find('all', $opt_Vendor);
		
		$this->set("numOf_Histories_Vendor_cnn", count($historys_Vendor_cnn));
		
		$this->set("numOf_Histories_Vendor_cnn_Ratio",
				(double)count($historys_Vendor_cnn) / count($historys));
		
	}

	public function
	csv() {

		debug($this->response->getMimeType('csv'));
		
	}

	public function
	csv_Tokens_create($name) {
		
		debug("name => $name");
		
		
		/*******************************
			historys
		*******************************/
		if ($name == "historys") {

			$this->csv_Histories_create($name);
			
			return $this->redirect(array('action' => 'csv'));
			
		}
		
		/*******************************
			categorys
		*******************************/
		if ($name == "categorys") {

			$this->csv_Categories_create($name);
			
			return $this->redirect(array('action' => 'csv'));
			
		}
		
		/*******************************
			genres
		*******************************/
		if ($name == "genres") {

			$this->csv_Genres_create($name);
			
			return $this->redirect(array('action' => 'csv'));
			
		}
		
		/*******************************
			tokens
		*******************************/
		$this->loadModel('Token');
		
		$tokens = $this->Token->find('all');
		
// 		debug(count($tokens));
		
// 		debug(array_values($tokens[0]['Token']));
// 		debug($tokens[0]['Token']);
// 		debug($tokens[0]);

		/*******************************
			write file
		*******************************/
// 		REF http://www.tizag.com/phpT/filecreate.php
// 		$file = fopen("webroot/$name.csv", 'w');
		$file = fopen("$name.csv", 'w');
// 		$file = fopen("tokens.csv", 'w');

		$values = array_values($tokens[0]['Token']);
		$keys = array_keys($tokens[0]['Token']);
		
		fputcsv($file, $keys);
		
		for ($i = 0; $i < count($tokens); $i++) {
			
			$values = array_values($tokens[$i]['Token']);
			
			fputcsv($file, $values);
			
		}
		
// 		fputcsv($file, $values);
		
		fclose($file);
		
		//REF http://book.cakephp.org/2.0/en/core-libraries/components/sessions.html "You can use the additional parameters of setFlash() to create different kinds of flash messages"
		$this->Session->setFlash("csv created => $name.csv", 'flash_done');	
// 		$this->Session->setFlash(__("csv created => $name.csv"));	
// 		$this->Session->setFlash(__('csv created'));	
		
		return $this->redirect(array('action' => 'csv'));
		
		
	}//csv_Tokens_create()
	
	public function
	csv_Categories_create($name) {
		
		$this->loadModel('Category');
		
		$categorys = $this->Category->find('all');
		
// 		debug(count($tokens));
		
// 		debug(array_values($tokens[0]['Token']));
// 		debug($tokens[0]['Token']);
// 		debug($tokens[0]);

		/*******************************
			write file
		*******************************/
// 		REF http://www.tizag.com/phpT/filecreate.php
// 		$file = fopen("webroot/$name.csv", 'w');
		$file = fopen("$name.csv", 'w');
// 		$file = fopen("tokens.csv", 'w');

		$values = array_values($categorys[0]['Category']);
		$keys = array_keys($categorys[0]['Category']);
		
		fputcsv($file, $keys);
		
		for ($i = 0; $i < count($categorys); $i++) {
			
			$values = array_values($categorys[$i]['Category']);
			
			fputcsv($file, $values);
			
		}
		
// 		fputcsv($file, $values);
		
		fclose($file);
		
		//REF http://book.cakephp.org/2.0/en/core-libraries/components/sessions.html "You can use the additional parameters of setFlash() to create different kinds of flash messages"
		$this->Session->setFlash("csv created => $name.csv", 'flash_done');	
// 		$this->Session->setFlash(__("csv created => $name.csv"));	
// 		$this->Session->setFlash(__('csv created'));	
		
		return $this->redirect(array('action' => 'csv'));
		
		
	}//csv_Categories_create()
	
	public function
	csv_Genres_create($name) {
		
		$this->loadModel('Genre');
		
		$genres = $this->Genre->find('all');
		
// 		debug(count($tokens));
		
// 		debug(array_values($tokens[0]['Token']));
// 		debug($tokens[0]['Token']);
// 		debug($tokens[0]);

		/*******************************
			write file
		*******************************/
// 		REF http://www.tizag.com/phpT/filecreate.php
// 		$file = fopen("webroot/$name.csv", 'w');
		$file = fopen("$name.csv", 'w');
// 		$file = fopen("tokens.csv", 'w');

		$values = array_values($genres[0]['Genre']);
		$keys = array_keys($genres[0]['Genre']);
		
		fputcsv($file, $keys);
		
		for ($i = 0; $i < count($genres); $i++) {
			
			$values = array_values($genres[$i]['Genre']);
			
			fputcsv($file, $values);
			
		}
		
// 		fputcsv($file, $values);
		
		fclose($file);
		
		//REF http://book.cakephp.org/2.0/en/core-libraries/components/sessions.html "You can use the additional parameters of setFlash() to create different kinds of flash messages"
		$this->Session->setFlash("csv created => $name.csv", 'flash_done');	
// 		$this->Session->setFlash(__("csv created => $name.csv"));	
// 		$this->Session->setFlash(__('csv created'));	
		
		return $this->redirect(array('action' => 'csv'));
		
		
	}//csv_Genres_create()
	
	public function
	csv_Histories_create($name) {
		
		$this->loadModel('History');
		
		$historys = $this->History->find('all');
		
// 		debug(count($tokens));
		
// 		debug(array_values($tokens[0]['Token']));
// 		debug($tokens[0]['Token']);
// 		debug($tokens[0]);

		/*******************************
			write file
		*******************************/
// 		REF http://www.tizag.com/phpT/filecreate.php
// 		$file = fopen("webroot/$name.csv", 'w');
		$file = fopen("$name.csv", 'w');
// 		$file = fopen("tokens.csv", 'w');

		$values = array_values($historys[0]['History']);
		$keys = array_keys($historys[0]['History']);
		
		fputcsv($file, $keys);
		
		for ($i = 0; $i < count($historys); $i++) {
			
			$values = array_values($historys[$i]['History']);
			
			fputcsv($file, $values);
			
		}
		
// 		fputcsv($file, $values);
		
		fclose($file);
		
		//REF http://book.cakephp.org/2.0/en/core-libraries/components/sessions.html "You can use the additional parameters of setFlash() to create different kinds of flash messages"
		$this->Session->setFlash("csv created => $name.csv", 'flash_done');	
// 		$this->Session->setFlash(__("csv created => $name.csv"));	
// 		$this->Session->setFlash(__('csv created'));	
		
		return $this->redirect(array('action' => 'csv'));
		
		
	}//csv_Histories_create()
	
	
	/*******************************
		download csv files
	*******************************/
	public function
// 	csv_Categories_dl($name) {
	csv_Tokens_dl($name) {

		//REF http://stackoverflow.com/questions/14760630/downloading-a-docx-file-in-cakephp answered Feb 7 '13 at 21:20
		$this->autoRender = false;	//=> n/c
		
		//REF http://stackoverflow.com/questions/15887953/cakephp-file-download-link answered Apr 8 '13 at 20:56
		$path = "$name.csv";
// 		$path = "categorys.csv";

		$this->response->file($path, 
				array(
					'download' => true,
					'name' => "$name.csv",
		));
		
		$this->Session->setFlash("dowloading csv... => $name.csv", 'flash_done');
		
		return $this->response;
		
	}//csv_Categories_dl($name)

	public function stats2() {
	
		/*******************************
			geschichtes
		*******************************/
		$this->loadModel('Geschichte');
		
		$options = 				array(
				
				"conditions"	=> array(
				
						
// 						'Geschichte.category_id >='	=> 49
						'Geschichte.genre_id >='	=> 10
				)
		
				,
		
				'order'		=> array(
		
						'Geschichte.id'	=> "asc"
				)
		
		);
		
// 		debug($options);
		
		/*******************************
		 geschichtes
		 *******************************/
		$geschichtes = $this->Geschichte->find('all', $options);
		
// 		debug("count(\$geschichtes) =>");
// 		debug(count($geschichtes));

// 		debug("\$geschichtes[0] =>");
// 		debug($geschichtes[0]);
		
		/**************************************************************
			count --> categories
		**************************************************************/
		/*******************************
			get: minimum category id
		*******************************/
		$id_min = 49;	//=> 'Computer'
// 		$id_min = 99999;
		
// 		foreach ($geschichtes as $g) {
		
// 			$cat_id = $g['Geschichte']['category_id'];
			
// 			// judge
// 			if ($cat_id < $id_min && $cat_id > 0) {
			
// 				$id_min = $cat_id;
				
// 			}//if ($cat_id < $id_min)
// 			;
			
// 		}//foreach ($geschichtes as $g)
		
// 		debug("min cat id => $id_min");
		
		/*******************************
			count
		*******************************/
		// num of categories
		$this->loadModel('Category');
		
		$options_2 = 				array(
		
				"conditions"	=> array(
		
		
				// 						'Geschichte.category_id >='	=> 49
						'Category.id >='	=> 49
				)
		
				,
		
				'order'		=> array(
		
						'Category.id'	=> "asc"
				)
		
		);
		
// 		debug($options_2);
		
		$categories = $this->Category->find('all', $options_2);
		
// 		debug("count(\$categories) =>");
// 		debug(count($categories));

		/*******************************
			histogram
		*******************************/
		// init: "+1" --> for 'others' category
// 		debug("\$categories[count(\$categories)-1]['Category']['id'] =>");
// 		debug($categories[count($categories)-1]['Category']['id']);
		
		$lastid_categories = $categories[count($categories)-1]['Category']['id'];
		
// 		debug("last id => $lastid_categories");
		
		//ref http://php.net/manual/ja/function.array-fill.php
		$aryof_histogram = array_fill(
// 		$aryof_histogram = array(

// 				$id_min, count($categories), 0

				-1,
				$lastid_categories + 1,
// 				$categories[count($categories)-1]['Category']['id'] + 1,
				0
				
		);
		
// 		array_unshift($aryof_histogram, -1);
		
// 		/*******************************
// 			subtract ---> index 0 up to 48
// 		*******************************/
// 		$ary_tmp = array_slice($aryof_histogram, 0, ($id_min));
// // 		$ary_tmp = array_slice($aryof_histogram, 0, ($id_min - 1));
		
// 		debug($aryof_histogram);

		$lenof_aryof_histogram = count($aryof_histogram);
		
		for ($i = 0; $i < $id_min; $i++) {
// 		for ($i = 0; $i <= $id_min; $i++) {
		
			unset($aryof_histogram[$i]);
			
		}//for ($i = 0; $i < $lenof_aryof_histogram; $i++)
		
// 		debug("\$aryof_histogram");
// 		debug($aryof_histogram);
		
		
// 		$ary_tmp = array_fill(0, $id_min, 0);
		
// 		debug("\$ary_tmp");
// 		debug($ary_tmp);
		
		
// 		$ary_tmp_2 = array_diff($aryof_histogram, $ary_tmp);
		
// 		debug("\$ary_tmp");
// 		debug($ary_tmp);
		
// 		$aryof_histogram = array_diff($aryof_histogram, $ary_tmp);
		
// 		debug($aryof_histogram);
		
// 		$aryof_histogram = array($categories[count($categories)-1]['Category']['id'] + 1);
// 		$aryof_histogram = array($categories[count($categories)-1]['id'] + 1);
// 		$aryof_histogram = array(end($categories)['id'] + 1);
// 		$aryof_histogram = array(count($categories) + 1);
// 		$aryof_histogram = array();

// 		debug("count(\$aryof_histogram) =>");
// 		debug(count($aryof_histogram));
		
		// init array
		foreach ($aryof_histogram as $a) {
		
			$a = 0;
			
		}//foreach ($aryof_histogram as $a)
		
		// count up
		foreach ($geschichtes as $g) {
		
			$cat_id = $g['Geschichte']['category_id'];
		
			// count up
			$aryof_histogram[$cat_id] += 1;
			
		}//foreach ($geschichtes as $g)

// 		debug("\$aryof_histogram");
// 		debug($aryof_histogram);

		/*******************************
			build: list
		*******************************/
		$aryof_category_stats = array();
		
		for ($i = 0; $i < $lenof_aryof_histogram; $i++) {
		
			if (isset($aryof_histogram[$i])) {
			
				$cat = Utils::get_Category_From_Id($i);

				//debug
				if (!isset($cat['Category'])) {

// 					debug("\$cat['Category'] => not set: $i");
					
					continue;
				
				}//if ($cat[])
				
				array_push(
						$aryof_category_stats, 
						
						array(
								$i, 
								$cat['Category']['name'], 
								$cat['Genre']['name'], 
								$aryof_histogram[$i])
// 						array($i, $cat['Category']['name'], $aryof_histogram[$i])
				);
				
			}//if (isset($aryof_histogram[$i]))
			;;
			
		}//for ($i = 0; $i < $lenof_aryof_histogram; $i++)
		
// 		debug("\$aryof_category_stats");
// 		debug($aryof_category_stats);

		/*******************************
			sort
		*******************************/
		@usort($aryof_category_stats, array(&$this, 'cmp_category_stats__freq'));
		
		/*******************************
			set: page vars
		*******************************/
		$this->set("aryof_category_stats", $aryof_category_stats);
		
		// sum of frequency
		$sum = 0;
		
		foreach ($aryof_category_stats as $ary) {
		
			$sum += $ary[3];
			
		}//foreach ($aryof_category_stats as $ary)
		
		$this->set("sumof_freqs", $sum);
		
		
// 		/**********************************
// 			* render
// 			**********************************/
// // 		$this->render("/Admins/stats/stats");
	
	}//public function stats2()

	public function
	cmp_category_stats__freq($a1, $a2) {
		
// 		if ($a1[] != $a2[]) {
				
// 			// 			debug($a1);
// 			// 			debug($a2);
				
// 			// 			return 1;
// 			// 			return -1;
// 			return strcasecmp($a2['news_time'], $a1['news_time']);;
// 			// 			return 0;
				
// 		}
		
// 		$a1_new = $a1['vendor'];
// 		$a2_new = $a2['vendor'];
		
		return ($a1[3] < $a2[3]);	// Z -> A
// 		return ($a1[3] > $a2[3]);
		
	}//cmp_category_stats__freq
	
}