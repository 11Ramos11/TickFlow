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
    var error = document.getElementById("error");
	const container = document.getElementById('container');
  
   if (error == null){
        return;
    }
    error.classList.toggle("show");
    // After 3 seconds, remove the show class from DIV
	container.classList.add("right-panel-active");
    setTimeout(function(){ error.classList.toggle("show"); }, 4000);
  }
  