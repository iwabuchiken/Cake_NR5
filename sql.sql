#pushd C:\WORKS\WS\Eclipse_Kepler\Cake_NR5\app\webroot
#sqlite3 C:\WORKS\WS\Eclipse_Kepler\Cake_NR5\app\webroot\development.sqlite3

pushd C:\WORKS_2\WS\Eclipse_Luna\Cake_NR5
sqlite3 C:\WORKS_2\WS\Eclipse_Luna\Cake_NR5\app\webroot\development.sqlite3
.explain on
.tables

pragma table_info(admin);
pragma table_info(tokens);

pragma table_info(articles);
pragma table_info(categories);
pragma table_info(histories);
/*
#ref https://stackoverflow.com/questions/947215/how-to-get-a-list-of-column-names-on-sqlite3-iphone 'answered Jun 4 '09 at 1:38'
pragma table_info(pieces);

SELECT id,name FROM genres;

.exit
*/
[sqlite3]======================================
DROP TABLE users;

CREATE TABLE users (
	id			INTEGER PRIMARY KEY     AUTOINCREMENT	NOT NULL,
	created_at	VARCHAR(30),
	updated_at	VARCHAR(30),
	
    username VARCHAR(50),
    password VARCHAR(255),
    role VARCHAR(20)
	
);

CREATE TABLE articles(
   id			INTEGER PRIMARY KEY     AUTOINCREMENT	NOT NULL,
   created_at	VARCHAR(30),
   updated_at	VARCHAR(30),
   
   line			TEXT,
   url			TEXT,
   vendor		VARCHAR(30),
   
   news_time	VARCHAR(30),
   
   genre_id		INT,
   cat_id		INT,
   subcat_id	INT,
   
   user_id		INT
   
   
   
);

CREATE TABLE genres (
	id			INTEGER PRIMARY KEY     AUTOINCREMENT	NOT NULL,
	created_at	VARCHAR(30),
	updated_at	VARCHAR(30),
	
	code			VARCHAR(100),
	name			VARCHAR(100)
	
);

DROP TABLE categories;

CREATE TABLE categories (
	id			INTEGER PRIMARY KEY     AUTOINCREMENT	NOT NULL,
	created_at	VARCHAR(30),
	updated_at	VARCHAR(30),
	
	name		VARCHAR(100),
	genre_id	INTEGER,

	original_id	INTEGER
	
);

DROP TABLE keywords;

CREATE TABLE keywords (
	id			INTEGER PRIMARY KEY     AUTOINCREMENT	NOT NULL,
	created_at	VARCHAR(30),
	updated_at	VARCHAR(30),
	
	name		VARCHAR(100),
	category_id	INTEGER
	
);

DROP TABLE histories;

CREATE TABLE histories(
   id			INTEGER PRIMARY KEY     AUTOINCREMENT	NOT NULL,
   created_at	VARCHAR(30),
   updated_at	VARCHAR(30),
   
   line			TEXT,
   url			TEXT,
   vendor		VARCHAR(30),
   
   news_time	VARCHAR(30),
   
   genre_id		INT,
   category_id	INT,
   subcat_id	INT,
   
   content		TEXT,
   
   user_id		INT
   
);

DROP TABLE tokens;

CREATE TABLE tokens(

	id			INTEGER PRIMARY KEY     AUTOINCREMENT	NOT NULL,
	created_at	VARCHAR(30),
	updated_at	VARCHAR(30),
	
	form			VARCHAR(30),
	
	hin			VARCHAR(30),
	hin_1		VARCHAR(30),
	hin_2		VARCHAR(30),
	hin_3		VARCHAR(30),
	
	katsu_kei	VARCHAR(30),
	katsu_kata	VARCHAR(30),
	
	genkei		VARCHAR(30),
	
	yomi			VARCHAR(30),
	hatsu		VARCHAR(30),
	
	history_id	INT,
	
	category_id	INT,
	genre_id	INT,
	
	user_id		INT
   
);

DROP TABLE skimmed_tokens;

CREATE TABLE skimmed_tokens(
   id			INTEGER PRIMARY KEY     AUTOINCREMENT	NOT NULL,
   created_at	VARCHAR(30),
   updated_at	VARCHAR(30),
   
   form			VARCHAR(30),
   
   hin			VARCHAR(30),
   hin_1		VARCHAR(30),
   hin_2		VARCHAR(30),
   hin_3		VARCHAR(30),
   
   katsu_kei	VARCHAR(30),
   katsu_kata	VARCHAR(30),
   
   genkei		VARCHAR(30),
   
   yomi			VARCHAR(30),
   hatsu		VARCHAR(30),
   
   history_id	INT,
   
   user_id		INT
   
);

DROP TABLE admins;

CREATE TABLE admins (
	id			INTEGER PRIMARY KEY     AUTOINCREMENT	NOT NULL,
	created_at	VARCHAR(30),
	updated_at	VARCHAR(30),
	
	name		VARCHAR(30),
	val1		VARCHAR(100),
	val2		VARCHAR(100)
	
);

