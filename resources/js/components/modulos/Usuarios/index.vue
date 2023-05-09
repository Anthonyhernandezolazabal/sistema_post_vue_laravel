<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>

    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <button
            type="button"
            data-toggle="modal"
            data-target="#modal_usuario"
            class="btn btn-primary btn-flat m_a_u"
          >
            Agregar Usuario
          </button>
          <div class="card-tools">
            <button
              type="button"
              class="btn btn-tool"
              data-card-widget="collapse"
              title="Collapse"
            >
              <i class="fas fa-minus"></i>
            </button>
            <button
              type="button"
              class="btn btn-tool"
              data-card-widget="remove"
              title="Remove"
            >
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">Start creating your amazing application!</div>
        <!-- /.card-body -->
        <div class="card-footer">Footer</div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
    </section>

    <!--=====================================
    MODAL AGREGAR USUARIO
    ======================================-->
    <div class="modal fade" id="modal_usuario">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><b>Agregar usuario</b></h4>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-7">
                  <div class="card card-outline card-primary">
                    <div class="card-header">
                      <h3 class="card-title">
                        <i class="fas fa-clipboard-list"></i>
                        Datos de usuario
                      </h3>
                    </div>

                    <div class="card-body">
                      <!-- ENTRADA PARA EL NOMBRE -->
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="nuevoNombre" placeholder="Nombre" required/>
                      </div>

                      <!-- ENTRADA PARA EL USUARIO -->
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-key"></i></span>
                        </div>
                        <input type="text" class="form-control" name="nuevoUsuario" id="nuevoUsuario" placeholder="Usuario" />
                      </div>
                      <!-- ENTRADA PARA LA CONTRASEÑA -->
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="password" class="form-control" name="nuevoPassword" placeholder="Contraseña" />
                      </div>
                      <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-key"></i></span>
                        </div>

                        <select class="form-control input-lg" name="nuevoPerfil">
                          <option value="">Selecionar perfil</option>

                          <option value="Administrador">Administrador</option>

                          <option value="Especial">Especial</option>

                          <option value="Vendedor">Vendedor</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- ENTRADA PARA SUBIR FOTO -->
                <div class="col-md-5">
                  <div class="card card-outline card-primary">
                    <div class="card-header">
                      <h3 class="card-title">
                        <i class="fas fa-image"></i>

                        SUBIR FOTO
                      </h3>
                    </div>

                    <div class="card-body">
                      <div class="form-group">
                        <small class="text-primary">Seleccione una <cite title="Source Title">Imagen</cite></small>

                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input nuevaFoto" id="exampleInputFile" name="nuevaFoto"/>

                            <label class="custom-file-label" for="exampleInputFile">Subir archivo</label>
                          </div>
                        </div>
                        <small class="text-muted">Peso máximo de la foto<cite title="Source Title">2MB</cite></small>
                        <br />
                        <center>
                          <img :src="'./img/default.png'" class="img-thumbnail previsualizar mt-2" width="107px" />
                        </center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">
                Salir
              </button>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

  <script>
export default {
  mounted() {
    console.log("Component index.");
  },
};
</script>
