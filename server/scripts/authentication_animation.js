window.onload = function() {
	authenticationSwitch();
	showError();
}

function authenticationSwitch() {
	const signUpButton = document.getElementById('signUp');
	const signInButton = document.getElementById('signIn');
	const container = document.getElementById('container');

	signUpButton.addEventListener('click', () => {
		container.classList.add("right-panel-active");
	});

	signInButton.addEventListener('click', () => {

		container.classList.remove("right-panel-active");
	});
}

function showError() {
    // Get the snackbar DIV
    const error = document.getElementById("error");
	const container = document.getElementById('container');
  
   if (error == null){
        return;
    }
    error.classList.toggle("show");
    
    setTimeout(function(){ error.classList.toggle("show"); }, 4000);

	if (error.dataset.code == "Register"){
		container.classList.add("right-panel-active");
	}
  }
  