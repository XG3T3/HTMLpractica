

//  let elementos = [
//     {
//         "nombre": "Maquina hidraulica",
//        "descipcion": "Funciona mediante pistones",
//       "n_Serie": "1231",
//         "activo": "Activo",
//        "prioridad": "Media"
//     },
//     {
//        "nombre": "Maquinas Termica",
//        "descipcion": "Funciona mediante calor",
//        "n_Serie": "1231",
//       "activo": "Inactivo",
//       "prioridad": "Media"
//    },
//    {
//        "nombre": "Maquina Refrigeradora",
//       "descipcion": "Funciona mediante frio",
//        "n_Serie": "1231",
//        "activo": "Inactivo",
//         "prioridad": "Media"
//     },
//     {
//        "nombre": "Maquina Instaladora",
//        "descipcion": "Funciona instalando",
//       "n_Serie": "1231",
//         "activo": "Inactivo",
//          "prioridad": "Media"
//     },
//    {
//         "nombre": "Medidor de Presion",
//          "descipcion": "Funciona midiendo presion",
//         "n_Serie": "1231",
//         "activo": "Activo",
//         "prioridad": "Alta"
//     }];




// {  
//     let tabla = document.querySelector('tbody');


//     for(let i = 0; i < elementos.length; i++)
//     {


//         //CREA FILA
//         let fila=document.createElement('tr');
//         fila.setAttribute('id','e' + i);


//         //BOTON EN CELDA
//         let celda = document.createElement('td');
//         let bt = document.createElement('button')
//         bt.textContent = 'Delete'
//         bt.setAttribute('onclick','borrar(' + i + ')')
//         celda.appendChild(bt);
//         fila.appendChild(celda);

//         //INSERTAR CELDA E INFORMACION DEL ELEMENTO
//         for (const property in elementos[i])
//         {
//             let celda = document.createElement('td');
//             celda.textContent = `${elementos[i][property]}`;
//             fila.appendChild(celda);
//         }

//         tabla.appendChild(fila);

//     }
// }


const URL ='./ws/getElement.php';




window.addEventListener('load', () => {
   cargaElementos();
}
)


 function cargaElementos(){
     fetch(URL).then((response) => response.json()).then(elementos => cargaTabla(elementos.data));

}

function cargaTabla(elementos){
    let tabla = document.querySelector('tbody');
    tabla.innerHTML = "";

    // console.log((JSON.stringify(elementos)));
    // console.log(('elementos'));
    // console.log(typeof(elementos));


    for (let i = 0; i < elementos.length; i++) {


        //CREA FILA
        let fila = document.createElement('tr');
        fila.setAttribute('id', 'e' + elementos[i]["id"]);


        //BOTON EN CELDA
        let celda = document.createElement('td');


        let bt = document.createElement('button')
        bt.textContent = 'Delete'
        bt.setAttribute('onclick', 'borrar(' + elementos[i]["id"] + ')')
        celda.appendChild(bt);

        let btg = document.createElement('button');
        btg.textContent = 'v'
        btg.style.display = "none";

        celda.appendChild(btg);
        ///////////////////////////////////////////

        bt = document.createElement('button')
        bt.textContent = 'editar'
        bt.setAttribute('id', 'editar' + elementos[i]["id"])
        bt.setAttribute('onclick', 'editar(' + elementos[i]["id"] + ')')
        celda.appendChild(bt);



        fila.appendChild(celda);

        //INSERTAR CELDA E INFORMACION DEL ELEMENTO
        for (const property in elementos[i]) {

            
            if(property != 'id')
            {let celda = document.createElement('td');
            celda.textContent = `${elementos[i][property]}`;


            let modificar = document.createElement('input');


            fila.appendChild(celda);}
            
        }
        tabla.appendChild(fila);

    }
}




function borrar(i) {

    Swal.fire({
        title: 'Estas seguro de borrar?',
        text: "No podras revertir el borrado!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'NO, RECHAZO!',
        confirmButtonText: 'SI, CONFIRMO!'

        
      }).then((result) => {
        if (result.isConfirmed) {

            fetch("./ws/deleteElement.php?id="+i).then(response => response.json()).then(response => {
                if(response.success){
                    Swal.fire(
                        'BORRADO!',
                        response.message,
                        'success'
                      ) 
                      let t = document.querySelector("#e" + i);
                      t.remove(); 
                } 
                else{
                    Swal.fire(
                        'No Borrado!',
                        response.message,
                        'error')
                }
            })
          
        }
      })

    // fetch("./ws/deleteElement.php?id="+i
    // )
    //  let t = document.querySelector("#e" + i);
    //  t.remove();

    
}

