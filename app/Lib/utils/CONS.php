<?php

class CONS {

	/******************************
	
		Paths and names
	
	******************************/
	public static $dname_Utils		= "utils";
	public static $dname_Log			= "log";
	public static $dname_Doc			= "docs";
	// 		const dbName_Local = "development.sqlite3";
	// 		private final $dbName_Local = "development.sqlite3";
	public static $dbName_Local = "development.sqlite3";

	public static $local_HostName = "localhost";

	public static $timeLabelTypes = array(

			"rails" => "railsType",	// "yyyy-MM-dd H:i:s"
			"basic" => "basicType",	// "yyyy/MM/dd H:i:s"
			"serial" => "serialType"	// "yyyyMMdd_His"
	);

	/****************************************
		* csv files
	****************************************/
	public static $logFile_maxLineNum = 3000;

	/****************************************
		* Session keys
	****************************************/

	/**********************************
	* DB
	**********************************/
	public static $genre_code_dflt = "soci";
	
	/**********************************
	* Articles
	**********************************/
	public static $category_Others_Label = "Others";
	
	public static $category_Others_Num = -5;
	
	/**********************************
	* admin
	**********************************/
	public static $admin_Open_Mode = "open_mode";
	
	public static $admin_Colorize = "colorize";
	
	/**********************************
	* Tokens
	**********************************/
	public static $str_Filter_Hins = "filter_hins";
	
	public static $str_Filter_Hins_all = "filter_hins_all";
	
}//class CONS
