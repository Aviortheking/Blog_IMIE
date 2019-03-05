// Fichier des scripts (logiquement que pour les requets AJAX et pour certaines animations) (plusieurs fichiers sont possible bien sur)

var sendImage = (file) => {
	var request = new XMLHttpRequest();
	var form = new FormData();
	form.append("file", file[0]);
	request.open("POST", "../upload/", true);
	eadystatechange = function() {//Call a function when the state changes.
		if(http.readyState == 4 && http.status == 200) {
			alert(http.responseText);
			// window.location = window.location.href.replace("edit/", "");
		}
	}
	console.log("sending");
	request.send(form);
}

// document.querySelector("button").addEventListener("click", processForm);

var addTag = (element) => {
	console.log(this);
	console.log(element.target);
	/** @var HTMLButtonElement btn */
	var btn = element.target;
	var tag = document.createElement("input");
	tag.classList.add("add-tag");
	tag.style.width = "100%";
	var cancelBtn = document.createElement("button");
	cancelBtn.classList.add("cancelBtn");

	cancelBtn.innerText = "Annuler";
	cancelBtn.addEventListener("click", cancel);

	btn.removeEventListener("click", addTag);
	btn.addEventListener("click", addingTag);

	btn.parentElement.insertBefore(tag, btn);
	btn.parentElement.insertBefore(cancelBtn, btn);

	btn.innerText = "Ajouter le tag";

}

var cancel = (element) => {
	var input = element.target.parentElement.querySelector(".add-tag");
	var btn = input.parentElement.querySelector(".addTag");
	btn.removeEventListener("click", addingTag);
	btn.addEventListener("click", addTag);
	btn.innerText = "Add Tag";
	input.parentElement.removeChild(input);
	element.target.parentElement.removeChild(element.target);
}

var addingTag = (element) => {
	var input = document.createElement("input");
	var uuid = Math.floor(Math.random() * Math.floor(-1000000));
	var addtag = element.target.parentElement.querySelector(".add-tag");
	input.setAttribute("type", "checkbox");
	input.setAttribute("id", uuid);
	input.setAttribute("data-text", addTag.value);

	var label = document.createElement("label");
	label.setAttribute("for", uuid);
	label.innerText = addtag.value;

	input.setAttribute("data-text", label.innerText);

	element.target.parentElement.insertBefore(input, element.target);
	element.target.parentElement.insertBefore(label, element.target);

	var cbtn = addtag.parentElement.querySelector(".cancelBtn");
	cbtn.parentElement.removeChild(cbtn);
	addtag.parentElement.removeChild(addtag);

	element.target.removeEventListener("click", addingTag);
	element.target.addEventListener("click", addTag);
}

var submit = () => {

	var major = document.querySelector('.note-editing-area .note-editable');
	var title = document.querySelector("h2.title > input");
	var category = document.querySelector("span.cat > select");
	var tags = document.querySelectorAll("input[type='checkbox']:checked");
	console.log(title.value);
	console.log(category.value);
	console.log(major.innerText);
	console.log(tags);
	var tglst = "";
	tags.forEach(element => {
		tglst += "," + element.getAttribute("data-text");
	});
	tglst = tglst.substr(1);

	var data = new FormData();
	data.append("title", title.value);
	data.append("category", category.value);
	data.append("content", major.innerHTML);
	data.append("tags", tglst);

	var http = new XMLHttpRequest();
	http.open("POST", "./", true);
	http.onreadystatechange = function() {//Call a function when the state changes.
		if(http.readyState == 4 && http.status == 200) {
			document.write(http.responseText);
			// window.location = window.location.href.replace("edit/", "");
		}
	}
	http.send(data);
	// var url = './';
	// var params = "title="+ title.value +"&category=" + category.value + "&content=" + major.innerHTML + "&tags=" + tglst;
	// http.open('POST', url, true);

	// //Send the proper header information along with the request
	// http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

	// console.log(major.innerHTML);


	// http.send(params);


}

if(document.querySelector(".addTag") != null) {
	document.querySelector(".addTag").addEventListener("click", addTag);
	document.querySelector(".submitPost").addEventListener("click", submit);
}

document.querySelector("#search + button").addEventListener("click", function() {
	window.location = window.location.pathname + "?term=" + document.querySelector("#search").value;
});

document.querySelectorAll(".int-search .filtre").forEach(function(el) {
	el.addEventListener("click", function() {
		var tagW = new URL(window.location).searchParams.get("tag");
		var tag = (tagW != null ? "&tag=" + tagW : "");
		var termW = new URL(window.location).searchParams.get("term");
		var term = (termW != null ? "&term=" + termW : "");
		window.location = window.location.pathname + "?category=" + this.getAttribute("data-category") + tag + term;
	})
})


$(document).ready(function() {
	$('.summernote').summernote({
		minHeight: 300,
		// airMode: true,
		callbacks: {
			onImageUpload: function(file) {
				sendImage(file);
				console.log(file);
				let img = document.createElement("img");
				window.location
				img.setAttribute("src", "/uploads/posts/" + window.location.pathname.split("/")[2] + "/" + file[0].name);
				img.setAttribute("style", "width: 100%");
				$('.summernote').summernote('insertNode', img)
			}
		},
		toolbar: [
			['style', ['style']],
			['font', ['bold', 'italic', 'underline', 'clear']],
			['fontname', ['fontname']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']],
			['table', ['table']],
			['insert', ['link', 'picture', 'hr']],
			['view', ['fullscreen', 'codeview']],
			['help', ['help']]
		]
	});
});
