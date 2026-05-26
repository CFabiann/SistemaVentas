<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Administrar Usuarios
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrar Usuarios</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"
                    title="Collapse">
                    Agregar Usuario
                </button>



            </div>
            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

                    <thead>
                        <tr>
                            <th># </th>
                            <th>Nombre </th>
                            <th>Usuario </th>
                            <th>Foto </th>
                            <th>Perfil </th>
                            <th>Estado </th>
                            <th>Acciones </th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        $item = null;
                        $valor = null;

                        $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                        foreach ($usuarios as $key => $value) {
                            echo '
                        <tr>
                            <td>' . $value["id"] . '</td>
                            <td>' . $value["nombre"] . '</td>
                            <td>' . $value["usuario"] . '</td>
                            <td><img src="' . $value["foto"] . '" width="40px"></td>
                            <td>' . $value["perfil"] . '</td>
                            <td><button class="btn btn-success btn-xs">Activado</button></td>
                            <td>
                                <div class="btn-group">

                                    <button class="btn-primary btnEditarUsuario" idUsuario="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarUsuario">
                                        <i class="fa fa-pencil"></i>
                                    </button>

                                    <button class="btn-danger btnElinimarUsuario" idUsuario="' . $value["id"] . '" fotoUsuario="' . $value["foto"] . '" usuario="' . $value["usuario"] . '">
                                        <i class="fa fa-times"></i>
                                    </button>

                                </div>
                            </td>


                        </tr>
                        ';
                        }
                        ?>


                    </tbody>

                </table>

            </div>


        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>

<!--Modal agregar usuario -->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">

                <!--CABEZA DEL MODAL -->

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4>Agregar Usuario</h4>

                </div>

                <!--CUERPO DEL MODAL -->
                <div class="modal-body">
                    <div class="box-body">
                        <!--ENTRADA NOMBRE -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control input-lg" name="nuevoNombre"
                                    placeholder="Ingresar nombre" required>
                            </div>

                        </div>

                        <!--ENTRADA USUARIO-->
                        <div class="form-group">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="text" class="form-control input-lg" name="nuevoUsuario"
                                    placeholder="Ingresar Usuario" id="nuevoUsuario" required>
                            </div>

                        </div>


                        <!--ENTRADA CONTRASEÑA-->

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control input-lg" name="nuevoPassword"
                                    placeholder="Ingresar Contraseña" required>

                            </div>

                        </div>

                        <!--ENTRADA PARA PERFIL -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <select class="form-control input-lg" name="nuevoPerfil">
                                    <option value="">Seleccionar Perfil</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Especial">Especial</option>
                                    <option value="Vendedor">Vendedor</option>
                                </select>

                            </div>
                        </div>

                        <!--ENTRADA FOTO-->
                        <div class="form-group">
                            <div class="panel">SUBIR FOTO</div>
                            <input type="file" class="nuevaFoto" name="nuevaFoto">
                            <p class="help-block">Peso maximo de la foto 2MB</p>
                            <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar"
                                width="200px" height="200px ">
                        </div>


                    </div>
                </div>

                <!--PIE MODAL-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar usuario</button>
                </div>


                <?php

                $crearUsuario = new ControladorUsuarios();
                $crearUsuario->ctrCrearUsuario();
                ?>


            </form>
        </div>
    </div>
</div>


<!--MODAL EDITAR USUARIO-->

<div id="modalEditarUsuario" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">

                <!--CABEZA DEL MODAL-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-tittle">Editar Usuario</h4>

                </div>

                <!--CUERPO DEL MODAL-->

                <div class="modal-body">

                    <div class="box-body">

                        <!--ENTRADA PARA EL NOMBRE-->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="fa fa-user"></i> </span>

                                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>

                            </div>


                        </div>


                        <!--ENTRADA PARA EL USUARIO-->
                        <div class="form-group">

                            <div class="input-group">
                                <span class="input-group-addon"> <i class="fa fa-key"></i> </span>


                                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>

                            </div>

                        </div>


                        <!--ENTRADA PARA LA CONTRASEÑA-->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"> <i class="fa fa-lock"></i> </span>

                                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña">

                                <input type="hidden" id="passwordActual" name="passwordActual">

                            </div>
                        </div>


                        <!--ENTRADA PARA SELECCIONAR PERFIL-->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"> <i class="fa fa-users"></i> </span>

                                <select class="form-control input-lg" name="editarPerfil">

                                    <option value="" id="editarPerfil"></option>

                                    <option value="Administrador">Administrador</option>

                                    <option value="Especial">Especial</option>

                                    <option value="Vendedor">Vendedor</option>

                                </select>

                            </div>
                        </div>

                        <!--ENTRADA PARA SUBIR FOTO-->

                        <div class="form-group">
                            <div class="panel">SUBIR FOTO</div>
                            <input type="file" class="nuevaFoto" name="editarFoto">

                            <p class="help-block">Peso maximo de la foto 2MB</p>

                            <img src="vistas/img/usuarios/default/anonymous.png"
                                class="img-thumbnail previsualizarEditar" width="100px">

                        </div>

                    </div>
                </div>

                <!--PIE DEL MODAL-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary">Modificar Usuario</button>

                </div>





            </form>

            <?php 

            $editarUsuario = new ControladorUsuarios();
            $editarUsuario -> ctrEditarUsuario();
             ?>



        </div>
    </div>
</div>