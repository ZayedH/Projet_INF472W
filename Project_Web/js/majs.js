$(document).ready(function() {
	$("#myBtn").click(function() {
		$("#myAlert").alert("close");
	});

});




function verify() {
    var pass1 = document.getElementById("input_mdp").value;
    var pass2 = document.getElementById("input_mdp2").value;
    if (pass1 !== pass2) {
        document.getElementById("msg").innerHTML = "Invalide";
        document.getElementById("msg").style.color = "red";
    } else {
        document.getElementById("msg").innerHTML = "Valide";
        document.getElementById("msg").style.color = "green";
    }
 
};

function verifymailformX(email){
    var emailform=/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    return emailform.test(email);


};

function validatemail(){
     var email = document.getElementById("email").value;
     if (verifymailformX(email)) {
        alert('Adresse e-mail valide');
    } else {
        alert('Adresse e-mail non valide');
    }
   

};
function getOption() {
    selectElement = document.querySelector('#select1');
    output = selectElement.value;
    document.querySelector('.output').textContent = output;
};
