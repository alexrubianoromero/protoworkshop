function pantallagastos(idOrden)
{
    //  alert('pantalla gastos '+ idOrden); 
    const http=new XMLHttpRequest();
    const url = '../gastosorden/pantallagastosorden.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("contenidos").innerHTML = this.responseText;
        }
    };

    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(
     "id="+idOrden
    );
}

function agregarGasto(idOrden)
{
    var proveedor = document.getElementById("proveedor").value;
    var descripcion = document.getElementById("descripciongasto").value;
    var valor = document.getElementById("valorgasto").value;
    const http=new XMLHttpRequest();
    const url = '../gastosorden/adicionargasto.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("div_principal_gastos").innerHTML = this.responseText;
        }
    };
    
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(
        "id="+idOrden
        + "&descripcion="+descripcion
        + "&valor="+valor
        + "&proveedor="+proveedor
        );
        
    }
    
    function eliminargastoorden(idGasto)
    {
        // alert('id'+idGasto)
        var id = document.getElementById("id").value;
        const http=new XMLHttpRequest();
        const url = '../gastosorden/eliminargastoorden.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("div_principal_gastos").innerHTML = this.responseText;
            }
        };
        
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send(
            "idGasto="+idGasto
            + "&id="+id
    );

}