<?php

namespace App\DB;

class Post {


	private $id;

	private $title;

	private $url;

	private $content;

	private $short;

	private $categorie;

	private $author;

	private $dt;

	/**
	 * list of posts
	 *
	 * @param boolean $recent sort by most recent or not
	 * @param integer $limit limit the number of result
	 *
	 * @return array(Post)
	 */
	public static function list($recent = true, $limit = 100) {
	}

	/**
	 *
	 * get a specific Post
	 *
	 * @param integer $id the id
	 *
	 * @return Post
	 */
	public static function get(int $id) {
	}

	/**
	 * add a post to the db
	 *
	 * @param Post $post
	 *
	 */
	public static function add(Post $post) {
	}

	/**
	 * remove the post
	 *
	 * @param Post $post
	 *
	 */
	public static function remove(Post $post) {}

	/**
	 * update the post data on the db
	 *
	 * @param Post $post
	 *
	 * @return void
	 */
	public static function update(Post $post) {}
}
