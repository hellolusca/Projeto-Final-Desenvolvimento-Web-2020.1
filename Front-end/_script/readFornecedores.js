if (sessionStorage.getItem("id") == null) {
    window.location.href = "http://projetofinalweb/"
}

function logout() {
    sessionStorage.removeItem("id")
    window.location.href = "http://projetofinalweb";
}

$( document ).ready(function() {
    //NAVBAR
    document.getElementById("userinfo").innerHTML="" + sessionStorage.getItem("name") + " " + sessionStorage.getItem("surname");
        
    $("#feedbackPositivo").hide();
    $("#feedbackNegativo").hide();

    //Preencher tabela
    function list() {
        return fetch(`http://projetofinalweb/Back-end/providers`)
        .then((response) => {
            return response.json()
        })
        .then(json => {
            return json
        })
        .catch((err) => {
            console.log('Fetch Error :-S', err);
        });
    }

    (async function() {
        let data = await list()
        let [rep1, rep2, ...repRest] = data
        addTwoRows(data)
    })();

    let addTwoRows = (rows) => {
        rows.forEach(e => {
        let tbody = document.querySelector('#listaDeFornecedores tbody')
        let tr = document.createElement('tr')
        tr.id = "linha"+e.id;
        tr.innerHTML = rowHtml(e)
        tbody.appendChild(tr)
        })
    }

    let rowHtml = row => {
        html = ''
        html += `<td><a href="edit.html?id=${row.id}">${row.id}</a></td><td>${row.company_name}</td><td>${row.cnpj}</td><td>${row.email}</td><td>${row.cellphone}</td><td>${row.city} / ${row.state}</td><td><button class="btn btn-secondary my-2 my-sm-0" type="button" value="${row.id}" onclick="listFunc(${row.id})">&#128712;</button><button class="btn btn-primary my-2 my-sm-0" type="button" value="${row.id}" onclick="editFunc(${row.id})">&#9998;</button><button class="btn btn-danger my-2 my-sm-0" type="button" value="${row.id}" onclick="deleteFunc(${row.id}, '${row.company_name}')">&#128465;</button></td>`
        return html
    }

});

$("#filterButton").click(function () {
    $("#corpoTabela").empty();
    function list() {
        return fetch(`http://projetofinalweb/Back-end/providers`, {
            method: "POST",
            body: JSON.stringify({
                "oper": "filter",
                "filter_by": $("#filter_by").val(),
                "keyword": $("#keyword").val()
            }), 
            headers: { 
                "Content-type": "application/json; charset=UTF-8",
                "Accept": "application/json"
            }
        })
          .then((response) => {
            return response.json()
          })
          .then(json => {
            return json
          })
          .catch((err) => {
            console.log('Fetch Error :-S', err);
          });
    }
    
    (async function() {
        let data = await list()
        let [rep1, rep2, ...repRest] = data
        addRows(data)
      })();
    
    let addRows = (rows) => {
        rows.forEach(e => {
          let tbody = document.querySelector('#listaDeFornecedores tbody')
          let tr = document.createElement('tr');
          tr.id = "linha"+e.id;
          tr.innerHTML = rowHtml(e)
          tbody.appendChild(tr)
        })
      }
    
    let rowHtml = row => {
        html = ''
        html += `<td><a href="edit.html?id=${row.id}">${row.id}</a></td><td>${row.company_name}</td><td>${row.cnpj}</td><td>${row.email}</td><td>${row.cellphone}</td><td>${row.city} / ${row.state}</td><td><button class="btn btn-secondary my-2 my-sm-0" type="button" value="${row.id}" onclick="listFunc(${row.id})">&#128712;</button><button class="btn btn-primary my-2 my-sm-0" type="button" value="${row.id}" onclick="editFunc(${row.id})">&#9998;</button><button class="btn btn-danger my-2 my-sm-0" type="button" value="${row.id}" onclick="deleteFunc(${row.id}, '${row.company_name}')">&#128465;</button></td>`
        return html
    }
})

function listFunc(id) {
    fetch(`http://projetofinalweb/Back-end/providers/${id}`)
        .then((response) => {
            return response.json()
        })
        .then(resposta => {
            document.getElementById('idList').innerHTML = "ID do Funcionário: "+resposta.id;
            document.getElementById('company_nameList').innerHTML = "Nome da empresa: "+resposta.company_name;
            document.getElementById('cnpjList').innerHTML = "CNPJ: "+resposta.cnpj;
            document.getElementById('cellphoneList').innerHTML = "Telefone: "+resposta.cellphone;
            document.getElementById('emailList').innerHTML = "Email: "+resposta.email;
            document.getElementById('addressList').innerHTML = "Endereço: "+resposta.address;
            document.getElementById('numberList').innerHTML = "Número: "+resposta.number;
            document.getElementById('complementList').innerHTML = "Complemento: "+resposta.complement;
            document.getElementById('cepList').innerHTML = "CEP: "+resposta.cep;
            document.getElementById('neighborhoodList').innerHTML = "Bairro: "+resposta.neighborhood;
            document.getElementById('cityList').innerHTML = "Cidade : "+resposta.city;
            document.getElementById('stateList').innerHTML = "Estado: "+resposta.state;
        })
        .catch((err) => {
            console.log('Fetch Error :-S', err);
        });
    $("#modalList").modal();
}

function editFunc(id) {
    var company_name, cnpj, cellphone, email, address, number, complement, cep, neighborhood, city, state;
    fetch(`http://projetofinalweb/Back-end/providers/${id}`)
        .then((response) => {
            return response.json()
        })
        .then(resposta => {
            $('#id').val(id);
            $('#company_name').val(resposta.company_name);
            $('#cnpj').val(resposta.cnpj);
            $('#cellphone').val(resposta.cellphone);
            $('#email').val(resposta.email);
            $('#address').val(resposta.address);
            $('#number').val(resposta.number);
            $('#complement').val(resposta.complement);
            $('#cep').val(resposta.cep);
            $('#neighborhood').val(resposta.neighborhood);
            $('#city').val(resposta.city);
            $('#state').val(resposta.state);
        })
        .catch((err) => {
            console.log('Fetch Error :-S', err);
        });
    $("#modalEdit").modal();
}

$("#save").click(function() {
    var id = $('#id').val();
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
                oper: "update",
                id: id,
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
                    document.location.reload(true);
                }, 2000)
            })
        } else {
            $("#feedbackPositivo").hide();
            $("#feedbackNegativo").show();
            setTimeout(function() { 
                $("#feedbackNegativo").hide();
            }, 3000)
        }
})

function deleteFunc(id=null, company_name="") {
    var result = confirm(`Tem certeza que deseja excluir o fornecedor `+company_name+ `?`);
    if (result) {
        fetch(`http://projetofinalweb/Back-end/providers`, {
            method: "POST",
            body: JSON.stringify({
                "oper": "delete",
                "id": id,
            }), 
            headers: { 
                "Content-type": "application/json; charset=UTF-8",
                "Accept": "application/json"
            }
        })
          .then((response) => {
            return response.json()
            console.log(response[0]);
          })
          .catch((err) => {
            console.log('Fetch Error :-S', err);
        });
        $(`#linha${id}`).remove();
        alert("Excluído com sucesso!")
    }
}
