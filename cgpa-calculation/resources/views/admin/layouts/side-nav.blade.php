<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
  <div class="scrollbar-inner">
    <!-- Brand -->
    <div class="sidenav-header  align-items-center">
      <a class="navbar-brand" href="javascript:void(0)">
        <img src="../assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
      </a>
    </div>
    <div class="navbar-inner">
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Nav items -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.dashboard') }}">
              <i class="ni ni-tv-2 text-primary"></i>
              <span class="nav-link-text">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.regulation.get') }}">
              <i class="ni ni-archive-2 text-orange"></i>
              <span class="nav-link-text">Regulations</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.branch.get') }}">
              <i class="ni ni-map-big text-orange"></i>
              <span class="nav-link-text">Branches</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.subject-type.get') }}">
              <i class="ni ni-single-copy-04 text-primary"></i>
              <span class="nav-link-text">Subject Types</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.subject.get') }}">
              <i class="ni ni-book-bookmark text-orange"></i>
              <span class="nav-link-text">Subjects</span>
            </a>
          </li>
          @if(auth()->user()->hasAnyRole(['super-admin']))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.visited-user.get') }}">
              <i class="ni ni-chart-bar-32"></i>
              <span class="nav-link-text">Visitors</span>
            </a>
          </li>
          @endif
          @if(auth()->user()->hasAnyRole(['super-admin']))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.registered-user.get') }}">
              <i class="ni ni-chart-bar-32"></i>
              <span class="nav-link-text">Registered Users</span>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" href="{{ route('user.profile') }}">
              <i class="ni ni-single-02 text-yellow"></i>
              <span class="nav-link-text">Profile</span>
            </a>
          </li>
        </ul>
        </ul>
      </div>
    </div>
  </div>
</nav>