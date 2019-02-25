CREATE TABLE images (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	date DATETIME,
	name VARCHAR(32),
	alt VARCHAR(128),
	post_id INT
);

CREATE TABLE posts (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(32),
	url VARCHAR(32),
	content TEXT,
	short varchar(256),
	dt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	categorie INT,
	author INT
);

CREATE TABLE post_tag (
	post_id INT NOT NULL,
	categorie INT NOT NULL
);


CREATE TABLE newsletter (
	email VARCHAR(128) PRIMARY KEY
);

CREATE TABLE tag (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	url VARCHAR(32),
	name VARCHAR(32)
);

CREATE TABLE categories (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(32)
);

CREATE TABLE users (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(128),
	linkedin VARCHAR(560)
);


ALTER TABLE post_tag
ADD FOREIGN KEY (post_id) REFERENCES posts(id);

ALTER TABLE post_tag
ADD FOREIGN KEY (categorie) REFERENCES tag(id);

ALTER TABLE posts
ADD FOREIGN KEY (categorie) REFERENCES categories(id);

ALTER TABLE posts
ADD FOREIGN KEY (author) REFERENCES users(id);


-- posts
INSERT INTO posts (title, url, content, short, categorie, author)
VALUES ('pokemon', 'pokemon', 'cacacacacacacacacacacacaca\r\ncacacacacacacacacacacacaca\r\ncacacacacacacacacacacacaca', 'caca', 1, 2),
('Pokemon Go', 'pokemon-go', 'I PLAY POKEMON GO EVERYDAY', 'I PLAY POKEMON GO', 2, 1);

-- users
INSERT INTO users (username, linkedin) VALUES ('Florian Bouillon', NULL), ('Adrien huchet', 'adrienhuchet');

-- categories
INSERT INTO categories (name) VALUES ('devops'), ('ops'), ('dev'), ('digi');

-- requete 1 :
-- recuperer 10 posts avec la categorie associÃ© la date du post  et les 256 premiers  mots du contenu

SELECT title, short, categorie, url FROM posts
LIMIT 10;

-- requete 2 :
-- recuperer 1 post son titre, Categories, dates, contenu, nom_auteur, photo_auteur, lien linkedin

SELECT post.title as title, post.categorie as categorie, post.date as date, post.content as content, user.username as author, user.linkedin as linkedin
FROM post
INNER JOIN users BY post.author=user.id
LIMIT 1;

-- requette 3 : comme la 1 sauf uniquement les 6 posts les plus récents
-- requete lancée lors sur la page d'accueil
SELECT title, categories.name as categorie, dt as date, short as content
FROM posts
INNER JOIN categories ON categories.id=posts.categorie
ORDER BY date DESC
LIMIT 6;
