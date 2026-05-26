<?php



class ControladorUsuarios
{

    /*MOSTRAR USUARIOS*/
    static public function ctrMostrarUsuarios($item, $valor)
    {

        $tabla = "usuarios";

        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

        return $respuesta;
    }



    /*========EDITAR USUARIO========= */

    static public function ctrEditarUsuario()
    {
        if (isset($_POST["editarNombre"])) {


            /*===VALIDAR IMAGEN=== */

            $ruta = $_POST["fotoActual"];
            if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])) {

                list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);
                $nuevoAncho = 500;
                $nuevoAlto = 500;
                


                /* CREAMOS NUEVO DIRECTORIO DONDE SE GUARDAN LAS FOTOS DE USAURIO*/

                $directorio = "vistas/img/usuarios/" . $_POST["editarUsuario"];


                /* PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BASE DE DATOS*/

                if (!empty($_POST["fotoActual"])) {

                    unlink($_POST["fotoActual"]);
                } else {
                    mkdir($directorio, 0755);
                }

                /*=====DE ACUERDO AL TIPO DE IMAGEN=====*/


                if ($_FILES["editarFoto"]["type"] == "image/jpeg") {

                    /*=====GUARDAMOS LA IMAGEN======*/
                    $aleatorio = mt_rand(100, 999);

                    $ruta = "vistas/img/usuarios/" . $_POST["editarUsuario"] . "/" . $aleatorio . ".jpg";

                    $origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);

                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    imagejpeg($destino, $ruta);
                }

                if ($_FILES["editarFoto"]["type"] == "image/png") {

                    /*=====GUARDAMOS LA IMAGEN======*/

                    $aleatorio = mt_rand(100, 999);

                    $ruta = "vistas/img/usuarios/" . $_POST["editarUsuario"] . "/" . $aleatorio . ".png";

                    $origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);

                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    imagepng($destino, $ruta);
                }
            }

            $tabla = "usuarios";

            if ($_POST["editarPassword"] != "") {

                $encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
            }else{
                $encriptar = $_POST["passwordActual"];
            }
 
            $datos = array(
                "nombre" => $_POST["editarNombre"],
                "usuario" => $_POST["editarUsuario"],
                "password" => $encriptar,
                "perfil" => $_POST["editarPerfil"],
                "foto" => $ruta
            );

            $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

        if ($respuesta == "ok") {
            echo "<script>
            Swal.fire({
            title: 'El usuario ha sido editado correctamente',
            icon: 'success',
            }).then((result) => {
            window.location = 'usuarios';
            })
            </script>";
        }
        }
    }

    /*
    RESGISTRO DE usuario
    */

    static public function ctrCrearUsuario()
    {
        if (isset($_POST["nuevoNombre"])) {

            /*
        VALIDAR IMAGEN
    */
            $ruta = "";

            if (isset($_FILES["nuevaFoto"]["tmp_name"])) {
                list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

                $nuevoAncho = 500;
                $nuevoAlto = 500;


                $directorio = "vistas/img/usuarios/" . $_POST["nuevoUsuario"];
                mkdir($directorio, 0755);


                if ($_FILES["nuevaFoto"]["type"] == "image/jpeg") {



                    $aleatorio = mt_rand(100, 999);
                    $ruta = "vistas/img/usuarios/" . $_POST["nuevoUsuario"] . "/" . $aleatorio . ".jpg";

                    $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    imagejpeg($destino, $ruta);
                }




                if ($_FILES["nuevaFoto"]["type"] == "image/png") {


                    $aleatorio = mt_rand(100, 999);
                    $ruta = "vistas/img/usuarios/" . $_POST["nuevoUsuario"] . "/" . $aleatorio . ".png";

                    $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    imagepng($destino, $ruta);
                }
            }


            $tabla = "usuarios";

            $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

            $datos = array(
                "nombre" => $_POST["nuevoNombre"],
                "usuario" => $_POST["nuevoUsuario"],
                "password" => $encriptar,
                "perfil" => $_POST["nuevoPerfil"],
                "foto" => $ruta
            );


            $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

            if ($respuesta == "ok") {

                echo "<script>    
              Swal.fire({
              title: 'EL usuario ha sido guardado correctamente',
              icon:'success',
              }).then((result) => {
              window.location = 'usuarios' ;
              })
              </script>";
            }
        }
    }
}
