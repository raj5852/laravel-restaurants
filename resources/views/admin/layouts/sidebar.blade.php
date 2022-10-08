 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link text-center">
     
      <span class="brand-text font-weight-light"><b>User</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="{{ route('home') }}" class="nav-link {{ request()->is('home')?'active':'' }} ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
           
          </li>
          <li class="nav-item">
            <a href="{{ route('category') }}" class="nav-link {{ request()->is('category')?'active':'' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Category
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('table') }}" class="nav-link {{ request()->is('table')?'active':'' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Table
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('tax') }}" class="nav-link {{ request()->is('tax')?'active':'' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Tax
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('product') }}" class="nav-link {{ request()->is('product')?'active':'' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Product
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('user') }}" class="nav-link {{ request()->is('user')?'active':'' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                User
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('order') }}" class="nav-link {{ request()->is('order')?'active':'' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Order
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
