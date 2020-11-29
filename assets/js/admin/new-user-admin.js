/** ENVOYER LE FORMULAIRE - ADD USER **/
async function sendNewUserForm(){
    let alertSection = document.getElementById('alert-message');
    let allInputs = document.getElementsByClassName('new-user-input');
    for(let i = 0; i < allInputs.length; i++){
        if(allInputs[i].value == ""){
            alertSection.classList.add("alert-danger");
            alertSection.style.display = "block";
            if(allInputs[i].placeholder == undefined)
                // alertSection.innerText = "Le type d'utilisateur n'a pas été renseigné(e) !";
                alertSection.innerText = allInputs[i].getAttribute('aglplaceholder')+" n'a pas été renseigné(e) !";
            else
                alertSection.innerText = allInputs[i].placeholder+" n'a pas été renseigné(e) !";
            
            return ;
        }
    } 

    let passwordInput = document.getElementById('password');
    let passwordConfirmInput = document.getElementById('confirmPassword');

    if(passwordInput.value.length < 8){
        alertSection.classList.add("alert-danger");
        alertSection.style.display = "block";
        alertSection.innerText = "Le mot de passe doit contenir au moins 8 caractères !";
        passwordInput.value = "";
        passwordConfirmInput.value = "";

        return ;
    }

    if(passwordInput.value != passwordConfirmInput.value){
        alertSection.classList.add("alert-danger");
        alertSection.style.display = "block";
        alertSection.innerText = " Les mots de passe ne sont pas identiques !";
        passwordConfirmInput.value = "";

        return ;
    }

    // ENVOYER TOUS LES INPUTS 
    let formData = new FormData();           
    formData.append("lastname", lastname.value);
    formData.append("firstname", firstname.value);
    formData.append("usertype", userType.value);
    formData.append("email", email.value);
    formData.append("password", password.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "Added") {
                alertSection.classList.remove("alert-danger");
                alertSection.classList.add("alert-success");
                alertSection.style.display = "block";
                alertSection.innerText = "L'utlisateur a bien été ajouté !";

                document.getElementById('submit-btn').style.display = "none";
                document.getElementById('return-home').style.display = "block";
            } else {
                alertSection.classList.add("alert-danger");
                alertSection.style.display = "block";
                alertSection.innerText = this.responseText;
            }
        }
    };

    request.open("POST", thisAglDomain+"admin/user/add", true);
    request.send(formData);
}


/** ENVOYER LE FORMULAIRE - EDIT POST **/
async function sendEditPostForm(){
    let postID = document.getElementById('post-id-input').value;

    let alertSection = document.getElementById('alert-message');
    let allInputs = document.getElementsByClassName('new-post-input');
    for(let i = 0; i < allInputs.length; i++){
        if(allInputs[i].value == "" && allInputs[i].placeholder != "Image mise en avant"){
            alertSection.classList.add("alert-danger");
            alertSection.style.display = "block";
            alertSection.innerText = allInputs[i].placeholder+" n'a pas été renseigné(e) !";

            return ;
        }
    } 

    // ENVOYER TOUS LES INPUTS 
    let formData = new FormData();           
    formData.append("title", title.value);
    formData.append("extract", extract.value);
    formData.append("content", content.value);
    formData.append("allCats", allCats);
    formData.append("file", img.files[0]);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "Edited") {
                alertSection.classList.remove("alert-danger");
                alertSection.classList.add("alert-success");
                alertSection.style.display = "block";
                alertSection.innerText = "L'article a bien été modifié !";

                document.getElementById('submit-btn').style.display = "none";
                document.getElementById('return-home').style.display = "block";
            } else {
                alertSection.classList.add("alert-danger");
                alertSection.style.display = "block";
                alertSection.innerText = "Une erreur est survenue !";
            }
        }
    };

    request.open("POST", thisAglDomain+"admin/article/editArticle/"+postID, true);
    request.send(formData);
}

/** ENVOYER LE FORMULAIRE - EDIT USER **/
async function sendEditUserForm(){
    let userID = document.getElementById('user-id-input').value;

    let alertSection = document.getElementById('alert-message');
    let allInputs = document.getElementsByClassName('new-user-input');
    for(let i = 0; i < allInputs.length; i++){
        if(allInputs[i].value == ""){
            if(allInputs[i].placeholder == "Mot de passe"){
                break;
            }
            alertSection.classList.add("alert-danger");
            alertSection.style.display = "block";
            if(allInputs[i].placeholder == undefined)
                // alertSection.innerText = "Le type d'utilisateur n'a pas été renseigné(e) !";
                alertSection.innerText = allInputs[i].getAttribute('aglplaceholder')+" n'a pas été renseigné(e) !";
            else
                alertSection.innerText = allInputs[i].placeholder+" n'a pas été renseigné(e) !";
            
            return ;
        }
    } 

    // ENVOYER TOUS LES INPUTS 
    let formData = new FormData();           
    formData.append("lastname", lastname.value);
    formData.append("firstname", firstname.value);
    formData.append("usertype", userType.value);

    let passwordInput = document.getElementById('password');
    let passwordConfirmInput = document.getElementById('confirmPassword');

    if(passwordInput.value.length > 8) {
        formData.append("password", password.value);
    } 
    else if(passwordInput.value.length > 0 && passwordInput.value.length < 8) {
        alertSection.classList.add("alert-danger");
        alertSection.style.display = "block";
        alertSection.innerText = "Le mot de passe doit contenir au moins 8 caractères !";
        passwordInput.value = "";
        passwordConfirmInput.value = "";

        return ;
    } 
    else if(passwordInput.value != passwordConfirmInput.value){
        alertSection.classList.add("alert-danger");
        alertSection.style.display = "block";
        alertSection.innerText = " Les mots de passe ne sont pas identiques !";
        passwordConfirmInput.value = "";

        return ;
    }

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "Edited") {
                alertSection.classList.remove("alert-danger");
                alertSection.classList.add("alert-success");
                alertSection.style.display = "block";
                alertSection.innerText = "L'utlisateur a bien été modifié !";

                document.getElementById('submit-btn').style.display = "none";
                document.getElementById('return-home').style.display = "block";
            } else {
                alertSection.classList.add("alert-danger");
                alertSection.style.display = "block";
                alertSection.innerText = "Une erreur est survenue !";
            }
        }
    };

    request.open("POST", thisAglDomain+"admin/user/editUser/"+userID, true);
    request.send(formData);
}
