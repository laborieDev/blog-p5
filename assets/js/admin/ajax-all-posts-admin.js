let postIDDelete = -1;

function getDeleteModal(postID){
    postIDDelete = postID;
    let modal = document.getElementById('modal-delete-post');
    if(modal.style.display == "none"){
        modal.style.display = "block";
    }
    else{
        modal.style.display = "none";
        postIDDelete = -1;
    }
}

function deleteThisPost(){
    let postsSection = document.getElementById("posts-data-dashboard");
    let thisPostSection = document.getElementById("row-post-"+postIDDelete);
    let alertMessage = document.getElementById("alert-message");

    //APPEL AJAX POUR EDITER LE COMMENTAIRE 
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.responseText);
            thisPostSection.style.display = "none";
            alertMessage.style.display = "block";
            alertMessage.innerText = response.message;
            getDeleteModal(-1);
        }
    };
    request.open("GET", thisAglDomain+"/admin/article/delete/"+postIDDelete);
    request.send();
}
