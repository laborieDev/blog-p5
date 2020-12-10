let allCats = [];

let allCatsListSection = document.getElementById('cat-selected');

/** GESTION DES CATEGORIES **/
function setCats(select){
    let catID = select.value;
    let catTitle = document.getElementById('cat-option-'+catID).innerText;

    if(allCats.indexOf(catID) == -1){
        allCats.push(catID);
        allCatsListSection.innerHTML = allCatsListSection.innerHTML + "<span id='cat-list-item-"+catID+"'>"+catTitle+"<i class='lni lni-close' onclick='removeThisCat(\""+catID+"\")'></i>";
    }
    select.value = "";
}

function removeThisCat(thisCatID){
    let index = allCats.indexOf(thisCatID);
    if(index != -1){
        allCats.splice(index, 1);
        document.getElementById('cat-list-item-'+thisCatID).remove();
    }
}

/** ENVOYER LE FORMULAIRE - ADD POST **/
async function sendNewPostForm(){
    let alertSection = document.getElementById('alert-message');
    let allInputs = document.getElementsByClassName('new-post-input');
    for(let i = 0; i < allInputs.length; i++){
        if(allInputs[i].value == ""){
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
        if (this.readyState === 4 && this.status === 200) {
            if (this.responseText == "Added") {
                alertSection.classList.remove("alert-danger");
                alertSection.classList.add("alert-success");
                alertSection.style.display = "block";
                alertSection.innerText = "L'article a bien été ajouté !";

                document.getElementById('submit-btn').style.display = "none";
                document.getElementById('return-home').style.display = "block";
            } else {
                alertSection.classList.add("alert-danger");
                alertSection.style.display = "block";
                alertSection.innerText = "Une erreur est survenue !";
            }
        }
    };

    request.open("POST", thisAglDomain+"admin/article/add", true);
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
        if (this.readyState === 4 && this.status === 200) {
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
