<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script type="text/javascript">
      csrf_token = document.getElementsByName('csrf-token')[0].content;
  </script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Admin</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('admin/assets/img/brand/favicon.png')}}" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{ asset('admin/assets/css/argon.css?v=1.2.0')}}" type="text/css">
  <link href="{{ asset('admin/assets/css/pnotify/pnotify.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/assets/css/pnotify/pnotify.buttons.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/assets/css/pnotify/pnotify.nonblock.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tablefilter/2.5.0/filtergrid.min.css" integrity="sha512-/quVzW/6iogTlP6O3wOteqTbtuuzGkBjlu9May8avJQCWQv4Esp+avyCnlRcOG72z4GYD1sjs2bLEC7ps+FbfQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body >
  <!-- Main content -->
  @if(auth()->check() && auth()->user()->isAdmin())  @include('admin.layouts.side-nav') @endif
  <div class="main-content" id="panel">
    <!-- Page content -->
    @if(auth()->check() && auth()->user()->isAdmin())
    @include('admin.layouts.top-nav')
    @endif
    @include('admin.layouts.alerts')
    @yield('content')
    <!-- Page Content -->
    <!-- Footer -->
    {{-- @include('admin.layouts.footer') --}}
  </div>
    <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ asset('admin/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset('admin/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('admin/assets/vendor/js-cookie/js.cookie.js')}}"></script>
  <script src="{{ asset('admin/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
  <script src="{{ asset('admin/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
  <!-- Argon JS -->
  <script src="{{ asset('admin/assets/js/argon.js?v=1.2.0')}}"></script>
  <script src="{{ asset('admin/assets/js/pnotify/pnotify.js')}}"></script>
        <script src="{{ asset('admin/assets/js/pnotify/pnotify.buttons.js')}}"></script>
        <script src="{{ asset('admin/assets/js/pnotify/pnotify.nonblock.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tablefilter/2.5.0/tablefilter_min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/cr-1.5.3/date-1.0.3/r-2.2.7/rr-1.2.7/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.3/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.24/cr-1.5.3/date-1.0.3/r-2.2.7/rr-1.2.7/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.3/datatables.min.js"></script>

  <script type="text/javascript">
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        });
        $(document).ajaxSuccess(function(event, request, settings) {
          console.log('from common success')
          var response = request.responseJSON;
          if(response){
            if(response.message.notify){
              var notify = response.message.notify;
              new PNotify({title: notify.type,text: notify.message,type: notify.type,styling: 'bootstrap3'});
            }
          }
        });
        $(document).ajaxError(function(event, request, settings) {
          var response = request.responseJSON;
          console.log('from common error')
          if(response.message){
            if(response.message.notify){
              var notify = response.message.notify;
              new PNotify({title: 'Error',text: notify.message,type: 'error',styling: 'bootstrap3'});
            }
          }
          else{
            new PNotify({title: 'Error',text: "Some problem occured, Please try again",type: 'error',styling: 'bootstrap3'});
          }
        });
        </script>
  @yield('js')
</body>

</html>