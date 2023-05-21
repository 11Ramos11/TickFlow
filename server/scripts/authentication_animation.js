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
  
    const snackbar = document.getElementsByClassName("snack-bar")[0];
	const container = document.getElementById('container');
  
   if (snackbar == null){
        return;
    }
    snackbar.classList.toggle("show");
    
    setTimeout(function(){ snackbar.classList.toggle("show"); }, 4000);

	if (snackbar.dataset.code == "Register"){
		container.classList.add("right-panel-active");
	}
  }
  