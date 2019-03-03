// Fichier des scripts (logiquement que pour les requets AJAX et pour certaines animations) (plusieurs fichiers sont possible bien sur)

var processForm = () => {
	var request = new XMLHttpRequest();
	var form = new FormData();
	form.append("photo", document.querySelector("#file").files[0]);
	request.open("POST", "/test/", true);
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

	var major = document.querySelector('.post.text > textarea');
	var title = document.querySelector("h2.title > input");
	var category = document.querySelector("span.cat > select");
	var tags = document.querySelectorAll("input[type='checkbox']:checked");
	console.log(title.value);
	console.log(category.value);
	console.log(major.value);
	console.log(tags);
	var tglst = "";
	tags.forEach(element => {
		tglst += "," + element.getAttribute("data-text");
	});
	tglst = tglst.substr(1);

	window.location.search = "title="+ title.value +"&category=" + category.value + "&content=" + major.value + "&tags=" + tglst;

	//?title=$title&category=$category&content=$major&

}

if(document.querySelector(".addTag") != null) {
	document.querySelector(".addTag").addEventListener("click", addTag);
	document.querySelector(".submitPost").addEventListener("click", submit);
}
