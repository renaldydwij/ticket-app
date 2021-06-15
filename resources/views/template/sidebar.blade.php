<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
      <img src="./img/logo.png" alt="Ticket Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Support Ticketing</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./img/profile.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="" class="d-block">
            {{ Auth::user()->name }}
          <p>{{ Auth::user()->role }}</p>  
          </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <router-link to="/dashboard" class="nav-link">
                  <i class="fas fa-tachometer-alt nav-icon cyan"></i>
                  <p>
                    Dashboard
                  </p>
                </router-link>
            </li>
            {{-- <li class="nav-item">
                <router-link to="/profile" class="nav-link">
                  <i class="fas fa-user nav-icon indigo"></i>
                  <p>
                    Profile
                  </p>
                </router-link>
            </li> --}}
          
            @can('isAdmin')
            <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                <i class="fas fa-cogs nav-icon yellow"></i>
                <p>
                    Management
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <router-link to="/customer" class="nav-link">
                    <i class="fas fa-user-tie nav-icon green"></i>
                    <p>Customer</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/status" class="nav-link">
                    <i class="fas fa-clipboard nav-icon orange"></i>
                    <p>Status</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/priority" class="nav-link">
                    <i class="fas fa-sticky-note nav-icon purple"></i>
                    <p>Priority</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/user" class="nav-link">
                    <i class="fas fa-users nav-icon indigo"></i>
                    <p>User</p>
                    </router-link>
                </li>
                </ul>
            </li>
            
            <li class="nav-item">
                    <router-link to="/ticket" class="nav-link">
                    <i class="fas fa-ticket-alt nav-icon cyan"></i>
                    <p>
                        Ticket
                    </p>
                    </router-link>
            </li>
            @endcan

            <li class="nav-item">
                    <router-link to="/ticket-user" class="nav-link">
                    <i class="fas fa-ticket-alt nav-icon cyan"></i>
                    <p>
                        Ticket
                    </p>
                    </router-link>
            </li>

            <li class="nav-item">
                    <router-link to="/ticket-admin" class="nav-link">
                    <i class="fas fa-ticket-alt nav-icon cyan"></i>
                    <p>
                        Ticket-Admin
                    </p>
                    </router-link>
            </li>
          

            <li class="nav-item">
                    <router-link to="/rating" class="nav-link">
                    <i class="fas fa-medal nav-icon yellow"></i>
                    <p>
                        Rating
                    </p>
                    </router-link>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt nav-icon red"></i>
                    <p>
                      {{ __('Logout') }}
                    </p>
                </a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                 </form>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>