CREATE TABLE users (
	id			INTEGER PRIMARY KEY     AUTOINCREMENT	NOT NULL,
	created_at	VARCHAR(30),
	updated_at	VARCHAR(30),
	
	username VARCHAR(50),
	password VARCHAR(50),
	role VARCHAR(20)
	
);

DROP TABLE eqs;

CREATE TABLE eqs (
	id			INTEGER PRIMARY KEY     AUTOINCREMENT	NOT NULL,
	created_at	VARCHAR(30),
	updated_at	VARCHAR(30),
	
	time_eq		VARCHAR(30),
	time_pub	VARCHAR(100),
	epi			VARCHAR(30),
	mag			VARCHAR(30),
	ss			INTEGER,

	longi		VARCHAR(30),
	lat			VARCHAR(30),
	depth		VARCHAR(30),
	info		VARCHAR(100),
	
	url_img		VARCHAR(200),
	
	time_eq_serial	VARCHAR(20)
);

CREATE TABLE users (
	id			INTEGER PRIMARY KEY     AUTOINCREMENT	NOT NULL,
	created_at	VARCHAR(30),
	updated_at	VARCHAR(30),
	
	username VARCHAR(50),
	password VARCHAR(50),
	role VARCHAR(20)
	
);

DROP TABLE tokens_new;

CREATE TABLE tokens_new (
   id			INTEGER PRIMARY KEY     AUTOINCREMENT	NOT NULL,
   created_at	VARCHAR(30),
   updated_at	VARCHAR(30),
   
   form			VARCHAR(30),
   
   hin			VARCHAR(30),
   hin_1		VARCHAR(30),
   hin_2		VARCHAR(30),
   hin_3		VARCHAR(30),
   
   katsu_kei	VARCHAR(30),
   katsu_kata	VARCHAR(30),
   
   genkei		VARCHAR(30),
   
   yomi			VARCHAR(30),
   hatsu		VARCHAR(30),
   
   history_id	INT,
   
   category_id	INT,
   genre_id	INT,
   
   user_id		INT
   
);

INSERT INTO tokens_new (

	id,
	created_at,
	updated_at,

	form		,

	hin		,
	hin_1	,
	hin_2	,
	hin_3	,

	katsu_kei,
	katsu_kata,

	genkei	,

	yomi		,
	hatsu	,

	history_id,

	user_id
	)
	SELECT * FROM tokens;

SELECT id,yomi FROM tokens_new WHERE id < 20;

DROP TABLE tokens;
/*
#REF http://stackoverflow.com/questions/426495/how-do-you-rename-a-table-in-sqlite-3-0 Runscope API Tools
#REF consicely explained => http://stackoverflow.com/questions/805363/how-do-i-rename-a-column-in-a-sqlite-database-table answered Apr 30 '09 at 5:57
*/
ALTER TABLE tokens_new RENAME TO tokens;

#REF	http://razorsql.com/features/sqlite_add_column.html
ALTER TABLE histories ADD updates VARCHAR(200);

CREATE TABLE genre_names 
( 
	id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 
	created_at VARCHAR(30), 
	updated_at VARCHAR(30), 
	
	genre_id	INT,
	
	media_name	VARCHAR(30),
	
	genre_name	VARCHAR(30),
	
	memo		VARCHAR(100) 
	
);

#ref https://www.dbonline.jp/sqlite/insert/index1.html
INSERT INTO genre_names (

	created_at, updated_at,
	
	id_master, media_name, genre_name
	
)
VALUES (

	'03/30/2017 15:27:20', '03/30/2017 15:27:20',

	10, 'asahi', 'tech_science' 

);
	
DROP TABLE genre_names;

#ref http://stackoverflow.com/questions/805363/how-do-i-rename-a-column-in-a-sqlite-database-table
ALTER TABLE genre_names_tmp RENAME TO genre_names;
ALTER TABLE genre_names RENAME TO genre_names_tmp;

INSERT INTO genre_names(

	id, created_at, updated_at,  genre_id,  media_name,  genre_name,  memo 

)
SELECT id, created_at, updated_at,  id_master,  media_name,  genre_name,  memo

FROM genre_names_tmp;

DROP TABLE genre_names_tmp;

----------------------------------
CREATE TABLE geschichtes (
 
	id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
	created_at VARCHAR(30),
	updated_at VARCHAR(30),
	
	line TEXT,
	url TEXT,
	vendor VARCHAR(30),
	news_time VARCHAR(30),
	
	genre_id INT,
	category_id INT,
	subcat_id INT,
	
	content TEXT,
	user_id INT
	
)

DROP TABLE geschichtes;

/*
[mysql(lollipop)]======================================
#REF http://sql-info.de/mysql/examples/CREATE-TABLE-examples.html
*/
DROP TABLE users;

CREATE TABLE users (
	id			INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	created_at	VARCHAR(30),
	updated_at	VARCHAR(30),
	
    username VARCHAR(50),
    password VARCHAR(255),
    role VARCHAR(20)
	
);

