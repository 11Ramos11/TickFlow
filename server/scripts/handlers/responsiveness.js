async function responsivenessHandler(){

    const leftSidebar = document.querySelector(".left-sidebar");
    const middleColumn = document.querySelector(".middle-column");
    const rightSidebar = document.querySelector(".right-sidebar");


    const optionsButtonRight = document.querySelector(".options-right");
    const optionsButtonLeft = document.querySelector(".options-left");

    optionsButtonRight.addEventListener("click", () => {
		middleColumn.classList.toggle("middle-column-active");
		rightSidebar.classList.toggle("right-sidebar-active");
        optionsButtonRight.classList.toggle("options-right-active");
    });

    optionsButtonLeft.addEventListener("click", () => {
        leftSidebar.classList.toggle("left-sidebar-active");
        middleColumn.classList.toggle("middle-column-active");
    });

}
