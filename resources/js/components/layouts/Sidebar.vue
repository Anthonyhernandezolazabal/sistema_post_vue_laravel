<template>
  <div>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../../index3.html" class="brand-link">
        <img
          :src="'img/icono-blanco.png'"
          alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3"
          style="opacity: 0.8"
        />
        <span class="brand-text font-weight-light">Post Venta 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img
              :src="'./img/user2-160x160.jpg'"
              class="img-circle elevation-2"
              alt="User Image"
            />
          </div>
          <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input
              class="form-control form-control-sidebar"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul
            class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            role="menu"
            data-accordion="false"
          >
            <li class="nav-header">NAVEGACIÓN</li>
            <li class="nav-item">

            <router-link :to="'/'" class="nav-link">
                <i class="nav-icon far fas fa-home"></i>
                <p>Inicio</p>
            </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="'usuarios'" class="nav-link">
                <i class="nav-icon far fa fa-user"></i>
                <p>Usuarios</p>
              </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="'categorias'"  class="nav-link">
                    <i class="nav-icon far fas fa-th"></i>
                    <p>Categorías</p>
                </router-link>
            </li>
            <li class="nav-item">
              <a href="../widgets.html" class="nav-link">
                <i class="nav-icon fab fa-product-hunt"></i>
                <p>Productos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="clientes" class="nav-link">
                <i class="nav-icon far fas fa-users"></i>
                <p>Clientes</p>
              </a>
            </li>
            <li class="nav-header">VENTAS</li>
            <li class="nav-item">
              <a href="ventas" class="nav-link">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>Administrar Ventas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="crear-venta" class="nav-link">
                <i class="nav-icon fas fa-shopping-basket"></i>
                <p>Crear Ventas</p>
              </a>
            </li>
            <li class="nav-header">REPORTES</li>
            <li class="nav-item">
              <a href="reportes" class="nav-link">
                <i class="nav-icon far fa-file-powerpoint"></i>
                <p>Reporte de Ventas</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
