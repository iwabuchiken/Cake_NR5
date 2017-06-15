
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
	
	geschichte_id	INT,
	
	category_id	INT,
	genre_id	INT
	
);
