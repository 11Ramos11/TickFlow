function faqChatHandler(){

    const faqButton  = document.getElementById("faq-button");

    if (faqButton == null){
        return;
    }

    const faqDialog = document.getElementById("faq-dialog");

    faqButton.addEventListener("click", function() {
        faqDialog.showModal();
    });

    faqDialog.addEventListener("click", function(event) {
        if (event.target == faqDialog) {
            faqDialog.close();
        }
    });

    const useFAQButtons = document.getElementsByClassName("use-faq");

    for (const useFAQButton of useFAQButtons){

        useFAQButton.addEventListener("click", function() {
            const messageBox = document.getElementById("message-input");
            const message = useFAQButton.dataset.answer;
            messageBox.value = message;
            faqDialog.close();
        });
    }
}