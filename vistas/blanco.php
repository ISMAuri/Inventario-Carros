<?php

    require_once "head.php";
    if (!isset($_SESSION['nombre']) || empty($_SESSION['nombre'])) {
    header("Location: login.html");
    exit();
}
?>


  <div class="content-wrapper">



        <!-- BODY -->
        <div class="card-body">

            <form id="formularioUsuario"
                method="POST"
                enctype="multipart/form-data">

                <input type="hidden"
                    name="idusuario"
                    id="idusuario">

                <!-- FILA 1 -->
                <div class="row">

                    <!-- NOMBRE -->
                    <div class="col-md-3">

                        <div class="form-group">

                            <label>Nombre</label>

                            <input type="text"
                                name="nombre"
                                id="nombre"
                                class="form-control"
                                placeholder="Nombre completo"
                                required>

                        </div>

                    </div>

                    <!-- LOGIN -->
                    <div class="col-md-3">

                        <div class="form-group">

                            <label>Login</label>

                            <input type="text"
                                name="login"
                                id="login"
                                class="form-control"
                                placeholder="Usuario"
                                required>

                        </div>

                    </div>

                    <!-- CLAVE -->
                    <div class="col-md-3">

                        <div class="form-group">

                            <label>Clave</label>

                            <input type="password"
                                name="clave"
                                id="clave"
                                class="form-control"
                                placeholder="********"
                                required>

                        </div>

                    </div>

                    <!-- CARGO -->
                    <div class="col-md-3">

                        <div class="form-group">

                            <label>Cargo</label>

                            <input type="text"
                                name="cargo"
                                id="cargo"
                                class="form-control"
                                placeholder="Cargo">

                        </div>

                    </div>

                </div>

                <!-- FILA 2 -->
                <div class="row">

                    <!-- IMAGEN -->
                    <div class="col-md-4">

                        <div class="form-group">

                            <label>Imagen</label>

                            <input type="file"
                                name="imagen"
                                id="imagen"
                                class="form-control">

                        </div>

                    </div>

                    <!-- ESTADO -->
                    <div class="col-md-4">

                        <div class="form-group">

                            <label>Estado</label>

                            <select name="condicion"
                                id="condicion"
                                class="form-control">

                                <option value="1">
                                    Activado
                                </option>

                                <option value="0">
                                    Desactivado
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

              
                <div class="row mt-3">

                    <div class="col-md-12">

                        <div class="card border-primary">

                            <div class="card-header bg-primary text-white">

                                <i class="fas fa-user-shield"></i>
                                Permisos del Usuario

                            </div>

                            <div class="card-body">

                                <div class="row">
                                    <label>Permisos</label>
                                    <div id="listadopermisos"></div>
                                  
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- BOTONES -->
                <div class="row mt-4">

                    <div class="col-md-12 text-center">

                        <button type="submit"
                            class="btn btn-success">

                            <i class="fas fa-save"></i>
                            Guardar Usuario

                        </button>

                        <button type="reset"
                            class="btn btn-danger">

                            <i class="fas fa-times"></i>
                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

  </div>



<?php
    
    require_once "footer.php";
?>


