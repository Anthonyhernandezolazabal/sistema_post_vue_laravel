<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Crear nuevo cliente</h1>
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
                        v-model="fillCrearCliente.cNombre"
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
                        v-model="fillCrearCliente.cApellidos"
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
                    v-model="fillCrearCliente.cDocumento"
                    placeholder="N° de Documento de identidad"
                  />
                </div>
                <div class="form-group">
                  <label for="">Teléfono</label>
                  <input
                    type="number"
                    class="form-control form-control-border border-width-2"
                    v-model="fillCrearCliente.cTelefono"
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
                    v-model="fillCrearCliente.cEmail"
                    placeholder="Dirección de Correo Electrónico"
                  />
                </div>
                <div class="form-group">
                  <label for="">Dirección</label>
                  <input
                    type="text"
                    class="form-control form-control-border border-width-2"
                    v-model="fillCrearCliente.cDireccion"
                    placeholder="Dirección de domicilio"
                  />
                </div>
                <div class="form-group">
                  <label for="">Fecha nacimiento</label>
                  <input
                    type="date"
                    class="form-control form-control-border border-width-2"
                    v-model="fillCrearCliente.cFnacimiento"
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
            <i class="fas fa-save"></i> Registrar
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
      fillCrearCliente: {
        cNombre: "",
        cApellidos: "",
        cDocumento: "",
        cTelefono: "",
        cEmail: "",
        cDireccion: "",
        cFnacimiento: "",
        cEstado: 0,
      },
      error: 0,
      fullscreenLoading: false,
    };
  },
  methods: {
    setRegistrarCliente() {
      this.fullscreenLoading = true;
      if (this.validarRegistroCliente()) {
        this.fullscreenLoading = false;
        return;
      } else {
        this.fullscreenLoading = true;
        axios
          .post("/cliente/setRegistrarCliente", {
            nombre: this.fillCrearCliente.cNombre,
            apellidos: this.fillCrearCliente.cApellidos,
            documento: this.fillCrearCliente.cDocumento,
            email: this.fillCrearCliente.cEmail,
            telefono: this.fillCrearCliente.cTelefono,
            direccion: this.fillCrearCliente.cDireccion,
            fecha_nacimiento: this.fillCrearCliente.cFnacimiento,
          })
          .then((rpta) => {
            if (rpta.data == "existeDocumento") {
                toastr.warning("El N° de documento ya existe!");
                this.fullscreenLoading = false;
            } else if (rpta.data == "existeEmail") {
                toastr.warning("El correo electrónico ya existe!");
                this.fullscreenLoading = false;
            } else {
                toastr.success("Cliente nuevo registrado!");
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

      if (!this.fillCrearCliente.cNombre) {
        toastr.error("El Nombre es un campo obligatorio.");
        this.error = 1;
      }
      if (!this.fillCrearCliente.cApellidos) {
        toastr.error("El apellido es un campo obligatorio.");
        this.error = 1;
      }
      if (!this.fillCrearCliente.cDocumento) {
        toastr.error("El N° de documento es un campo obligatorio.");
        this.error = 1;
      }
      if ((this.fillCrearCliente.cDocumento).length != 8) {
        toastr.error("El N° de documento tiene que tener 8 dígitos.");
        this.error = 1;
      }
      if (!this.fillCrearCliente.cTelefono) {
        toastr.error("El teléfono es un campo obligatorio.");
        this.error = 1;
      }
      if ((this.fillCrearCliente.cTelefono).length != 11) {
        toastr.error("Considerar 51 en el teléfono.");
        this.error = 1;
      }
      if (!this.fillCrearCliente.cEmail) {
        toastr.error("El correo es un campo obligatorio.");
        this.error = 1;
      }
      if (!this.verificarCorreo(this.fillCrearCliente.cEmail)) {
        toastr.error("Datos inválidos para el correo.");
        this.error = 1;
      }
      if (!this.fillCrearCliente.cDireccion) {
        toastr.error("La dirección es un campo obligatorio.");
        this.error = 1;
      }
      if (!this.fillCrearCliente.cFnacimiento) {
        toastr.error("La F. nacimiento es un campo obligatorio.");
        this.error = 1;
      }

      return this.error;
    }
  },
};
</script>
