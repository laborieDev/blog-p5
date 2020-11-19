function sendCommentForm(){
    let url = window.location.href;
    let urlIndex = url.indexOf('article/');
    let postID = parseInt(url.substring(urlIndex+8));

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
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == 200) {
                alertMessage.style.display = "block";
                alertMessage.classList.remove("alert-danger");
                alertMessage.classList.add("alert-success");
                alertMessage.innerText = "Merci pour votre commentaire !";
            } else {
                alertMessage.style.display = "block";
                alertMessage.classList.add("alert-danger");
                alertMessage.innerText = "Désolé... Une erreur s'est produite !";
            }
        }
    };
    request.open("GET", thisAglDomain+"/ajax/new-comment/"+postID+"/"+nameInput.value+"/"+messageInput.value);
    request.send();
}
