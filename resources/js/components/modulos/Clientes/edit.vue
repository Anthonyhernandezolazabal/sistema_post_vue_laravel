<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar cliente</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link :to="'/'">Inicio</router-link>
              </li>
              <li class="breadcrumb-item">
                <router-link :to="'/clientes'">Clientes</router-link>
              </li>
              <li class="breadcrumb-item active">Nuevo cliente</li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <!-- Default box -->
        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Nombre</label>
                      <input
                        type="text"
                        class="form-control form-control-border border-width-2"
                        v-model="fillEditarCliente.cNombre"
                        placeholder="Escribre aquí el nombre"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Apellidos</label>
                      <input
                        type="text"
                        class="form-control form-control-border border-width-2"
                        v-model="fillEditarCliente.cApellidos"
                        placeholder="Paterno | Materno"
                      />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="">Documento</label>
                  <input
                    type="number"
                    class="form-control form-control-border border-width-2"
                    v-model="fillEditarCliente.cDocumento"
                    placeholder="N° de Documento de identidad"
                  />
                </div>
                <div class="form-group">
                  <label for="">Teléfono</label>
                  <input
                    type="number"
                    class="form-control form-control-border border-width-2"
                    v-model="fillEditarCliente.cTelefono"
                    placeholder="+51 ___ __ __ __"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <div class="form-group">
                  <label for="">Correo Electrónico</label>
                  <input
                    type="email"
                    class="form-control form-control-border border-width-2"
                    v-model="fillEditarCliente.cEmail"
                    placeholder="Dirección de Correo Electrónico"
                  />
                </div>
                <div class="form-group">
                  <label for="">Dirección</label>
                  <input
                    type="text"
                    class="form-control form-control-border border-width-2"
                    v-model="fillEditarCliente.cDireccion"
                    placeholder="Dirección de domicilio"
                  />
                </div>
                <div class="form-group">
                  <label for="">Fecha nacimiento</label>
                  <input
                    type="date"
                    class="form-control form-control-border border-width-2"
                    v-model="fillEditarCliente.cFnacimiento"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
        <router-link
          :to="'/clientes'"
          class="btn btn-outline-secondary btn-flat"
          ><i class="fas fa-times"></i> Cerrar</router-link
        >
        <button
          type="button"
          @click.prevent="setRegistrarCliente()"
          :disabled="fullscreenLoading"
          class="btn btn-outline-info btn-flat"
        >
          <i class="fas fa-edit"></i> Editar
        </button>
      </div>
      <!-- /.card -->
    </section>
  </div>
</template>

    <script>
export default {
  mounted() {
    console.log("Component index.");
  },
  data() {
    return {
      fillEditarCliente: {
        cNombre: "",
        cApellidos: "",
        cDocumento: "",
        cTelefono: "",
        cEmail: "",
        cDireccion: "",
        cFnacimiento: "",
        cEstado: 0,
      },
      obtengoId: this.$route.params.id,
      error: 0,
      fullscreenLoading: false,
    };
  },
  created() {
    this.setDatosCliente();
  },
  methods: {
    setDatosCliente() {
      axios
        .get("/cliente/getListarPorCliente/" + this.obtengoId)
        .then((rpta) => {
          (this.fillEditarCliente.cNombre = rpta.data.nombre),
            (this.fillEditarCliente.cApellidos = rpta.data.apellidos),
            (this.fillEditarCliente.cDocumento = rpta.data.documento),
            (this.fillEditarCliente.cEmail = rpta.data.email),
            (this.fillEditarCliente.cTelefono = rpta.data.telefono),
            (this.fillEditarCliente.cDireccion = rpta.data.direccion),
            (this.fillEditarCliente.cFnacimiento = rpta.data.fecha_nacimiento);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    setRegistrarCliente() {
      this.fullscreenLoading = true;
      if (this.validarRegistroCliente()) {
        this.fullscreenLoading = false;
        return;
      } else {
        this.fullscreenLoading = true;
        axios
          .post("/cliente/editCliente/"+this.obtengoId, {
            nombre: this.fillEditarCliente.cNombre,
            apellidos: this.fillEditarCliente.cApellidos,
            documento: this.fillEditarCliente.cDocumento,
            email: this.fillEditarCliente.cEmail,
            telefono: this.fillEditarCliente.cTelefono,
            direccion: this.fillEditarCliente.cDireccion,
            fecha_nacimiento: this.fillEditarCliente.cFnacimiento,
          })
          .then((rpta) => {
            if (rpta.data == "existeDocumento") {
              toastr.warning("El N° de documento ya existe!");
              this.fullscreenLoading = false;
            } else if (rpta.data == "existeEmail") {
              toastr.warning("El correo electrónico ya existe!");
              this.fullscreenLoading = false;
            } else {
              toastr.success("Cliente "+this.fillEditarCliente.cNombre+" editado!");
              this.$router.push("/clientes");
              this.fullscreenLoading = false;
            }
          })
          .catch((err) => {
            toastr.error("Ocurrió un error al registrar");
            this.fullscreenLoading = false;
          });
      }
    },
    verificarCorreo($n) {
      var ExpRegular_Correo = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
      return ExpRegular_Correo.test($n);
    },
    validarRegistroCliente() {
      this.error = 0;

      if (!this.fillEditarCliente.cNombre) {
        toastr.error("El Nombre es un campo obligatorio.");
        this.error = 1;
      }
      if (!this.fillEditarCliente.cApellidos) {
        toastr.error("El apellido es un campo obligatorio.");
        this.error = 1;
      }
      if (!this.fillEditarCliente.cDocumento) {
        toastr.error("El N° de documento es un campo obligatorio.");
        this.error = 1;
      }
      if (this.fillEditarCliente.cDocumento.length != 8) {
        toastr.error("El N° de documento tiene que tener 8 dígitos.");
        this.error = 1;
      }
      if (!this.fillEditarCliente.cTelefono) {
        toastr.error("El teléfono es un campo obligatorio.");
        this.error = 1;
      }
      if (this.fillEditarCliente.cTelefono.length != 11) {
        toastr.error("Considerar 51 en el teléfono.");
        this.error = 1;
      }
      if (!this.fillEditarCliente.cEmail) {
        toastr.error("El correo es un campo obligatorio.");
        this.error = 1;
      }
      if (!this.verificarCorreo(this.fillEditarCliente.cEmail)) {
        toastr.error("Datos inválidos para el correo.");
        this.error = 1;
      }
      if (!this.fillEditarCliente.cDireccion) {
        toastr.error("La dirección es un campo obligatorio.");
        this.error = 1;
      }
      if (!this.fillEditarCliente.cFnacimiento) {
        toastr.error("La F. nacimiento es un campo obligatorio.");
        this.error = 1;
      }

      return this.error;
    },
  },
};
</script>
