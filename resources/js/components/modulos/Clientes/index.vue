<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              Administrar clientes
              <router-link
                :to="'/clientes/crear-cliente'"
                style="border-radius: 100%"
                class="btn btn-outline-info"
              >
                <i class="fa-solid fa-plus"></i>
              </router-link>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Clientes</li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <!-- Default box -->

        <div class="card card-info card-outline">
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th class="text-center" style="width: 10px">#</th>
                  <th class="text-center">nombre</th>
                  <th class="text-center">documento</th>
                  <th class="text-center">compras</th>
                  <th class="text-center">ultima_compra</th>
                  <th class="text-center">Estado</th>
                  <th class="text-center">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in listClientes" :key="item.id">
                  <td class="text-center" v-text="item.id"></td>
                  <td class="text-center" v-text="item.nombre"></td>
                  <td class="text-center" v-text="item.documento"></td>
                  <td class="text-center" v-text="item.compras"></td>
                  <td
                    class="text-center"
                    v-if="item.ultima_compra != null"
                    v-text="item.ultima_compra"
                  ></td>
                  <td class="text-center" v-else>-</td>

                  <td class="project-state text-center">
                    <span
                      style="cursor: pointer"
                      v-if="item.estado === 0"
                      class="badge badge-success"
                      v-on:click="cambiarEstadoCliente(item.estado, item.id)"
                      >Activo</span
                    >
                    <span
                      style="cursor: pointer"
                      v-else-if="item.estado === 1"
                      class="badge badge-danger"
                      v-on:click="cambiarEstadoCliente(item.estado, item.id)"
                      >Inactivo</span
                    >
                    <span v-else class="badge badge-danger">Error</span>
                  </td>
                  <td class="project-actions text-center">
                    <button
                      type="button"
                      class="btn btn-info btn-sm"
                      data-toggle="modal"
                      data-target="#showClientes"
                      @click.prevent="getDatosPorCliente(item.id)"
                    >
                      <i class="fas fa-eye"></i>
                    </button>
                    <router-link :to="'/clientes/editar-cliente/'+item.id+''" class="btn btn-warning btn-sm">
                      <i class="fas fa-pencil-alt"></i>
                    </router-link>
                    <button
                      type="button"
                      class="btn btn-danger btn-sm"
                      @click.prevent="delCliente(item.id, item.nombre)"
                    >
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
      <!-- /.card -->
    </section>

    <div class="modal fade" id="showClientes">
      <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <b
              ><i class="fas fa-user-tag"></i> {{ datosPorCliente.nombre }}
              {{ datosPorCliente.apellidos }}</b
            >
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <ul class="ml-4 mb-0 fa-ul text-muted">
              <li class="small">
                <span class="fa-li">
                  <i class="far fa-address-card fa-lg"></i>
                </span>
                <b>Documento</b>: {{ datosPorCliente.apellidos }}
              </li>
              <hr />
              <li class="small">
                <span class="fa-li">
                  <i class="fas fa-envelope fa-lg"></i>
                </span>
                <b>Correo</b>: {{ datosPorCliente.email }}
              </li>
              <hr />
              <li class="small">
                <span class="fa-li"> <i class="fas fa-phone fa-lg"></i> </span>
                <b>Teléfono</b>: {{ datosPorCliente.telefono }}
              </li>
              <hr />
              <li class="small">
                <span class="fa-li">
                  <i class="fas fa-map-marker-alt fa-lg"></i>
                </span>
                <b>Dirección</b>: {{ datosPorCliente.direccion }}
              </li>
              <hr />
              <li class="small">
                <span class="fa-li">
                  <i class="fas fa-calendar-alt fa-lg"></i>
                </span>
                <b>Fecha Nacimiento:</b> {{ datosPorCliente.fecha_nacimiento }}
              </li>
              <hr />
              <li class="small">
                <span class="fa-li">
                  <i class="fas fa-shopping-basket fa-lg"></i>
                </span>
                <b>Total Compras:</b> {{ datosPorCliente.compras }}
              </li>
              <hr />
              <li class="small">
                <span class="fa-li">
                  <i class="fas fa-shopping-bag fa-lg"></i>
                </span>
                <b>Última Compra:</b>
                <template v-if="datosPorCliente.ultima_compra != null">
                  {{ datosPorCliente.ultima_compra }}
                </template>
                <template v-else> **** </template>
              </li>
              <hr />
              <li class="small">
                <span class="fa-li"> <i class="fas fa-lg fa-male"></i> </span>
                <b>Estado</b>:
                <span
                  style="cursor: pointer"
                  v-if="datosPorCliente.estado === 0"
                  class="right badge badge-success"
                  >Activo</span
                >
                <span
                  style="cursor: pointer"
                  v-else-if="datosPorCliente.estado === 1"
                  class="right badge badge-danger"
                  >Inactivo</span
                >
                <span v-else class="right badge badge-danger">Error</span>
              </li>
            </ul>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  </div>
</template>

  <script>
export default {
  mounted() {
    console.log("Component index.");
  },
  data() {
    return {
      listClientes: [],
      datosPorCliente: [],
    };
  },
  created() {
    this.setListaClientes();
  },
  methods: {
    setListaClientes() {
      axios
        .get("/cliente/getListarClientes")
        .then((rpta) => {
          this.listClientes = rpta.data;
          console.log(rpta.data);
        })
        .catch((err) => {
          toastr.error("Ocurrió un error al motrar registro.");
        });
    },
    getDatosPorCliente(id) {
      axios
        .get("/cliente/getListarPorCliente/" + id)
        .then((rpta) => {
          // this.datosPorCliente.push(rpta.data)
          this.datosPorCliente = rpta.data;
        })
        .catch((err) => {
            toastr.error(err);
        });
    },
    delCliente(id, nom) {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success mr-2",
          cancelButton: "btn btn-danger mr-2",
        },
        buttonsStyling: false,
      });

      swalWithBootstrapButtons
        .fire({
          title: "¿Desea eliminar " + nom + "?",
          text: "¡No podrá revertir esta acción!",
          icon: "question",
          showCancelButton: true,
          confirmButtonText: "Si, eliminar!",
          cancelButtonText: "No, cancelar!",
          reverseButtons: true,
        })
        .then((result) => {
          if (result.isConfirmed) {
            axios
              .delete("/cliente/delCliente/" + id)
              .then((response) => {
                toastr.success("Cliente " + nom + " eliminado.");
                this.setListaClientes();
              })
              .catch((error) => {
                toastr.error(error);
              });
          }
        });
    },
    cambiarEstadoCliente(e, id) {
      //0: activo    1: inactivo
      let estado = e == 1 ? 0 : 1; //Si viene en 1 me lo cambia a 0 y si viene en 0 me lo cambia a 1
      let tipoestado = estado == 1 ? "Inactivo" : "Activo";
      axios
        .post("/cliente/cambiarEstadoCliente/" + id, {
          estado: estado,
        })
        .then((rpta) => {
          Swal.fire({
            position: "top-center",
            icon: "success",
            title: "Pasó a estado " + tipoestado,
            showConfirmButton: false,
            timer: 1500,
          });
          this.setListaClientes();
        })
        .catch((error) => {
          toastr.error(error);
        });
    },
  },
};
</script>
