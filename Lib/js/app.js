
var preload = document.getElementById('preload');
preload.style.display = 'none';

//Validar formulario

//enviar datos al backend
var formUser = document.getElementById('formUser');
var msj = document.getElementById('msj');
formUser.addEventListener('submit',function(event){
    preload.style.display = 'block';

    event.preventDefault();
    var datos = new FormData(formUser);
        
    fetch("http://localhost/testInfocontrol/?user/save",{
        method : 'POST',
        body : datos
    })
    .then(res => res.json())
    .then(data => {
        if(data.error){
            msj.innerHTML=`
                <div class="alert alert-danger" role="alert">
                <h4>Atencion</h4>
                ${data.error.nombre ? data.error.nombre+'</br>' : ''}
                ${data.error.apellido ? data.error.apellido+'</br>' : ''}
                ${data.error.username ? data.error.username+'</br>' : ''}
                ${data.error.password ? data.error.password+'</br>' : ''}
                ${data.error.provincia ? data.error.provincia+'</br>' : ''}
                ${data.error.numero ? data.error.numero+'</br>' : ''}
                ${data.error.fecha ? data.error.fecha+'</br>' : ''}
            </div>`
        }else if(data.exito){
            swal.fire({
                icon: 'success',
                title: data.exito,
                toast: false,
                showConfirmButton: false,
            });
            setInterval(() => {
                window.location.href="http://localhost/testInfocontrol/?user/registerEdit/&id="+data.id;
            }, 4000);
        }
    
        preload.style.display = 'none';
    });
});