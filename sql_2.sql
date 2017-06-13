#pushd C:\WORKS\WS\Eclipse_Kepler\Cake_NR5\app\webroot
#sqlite3 C:\WORKS\WS\Eclipse_Kepler\Cake_NR5\app\webroot\development.sqlite3

#sqlite3 C:\WORKS\WS\Eclipse_Luna\Cake_NR5\app\webroot\development.sqlite3
#.explain on
#.tables

sqlite3 C:\WORKS_2\WS\Eclipse_Luna\Cake_NR5\app\webroot\development.sqlite3
.explain on
.tables

pragma table_info(admin);
pragma table_info(tokens);

pragma table_info(articles);
pragma table_info(categories);
pragma table_info(histories);

SELECT id,name FROM genres;

.exit

[sqlite3]======================================
TABLE genre_names

INSERT INTO genre_names (

	created_at, updated_at,
	
	id_master, media_name, genre_name
	
)
VALUES (

	'03/30/2017 15:27:20', '03/30/2017 15:27:20',

	10, 'asahi', 'tech_science' 

);
	
INSERT INTO genre_names (

	created_at, updated_at,
	
	id_master, media_name, genre_name
	
)
VALUES (

	'03/30/2017 15:27:20', '03/30/2017 15:27:20',

	11, 'asahi', 'tech_science' 

);
	
------------------------------------------------ pieces
DROP TABLE pieces;

CREATE TABLE pieces(

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
	
	geschichte_id	INT,
	
	category_id	INT,
	genre_id	INT
	
);
