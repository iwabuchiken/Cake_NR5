INSERT INTO pieces_new (

	id,
	created_at,
	updated_at,
	
	form,
	
	hin,
	hin_1,
	hin_2,
	hin_3,
	
	katsu_kei,
	katsu_kata,
	
	genkei,
	
	yomi,
	hatsu,
	
	geschichte_id,
	
	category_id,
	genre_id

	) SELECT * FROM pieces;
