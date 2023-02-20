function revisarItemSuma()
{
    alert('click en sumar ');
}



$(".btn_realizar_fusion").click(function()
{   
    // var idCotizacion = 'idCotizacion=' + $(this).attr('value');
    var data =  'ordenfusionar=' + $("#ordenfusionar").val();
    // alert(idCotizacion); 
    const http=new XMLHttpRequest();
    const url = '../cotizaciones/realizarfusionarcotizacionorden.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("cuerpoModalClientes").innerHTML = this.responseText;
        }
    };

    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("idCotizacion="+data);
        


})