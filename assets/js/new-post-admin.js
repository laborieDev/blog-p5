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

    let title = document.getElementById('title').value;
    let extract = document.getElementById('extract').value;
    let content = document.getElementById('content').value;
    // let img = document.getElementById('img').files[0];

    var formData = new FormData();
    formData.append("file", img.files[0]);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "Added") {
                alertSection.classList.remove("alert-danger");
                alertSection.classList.add("alert-success");
                alertSection.style.display = "block";
                alertSection.innerText = "L'article a bien été ajouté !";
            } else {
                alertSection.classList.add("alert-danger");
                alertSection.style.display = "block";
                alertSection.innerText = "Une erreur est survenue !";
            }
        }
    };

    request.open("POST", thisAglDomain+"admin/article/add", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("title="+title+"&extract="+extract+"&content="+content+"&img="+formData+"&cats="+allCats);
    // request.send("formData="+form+"&allCats="+allCats);
}
