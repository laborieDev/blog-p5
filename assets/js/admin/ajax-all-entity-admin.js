let deleteID = -1;
let editID = -1;

function getDeleteModal(postID){
    deleteID = postID;
    let modal = document.getElementById('modal-delete-post');
    if(modal.style.display == "none"){
        modal.style.display = "block";
    }
    else{
        modal.style.display = "none";
        deleteID = -1;
    }
}

// POSTS GESTION //
function deleteThisPost(){
    let postsSection = document.getElementById("posts-data-dashboard");
    let thisPostSection = document.getElementById("row-post-"+deleteID);
    let alertMessage = document.getElementById("alert-message");

    //APPEL AJAX POUR SUPPRIMER LE POST
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
    request.open("GET", thisAglDomain+"/admin/article/delete/"+deleteID);
    request.send();
}

function seeMorePosts(nbPage){
    let preloader = document.getElementById('preloader-all-posts');
    preloader.style.display = "block";
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let postsSection = document.getElementById("posts-data-dashboard");
            let btn = document.getElementById("see-more-post-btn");

            response = JSON.parse(this.responseText);

            preloader.style.display = "none";
            postsSection.innerHTML = postsSection.innerHTML + response.data;
            
            if (response.nbPage == -1) {
                btn.style.display = "none";
            } else {
                btn.setAttribute("onclick", "seeMorePosts("+response.nbPage+")");
            }
        }
    };
    request.open("GET", thisAglDomain+"admin/article/see-more/"+nbPage);
    request.send();
}

function seeMoreComments(nbPage){
    let preloader = document.getElementById('preloader-all-posts');
    preloader.style.display = "block";
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let commentsSection = document.getElementById("comments-data-dashboard");
            let btn = document.getElementById("see-more-post-btn");

            response = JSON.parse(this.responseText);

            preloader.style.display = "none";
            commentsSection.innerHTML = commentsSection.innerHTML + response.data;
            
            if (response.nbPage == -1) {
                btn.style.display = "none";
            } else {
                btn.setAttribute("onclick", "seeMoreComments("+response.nbPage+")");
            }
        }
    };
    request.open("GET", thisAglDomain+"admin/comment/see-more/"+nbPage);
    request.send();
}

// USER GESTION //
function deleteThisUser(){
    let thisUserSection = document.getElementById("row-user-"+deleteID);
    let alertMessage = document.getElementById("alert-message");

    //APPEL AJAX POUR SUPPRIMER L'UTILISATEUR
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.responseText);
            thisUserSection.style.display = "none";
            alertMessage.classList.remove("alert-danger");;
            alertMessage.style.display = "block";
            alertMessage.innerText = response.message;
            getDeleteModal(-1);
        } else if (this.readyState == 4 && this.status == 500) {
            response = JSON.parse(this.responseText);
            alertMessage.style.display = "block";
            alertMessage.classList.add("alert-danger");
            alertMessage.innerText = response.message;
            getDeleteModal(-1);
        }
    };
    request.open("GET", thisAglDomain+"/admin/user/delete/"+deleteID);
    request.send();
}

//COMMENT GESTION
function setThisComment(id = -1, status=""){
    let modal = document.getElementById('modal-edit-post');
    if(modal.style.display == "none"){
        editID = id;
        document.getElementById('status-edit-comment').value = status;
        modal.style.display = "block";
    } else {
        modal.style.display = "none";
        editID = -1;
        document.getElementById('status-edit-comment').value = "";
    }
}

function updateThisComment(){
    let status = document.getElementById('status-edit-comment').value;

    let alertMessage = document.getElementById("alert-message");

    //APPEL AJAX POUR EDITER LE COMMENTAIRE 
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.responseText);
            alertMessage.style.display = "block";
            alertMessage.innerText = response.message;
        }
    };
    request.open("GET", thisAglDomain+"/admin/set-comment/"+editID+"/"+status+"/false");
    request.send(); 

    let statusCell = document.getElementById('statut-cell-'+editID);
    statusCell.classList.remove('valid');
    statusCell.classList.remove('waiting');
    statusCell.classList.remove('reject');

    switch (status) {
        case "isValid" :
                statusCell.classList.add('valid');
                statusCell.innerText = "Validé";
                break;
        case "waiting" :
                statusCell.classList.add('waiting');
                statusCell.innerText = "En attente";
                break;
        case "isReject" :
                statusCell.classList.add('reject');
                statusCell.innerText = "Refusé";
                break;
    }

    setThisComment();
}

function deleteThisComment(){
    let thisCommentSection = document.getElementById("row-comment-"+deleteID);
    let alertMessage = document.getElementById("alert-message");

    //APPEL AJAX POUR SUPPRIMER LE POST
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.responseText);
            thisCommentSection.style.display = "none";
            alertMessage.style.display = "block";
            alertMessage.innerText = response.message;
            getDeleteModal(-1);
        }
    };
    request.open("GET", thisAglDomain+"/admin/comment/delete/"+deleteID);
    request.send();
}
