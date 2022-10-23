

let elementos=[{"Nombre":"Maquina hidraulica","Descipcion":"Funciona mediante pistones","N.Serie":"1231","Activo":true,"Prioridad":"Media"},
{"Nombre":"Maquinas Termica","Descipcion":"Funciona mediante calor","N.Serie":"1231","Activo":true,"Prioridad":"Media"},
{"Nombre":"Maquina Refrigeradora","Descipcion":"Funciona mediante frio","N.Serie":"1231","Activo":true,"Prioridad":"Media"},
{"Nombre":"Maquina Instaladora","Descipcion":"Funciona instalando","N.Serie":"1231","Activo":true,"Prioridad":"Media"},
{"Nombre":"Medidor de Presion","Descipcion":"Funciona midiendo presion","N.Serie":"1231","Activo":true,"Prioridad":"Media"}];




window.addEventListener('load',()=>
    {  
        let tabla = document.querySelector('tbody');
        
        
        for(let i = 0; i < elementos.length; i++)
        {


            //CREA FILA
            let fila=document.createElement('tr');
            fila.setAttribute('id','e' + i);


            //BOTON EN CELDA
            let celda = document.createElement('td');
            let bt = document.createElement('button')
            bt.textContent = 'X'
            bt.setAttribute('onclick','borrar(' + i + ')')
            celda.appendChild(bt);
            fila.appendChild(celda);

            //INSERTAR CELDA E INFORMACION DEL ELEMENTO
            for (const property in elementos[i])
            {
                let celda = document.createElement('td');
                celda.textContent = `${elementos[i][property]}`;
                fila.appendChild(celda);
            }

            tabla.appendChild(fila);

        }
    }
)




function borrar(i)
{
    let t=document.querySelector("#e"+i);
    t.remove();
}




function filtro()
{
    let filtro = document.getElementById('busqueda').value.toLowerCase();

    if(filtro.length >= 3)
    {
        elementos.filter
        (
            (elemento)=>
            {
                let id = elementos.indexOf(elemento);

                if (document.querySelector('#e' + id) != null)
                {
                    if (elemento.Nombre.toLowerCase().includes(filtro) || elemento.Descipcion.toLowerCase().includes(filtro) )
                    {
                        document.querySelector('#e' + id).style = "display:table-row;";
                    } 

                    else 
                    {   
                        document.querySelector('#e' + id).style ="display:none;";
                    }
                } 
            }   
        )
    }

    else
    {
        for(let i = 0; i<elementos.length;i++)
        {
            if (document.querySelector('#e'+i) != null)
            {
                document.querySelector('#e'+i).style = "display:table-row;";
            }
           
        }
    }
}



function limpia()
{
    document.getElementById('busqueda').value="";
    filtro();
}










