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
	cancelBtn.addEventListener("click", function(element) {
		var input = element.target.parentElement.querySelector(".add-tag");
		input.parentElement.querySelector(".addTag").innerText = "Add Tag";
		input.parentElement.removeChild(input);
		element.target.parentElement.removeChild(element.target);
	});

	btn.removeEventListener("click", addTag);
	btn.addEventListener("click", addingTag);

	btn.parentElement.insertBefore(tag, btn);
	btn.parentElement.insertBefore(cancelBtn, btn);

	btn.innerText = "Ajouter le tag";

}

var addingTag = (element) => {
	var input = document.createElement("input");
	var uuid = Math.floor(Math.random() * Math.floor(10000));
	input.setAttribute("type", "checkbox");
	input.setAttribute("id", uuid);

	var label = document.createElement("label");
	label.setAttribute("for", uuid);
	var addtag = element.target.parentElement.querySelector(".add-tag");
	label.innerText = addtag.value;

	element.target.parentElement.insertBefore(input, element.target);
	element.target.parentElement.insertBefore(label, element.target);

	var cbtn = addtag.parentElement.querySelector(".cancelBtn");
	cbtn.parentElement.removeChild(cbtn);
	addtag.parentElement.removeChild(addtag);

	element.target.removeEventListener("click", addingTag);
	element.target.addEventListener("click", addTag);
}

document.querySelector(".addTag").addEventListener("click", addTag);
