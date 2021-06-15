<!-- Navbar -->
<nav class="main-header navbar navbar-expand shadow navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    {{-- <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-bell nav-icon"></i>
          <span class="badge badge-warning navbar-badge small"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
    </ul> --}}
    

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    {{-- <div class="navbar-custom-menu"> --}}
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      {{-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-bell nav-icon"></i>
          <span class="badge badge-warning navbar-badge small"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li> --}}
    </ul>
    <ul class="navbar-nav ml-auto">
      <div class="dropdown user user-menu text">
        <a href="" class="dropdown-toggle" data-toggle="dropdown">
          <span>{{ Auth::user()->name }}</span>
          <img src="./img/profile.png" class="user-image" alt="User Image">
        </a>
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="sidebarIcon">
          <!-- User image -->
          <li class="user-header">
            <img src="./img/profile.png" class="img-circle" alt="User Image">

            <p>
              {{ Auth::user()->name }} - {{ Auth::user()->email }}
              <small>Member since {{ Auth::user()->created_at}}</small>
            </p>
          </li>
          <!-- Menu Body -->
          <li class="user-body">
            <div class="center">
              <router-link to="/profile">
                <button type="button" class="btn btn-success">Profile</button>
              </router-link>  

             {{--  <router-link to="{{ route('logout') }}">
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                  <button class="btn btn-danger">
                    {{ __('Logout') }}
                  </button>
              </router-link> --}}
             
                <a class="nav-link" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                    <button class="btn btn-danger">
                      {{ __('Logout') }}
                    </button>
                </a>
              
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                 </form>
            
              {{--
              <button type="submit" class="btn btn-danger"><router-link to="#">Logout</router-link></button> --}}
            </div>
            <!-- /.row -->
          </li>
          <!-- Menu Footer-->
          {{-- <li class="user-footer">
            <div class="pull-right">
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                <button type ="submit" class="btn btn-default btn-flat">Log out</button>
              </form>
            </div>
          </li> --}}
        </ul>
      </div>
    </ul>

  </nav>
  <!-- /.navbar -->