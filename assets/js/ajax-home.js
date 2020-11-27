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
