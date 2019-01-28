# project

CHANGELOG.md
idées.md
README.md seront enlever lors de l'upload vers le serveur (pour eviter des dechets en plus)

# Architecture

## /uploads
Dossiers ou se trouverons les uploads

trié par année puis mois (ex : /uploads/2018/10/pouet.png)

## /assets
dossiers des assets du logiciel

### /assets/js
contient les fichiers javascript utilisée

### /assets/css
contient les fichiers CSS utilisées

### /assets/php
contient les fichiers php utilisées


## .htaccess
gere la redirection des requetes et gere le cache de certains fichiers


### requettes SQL

#### Categories
```
CREATE TABLE categories (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(32)
);

INSERT INTO `categories` (`id`, `Name`) VALUES (NULL, 'Digi');
INSERT INTO `categories` (`id`, `Name`) VALUES (NULL, 'Ops');
INSERT INTO `categories` (`id`, `Name`) VALUES (NULL, 'Dev')
INSERT INTO `categories` (`id`, `Name`) VALUES (NULL, 'Devops')
```
#### Authors
```
CREATE TABLE user (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(128),
	linkedin VARCHAR(560)
);

INSERT INTO `users` (`id`, `username`, `linkedin`) VALUES (NULL, 'aviortheking', 'url') 
```
#### Posts
```
CREATE TABLE posts (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(32),
	url VARCHAR(32),
	content TEXT,
	categorie INT,
	author INT
);

ALTER TABLE posts
ADD FOREIGN KEY (categorie) REFERENCES categories(id)

ALTER TABLE posts
ADD FOREIGN KEY (author) REFERENCES users(id)
```

