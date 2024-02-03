  
  <script src="{{ asset('js/app.js') }}" defer></script>
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <div id="app">
     <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion layout-fixed" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Marothon</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item ">
        <a class="nav-link @yield('dashborad')" href="/dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Divider -->

      <li class="nav-item @yield('product-active')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#product" aria-expanded="true" aria-controls="product">
           <i class="fas fa-fw fa-folder"></i>
          <span>Products</span>
        </a>
        <div id="product" class="collapse @yield('product')" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item @yield('products')" href="/product">List Products</a>
            <a class="collapse-item @yield('product_create')" href="/product/create">Add Product</a>
          </div>
        </div>
      </li>
      @role('admin')

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item @yield('main-active')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#main" aria-expanded="true" aria-controls="main">
           <i class="fas fa-fw fa-folder"></i>
          <span>Main</span>
        </a>
        <div id="main" class="collapse @yield('main')" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item @yield('post')" href="/post">Post</a>
            <a class="collapse-item @yield('kategori')" href="/kategori">Kategori</a>
            <a class="collapse-item @yield('tag')" href="/tag">Tag</a>
            <a class="collapse-item @yield('banner')" href="/banner">Banner</a>
          </div>
        </div>
      </li>
      @endrole
     
      @role('admin')
          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item @yield('user-active')">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#user" aria-expanded="true" aria-controls="user">
              <i class="fas fa-fw fa-users"></i>
              <span>User</span>
            </a>
            <div id="user" class="collapse @yield('user')" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item @yield('admin')" href="/admin">Admin</a>
                <a class="collapse-item @yield('view')" href="/view">View</a>
              </div>
            </div>
          </li>
      @endrole

      @role('owner')
          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item @yield('student-active')">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#student" aria-expanded="true" aria-controls="student">
              <i class="fas fa-users"></i>
              <span>Student</span>
            </a>
            <div id="student" class="collapse @yield('students')" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item @yield('student')" href="/student">
                  <i class="fas fa-user-graduate"></i>
                  &nbsp; List Student
                </a>
                <a class="collapse-item @yield('student_create')" href="student/create"> 
                  <i class='fa fa-sitemap'></i>
                  &nbsp;Create Student
                </a>
              </div>
            </div>
          </li>
      @endrole

      @role('owner')
          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item @yield('floor-active')">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#floor" aria-expanded="true" aria-controls="floor">
              <i class="fas fa-building"></i>
              <span>Floor</span>
            </a>
            <div id="floor" class="collapse @yield('floors')" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item @yield('floor')" href="/floor">
                  <i class='fas fa-city fa-pulse'></i>
                  &nbsp; List Floor
                </a>
                <a class="collapse-item @yield('floor_create')" href="/floor/create">
                  <i class='fa fa-plus-circle fa-pulse'></i>
                  &nbsp; Create Floor
                </a>
              </div>
            </div>
          </li>
      @endrole
      @role('owner')
          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item @yield('class-active')">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#class" aria-expanded="true" aria-controls="floor">
              <i class="fas fa-building"></i>
              <span>Class</span>
            </a>
            <div id="class" class="collapse @yield('class')" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item @yield('classs')" href="/class">
                  <i class='fas fa-city fa-pulse'></i>
                  &nbsp; List Class
                </a>
                <a class="collapse-item @yield('class_create')" href="/class/create">
                  <i class='fa fa-plus-circle fa-pulse'></i>
                  &nbsp; Create Class
                </a>
              </div>
            </div>
          </li>
      @endrole

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item @yield('pengaturan-active')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pengaturan" aria-expanded="true" aria-controls="pengaturan">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Setting</span>
        </a>
        <div id="pengaturan" class="collapse @yield('pengaturan')" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item @yield('logo')" href="/logo">Logo</a>
            <a class="collapse-item @yield('footer')" href="/footer">Footer</a>
            <a class="collapse-item @yield('contact')" href="contact">Contact</a>
            <a class="collapse-item @yield('brand')" href="/brand">Brand</a>
            <a class="collapse-item @yield('category')" href="/category">Category</a>
            <a class="collapse-item @yield('unit')" href="/unit">Unit</a>
          </div>
        </div>
      </li>

       <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="/">
          <i class="fas fa-arrow-left"></i>
          <span>View</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>

</div>
<script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js')  }}"></script>