CREATE TABLE articles(
	id			INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	created_at	VARCHAR(30),
	updated_at	VARCHAR(30),
	
   line			TEXT,
   url			TEXT,
   vendor		VARCHAR(30),
   
   news_time	VARCHAR(30),
   
   genre_id		INT,
   cat_id		INT,
   subcat_id	INT,
   
   user_id		INT
	
);

CREATE TABLE genres (
	id			INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	created_at	VARCHAR(30),
	updated_at	VARCHAR(30),
	
	code			VARCHAR(100),
	name			VARCHAR(100)
	
);

DROP TABLE categories;
TRUNCATE TABLE categories;

CREATE TABLE categories (
	id			INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	created_at	VARCHAR(30),
	updated_at	VARCHAR(30),
	
	name		VARCHAR(100),
	genre_id	INTEGER,
	
	original_id	INTEGER
	
);

CREATE TABLE keywords (
	id			INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	created_at	VARCHAR(30),
	updated_at	VARCHAR(30),
	
	name		VARCHAR(100),
	category_id	INTEGER
	
);

DROP TABLE histories;

CREATE TABLE histories(
   id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   created_at	VARCHAR(30),
   updated_at	VARCHAR(30),
   
   line			TEXT,
   url			TEXT,
   vendor		VARCHAR(30),
   
   news_time	VARCHAR(30),
   
   genre_id		INT,
   category_id	INT,
   subcat_id	INT,
   
   content		TEXT,
   
   user_id		INT
   
);

DROP TABLE tokens;

CREATE TABLE tokens(
   id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   created_at	VARCHAR(30),
   updated_at	VARCHAR(30),
   
   form			VARCHAR(30),
   
   hin		VARCHAR(30),
   hin_1		VARCHAR(30),
   hin_2		VARCHAR(30),
   hin_3		VARCHAR(30),
   
   katsu_kei	VARCHAR(30),
   katsu_kata	VARCHAR(30),
   
   genkei		VARCHAR(30),
   
   yomi			VARCHAR(30),
   hatsu		VARCHAR(30),
   
   history_id	INT,
   
   category_id	INT,
   genre_id	INT,
   
   user_id		INT
   
);

DROP TABLE skimmed_tokens;

CREATE TABLE skimmed_tokens(
   id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   created_at	VARCHAR(30),
   updated_at	VARCHAR(30),
   
   form			VARCHAR(30),
   
   hin		VARCHAR(30),
   hin_1		VARCHAR(30),
   hin_2		VARCHAR(30),
   hin_3		VARCHAR(30),
   
   katsu_kei	VARCHAR(30),
   katsu_kata	VARCHAR(30),
   
   genkei		VARCHAR(30),
   
   yomi			VARCHAR(30),
   hatsu		VARCHAR(30),
   
   history_id	INT,
   
   user_id		INT
   
);

DROP TABLE admin;
DROP TABLE admins;

CREATE TABLE admins (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	created_at	VARCHAR(30),
	updated_at	VARCHAR(30),
	
	name		VARCHAR(30),
	val1		VARCHAR(100),
	val2		VARCHAR(100)
	
);

DROP TABLE eqs;

CREATE TABLE eqs (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	created_at	VARCHAR(30),
	updated_at	VARCHAR(30),
	
	time_eq		VARCHAR(30),
	time_pub	VARCHAR(100),
	epi			VARCHAR(30),
	mag			VARCHAR(30),
	ss			INTEGER,

	longi		VARCHAR(30),
	lat			VARCHAR(30),
	depth		VARCHAR(30),
	info		VARCHAR(100),
	
	url_img		VARCHAR(200),
	time_eq_serial	VARCHAR(20)
	
);

CREATE TABLE users (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	created_at	VARCHAR(30),
	updated_at	VARCHAR(30),
	
	username VARCHAR(50),
	password VARCHAR(50),
	role VARCHAR(20)
	
);

#REF http://www.tech-recipes.com/rx/378/add-a-column-to-an-existing-mysql-table/
ALTER TABLE histories ADD updates VARCHAR(200);

---------------------------------- [mysql] geschichtes
DROP TABLE geschichtes;

CREATE TABLE geschichtes (
 
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
	created_at VARCHAR(30),
	updated_at VARCHAR(30),
	
	line TEXT,
	url TEXT,
	vendor VARCHAR(30),
	news_time VARCHAR(30),
	
	genre_id INT,
	category_id INT,
	subcat_id INT,
	
	content TEXT,
	user_id INT
	
);

DELETE FROM geschichtes;
/*
 * ref https://www.dbonline.jp/mysql/insert/index12.html
 */
TRUNCATE TABLE geschichtes;
/*
 * ref https://stackoverflow.com/questions/8923114/how-to-reset-auto-increment-in-mysql 'answered Jan 19 '12 at 8:39'
 */
ALTER TABLE geschichtes AUTO_INCREMENT = 1;

---------------------------------- [mysql] genre_names
CREATE TABLE genre_names 
( 
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL, 
	
	created_at VARCHAR(30), 
	updated_at VARCHAR(30), 
	
	genre_id	INT,
	
	media_name	VARCHAR(30),
	
	genre_name	VARCHAR(30),
	
	memo		VARCHAR(100) 
	
);

DROP TABLE genre_names;
