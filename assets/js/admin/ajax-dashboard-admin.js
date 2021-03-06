function setThisComment(commentStatus,commentID){
    let commentsSection = document.getElementById("comments-data-dashboard");
    let alertMessage = document.getElementById("alert-message");

    //APPEL AJAX POUR EDITER LE COMMENTAIRE 
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            let response = JSON.parse(this.responseText);
            commentsSection.innerHTML = response.data;
            alertMessage.style.display = "block";
            alertMessage.innerText = response.message;
        }
    };
    let thisAglDomain = new WebSite().getDomain();
    request.open("GET", thisAglDomain+"/admin/set-comment/"+commentID+"/"+commentStatus+"/true");
    request.send();
}
