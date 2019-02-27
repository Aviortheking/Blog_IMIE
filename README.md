# project

CHANGELOG.md
idées.md
README.md seront enlever lors de l'upload vers le serveur (pour eviter des dechets en plus)

## Premier lancement

- `composer install\`

- après rajout de classes faire `composer update`

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


### Idées

# Fonctions (par utilisateurs)

## anonyme:
- recherche: (recherche pour trouver les tag/categories/posts)
	- prefixage: (non necessaire (optionnel))
		- "tag:"
		- "categorie:"
	- filtrage par id du post/tag/categorie (maybe)
	- filtrage par nom du post/Tag/categorie

- post
	- affichage tags categories, contenu du post
	- partager le post

- listage des posts (categories/tags/index/(url custom))

- listage des tags (/tags/ ou /tag/)
- listage des categories (/categories/ ou /categorie/)

- abonnement a la newsletter


## user (utilisateur connecté)

-commenter le post

## poster:

- gestions tags/categories:
	- url (nom en minuscule qui seras affiché dans l'url, doit être unique)
	- nom (Nom affiché lors de la requete)
	- parent (ex : categorie1/categorie2)
	- methode de trie (premier post au dernier et vis-versa)
	- description ?(dépend du design du site)
	- ajout/suppression

- gestionnaire des posts/pages:
	- upload video/image (gerable par le gestionnaire de medias)
	- gestion permalink
	- editeur de texte (https://summernote.org/)
	- titre du post
	- mettre en place tags/catgories

- gestionnaire de medias
	- upload
	- modification de tags ("alt")

## moderator:

- gestionnaire des posts/pages:
	- mettre en ligne le post

- gestionnaire des commentaires:
	- suppression

- gestionnaire d'utilisateurs
	- suppresssion
	- interdiction de commenter
	- désabonement/abonement manuel a la newsletter
	- changement de username et autre données sur lui

## admin:

- général:
	- gestion du prefix pour blogs (ex : delta-wings.net/__blog__/el) (sans prefix la page d'accueil est la liste des derniers posts, avec c'est une page)
	- gestion des suffix/prefix pour nom du post (identifiant unique, date du post) (ex : delta-wings.net/blog/__1-__ post-name __-2018-09-22__)
	- gestion nom/slogan du site (afficher sur le site)


- gestionnaire de medias:
	- suppression

- gestionnaire d'utilisateurs:
	- affectaction de roles (user, publisher, admin)

- analytics:
	- toggleable
	- stats indiquant qui est sur le site (ip (ne pas stocker pour anonyme), pays, url, referee (google search ou autre))

- thèmes: (après le tout) (optionnel)
	- avoir la possibilité des changer/creer un thème

# fonctiones automatiques
- generation de sitemap.xml
- generateur de metadata

# Languages utilisées:

- html (pug si l'envie vous la donne)
- css
- javascript
- php
- sql


# Types de pages (pour design) :

- / (page ou post)
- /page/
- /categories/ (et /tags/ peut être)
- /categorie/ (et /tag/ peut être)
- /tags/
- /tag/
- /post/
- /admin/
- /login/


# architecture fichiers

- assets/
	- php/
	- js/
	- css/
	- node_modules/ (maybe)
	- package.json
- uploads/ (fichiers uploaded)
	- 2018/
		- 09/
			- id-nom.png

- .htaccess
- robots.txt
- sitemap.xml
- favicon.ico
- apple-touch-icon-precomposed.png
- apple-touch-icon.png
- manifest.json

# bdd

- images
	- id
	- date
	- nom
	- alt
	- post_id (if linked to a post)

- post
	- id
	- title
	- url
	- content

- post_categories
	- post_id
	- categorie_id

- categorie
	- id
	- url
	- name

- post_tags
	- post_id
	- tag_id

- post_comments
	- post_id
	- user_id
	- comment

- tag
	- id
	- nom
	- parent_id

- settings
	- blog_prefix
	- prefix
	- suffix
	- name
	- slogan

- newsletter
	- id
	- email

- users
	- id
	- role
	- canComment (true, false)
	- username
	- email
	- password (hashed in one way)
