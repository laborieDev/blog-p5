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

function connectUser(){
    let email = document.getElementById('modal-email').value;
    let password = document.getElementById('modal-password').value;
    
    let errorSection = document.getElementById('modal-alert-message');

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "Error") {
                errorSection.style.display = "block";
                errorSection.innerHTML = "Une erreur s'est produite ! <br> Vérifiez votre identifiant et votre mot de passe."
            } else if (this.responseText == "Connected") {
                document.location.href = thisAglDomain+"admin"; 
            }
        }
    };
    request.open("POST", thisAglDomain+"user-connect");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("email="+email+"&password="+password);
}