```
INSERT INTO `posts` (`id`, `title`, `url`, `content`, `categorie`, `author`) VALUES
(1, 'Pokemon', 'pokemon', '\r\n\r\nId officiis nisi voluptate aperiam laboriosam. Porro doloribus repellat qui consectetur nam quo. Quam qui et omnis numquam. Mollitia consectetur quam dolor veniam voluptates exercitationem.\r\n\r\nRerum doloribus at fugiat ea. Maxime natus nulla consequatur ratione. Ducimus eius officia sit. Maiores sint sint ut et facere enim.\r\n\r\nVoluptatem nesciunt ut quod. Ab dignissimos harum ipsam velit perspiciatis reiciendis voluptatum incidunt. Excepturi natus dignissimos enim. Unde architecto maiores aut cumque dolores. Et mollitia accusamus rem et dolorem omnis quis beatae.\r\n\r\nIure eveniet consequatur aperiam. Quibusdam quo iusto nemo voluptatem vel id sunt. Ut et ducimus nobis cum ullam. Quia est voluptatem ducimus aut quo non aut. Distinctio architecto excepturi debitis.\r\n\r\nFacilis voluptatem est aspernatur facere aut voluptatem. Ipsa et omnis soluta iusto et natus. Temporibus rerum cumque ipsa porro amet omnis possimus ipsam. Eaque temporibus ipsam possimus est inventore aut exercitationem. Nemo adipisci aut aut velit rerum blanditiis.\r\n', NULL, NULL),
(2, 'Pokemon', 'pokemon', '\r\n\r\nId officiis nisi voluptate aperiam laboriosam. Porro doloribus repellat qui consectetur nam quo. Quam qui et omnis numquam. Mollitia consectetur quam dolor veniam voluptates exercitationem.\r\n\r\nRerum doloribus at fugiat ea. Maxime natus nulla consequatur ratione. Ducimus eius officia sit. Maiores sint sint ut et facere enim.\r\n\r\nVoluptatem nesciunt ut quod. Ab dignissimos harum ipsam velit perspiciatis reiciendis voluptatum incidunt. Excepturi natus dignissimos enim. Unde architecto maiores aut cumque dolores. Et mollitia accusamus rem et dolorem omnis quis beatae.\r\n\r\nIure eveniet consequatur aperiam. Quibusdam quo iusto nemo voluptatem vel id sunt. Ut et ducimus nobis cum ullam. Quia est voluptatem ducimus aut quo non aut. Distinctio architecto excepturi debitis.\r\n\r\nFacilis voluptatem est aspernatur facere aut voluptatem. Ipsa et omnis soluta iusto et natus. Temporibus rerum cumque ipsa porro amet omnis possimus ipsam. Eaque temporibus ipsam possimus est inventore aut exercitationem. Nemo adipisci aut aut velit rerum blanditiis.\r\n', NULL, NULL),
(3, 'Pokemon', 'pokemon', '\r\n\r\nId officiis nisi voluptate aperiam laboriosam. Porro doloribus repellat qui consectetur nam quo. Quam qui et omnis numquam. Mollitia consectetur quam dolor veniam voluptates exercitationem.\r\n\r\nRerum doloribus at fugiat ea. Maxime natus nulla consequatur ratione. Ducimus eius officia sit. Maiores sint sint ut et facere enim.\r\n\r\nVoluptatem nesciunt ut quod. Ab dignissimos harum ipsam velit perspiciatis reiciendis voluptatum incidunt. Excepturi natus dignissimos enim. Unde architecto maiores aut cumque dolores. Et mollitia accusamus rem et dolorem omnis quis beatae.\r\n\r\nIure eveniet consequatur aperiam. Quibusdam quo iusto nemo voluptatem vel id sunt. Ut et ducimus nobis cum ullam. Quia est voluptatem ducimus aut quo non aut. Distinctio architecto excepturi debitis.\r\n\r\nFacilis voluptatem est aspernatur facere aut voluptatem. Ipsa et omnis soluta iusto et natus. Temporibus rerum cumque ipsa porro amet omnis possimus ipsam. Eaque temporibus ipsam possimus est inventore aut exercitationem. Nemo adipisci aut aut velit rerum blanditiis.\r\n', NULL, NULL),
(4, 'Pokemon', 'pokemon', '\r\n\r\nId officiis nisi voluptate aperiam laboriosam. Porro doloribus repellat qui consectetur nam quo. Quam qui et omnis numquam. Mollitia consectetur quam dolor veniam voluptates exercitationem.\r\n\r\nRerum doloribus at fugiat ea. Maxime natus nulla consequatur ratione. Ducimus eius officia sit. Maiores sint sint ut et facere enim.\r\n\r\nVoluptatem nesciunt ut quod. Ab dignissimos harum ipsam velit perspiciatis reiciendis voluptatum incidunt. Excepturi natus dignissimos enim. Unde architecto maiores aut cumque dolores. Et mollitia accusamus rem et dolorem omnis quis beatae.\r\n\r\nIure eveniet consequatur aperiam. Quibusdam quo iusto nemo voluptatem vel id sunt. Ut et ducimus nobis cum ullam. Quia est voluptatem ducimus aut quo non aut. Distinctio architecto excepturi debitis.\r\n\r\nFacilis voluptatem est aspernatur facere aut voluptatem. Ipsa et omnis soluta iusto et natus. Temporibus rerum cumque ipsa porro amet omnis possimus ipsam. Eaque temporibus ipsam possimus est inventore aut exercitationem. Nemo adipisci aut aut velit rerum blanditiis.\r\n', NULL, NULL),
(5, 'Pokemon', 'pokemon', '\r\n\r\nId officiis nisi voluptate aperiam laboriosam. Porro doloribus repellat qui consectetur nam quo. Quam qui et omnis numquam. Mollitia consectetur quam dolor veniam voluptates exercitationem.\r\n\r\nRerum doloribus at fugiat ea. Maxime natus nulla consequatur ratione. Ducimus eius officia sit. Maiores sint sint ut et facere enim.\r\n\r\nVoluptatem nesciunt ut quod. Ab dignissimos harum ipsam velit perspiciatis reiciendis voluptatum incidunt. Excepturi natus dignissimos enim. Unde architecto maiores aut cumque dolores. Et mollitia accusamus rem et dolorem omnis quis beatae.\r\n\r\nIure eveniet consequatur aperiam. Quibusdam quo iusto nemo voluptatem vel id sunt. Ut et ducimus nobis cum ullam. Quia est voluptatem ducimus aut quo non aut. Distinctio architecto excepturi debitis.\r\n\r\nFacilis voluptatem est aspernatur facere aut voluptatem. Ipsa et omnis soluta iusto et natus. Temporibus rerum cumque ipsa porro amet omnis possimus ipsam. Eaque temporibus ipsam possimus est inventore aut exercitationem. Nemo adipisci aut aut velit rerum blanditiis.\r\n', NULL, NULL),
(6, 'Pokemon', 'pokemon', '\r\n\r\nId officiis nisi voluptate aperiam laboriosam. Porro doloribus repellat qui consectetur nam quo. Quam qui et omnis numquam. Mollitia consectetur quam dolor veniam voluptates exercitationem.\r\n\r\nRerum doloribus at fugiat ea. Maxime natus nulla consequatur ratione. Ducimus eius officia sit. Maiores sint sint ut et facere enim.\r\n\r\nVoluptatem nesciunt ut quod. Ab dignissimos harum ipsam velit perspiciatis reiciendis voluptatum incidunt. Excepturi natus dignissimos enim. Unde architecto maiores aut cumque dolores. Et mollitia accusamus rem et dolorem omnis quis beatae.\r\n\r\nIure eveniet consequatur aperiam. Quibusdam quo iusto nemo voluptatem vel id sunt. Ut et ducimus nobis cum ullam. Quia est voluptatem ducimus aut quo non aut. Distinctio architecto excepturi debitis.\r\n\r\nFacilis voluptatem est aspernatur facere aut voluptatem. Ipsa et omnis soluta iusto et natus. Temporibus rerum cumque ipsa porro amet omnis possimus ipsam. Eaque temporibus ipsam possimus est inventore aut exercitationem. Nemo adipisci aut aut velit rerum blanditiis.\r\n', NULL, NULL),
(7, 'Pokemon', 'pokemon', '\r\n\r\nId officiis nisi voluptate aperiam laboriosam. Porro doloribus repellat qui consectetur nam quo. Quam qui et omnis numquam. Mollitia consectetur quam dolor veniam voluptates exercitationem.\r\n\r\nRerum doloribus at fugiat ea. Maxime natus nulla consequatur ratione. Ducimus eius officia sit. Maiores sint sint ut et facere enim.\r\n\r\nVoluptatem nesciunt ut quod. Ab dignissimos harum ipsam velit perspiciatis reiciendis voluptatum incidunt. Excepturi natus dignissimos enim. Unde architecto maiores aut cumque dolores. Et mollitia accusamus rem et dolorem omnis quis beatae.\r\n\r\nIure eveniet consequatur aperiam. Quibusdam quo iusto nemo voluptatem vel id sunt. Ut et ducimus nobis cum ullam. Quia est voluptatem ducimus aut quo non aut. Distinctio architecto excepturi debitis.\r\n\r\nFacilis voluptatem est aspernatur facere aut voluptatem. Ipsa et omnis soluta iusto et natus. Temporibus rerum cumque ipsa porro amet omnis possimus ipsam. Eaque temporibus ipsam possimus est inventore aut exercitationem. Nemo adipisci aut aut velit rerum blanditiis.\r\n', NULL, NULL),
(8, 'Pokemon', 'pokemon', '\r\n\r\nId officiis nisi voluptate aperiam laboriosam. Porro doloribus repellat qui consectetur nam quo. Quam qui et omnis numquam. Mollitia consectetur quam dolor veniam voluptates exercitationem.\r\n\r\nRerum doloribus at fugiat ea. Maxime natus nulla consequatur ratione. Ducimus eius officia sit. Maiores sint sint ut et facere enim.\r\n\r\nVoluptatem nesciunt ut quod. Ab dignissimos harum ipsam velit perspiciatis reiciendis voluptatum incidunt. Excepturi natus dignissimos enim. Unde architecto maiores aut cumque dolores. Et mollitia accusamus rem et dolorem omnis quis beatae.\r\n\r\nIure eveniet consequatur aperiam. Quibusdam quo iusto nemo voluptatem vel id sunt. Ut et ducimus nobis cum ullam. Quia est voluptatem ducimus aut quo non aut. Distinctio architecto excepturi debitis.\r\n\r\nFacilis voluptatem est aspernatur facere aut voluptatem. Ipsa et omnis soluta iusto et natus. Temporibus rerum cumque ipsa porro amet omnis possimus ipsam. Eaque temporibus ipsam possimus est inventore aut exercitationem. Nemo adipisci aut aut velit rerum blanditiis.\r\n', NULL, NULL),
(9, 'Pokemon', 'pokemon', '\r\n\r\nId officiis nisi voluptate aperiam laboriosam. Porro doloribus repellat qui consectetur nam quo. Quam qui et omnis numquam. Mollitia consectetur quam dolor veniam voluptates exercitationem.\r\n\r\nRerum doloribus at fugiat ea. Maxime natus nulla consequatur ratione. Ducimus eius officia sit. Maiores sint sint ut et facere enim.\r\n\r\nVoluptatem nesciunt ut quod. Ab dignissimos harum ipsam velit perspiciatis reiciendis voluptatum incidunt. Excepturi natus dignissimos enim. Unde architecto maiores aut cumque dolores. Et mollitia accusamus rem et dolorem omnis quis beatae.\r\n\r\nIure eveniet consequatur aperiam. Quibusdam quo iusto nemo voluptatem vel id sunt. Ut et ducimus nobis cum ullam. Quia est voluptatem ducimus aut quo non aut. Distinctio architecto excepturi debitis.\r\n\r\nFacilis voluptatem est aspernatur facere aut voluptatem. Ipsa et omnis soluta iusto et natus. Temporibus rerum cumque ipsa porro amet omnis possimus ipsam. Eaque temporibus ipsam possimus est inventore aut exercitationem. Nemo adipisci aut aut velit rerum blanditiis.\r\n', NULL, NULL),
(10, 'Pokemon', 'pokemon', '\r\n\r\nId officiis nisi voluptate aperiam laboriosam. Porro doloribus repellat qui consectetur nam quo. Quam qui et omnis numquam. Mollitia consectetur quam dolor veniam voluptates exercitationem.\r\n\r\nRerum doloribus at fugiat ea. Maxime natus nulla consequatur ratione. Ducimus eius officia sit. Maiores sint sint ut et facere enim.\r\n\r\nVoluptatem nesciunt ut quod. Ab dignissimos harum ipsam velit perspiciatis reiciendis voluptatum incidunt. Excepturi natus dignissimos enim. Unde architecto maiores aut cumque dolores. Et mollitia accusamus rem et dolorem omnis quis beatae.\r\n\r\nIure eveniet consequatur aperiam. Quibusdam quo iusto nemo voluptatem vel id sunt. Ut et ducimus nobis cum ullam. Quia est voluptatem ducimus aut quo non aut. Distinctio architecto excepturi debitis.\r\n\r\nFacilis voluptatem est aspernatur facere aut voluptatem. Ipsa et omnis soluta iusto et natus. Temporibus rerum cumque ipsa porro amet omnis possimus ipsam. Eaque temporibus ipsam possimus est inventore aut exercitationem. Nemo adipisci aut aut velit rerum blanditiis.\r\n', NULL, NULL),
(11, 'Pokemon', 'pokemon', '\r\n\r\nId officiis nisi voluptate aperiam laboriosam. Porro doloribus repellat qui consectetur nam quo. Quam qui et omnis numquam. Mollitia consectetur quam dolor veniam voluptates exercitationem.\r\n\r\nRerum doloribus at fugiat ea. Maxime natus nulla consequatur ratione. Ducimus eius officia sit. Maiores sint sint ut et facere enim.\r\n\r\nVoluptatem nesciunt ut quod. Ab dignissimos harum ipsam velit perspiciatis reiciendis voluptatum incidunt. Excepturi natus dignissimos enim. Unde architecto maiores aut cumque dolores. Et mollitia accusamus rem et dolorem omnis quis beatae.\r\n\r\nIure eveniet consequatur aperiam. Quibusdam quo iusto nemo voluptatem vel id sunt. Ut et ducimus nobis cum ullam. Quia est voluptatem ducimus aut quo non aut. Distinctio architecto excepturi debitis.\r\n\r\nFacilis voluptatem est aspernatur facere aut voluptatem. Ipsa et omnis soluta iusto et natus. Temporibus rerum cumque ipsa porro amet omnis possimus ipsam. Eaque temporibus ipsam possimus est inventore aut exercitationem. Nemo adipisci aut aut velit rerum blanditiis.\r\n', NULL, NULL),
(12, 'Pokemon', 'pokemon', '\r\n\r\nId officiis nisi voluptate aperiam laboriosam. Porro doloribus repellat qui consectetur nam quo. Quam qui et omnis numquam. Mollitia consectetur quam dolor veniam voluptates exercitationem.\r\n\r\nRerum doloribus at fugiat ea. Maxime natus nulla consequatur ratione. Ducimus eius officia sit. Maiores sint sint ut et facere enim.\r\n\r\nVoluptatem nesciunt ut quod. Ab dignissimos harum ipsam velit perspiciatis reiciendis voluptatum incidunt. Excepturi natus dignissimos enim. Unde architecto maiores aut cumque dolores. Et mollitia accusamus rem et dolorem omnis quis beatae.\r\n\r\nIure eveniet consequatur aperiam. Quibusdam quo iusto nemo voluptatem vel id sunt. Ut et ducimus nobis cum ullam. Quia est voluptatem ducimus aut quo non aut. Distinctio architecto excepturi debitis.\r\n\r\nFacilis voluptatem est aspernatur facere aut voluptatem. Ipsa et omnis soluta iusto et natus. Temporibus rerum cumque ipsa porro amet omnis possimus ipsam. Eaque temporibus ipsam possimus est inventore aut exercitationem. Nemo adipisci aut aut velit rerum blanditiis.\r\n', NULL, NULL),
(13, 'Pokemon', 'pokemon', '\r\n\r\nId officiis nisi voluptate aperiam laboriosam. Porro doloribus repellat qui consectetur nam quo. Quam qui et omnis numquam. Mollitia consectetur quam dolor veniam voluptates exercitationem.\r\n\r\nRerum doloribus at fugiat ea. Maxime natus nulla consequatur ratione. Ducimus eius officia sit. Maiores sint sint ut et facere enim.\r\n\r\nVoluptatem nesciunt ut quod. Ab dignissimos harum ipsam velit perspiciatis reiciendis voluptatum incidunt. Excepturi natus dignissimos enim. Unde architecto maiores aut cumque dolores. Et mollitia accusamus rem et dolorem omnis quis beatae.\r\n\r\nIure eveniet consequatur aperiam. Quibusdam quo iusto nemo voluptatem vel id sunt. Ut et ducimus nobis cum ullam. Quia est voluptatem ducimus aut quo non aut. Distinctio architecto excepturi debitis.\r\n\r\nFacilis voluptatem est aspernatur facere aut voluptatem. Ipsa et omnis soluta iusto et natus. Temporibus rerum cumque ipsa porro amet omnis possimus ipsam. Eaque temporibus ipsam possimus est inventore aut exercitationem. Nemo adipisci aut aut velit rerum blanditiis.\r\n', NULL, NULL),
(14, 'Pokemon', 'pokemon', '\r\n\r\nId officiis nisi voluptate aperiam laboriosam. Porro doloribus repellat qui consectetur nam quo. Quam qui et omnis numquam. Mollitia consectetur quam dolor veniam voluptates exercitationem.\r\n\r\nRerum doloribus at fugiat ea. Maxime natus nulla consequatur ratione. Ducimus eius officia sit. Maiores sint sint ut et facere enim.\r\n\r\nVoluptatem nesciunt ut quod. Ab dignissimos harum ipsam velit perspiciatis reiciendis voluptatum incidunt. Excepturi natus dignissimos enim. Unde architecto maiores aut cumque dolores. Et mollitia accusamus rem et dolorem omnis quis beatae.\r\n\r\nIure eveniet consequatur aperiam. Quibusdam quo iusto nemo voluptatem vel id sunt. Ut et ducimus nobis cum ullam. Quia est voluptatem ducimus aut quo non aut. Distinctio architecto excepturi debitis.\r\n\r\nFacilis voluptatem est aspernatur facere aut voluptatem. Ipsa et omnis soluta iusto et natus. Temporibus rerum cumque ipsa porro amet omnis possimus ipsam. Eaque temporibus ipsam possimus est inventore aut exercitationem. Nemo adipisci aut aut velit rerum blanditiis.\r\n', NULL, NULL),
(15, 'Pokemon', 'pokemon', '\r\n\r\nId officiis nisi voluptate aperiam laboriosam. Porro doloribus repellat qui consectetur nam quo. Quam qui et omnis numquam. Mollitia consectetur quam dolor veniam voluptates exercitationem.\r\n\r\nRerum doloribus at fugiat ea. Maxime natus nulla consequatur ratione. Ducimus eius officia sit. Maiores sint sint ut et facere enim.\r\n\r\nVoluptatem nesciunt ut quod. Ab dignissimos harum ipsam velit perspiciatis reiciendis voluptatum incidunt. Excepturi natus dignissimos enim. Unde architecto maiores aut cumque dolores. Et mollitia accusamus rem et dolorem omnis quis beatae.\r\n\r\nIure eveniet consequatur aperiam. Quibusdam quo iusto nemo voluptatem vel id sunt. Ut et ducimus nobis cum ullam. Quia est voluptatem ducimus aut quo non aut. Distinctio architecto excepturi debitis.\r\n\r\nFacilis voluptatem est aspernatur facere aut voluptatem. Ipsa et omnis soluta iusto et natus. Temporibus rerum cumque ipsa porro amet omnis possimus ipsam. Eaque temporibus ipsam possimus est inventore aut exercitationem. Nemo adipisci aut aut velit rerum blanditiis.\r\n', NULL, NULL);

```
#### tags
```
CREATE TABLE tag (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	url VARCHAR(32),
	name VARCHAR(32)
);

CREATE TABLE post_tag (
	post_id INT NOT NULL,
	categorie INT NOT NULL
);

ALTER TABLE post_tag
ADD FOREIGN KEY (post_id) REFERENCES posts(post_id);

ALTER TABLE post_tag
ADD FOREIGN KEY (categorie) REFERENCES tag(categorie);
```