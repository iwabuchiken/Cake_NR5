<?php

class CONS {

	/**********************************
	* commons
	**********************************/
	public static $proj_Name = "Cake_NR5";
	
	public static $numOf_Modulus = 40;
	
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
	
	public static $str_Filter_Hins_1 = "filter_hins_1";
	public static $str_Filter_Hins_1_all = "filter_hins_1_all";
	
	public static $str_Filter_Hist_Id = "filter_hist_id";
	public static $str_Filter_Hist_Id_all = "filter_hist_id_all";
	
}//class CONS
