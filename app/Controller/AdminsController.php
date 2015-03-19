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
	csv_Tokens_dl($name) {
// 	csv_Tokens_dl() {

		//REF http://stackoverflow.com/questions/14760630/downloading-a-docx-file-in-cakephp answered Feb 7 '13 at 21:20
		$this->autoRender = false;	//=> n/c
		
// 		debug($name);
		
		//REF http://stackoverflow.com/questions/15887953/cakephp-file-download-link answered Apr 8 '13 at 20:56
		$path = "tokens.csv";
// 		$path = "webroot/tokens.csv";
// 		$path = "index.php";
// 		$path = "index.php";
		
		//REF download() http://andy-carter.com/blog/downloading-files-as-request-responses-in-cakephp-23
// 		$this->response->download($path);	//=> n/c

		//REF http://book.cakephp.org/2.0/en/controllers/request-response.html#sending-files
// 		$this->response->file($path);	//=> n/c

// 		debug($this->response->getMimeType('csv'));
		
		$this->response->file($path, 
				array(
					'download' => true,
					'name' => "$name.csv",
// 				'name' => 'the name of the file as it should appear on the client\'s computer',
		));
		
// 		//REF http://book.cakephp.org/2.0/en/controllers/request-response.html#dealing-with-content-types
// 		$this->response->type('csv');	//=> n/c
// 		$this->response->type('text/csv');	//=> 
		
		
		$this->Session->setFlash("dowloading csv... => $name.csv", 'flash_done');
		
		return $this->response;
		
		//REF http://www.tizag.com/phpT/filecreate.php
// 		$file = fopen("temp.txt", 'w');
		
// 		fclose($file);
		
		//REF http://andy-carter.com/blog/exporting-data-to-a-downloadable-csv-file-with-cakephp
// 		$this->response->download("index.php");
// 		$this->response->download("app/index.php");
// 		$this->response->download("memos.txt");
// 		$this->response->download("export.csv");
		
		
	}
	
}