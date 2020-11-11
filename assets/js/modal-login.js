function getLoginModal(){
    let modal = document.getElementById('modal-login');
    if(modal.style.display == "none"){
        modal.style.display = "block";
    }
    else{
        modal.style.display = "none";
    }
}

function seePassword(){
    let input = document.getElementById('modal-password');
    let icon = document.getElementById('eye-btn-icon');
    if(input.type == "password"){
        input.type = "text";
        icon.classList.add("active");
    }
    else{
        input.type = "password";
        icon.classList.remove("active");
    }
}