function editar(i) {
    let t = document.querySelector("#e" + i).cells




    for (let x = 0; x < t.length; x++) {



        if (x == 0) {
            let bt = document.createElement('button')
            bt.textContent = 'guardar'
            bt.setAttribute('id', 'guardar' + i)
            bt.setAttribute('onclick', 'guardar(' + i + ')');
            t[x].appendChild(bt);
        }

        else if (x == 4) {
            let valor = t[x].value;

            let inp = document.createElement('select');


            let sele = document.createElement('option');
            sele.setAttribute('value', 'Activo');
            sele.innerHTML = 'Activo';

            if (valor == sele.value) {
                sele.setAttribute('selected', '');
            }


            inp.appendChild(sele);

            sele2 = document.createElement('option');
            sele2.setAttribute('value', 'Inactivo');
            sele2.innerHTML = 'inactivo';
            if (valor == sele2.value) {
                sele2.setAttribute('selected', '');
            }


            inp.appendChild(sele2);

            //inp.setAttribute('value', valor);
            t[x].innerHTML = "";
            t[x].appendChild(inp);

        }

        else if (x == 5) {
            let valor = t[x].innerHTML;

            let inp = document.createElement('select');


            let sele = document.createElement('option');
            sele.setAttribute('value', 'Alta');
            sele.innerHTML = 'Alta';

            if (valor == sele.value) {
                sele.setAttribute('selected', '');
            }


            inp.appendChild(sele);

            sele2 = document.createElement('option');
            sele2.setAttribute('value', 'Media');
            sele2.innerHTML = 'Media';
            if (valor == sele2.value) {
                sele2.setAttribute('selected', '');
            }


            inp.appendChild(sele2);


            sele3 = document.createElement('option');
            sele3.setAttribute('value', 'Baja');
            sele3.innerHTML = 'Baja';
            if (valor == sele3.value) {
                sele3.setAttribute('selected', '');
            }


            inp.appendChild(sele3);

            //inp.setAttribute('value', valor);
            t[x].innerHTML = "";
            t[x].appendChild(inp);

        }


        else {
            let valor = t[x].innerHTML;

            let inp = document.createElement('input');
            inp.setAttribute('value', valor);
            t[x].innerHTML = "";
            t[x].appendChild(inp);

        }


        document.querySelector('#editar' + i).style.display = 'none';


    }

};

function guardar(i) {

    Swal.fire({
        title: 'Quieres guardar los datos?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Guardar',
        denyButtonText: `No Guardar`,
        icon:'warning',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {

            const formData = new FormData();

            let t = document.querySelector("#e" + i).cells;
            
           
            
            formData.append('nombre',t[1].firstChild.value);
            formData.append('desc',t[2].firstChild.value);
            formData.append('numero',t[3].firstChild.value);
            formData.append('act',t[4].firstChild.value);
            formData.append('prio',t[5].firstChild.value);
            
           
            
            fetch('./ws/modifyElement.php?id='+i,{
                    method:'POST',
                    body:formData
               })
               .then(()=>cargaElementos());




          Swal.fire('GUARDADOS', 
          'Cambios guardados en la base de datos', 
          'success');

     

             


        } else if (result.isDenied) {
          Swal.fire('No modificados',
           'Los datos no se han modificado en la base de datos', 
           'error')
          cargaElementos();
        }
      })




  //location.reload();

 

   //cargaElementos().then(elementos => cargaTabla(elementos.data));






   //let cambios = [];

   //console.log(t[1].firstChild.value);
   //console.log(t[2].firstChild.value);


//     for (let x = 0; x < t.length; x++) {

//         if (x > 0) {

//             let valor = t[x].firstChild.value;
//             cambios[x - 1] = valor;
//             t[x].innerHTML = valor;

//         }

//     }
// console.log(cambios);
//     let x = 0;

    // for (const property in elementos[i]) {
    //     elementos[i][property] = cambios[x];

    //     x++;
    // }


    // document.querySelector('#guardar' + i).remove();
    // document.querySelector('#editar' + i).style.display = 'inline-block';
}




function filtro() {
    let filtro = document.getElementById('busqueda').value.toLowerCase();

    if (filtro.length >= 3) {
        elementos.filter(
            (elemento) => {
                let id = elementos.indexOf(elemento);

                if (document.querySelector('#e' + id) != null) {
                    if (elemento.Nombre.toLowerCase().includes(filtro) || elemento.Descipcion.toLowerCase().includes(filtro)) {
                        document.querySelector('#e' + id).style = "display:table-row;";
                    }

                    else {
                        document.querySelector('#e' + id).style = "display:none;";
                    }
                }
            }
        )
    }

    else {
        for (let i = 0; i < elementos.length; i++) {
            if (document.querySelector('#e' + i) != null) {
                document.querySelector('#e' + i).style = "display:table-row;";
            }

        }
    }
}



function limpia() {
    document.getElementById('busqueda').value = "";
    filtro();
}










