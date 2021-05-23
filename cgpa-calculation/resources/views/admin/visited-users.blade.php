@extends('admin.layouts.app')
@section('content')
<!-- Header -->
<!-- Header -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Visitors</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="#">Visitors</a></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
          <h3 class="mb-0">Visitors</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush" id="demo">
            <thead class="thead-light">
              <tr>
                <th scope="col" class="sort" data-sort="name">name</th>
                <th scope="col">Regulation</th>
                <th scope="col">Branch</th>
                <th scope="col">Time</th>
                <th scope="col">Location</th>
              </tr>
            </thead>
            <tbody class="list">
              @foreach($visitedUsers as $user)
              <tr>
                <th scope="row">
                  <div class="media align-items-center">
                    <div class="media-body">
                      <span class="name mb-0 text-sm">{{ $user->name }}</span>
                    </div>
                  </div>
                </th>

                <td>
                  <span class="badge badge-dot mr-4">
                    <i class="bg-success"></i>
                    <span class="status">{{ $user->regulation->regulation ?? '-' }}</span>
                  </span>
                </td>
                <td>
                  <span class="badge badge-dot mr-4">
                    <i class="bg-success"></i>
                    <span class="status">{{ $user->branch->branch ?? '-' }}</span>
                  </span>
                </td>
                <td>
                  <span class="badge badge-dot mr-4">
                    <i class="bg-success"></i>
                    <span class="status">{{ $user->created_at->format('d-M-y g:i a') ?? '-' }}</span>
                  </span>
                </td>
                <td>
                  <span class="badge badge-dot mr-4">
                    <i class="bg-success"></i>
                    <span class="status">{{ $user->location['cityName'] ?? '-' }}</span>
                  </span>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script>
  $(document).ready(function(){
  $('#demo').DataTable();
  })
</script>
@endsection