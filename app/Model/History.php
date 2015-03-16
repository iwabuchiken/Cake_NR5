<?php

//REF http://www.grafikart.fr/forum/topic/4160 on 13/2/12
App::uses('Sanitize', 'Utility');


class History extends AppModel {

	
	var $name = 'History';
	
	var $belongsTo = 'Category';

	var $hasMany = array(
	
// 			'Token' => array(
	
// 					'className' => 'Token'
// 			),
			
			'SkimmedToken' => array(
	
					'className' => 'SkimmedToken'
			)
	
	);

// 	//REF http://stackoverflow.com/questions/6152416/how-to-limit-the-paginate-in-cakephp answered May 27 '11 at 13:23
// 	public function paginateCount($conditions = null, $recursive = 0, $extra = array())
// 	{
// 		if( isset($extra['totallimit']) ) return $extra['totallimit'];
// 	}
	
}