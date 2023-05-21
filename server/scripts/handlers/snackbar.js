function snackbarHandler() {
    // Get the snackbar DIV
   const snackbar = document.getElementsByClassName("snack-bar")[0];
  
   if (snackbar == null){
        return;
    }

    snackbar.classList.toggle("show");
    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ snackbar.classList.toggle("show"); }, 4000);
}