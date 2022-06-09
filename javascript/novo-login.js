const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});

function showPreview(event){
	if(event.target.files.length > 0){
	  var src = URL.createObjectURL(event.target.files[0]);
	  var preview = document.getElementById("file-ip-1-preview");
	  preview.src = src;
	  preview.style.display = "block";
	}
  }