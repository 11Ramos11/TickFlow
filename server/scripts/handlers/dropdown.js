function dropdownHandler(){

    const dropdownContainers = document.getElementsByClassName("edit-container");

    if (dropdownContainers.length == 0){
        return;
    }

    for (const dropdownContainer of dropdownContainers){

        const dropdownButton = dropdownContainer.getElementsByClassName("dropdown-button")[0];

        dropdownButton.addEventListener("click", function() {
            dropdownContainer.getElementsByClassName("edit-dropdown")[0].classList.toggle("active");
        });

        dropdownButton.parentElement.addEventListener("mouseleave", function() {
            dropdownContainer.getElementsByClassName("edit-dropdown")[0].classList.remove("active");
        });
    } 
}