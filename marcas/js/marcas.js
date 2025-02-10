function marcas()
{
    //  alert('funcion javascript');
    const http=new XMLHttpRequest();
    const url = '../marcas/marcas.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_principal_marcas").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=menuMarcas'
    );
}

function formuNuevaMarca()
{
    //  alert('funcion javascript');
    const http=new XMLHttpRequest();
    const url = '../marcas/marcas.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodyNuevaMarca").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=formuNuevaMarca'
    );
}
function formuNuevaLinea(idMarca)
{
    //  alert('funcion javascript');
    const http=new XMLHttpRequest();
    const url = '../marcas/marcas.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodyNuevaLinea").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=formuNuevaLinea'
    +'&idMarca='+idMarca
    );
}


function grabarNuevaMarca()
{
    // var valida =  validaInfoParqueadero();
    // if(valida == '1')
    // {
        var nombreMarca = document.getElementById('nombreMarca').value;
        const http=new XMLHttpRequest();
        const url = '../marcas/marcas.php';
        http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                           document.getElementById("modalBodyNuevaMarca").innerHTML  = this.responseText;
                    }
                };
                http.open("POST",url);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.send('opcion=grabarNuevaMarca'
                    +'&nombreMarca='+nombreMarca
                );
    // }
}


function grabarNuevaLinea()
{
    // var valida =  validaInfoParqueadero();
    // if(valida == '1')
    // {
        var idMarca = document.getElementById('idMarcaLinea').value;
        var nombreLinea = document.getElementById('nombreLinea').value;
        const http=new XMLHttpRequest();
        const url = '../marcas/marcas.php';
        http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                           document.getElementById("modalBodyNuevaLinea").innerHTML  = this.responseText;
                    }
                };
                http.open("POST",url);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.send('opcion=grabarNuevaLinea'
                    +'&nombreLinea='+nombreLinea
                    +'&idMarca='+idMarca
                );
    // }
}
function mostrarLineasMarca(idMarca)
{
    // var valida =  validaInfoParqueadero();
    // if(valida == '1')
    // {
       
        const http=new XMLHttpRequest();
        const url = '../marcas/marcas.php';
        http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                           document.getElementById("div_lineas").innerHTML  = this.responseText;
                    }
                };
                http.open("POST",url);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.send('opcion=mostrarLineasMarca'
                    +'&idMarca='+idMarca
                );
    // }
}

function mostrarLineasMarcasDesdeBotonCerrar()
{
    // var valida =  validaInfoParqueadero();
    // if(valida == '1')
    // {
        var idMarca = document.getElementById('idMarca').value;
        const http=new XMLHttpRequest();
        const url = '../marcas/marcas.php';
        http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                           document.getElementById("div_lineas").innerHTML  = this.responseText;
                    }
                };
                http.open("POST",url);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.send('opcion=mostrarLineasMarca'
                    +'&idMarca='+idMarca
                );
    // }
}

// function  validaInfoParqueadero()
// {
//     if( document.getElementById('nombreParqueadero').value == ''){
//         alert('Por favor digitar nombre');
//         document.getElementById('nombreParqueadero').focus();
//         return 0;
//     }
//     if( document.getElementById('direccionParqueadero').value == ''){
//         alert('Por favor digitar direccion');
//         document.getElementById('direccionParqueadero').focus();
//         return 0;
//     }
//     if( document.getElementById('telefonoParqueadero').value == ''){
//         alert('Por favor digitar telefono');
//         document.getElementById('telefonoParqueadero').focus();
//         return 0;
//     }
//     if( document.getElementById('emailParqueadero').value == ''){
//         alert('Por favor digitar email');
//         document.getElementById('emailParqueadero').focus();
//         return 0;
//     }
//     if( document.getElementById('manejaiva').value == ''){
//         alert('Por favor indicar si maneja iva');
//         document.getElementById('manejaiva').focus();
//         return 0;
//     }
//     return 1;
// }
