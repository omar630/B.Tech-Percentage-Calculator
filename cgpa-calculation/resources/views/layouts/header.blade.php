<link rel="apple-touch-icon" sizes="180x180" href="{{url('assets/img/apple-touch-icon.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{url('assets/img/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{url('assets/img/favicon-16x16.png')}}">
<link rel="mask-icon" href="{{url('assets/img/safari-pinned-tab.svg')}}" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
rel="stylesheet"
/>
<!-- Google Fonts -->
<link
href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
rel="stylesheet"
/>
<!-- MDB -->
<link
href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.5.0/mdb.min.css"
rel="stylesheet"
/>
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<!-- MDB -->
<script
type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.5.0/mdb.min.js"
></script>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button
    class="navbar-toggler"
    type="button"
    data-mdb-toggle="collapse"
    data-mdb-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent"
    aria-expanded="false"
    aria-label="Toggle navigation"
    >
    <i class="fas fa-bars"></i>
  </button>

  <!-- Collapsible wrapper -->
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <!-- Navbar brand -->
    <a class="navbar-brand mt-2 mt-lg-0" href="{{ route('home') }}">
      <img src="{{url('assets/img/safari-pinned-tab.svg')}}" width="30" height="30" alt="logo" loading="lazy">
    </a>
    <!-- Left links -->
    {{-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link" href="">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Team</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Projects</a>
      </li>
    </ul> --}}
    <!-- Left links -->
  </div>
  <!-- Collapsible wrapper -->

  <!-- Right elements -->
  <div class="d-flex align-items-center">
    <!-- Icon -->
    <a class="text-reset me-3" href="mailto:omarmd2311@gmail.com?subject=ContactUs">
      Contact Us
    </a>
    <a class="text-reset me-3" href="mailto:omarmd2311@gmail.com?subject=Report">
      Report
    </a>

    {{-- <!-- Notifications -->
      <a
      class="text-reset me-3 dropdown-toggle hidden-arrow"
      href="#"
      id="navbarDropdownMenuLink"
      role="button"
      data-mdb-toggle="dropdown"
      aria-expanded="false"
      >
      <i class="fas fa-bell"></i>
      <span class="badge rounded-pill badge-notification bg-danger">1</span>
    </a> --}}
    {{-- <ul
      class="dropdown-menu dropdown-menu-end"
      aria-labelledby="navbarDropdownMenuLink"
      >
      <li></li>
    </ul> --}}

    <!-- Avatar -->
    @auth
    <a
    class="dropdown-toggle d-flex align-items-center"
    href="#"
    id="navbarDropdownMenuLink"
    role="button"
    data-mdb-toggle="dropdown"
    aria-expanded="false"
    >
    <i class="fas fa-user"></i> {{ auth()->user()->name }}
  </a>
  @else
   <div class="d-flex align-items-center">
        <button type="button" class="btn btn-link px-3 me-2" onclick="window.location='{{ route('login') }}'">
          Login
        </button>
        <button type="button" class="btn btn-primary me-3" onclick="window.location='{{ route('register') }}'">
          Sign up for free
        </button>
      </div>
    </div>
  @endauth
  <ul
  class="dropdown-menu dropdown-menu-end"
  aria-labelledby="navbarDropdownMenuLink"
  >
  @auth
  <li>
    <a class="dropdown-item" href="{{ route('user.profile') }}">My Profile</a>
  </li>
  <li>
    <a class="dropdown-item" href="" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">Logout</a>
    <form action="{{ route('logout') }}" id="logout-form" method="POST">
      @csrf
    </form>
  </li>
  @endauth
</ul>
</div>
<!-- Right elements -->
</div>
<!-- Container wrapper -->
</nav>
</div>
