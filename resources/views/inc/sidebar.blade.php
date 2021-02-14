<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
  <div class="main-navbar">
    <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
      <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
        <div class="d-table m-auto">
          <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="{{ asset('shards_template/images/shards-dashboards-logo.svg') }}" alt="Shards Dashboard">
          <span class="d-none d-md-inline ml-1">{{ config('app.name')}}</span>
        </div>
      </a>
      <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
        <i class="material-icons">&#xE5C4;</i>
      </a>
    </nav>
  </div>
  <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
    <div class="input-group input-group-seamless ml-3">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <i class="fas fa-search"></i>
        </div>
      </div>
      <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>
    </form>
    <div class="nav-wrapper">
      <ul class="nav flex-column">
        
        @if(Auth::user()->is_pw_changed)
        <li class="nav-item">
          <a class="nav-link {{ $sidebar == 'Home' ? 'active' : ' ' }}" href="{{ asset('/home') }}">
            <i class="material-icons">dashboard_customize</i>
            <span>Home</span>
          </a>
        </li>
        
        @if(Auth::user()->is_user_mgt)
        <li class="nav-item">
          <a class="nav-link {{ $sidebar == 'User Management' ? 'active' : ' ' }}" href="{{ asset('/user_mgt') }}">
            <i class="material-icons">face</i>
            <span>User Management</span>
          </a>
        </li>
        @endif
        
        @endif
        
        <li class="nav-item">
          <a class="nav-link {{ $sidebar == 'Change Password' ? 'active' : ' ' }}" href="{{ asset('/change_pass') }}/{{Auth::user()->id}}/edit">
            <i class="material-icons">lock</i>
            <span>Change Password</span>
          </a>
        </li>
        
        {{-- <li class="nav-item">
          <a class="nav-link " href="add-new-post.html">
            <i class="material-icons">note_add</i>
            <span>Add New Post</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="form-components.html">
            <i class="material-icons">view_module</i>
            <span>Forms &amp; Components</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="tables.html">
            <i class="material-icons">table_chart</i>
            <span>Tables</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="user-profile-lite.html">
            <i class="material-icons">person</i>
            <span>User Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="errors.html">
            <i class="material-icons">error</i>
            <span>Errors</span>
          </a>
        </li> --}}
        
      </ul>
    </div>
  </aside>