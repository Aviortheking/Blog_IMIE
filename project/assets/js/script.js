// Fichier des scripts (logiquement que pour les requets AJAX et pour certaines animations) (plusieurs fichiers sont possible bien sur)

var processForm = () => {
	var request = new XMLHttpRequest();
	var form = new FormData();
	form.append("photo", document.querySelector("#file").files[0]);
	request.open("POST", "/test/", true);
	request.send(form);
}

document.querySelector("button").addEventListener("click", processForm);