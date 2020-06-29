if (sessionStorage.getItem("id") == null) {
    window.location.href = "http://projetofinalweb/"
}

function logout() {
    sessionStorage.removeItem("id")
    window.location.href = "http://projetofinalweb";
}

//NAVBAR
document.getElementById("userinfo").innerHTML="" + sessionStorage.getItem("name") + " " + sessionStorage.getItem("surname");

//Feedbacks
$("#feedbackPositivo").hide();
$("#feedbackNegativo").hide();
$('#submit').click(function() {
    var company_name = $('#company_name').val();
    var cnpj = $('#cnpj').val();
    var cellphone = $('#cellphone').val();
    var email = $('#email').val();
    var address = $('#address').val();
    var number = $('#number').val();
    var complement = $('#complement').val();
    var cep = $('#cep').val();
    var neighborhood = $('#neighborhood').val();
    var city = $('#city').val();
    var state = $('#state').val();

    if (company_name != "" &&
        cnpj != "" &&
        cellphone != "" &&
        email != "" &&
        address != "" &&
        number != 0 &&
        complement != "" &&
        cep != 0 &&
        neighborhood != "" &&
        city != "" &&
        state != "") {
            var body = JSON.stringify({
                oper: "insert",
                company_name: company_name,
                cnpj: cnpj,
                cellphone: cellphone,
                email: email,
                address: address,
                number: number,
                complement: complement,
                cep: cep,
                neighborhood: neighborhood,
                city: city,
                state: state,
            })
            console.log(body);
            
            fetch("http://projetofinalweb/Back-end/providers", { 
                method: "POST",
                body: body, 
                headers: { 
                    "Content-type": "application/json; charset=UTF-8",
                    "Accept": "application/json"
                } 
            }) 
            .then(response => response.json())
            .then(function(result) {
                $("#feedbackNegativo").hide();
                $("#feedbackPositivo").show();
                setTimeout(function() { 
                    $("#feedbackPositivo").hide();
                }, 3000)
            })
        } else {
            $("#feedbackPositivo").hide();
            $("#feedbackNegativo").show();
            setTimeout(function() { 
                $("#feedbackNegativo").hide();
            }, 3000)
        }
})