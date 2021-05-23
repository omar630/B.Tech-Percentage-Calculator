@extends('admin.layouts.app')
@section('content')
<!-- Header -->
<!-- Header -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Subject Types</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="#">Subject Types</a></li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <a href="#" class="btn btn-sm btn-neutral" onclick="$('#add-subject-type-modal').modal('show')">New</a>
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
          <h3 class="mb-0">Subject Types</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col" class="sort" data-sort="name">Subject Type</th>
                <th scope="col">Subjects count</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="list">
              @foreach($subjectTypes as $subjectType)
              <tr id="branch-{{ $subjectType->id }}">
                <th scope="row">
                  <div class="media align-items-center">
                    <div class="media-body">
                      <span class="name mb-0 text-sm" id="branch-name-{{ $subjectType->id }}">{{ $subjectType->name }}</span>
                    </div>
                  </div>
                </th>
                <td>
                  <span class="badge badge-dot mr-4">
                    <i class="bg-success"></i>
                    <span class="status">{{ $subjectType->subject_count }}</span>
                  </span>
                </td>
                <td class="text-right">
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <a class="dropdown-item" href="#" onclick="openEditModal({{ $subjectType->id }},'{{ $subjectType->name }}')">Edit</a>
                      <a class="dropdown-item" href="#" onclick="deleteBranch({{ $subjectType->id }})">Delete</a>
                    </div>
                  </div>
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
<!-- modal for edit -->
<div class="modal fade" id="edit-subject-type-modal" tabindex="-1" role="dialog" aria-labelledby="edit-subject-type-modal" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-header bg-transparent pb-5">
            <form role="form" id="edit-subject-type-form" method="POST" action="{{ route('admin.subject-type.update.post') }}">
              <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni"></i></span>
                  </div>
                  <input class="form-control" type="hidden" name="subject_type_id">
                  <input class="form-control" placeholder="Subject Type" type="text" name="subject_type_name">
                </div>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary my-4">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- modal end for edit -->
<!-- modal for add -->
<div class="modal fade" id="add-subject-type-modal" tabindex="-1" role="dialog" aria-labelledby="add-modal" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-header bg-transparent pb-5">
            <form role="form" id="add-branch-form" method="POST" action="{{ route('admin.subject-type.add.post') }}">
              <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni"></i></span>
                  </div>
                  <input class="form-control" placeholder="Branch" type="text" name="subject_type_name">
                </div>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary my-4">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- modal end for add -->
@endsection
@section('js')
<script>
  function openEditModal(subject_type_id, branch){
    $('#edit-subject-type-modal input[name="subject_type_name"]').val(branch);
    $('#edit-subject-type-modal input[name="subject_type_id"]').val(subject_type_id);
    $('#edit-subject-type-modal').modal('show');
  }

  function deleteBranch(subject_type_id) {
    $.ajax({
      type: "DELETE",
      url: "{{ route('admin.subject-type.delete.post') }}",
      data: {
        "subject_type_id": subject_type_id,
      },
      success: function(data) {
        if(data.error == false) {
          location.reload();
        }
      }
    });
  }

  $('#edit-subject-type-form').on('submit', function(e) {
    e.preventDefault();
    var form = $(e.target);
    $.ajax({
      type: "POST",
      url: $(form).attr('action'),
      data: {
        "subject_type_id": $(form).find("input[name='subject_type_id']").val(),
        "subject_type_name": $(form).find("input[name='subject_type_name']").val()
      }
    });
  })
  $('#add-branch-form').on('submit', function(e) {
    e.preventDefault();
    var form = $(e.target);
    $.ajax({
      type: "PUT",
      url: $(form).attr('action'),
      data: {
        "subject_type_name": $(form).find("input[name='subject_type_name']").val()
      },
      success: function(data) {
        if(data.error == false) {
          location.reload();
        }
      }
    });
  })
</script>
@endsection