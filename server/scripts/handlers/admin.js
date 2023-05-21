function adminHandler(){


    const removeTicketButtons = document.getElementsByClassName("remove-ticket");

    if (removeTicketButtons.length != 0){
        for (const removeButton of removeTicketButtons){
            removeButton.addEventListener("click", function() {
                removeDialog = removeButton.parentElement.parentElement.getElementsByClassName("remove-dialog")[0];
    
                removeDialog.getElementsByClassName("cancel-button")[0].addEventListener("click", function() {
                    removeDialog.close();
                });
                removeDialog.showModal();
            });
        }
    }

    const removeFAQButtons = document.getElementsByClassName("remove-faq");

    if (removeFAQButtons.length != 0){
        for (const removeButton of removeFAQButtons){
            removeButton.addEventListener("click", function() {
                removeDialog = removeButton.parentElement.parentElement.getElementsByClassName("remove-dialog")[0];
             
                removeDialog.getElementsByClassName("cancel-button")[0].addEventListener("click", function() {
                    removeDialog.close();
                });
                removeDialog.showModal();
            });
        }
    }
    
    if (document.getElementById("administration") == null){
        return;
    }

    const categories = document.getElementsByClassName("category");

    for (const category of categories){
        
        const addButton = category.getElementsByClassName("add-button")[0];
        const addDialog = category.getElementsByClassName("add-dialog")[0];
        
        addButton.addEventListener("click", function() {
            addDialog.showModal();
        });

        const cancelButton = addDialog.getElementsByClassName("cancel-button")[0];
        cancelButton.addEventListener("click", function() {
            addDialog.close();
        });
    }

    const adminItems = document.getElementsByClassName("admin-item");

    for (const adminItem of adminItems){
            
        const editButton = adminItem.getElementsByClassName("edit-button")[0];
        const editDialog = adminItem.getElementsByClassName("edit-dialog")[0];
        
        editButton.addEventListener("click", function() {
            editDialog.showModal();
        });
        
        const removeButton = adminItem.getElementsByClassName("remove-button")[0];
        const removeDialog = adminItem.getElementsByClassName("remove-dialog")[0];

        removeButton.addEventListener("click", function() {
            removeDialog.showModal();
        });

        const editCancelButton = editDialog.getElementsByClassName("cancel-button")[0];
        editCancelButton.addEventListener("click", function() {
            editDialog.close();
        }); 

        const removeCancelButton = removeDialog.getElementsByClassName("cancel-button")[0];
        removeCancelButton.addEventListener("click", function() {
            removeDialog.close();
        });

    }
}