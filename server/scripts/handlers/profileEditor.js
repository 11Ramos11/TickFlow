function profileEditor(){

    const profileInfo = document.getElementById("profile-info");

    if (profileInfo != null){

        const editButton = document.getElementById("edit-user-button");
        const editProfile = document.getElementById("edit-profile");
        const cancelButton = document.getElementById("cancel-button");

        function toggleProfile(){
            profileInfo.classList.toggle("active");
            editProfile.classList.toggle("active");
        }

        editButton.addEventListener("click", function() {

            const nameInfo = document.getElementById("name-info");
            const emailInfo = document.getElementById("email-info");
            const roleInfo = document.getElementById("role-info");
            const departmentInfo = document.getElementById("department-info");

            const nameEditor = document.getElementById("name-editor");
            nameEditor.value = nameInfo.textContent;

            const emailEditor = document.getElementById("email-editor");
            emailEditor.value = emailInfo.textContent;

            const roleSelector = document.getElementById("role-editor");
            if (roleSelector != null){
                const roleOption = document.getElementById(roleInfo.textContent);
                roleOption.setAttribute("selected",  "selected")
            }

            const departmentEditor = document.getElementById("department-editor");
            if (departmentEditor != null){
                const departmentOption = document.getElementById(departmentInfo.textContent);
                departmentOption.setAttribute("selected",  "selected")

            }

            toggleProfile();
        });

        cancelButton.addEventListener("click", function() {
            toggleProfile();
            disablePasswordField();
        });

        const passwordEditor = document.getElementById("password-editor");
        const showPassword = document.getElementById("change-password-button");

        if (showPassword != null){
            showPassword.addEventListener("click", function() {
                togglePasswordField();
            });
        }

        const cancelPassword = document.getElementById("cancel-password-button");

        if (cancelPassword != null){
            cancelPassword.addEventListener("click", function() {
                togglePasswordField();
            });
        }

        function disablePasswordField(){
            passwordEditor.classList.remove("active");
            if (!showPassword.classList.contains("active"))
                showPassword.classList.add("active");
        }

        function togglePasswordField(){
            passwordEditor.classList.toggle("active");
            showPassword.classList.toggle("active");
        }

    }
}