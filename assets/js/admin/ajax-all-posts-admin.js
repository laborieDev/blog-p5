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
