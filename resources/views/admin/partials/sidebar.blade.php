<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <img src="{{ getImage(getFilePath('logoIcon') .'/logo.png') }}" alt="Admin Logo" class="brand-image">
      <span class="brand-text font-weight-light"><b>{{ ($general->site_title) ? $general->site_title : 'Admin Panel' }}</b></span>
    </a>
    <div class="sidebar">
      <div class="form-inline mt-3 p-1">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ menuActive('admin.dashboard') }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
        <li class="nav-item">
            <a href="{{ route('admin.app.index') }}" class="nav-link {{ menuActive(['admin.app.*']) }}">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Passwords & Keys
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.setting.logo.icon') }}" class="nav-link {{ menuActive(['admin.setting.logo.icon.*']) }}">
              <i class="nav-icon fas fa-image"></i>
              <p>
                Logo / Favicon
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.setting.index') }}" class="nav-link {{ menuActive(['admin.setting.index.*']) }}">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                General Setting
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>