<?php
if(isset($_GET["image"]) && !empty($_GET["image"])) $_POST["image"] = $_GET["image"];

$id = 1; //post id

$uploadFolder = "../../uploads/posts/$id/";

if(!file_exists($uploadFolder)) {
	mkdir($uploadFolder, 0660, true);
}

if(isset($_FILES["photo"]) && !empty($_FILES["photo"])) {
	var_dump($_FILES["photo"]);
	move_uploaded_file($_FILES["photo"]["tmp_name"], $uploadFolder.$_FILES["photo"]["name"]);
	// require_once "functions.php";
	// file_put_contents($uploadFolder."/pouet.jpg", base64_decode($_POST["image"]));
	// base64_to_jpeg($_POST["image"], $uploadFolder."/pouet.jpg");
	// file_put_content($uploadFolder."/pouet.jpg", base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $_POST["image"])));
}




echo '<input id="file" type="file" multiple/><button>Send !</button>';

echo '
<script defer>
var processForm = () => {
	var request = new XMLHttpRequest();
	var form = new FormData();
	form.append("photo", document.querySelector("#file").files[0]);
	request.open("POST", "/test/", true);
	request.send(form);
}

document.querySelector("button").addEventListener("click", processForm);
</script>
';
