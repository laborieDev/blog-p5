function seeMorePosts(nbPage){
    let preloader = document.getElementById('preloader-blog-home');
    preloader.style.display = "block";
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let blogSection = document.getElementById("blog-list");
            let btn = document.getElementById("see-more-post-btn");

            response = JSON.parse(this.responseText);

            preloader.style.display = "none";
            blogSection.innerHTML = blogSection.innerHTML + response.data;
            
            if (response.nbPage <= 1) {
                btn.style.display = "none";
            } else {
                btn.setAttribute("onclick", "seeMorePosts("+response.nbPage+")");
            }
        }
    };
    request.open("GET", "ajax/more-post/"+nbPage);
    request.send();
}

function setCatPost(element, setOff = false){
    let preloader = document.getElementById('preloader-blog-home');
    preloader.style.display = "block";

    let catID = element.getAttribute("categoryid");

    //Gestion de la classe et du onclick des boutons de catégorie
    let allCatBtns = document.getElementsByClassName("set_cat_btn");
    for(let i = 0; i < allCatBtns.length; i++){
        allCatBtns[i].classList.remove("active");
        allCatBtns[i].setAttribute("onclick", "setCatPost(this)");
    }

    let catBtn = document.getElementById("cat-blog-btn");
    let thisCatBtn = document.getElementById("set-cat-btn-"+catID);
    let thisCatBtnMobile = document.getElementById("set-cat-btn-mobile-"+catID);
    if (setOff == false) {
        catBtn.classList.add("active");
        thisCatBtn.classList.add("active");
        thisCatBtnMobile.classList.add("active");

        thisCatBtn.setAttribute("onclick", "setCatPost(this, true)");
        thisCatBtnMobile.setAttribute("onclick", "setCatPost(this, true)");
    } else {
        thisCatBtn.setAttribute("onclick", "setCatPost(this)");
        thisCatBtnMobile.setAttribute("onclick", "setCatPost(this)")
        catBtn.classList.remove("active");
    }

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let blogSection = document.getElementById("blog-list");
            let btn = document.getElementById("see-more-post-btn");

            response = JSON.parse(this.responseText);

            preloader.style.display = "none";
            blogSection.innerHTML = response.data;
            
            //Gestion du bouton Charger Plus
            if (response.nbPage <= 1) {
                btn.style.display = "none";
            } else if(setOff == true) {
                btn.setAttribute("onclick", "seeMorePosts("+response.nbPage+")");
                btn.style.display = "block";
            } else {
                btn.style.display = "block";
                btn.setAttribute("onclick", "setCatMorePost("+catID+","+response.nbPage+")");
            }
        }
    };
    //Gestion de la requête à envoyer
    if(setOff == true) {
        request.open("GET", "ajax/see-all-post/");
    } else {
        request.open("GET", "ajax/see-cat-post/"+catID);
    }
    
    request.send();
}

function setCatMorePost(catID, nbPage = 1){
    let preloader = document.getElementById('preloader-blog-home');
    preloader.style.display = "block";
    
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let blogSection = document.getElementById("blog-list");
            let btn = document.getElementById("see-more-post-btn");

            response = JSON.parse(this.responseText);

            preloader.style.display = "none";
            blogSection.innerHTML = blogSection.innerHTML + response.data;
            
            //Gestion du bouton Charger Plus
            if (response.nbPage <= 1) {
                btn.style.display = "none";
            } else {
                btn.style.display = "block";
                btn.setAttribute("onclick", "setCatMorePost("+catID+","+response.nbPage+")");
            }
        }
    };
    //Gestion de la requête à envoyer
    request.open("GET", "ajax/see-cat-post/"+catID+"/"+nbPage);

    request.send();
}

function sendContactForm(){
    let alertSection = document.getElementById('alert-message-contact-form');

    let allInputs = document.getElementsByClassName("contact-form-input");

    for(let i = 0; i < allInputs.length; i++){
        allInputs[i].style.border = "0";
    }

    for(let j = 0; j < allInputs.length; j++){
        if(allInputs[j].value == ""){
            allInputs[j].style.border = "solid 1px red";
            alertSection.classList.add("alert-danger");
            alertSection.style.display = "block";
            alertSection.innerText = "Vous devez rentrer toutes les informations.";

            return ;
        }
    }

    // ENVOYER TOUS LES INPUTS 
    let formData = new FormData();           
    formData.append("name", contactname.value);
    formData.append("email", email.value);
    formData.append("subject", subject.value);
    formData.append("number", number.value);
    formData.append("number", number.value);
    formData.append("message", message.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "Send") {
                alertSection.classList.remove("alert-danger");
                alertSection.classList.add("alert-success");
                alertSection.style.display = "block";
                alertSection.innerText = "Merci ! Votre message a bien été envoyé !";

                document.getElementById('submit-form-btn').style.display = "none";
                document.getElementById('return-home').style.display = "block";
            } else {
                alertSection.classList.add("alert-danger");
                alertSection.style.display = "block";
                alertSection.innerText = "Désolé... Une erreur est survenue.";
            }
        }
    };

    request.open("POST", thisAglDomain+"ajax/send-contact-form", true);
    request.send(formData);
}
