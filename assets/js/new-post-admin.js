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

/** ENVOYER LE FORMULAIRE **/
function sendNewPostForm(){
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

    alertSection.classList.remove("alert-danger");
    alertSection.classList.add("alert-success");
    alertSection.style.display = "block";
    alertSection.innerText = "L'article a bien été ajouté !";

    return ;
}
