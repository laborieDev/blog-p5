function sendCommentForm(){
    let commentForm = document.getElementById("comment-form");
    let nameInput = document.getElementById("name");
    let messageInput = document.getElementById("message");
    let alertMessage = document.getElementById("alert-message");

    let allInputs = commentForm.getElementsByClassName("form-input");
    for(let i = 0; i < allInputs.length; i++){
        if(allInputs[i].value == ""){
            alertMessage.style.display = "block";
            alertMessage.classList.add("alert-danger");
            alertMessage.innerText = allInputs[i].placeholder+" n'est pas renseigné !";
            return ;
        }
    }

    //APPEL AJAX POUR SAUVEGARDER LE COMMENTAIRE 
    //A FAIRE


    alertMessage.style.display = "block";
    alertMessage.classList.remove("alert-danger");
    alertMessage.classList.add("alert-success");
    alertMessage.innerText = "Merci pour votre commentaire !";
}