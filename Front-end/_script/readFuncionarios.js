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

    //Preencher tabela
    function list() {
        return fetch(`http://projetofinalweb/Back-end/employees`)
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
        let tbody = document.querySelector('#listaDeFuncionarios tbody')
        let tr = document.createElement('tr')
        tr.id = "linha"+e.id;
        tr.innerHTML = rowHtml(e)
        tbody.appendChild(tr)
        })
    }

    let rowHtml = row => {
        html = ''
        html += `<td><a href="edit.html?id=${row.id}">${row.id}</a></td><td>${row.name}</td><td>${row.surname}</td><td>${row.cpf}</td><td>${row.email}</td><td>${row.cellphone}</td><td><button class="btn btn-primary my-2 my-sm-0" type="button" value="${row.id}" onclick="editFunc(${row.id})">&#9998;</button><button class="btn btn-danger my-2 my-sm-0" type="button" value="${row.id}" onclick="deleteFunc(${row.id}, '${row.name}', '${row.surname}')">&#128465;</button></td>`
        return html
    }

});

$("#filterButton").click(function () {
    $("#corpoTabela").empty();
    function list() {
        return fetch(`http://projetofinalweb/Back-end/employees`, {
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
          let tbody = document.querySelector('#listaDeFuncionarios tbody')
          let tr = document.createElement('tr');
          tr.id = "linha"+e.id;
          tr.innerHTML = rowHtml(e)
          tbody.appendChild(tr)
        })
      }
    
    let rowHtml = row => {
        html = ''
        html += `<td><a href="edit.html?id=${row.id}">${row.id}</a></td><td>${row.name}</td><td>${row.surname}</td><td>${row.cpf}</td><td>${row.email}</td><td>${row.cellphone}</td><td><button class="btn btn-primary my-2 my-sm-0" type="button" value="${row.id}" onclick="editFunc(${row.id})">&#9998;</button><button class="btn btn-danger my-2 my-sm-0" type="button" value="${row.id}" onclick="deleteFunc(${row.id}, '${row.name}', '${row.surname}')">&#128465;</button></td>`
        return html
    }
})

function editFunc(id, name, surname) {
    
}

function deleteFunc(id=null, name="", surname="") {
    var result = confirm(`Tem certeza que deseja excluir o funcionário `+name+ ` `+surname+`?`);
    if (result) {
        fetch(`http://projetofinalweb/Back-end/employees`, {
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
