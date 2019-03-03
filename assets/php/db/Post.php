<?php

namespace App\DB;

use App\Functions;
use DateTime;
use PDO;

class Post {


	private $id;

	private $title;

	private $content;

	private $category;

	private $author;

	private $tags;

	private $dt;

	public function setId($id) {
		$this->id = $id;
	}


	public function setTitle($title) {
		$this->title = $title;
	}

	public function setContent($content) {
		$this->content = $content;
	}

	public function setCategory($category) {
		$this->category = $category;
	}

	public function setAuthor($author) {
		$this->author = $author;
	}

	public function setDateTime($dt) {
		$this->dt = $dt;
	}

	public function setTags($taglist) {
		$this->tags = $taglist;
	}





	public function getId() {
		return $this->id;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getContent() {
		return $this->content;
	}

	public function getCategory() {
		if($this->category != null) return Category::get($this->category);
		else return null;
	}

	public function getAuthor() {
		return Author::get($this->author);
	}

	public function getDateTime() {
		return $this->dt;
	}

	/**
	 *
	 * @return \App\DB\Tag[]
	 */
	public function getTags() {
		$temp = array();
		if ($this->tags == null) return $temp;
		/** @var int $tag */
		foreach ($this->tags as $tag) {
			// var_dump($tag);
			// die;
			$temp[] = Tag::get($tag);
		}
		// die;
		return array_unique($temp, SORT_REGULAR);
	}
















	public function __construct() {
		$this->dt = new \DateTime();
	}

	public static function fromArray($array) {
		$post = new Post();
		$post->setId($array["id"]);
		$post->setTitle($array["title"]);
		$post->setContent($array["content"]);
		if(isset($array["category"])) $post->setCategory($array["category"]);
		$post->setAuthor($array["author"]);
		$post->setDateTime($array["dt"]);
		return $post;
	}

	/**
	 * list of posts
	 *
	 * @param boolean $recent sort by most recent or not
	 * @param integer $limit limit the number of result
	 *
	 * @return Post[]
	 */

	public static function list($recent = true, $limit = 100) {
		$sort = $recent ? "DESC" : "ASC";
		$query = "SELECT * FROM posts ORDER BY dt " . $sort . " LIMIT " . $limit;

		$pdo = Functions::connect();
		$posts = $pdo->query($query)->fetchAll();

		$res = array();

		foreach ($posts as $post) {
			$post = Post::fromArray($post);
			$query = "SELECT * FROM post_tag WHERE post_id=". $post->getId();
			$tagList = array();
			$bool = $pdo->query($query);
			// var_dump($bool->fetchAll());
			if($bool) foreach ($pdo->query($query)->fetchAll() as $tag) {
				$tagList[] = $tag["tag"];
			}
			$post->setTags($tagList);

			$res[] = $post;
		}

		return $res;
	}

	public static function listByCategory($categoryId = null, $recent = true, $limit = 100) {
		$sort = $recent ? "DESC" : "ASC";
		$cat = $categoryId !== null ? "WHERE category=" . $categoryId : "";
		$query = "SELECT * FROM posts " . $cat . " ORDER BY dt " . $sort . " LIMIT " . $limit;

		$pdo = Functions::connect();
		$posts = $pdo->query($query)->fetchAll();

		$res = array();

		foreach ($posts as $post) {
			$post = Post::fromArray($post);
			$query = "SELECT * FROM post_tag WHERE post_id=". $post->getId();
			$tagList = array();
			$bool = $pdo->query($query);
			// var_dump($bool->fetchAll());
			if($bool) foreach ($pdo->query($query)->fetchAll() as $tag) {
				$tagList[] = $tag["tag"];
			}
			$post->setTags($tagList);

			$res[] = $post;
		}

		return $res;
	}



	/**
	 *
	 * get a specific Post
	 *
	 * @param integer $id the id
	 *
	 * @return Post
	 */
		public static function get($id) {
			$post = Post::fromArray(Functions::connect()->query("SELECT * FROM posts WHERE id=" . $id)->fetch());
			$query = "SELECT * FROM post_tag WHERE post_id=". $post->getId();
			$pdo = Functions::connect();
			$bool = $pdo->query($query);

			$tagList = array();
			if($bool) {
				foreach ($bool->fetchAll() as $tag) {
					$tagList[] = $tag["tag"];
				}
				if(count($tagList) >= 1) $post->setTags($tagList);
			}

			return $post;
	}

	/**
	 * add a post to the db
	 *
	 * @param Post $post
	 *
	 */
	public static function add(Post $post) {
		$query = "INSERT INTO posts (id, title, content, category, author, dt)
		VALUES (NULL, :title, :content, :category, :author, :dt);";

		$title = $post->getTitle();
		$content = $post->getContent();
		$category = $post->getCategory()->getId();
		$author = $post->getAuthor()->getId();
		$dt = (new DateTime())->format("d/m/Y h:i:s");


		$pdo = Functions::connect();
		$prepared = $pdo->prepare($query);
		$prepared->bindValue(":title", $title);
		$prepared->bindValue(":content", $content);
		$prepared->bindValue(":category", $category, PDO::PARAM_INT);
		$prepared->bindValue(":author", $author, PDO::PARAM_INT);
		$prepared->bindValue(":dt", $dt);

		$prepared->execute();

		$p = Post::list(true, 1)[0]->getId();

		$tags = $post->getTags();
		var_dump($tags);
		if(count($tags) >= 1) {
			$q = "INSERT INTO post_tag (post_id, tag) VALUES ( :post , :tag )";
			$prepared = $pdo->prepare($q);
			$prepared->bindValue(":post", $p);
			foreach ($tags as $tg) {
				$id = $tg->getId();
				$prepared->bindValue(":tag", $id);

				$prepared->execute();
			}
		}
		// var_dump($prepared->errorInfo());

	}



	/**
	 * remove the post
	 *
	 * @param Post $post
	 *
	 *
	 */
	public static function remove(Post $post) {
		Functions::connect()->prepare("DELETE FROM posts WHERE id=:id")->execute(array(":id" => $post->getId()));

	}




	/**
	 * update the post data on the db
	 *
	 * @param Post $post
	 *
	 */
	public static function update(Post $post) {

		$title = $post->getTitle();
		$content = $post->getContent();
		$category = $post->getCategory()->getId();
		$author = $post->getAuthor()->getId();
		$dt = $post->getDateTime();
		$id = $post->getid();

		$pdo = Functions::connect();


		$prepared = $pdo->prepare("UPDATE posts SET title=:title, content=:content, category=:category, author=:author, dt=:dt WHERE id=:id");
		$prepared->bindValue(":title", $title);
		$prepared->bindValue(":content", $content);
		$prepared->bindValue(":category", $category, PDO::PARAM_INT);
		$prepared->bindValue(":author", $author, PDO::PARAM_INT);
		$prepared->bindValue(":dt", $dt);
		$prepared->bindValue(":id", $id);
		$prepared->execute();

		$tags = $post->getTags();
		if(count($tags) >= 1) {
			$pdo->exec("DELETE FROM post_tag WHERE post_id=" . $id);
			$q = "INSERT INTO post_tag (post_id, tag) VALUES ( :post , :tag )";
			$prepared = $pdo->prepare($q);
			$prepared->bindValue(":post", $id);
			foreach ($tags as $tg) {
				$id = $tg->getId();
				$prepared->bindValue(":tag", $id);

				$prepared->execute();
			}
		}
	}

}
