<template>
    <div>
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><i class="nav-icon far fas fa-tag"></i> Administrar marcas</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Marcas</li>
              </ol>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </section>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-4">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-edit"></i>
                    Registrar Marca
                  </h3>
                </div>
                <div class="card-body">
                  <!-- ENTRADA PARA EL NOMBRE -->
                  <div class="input-group mb-0">
                    <div class="input-group-prepend">
                      <span class="input-group-text"
                        ><i class="far fas fa-th"></i
                      ></span>
                    </div>
                    <input
                      type="text"
                      class="form-control"
                      v-model="fillCrearMarca.cNombre"
                      placeholder="Ingresar Marca"
                      @keyup.enter="setRegistrarMarca"
                    />
                  </div>
                  <small
                    class="text-danger"
                    v-if="validarcampo"
                    v-text="msmvalidar"
                  ></small>
                  <button
                    class="btn btn-primary btn-block btn-flat mt-3"
                    @click.prevent="setRegistrarMarca"
                    :disabled="fullscreenLoading"
                  >
                Marca    Registrar
                  </button>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card card-info card-outline">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-list"></i>
                    Marca
                  </h3>
                </div>
                <div class="card-body">
                  <table class="table table-striped projects">
                    <thead>
                      <tr>
                        <th style="width: 1%">N°</th>
                        <th style="width: 30%">Marca</th>
                        <th style="width: 2%" class="text-center">Estado</th>
                        <th style="width: 8%" class="text-center">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="item in listMarcas" :key="item.id">
                        <td v-text="item.id"></td>
                        <td v-text="item.nombre"></td>
                        <td class="project-state text-center">
                          <span
                            style="cursor: pointer"
                            v-if="item.estado === 0"
                            class="badge badge-success"
                            v-on:click="cambiarEstado(item.estado,item.id)"
                            >Activo</span
                          >
                          <span
                            style="cursor: pointer"
                            v-else-if="item.estado === 1"
                            class="badge badge-danger"
                            v-on:click="cambiarEstado(item.estado,item.id)"
                            >Inactivo</span
                          >
                          <span v-else class="badge badge-danger">Error</span>
                        </td>
                        <td class="project-actions text-center">
                          <button
                            class="btn btn-warning btn-sm"
                            type="button"
                            v-on:click="showEdit(item.id, item.nombre)"
                          >
                            <i class="fas fa-pencil-alt"> </i>
                          </button>
                          <button
                            class="btn btn-danger btn-sm"
                            type="button"
                            v-on:click="delMarca(item.id, item.nombre)"
                          >
                            <i class="fas fa-trash"> </i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
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
        fillCrearMarca: {
          cNombre: "",
          cEstado: 0,
        },
        validarcampo: false,
        msmvalidar: "",
        strCat: "",
        fullscreenLoading: false,
        listMarcas: [],
      };
    },
    created() {
      this.getListarMarca();
    },
    methods: {
      getListarMarca() {
        axios
          .get("/marca/getListarMarca")
          .then((rpta) => (this.listMarcas = rpta.data))
          .catch(function (error) {
            // handle error
            toastr.error("Ocurrió un error al motrar registro.");
          });
      },
      setRegistrarMarca() {
        console.log("pruebaaaa... :", this.fillCrearMarca.cNombre);
        this.fullscreenLoading = true;
        if (!this.fillCrearMarca.cNombre) {
          this.msmvalidar = "Este campo es obligatorio.";
          this.validarcampo = true;
          this.fullscreenLoading = false;
        } else {
          axios
            .post("/marca/setRegistrarMarca", {
              nombre: this.fillCrearMarca.cNombre,
              estado: this.fillCrearMarca.cEstado,
            })
            .then((response) => {
              toastr.success(
                "Marca " + this.fillCrearMarca.cNombre + " registrado."
              );
              this.validarcampo = false;
              this.fullscreenLoading = false;
              this.fillCrearMarca.cNombre = "";
              this.getListarMarca();
            })
            .catch((error) => {
              this.fullscreenLoading = false;
            });
        }
      },
      delMarca(id, nom) {
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
                .delete("/marca/delMarca/" + id)
                .then((response) => {
                  console.log("deleted :", response);
                  toastr.success("Marca " + nom + " eliminado.");
                  this.getListarMarca();
                })
                .catch((error) => {
                  toastr.error(error);
                });
            }
          });
      },
      showEdit(id,nom) {
        Swal.fire({
          title: "Editar Marca",
          input: "text",
          showCancelButton: true,
          confirmButtonText: "Guardar",
          cancelButtonText: "Cancelar",
          inputValue: nom,
          inputValidator: (nombre) => {
            // Si el valor es válido, debes regresar undefined. Si no, una cadena
            if (!nombre) {
              return "Este campo es obligatorio.";
            } else {
              return undefined;
            }
          },
        }).then((resultado) => {
          if (resultado.value) {
            axios.post('/marca/editMarca/'+id,{
              'nombre': resultado.value
            }).then(rpta => {
              toastr.success(
                "La Marca se ha editado."
              );
              this.getListarMarca();
            }).catch(error => {
              toastr.error(error);
            })
          }
        });
      },
      cambiarEstado(e,id){
        //0: activo    1: inactivo
        let estado = e == 1 ? 0 : 1; //Si viene en 1 me lo cambia a 0 y si viene en 0 me lo cambia a 1
        let tipoestado = estado == 1 ? 'Inactivo' : 'Activo'
        axios.post('/marca/editMarca/'+id,{
          'estado': estado
        }).then(rpta => {
          Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: 'Pasó a estado '+tipoestado,
            showConfirmButton: false,
            timer: 1500
          })
          this.getListarMarca();
        }).catch(error => {
          toastr.error(error);
        })
      }
    },
  };
  </script>
