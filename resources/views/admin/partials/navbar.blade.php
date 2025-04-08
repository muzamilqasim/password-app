<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
          <a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
              <img src="{{ getImage('assets/admin/images/profile/'. auth('admin')->user()->image) }}" class='img-circle elevation-2' width="40" height="40" alt="">
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
              <h4 class="h4 mb-0"><strong>{{ auth('admin')->user()->name }}</strong></h4>
              <div class="mb-3">{{ auth('admin')->user()->email }}</div>
              <div class="dropdown-divider"></div>
              <div class="dropdown-divider"></div>
              <a href="{{ route('admin.profile') }}" class="dropdown-item {{ menuActive(['admin.profile']) }}">
                  <i class="fas fa-cog mr-2"></i> Profile Setting
              </a>
              <a href="{{ route('admin.password') }}" class="dropdown-item {{ menuActive(['admin.password']) }}">
                  <i class="fas fa-lock mr-2"></i> Change Password
              </a>
              <div class="dropdown-divider"></div>
              <a href="{{ route('admin.logout') }}" class="dropdown-item text-danger">
                  <i class="fas fa-sign-out-alt mr-2"></i> Logout                         
              </a>                            
          </div>
      </li>
  </ul>
  </nav>