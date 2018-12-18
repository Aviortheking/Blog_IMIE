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
	url VARCHAR(32),
	name VARCHAR(32)
);

CREATE TABLE user (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(128),
	linkedin VARCHAR(560)
);


ALTER TABLE post_tag
ADD FOREIGN KEY (post_id) REFERENCES posts(post_id);

ALTER TABLE post_tag
ADD FOREIGN KEY (categorie) REFERENCES tag(categorie);

ALTER TABLE posts
ADD FOREIGN KEY (categorie) REFERENCES categories(id)

ALTER TABLE posts
ADD FOREIGN KEY (author) REFERENCES users(id)