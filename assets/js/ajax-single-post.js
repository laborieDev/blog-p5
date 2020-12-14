function sendCommentForm(button){
    let url = window.location.href;
    let urlIndex = url.indexOf("article/");
    let postID = parseInt(url.substring(urlIndex+8), 10);

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
        if (this.readyState === 4 ) {
            if (this.status === 200) {
                alertMessage.style.display = "block";
                alertMessage.classList.remove("alert-danger");
                alertMessage.classList.add("alert-success");
                alertMessage.innerText = "Merci pour votre commentaire !";
                button.style.display = "none";
            } else {
                alertMessage.style.display = "block";
                alertMessage.classList.add("alert-danger");
                alertMessage.innerText = "Désolé... Une erreur s'est produite !";
            }
        }
    };
    let thisAglDomain = new WebSite().getDomain();
    request.open("POST", thisAglDomain+"ajax/new-comment/");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("postID="+postID+"&authorName="+nameInput.value+"&message="+messageInput.value);
}

function seeMoreComments(minID){
    let url = window.location.href;
    let urlIndex = url.indexOf("article/");
    let postID = parseInt(url.substring(urlIndex+8));

    let preloader = document.getElementById("preloader-comments-post");
    preloader.style.display = "block";
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            let commentsSection = document.getElementById("all-comments-single-post");
            let btn = document.getElementById("see-more-comment-btn");

            let response = JSON.parse(this.responseText);

            preloader.style.display = "none";
            commentsSection.innerHTML = commentsSection.innerHTML + response.data;
            
            if (response.minID <= 1) {
                btn.style.display = "none";
            } else {
                btn.setAttribute("onclick", "seeMoreComments("+response.minID+")");
            }
        }
    };
    let thisAglDomain = new WebSite().getDomain();
    request.open("GET", thisAglDomain+"ajax/more-comment/"+postID+"/"+minID);
    request.send();
}
