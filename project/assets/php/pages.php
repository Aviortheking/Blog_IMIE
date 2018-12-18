<?php

/**
 * classe Pages
 * a constructor to load additionnal pages and initialize the whole class and load the pages
 */

/**
 * Class Pages
 * 
 * attributes
 * pageList : Array
 * 
 * functions
 * 
 * __construct($pages = array())
 * # load the pages list from db and static files (index/search)
 * loadPage($url)
 * # return a class of type Page (see below)
 */

/**
 * class Page
 * contain the Page to load (on init only a light version but when using loadPage the whole page is in the class)
 * here it contains three extended classes (Index/Search/Post where we will add functions to the loadPage)
 */

/**
 * abstract Class Page
 * 
 * attributes
 * id
 * title
 * regex
 * content
 * isLoaded: boolean
 * 
 * functions:
 * abstract __construct()
 * absract loadPage()
 * 
 */

/**
 * class Post
 * contains a post
 * with basics informations at first and when loadPost is launche the whole class will be usable
 */

/**
 * class Post
 * 
 * attributes
 * id
 * authorName
 * authorLinkedin
 * content
 * isloaded: false
 * 
 * __construct(id);
 * 
 * loadPost()
 * 
 */

abstract class Pages {
	private $pageList = array();

	public function __construct($pages = array()) {
		$pouet = array();
		$pages = array_merge($pouet, $pages);
	}

}

abstract class Page {
	private $id;
	private $title;
	private $regex;
	private $content;
	private $isLoaded = false;

	abstract function loadPage();
}

interface Page {
	public function __construct();
	public function loadPage();
	public function getId();
	public function getTitle();
	public function getRegex();
}



class Post {
	private $id;
	private $authorName;
	private $authorLinkedin;
	private $content;
	private $isLoaded = false;

	public function __construct($id) {
		$this->id = $id;
	}

	public function loadPost() {

	}

}


class Posts implements Page {
	public function __construct() {}
	
}


