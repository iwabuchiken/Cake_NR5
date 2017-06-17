/*
pushd C:\WORKS_2\WS\Eclipse_Luna\Cake_NR5
sqlite3 app\webroot\development.sqlite3
.explain on
.tables

.read sqls/20170615_110159.create_table_pieces-new.sql
.read sqls/20170615_111504.insert_into_table_pieces-new_from_pieces.sql
.read sqls/20170615_112300.drop-table_pieces.sql
.read sqls/20170615_112421.alter-table_rename-to-pieces.sql

 * 
 */
CREATE TABLE pieces_new (

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
	
	type		VARCHAR(30),
	
	intext_id	INT,
	
	geschichte_id	INT,
	
	category_id	INT,
	genre_id	INT
	
);
