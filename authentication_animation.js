const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

if (document.getElementById('register-error') != null) {
	container.classList.add("right-panel-active");
}

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	
	container.classList.remove("right-panel-active");
});

