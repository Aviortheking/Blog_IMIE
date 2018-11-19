<?php
/**
 * <tag type="pokemon" arg="pokemongo"><div class="pokemon-item"></div></tag>
 */
class tag {

	private $DOM = "<div>Please, edit it !</div>";
	private $attr = array();
	
	public function __construct(array $attributes = array(), String $DOMContent= "") {
		$this->attr = array_merge($this->attr, $attributes);
		$this->DOM = $DOMContent;
	}

	private function process() {
		return $this->DOM;
	}

	public function render() {
		return $this->process();
	}
}





class loop extends tag {
	private function process() {
		return "<div>pokemon</div>";
	}
}
$tag = new tag();
$loop = new loop();
echo $tag->render();
echo $loop->render();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Page Title</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<tag type="tag"></tag>
	<tag type="loop"></tag>
</body>
</html>