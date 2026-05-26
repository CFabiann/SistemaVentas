//EDITAR USUARIO


$(".tablas").on("click", ".btnEditarUsuario", function(){


    var idUsuario=$(this).attr("idUsuario");

    var datos = new FormData();

    datos.append("idUsuario", idUsuario);   

    $.ajax({

        url:"ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,   
        contentType:false,
        processData:false,
        dataType:"json",
        success: function(respuesta){

            $("#editarNombre").val(respuesta["nombre"]);
            $("#editarUsuario").val(respuesta["usuario"]);
            $("#editarPerfil").html(respuesta["perfil"]);
            $("#editarPerfil").val(respuesta["perfil"]);
            $("#fotoActual").val(respuesta["foto"]);

            $("#passwordActual").val(respuesta["password"]);

            if (respuesta["foto"] != "") {

                $(".previsualizarEditar").attr("src", respuesta["foto"]);
                
            }else{
                $(".previsualizarEditar").attr("src", "vistas/img/usuarios/default/anonymous.png")
            }


        

        


        }
    })
})