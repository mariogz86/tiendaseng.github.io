<html>
    <head>
        <!-- CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        
        <script src="https://code.jquery.com/jquery-3.0.0.js"crossorigin="anonymous"></script>
        <!-- jQuery and JS bundle w/ Popper.js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
	</head>
    <body>
        <div id="contenido"  class="container-fluid"  >
 

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Conversacion Interna</label>
                <textarea class="form-control" id="txtchat" rows="10" readonly></textarea>
            </div>  
            
            <div class="form-group"> 
            <label for="exampleFormControlTextarea1">Escriba aqui</label>
                <textarea class="form-control" id="txtchatenviar" rows="3" onkeypress="pulsar(event)"></textarea>
            </div>   
            <button type="submit" class="btn btn-primary mb-2" id="btnborrar">Borrar Conversacion</button>
           
        </div> 
    </body>
    <script>
        window.onload = function() {
            Obtener(); 
			
			
        };

        function IrFormularioCrear(){
            window.location = "Registro.html";
        }

        function Obtener(){

            $(".table tbody").html("");

            $.get("https://localhost:7011/api/Usuario/listar")
            .done(function( response ) {
                console.log(response);
                $.each( response, function( id, fila ) {
                    $("<tr>").append(
                        $("<td>").text(fila.idUsuario),
                        $("<td>").text(fila.documentoIdentidad),
                        $("<td>").text(fila.nombres),
                        $("<td>").text(fila.telefono),
                        $("<td>").text(fila.correo),
                        $("<td>").text(fila.ciudad),
                        $("<td>").append(
                            $("<button>").data("id",fila.idUsuario).addClass("btn btn-success btn-sm mr-1 editar").text("Editar").attr({"type":"button"}),
                            $("<button>").data("id",fila.idUsuario).addClass("btn btn-danger btn-sm eliminar").text("Eliminar").attr({"type":"button"})
                        )
                    ).appendTo(".table");
                });
            });
        }

        $(document).on('click', '.editar', function () {
            console.log($(this).data("id"));
            window.location = "Registro.html?id=" + $(this).data("id");
            
        });


        $(document).on('click', '.eliminar', function () {
            console.log($(this).data("id"));

            $.ajax({
            method: "POST",
            url: "https://mgomez:443/usuario/eliminar?id=" + $(this).data("id")
            })
            .done(function( response ) {
                console.log(response);
                if(response){
                    Obtener();
                }else{
                    alert("Error al eliminar")
                }
            });
            
        });


    </script>
</html>