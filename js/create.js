
const formulario = document.getElementById('formu');



formulario.addEventListener('submit',(e)=>{
  e.preventDefault();


  
  Swal.fire({
    title: 'crear el elemento?',
    text: "Se creara un objeto!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'NO, RECHAZO!',
    confirmButtonText: 'SI, CONFIRMO!'

    
  }).then((result) => {
    if (result.isConfirmed) {

      const formData = new FormData(formulario);
      fetch('./ws/createElement2.php',
      {
          method:'POST',
          body:formData
      })
    .then(response => response.json()).then(response => {
      if(response.success){
          Swal.fire(
              'Elemento Creado',
              response.message,
              'success'
            ) 
        
      formulario.reset();
      } 
      else{
          Swal.fire(
              'Elemento no creado',
              response.message,
              'error')
      }
  })
  
  }
})
})




//  function crear(){


// const formData = new FormData(document.getElementById('formu'));
//  fetch('./ws/createElement2.php',
//      {
//        method:'POST',
//         body:formData
//     })
       
// }

